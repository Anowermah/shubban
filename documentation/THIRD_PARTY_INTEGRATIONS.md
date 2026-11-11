# THIRD-PARTY INTEGRATIONS & EXTERNAL SERVICES

This document details all external APIs, digital payment gateways, cryptographic protocols, cloud messaging services, and PDF engines used by the application, with complete Node.js/TypeScript replacement implementations.

---

## 1. bKash Tokenized Payment Gateway Integration

The application integrates the official **bKash Tokenized Checkout API (v1.2.0-beta)**.

### 1.1 Configuration & Environment Keys
```env
BKASH_SANDBOX=true
BKASH_APP_KEY=your_bkash_app_key
BKASH_APP_SECRET=your_bkash_app_secret
BKASH_USERNAME=your_bkash_username
BKASH_PASSWORD=your_bkash_password
BKASH_MERCHANT_NUMBER=017XXXXXXXX
```

### 1.2 Base URLs
* **Sandbox**: `https://tokenized.sandbox.bka.sh/v1.2.0-beta`
* **Production (Live)**: `https://tokenized.pay.bka.sh/v1.2.0-beta`

### 1.3 Complete API Handshake
1. **Grant Token (`POST /tokenized/checkout/token/grant`)**:
   * Headers: `username`, `password`.
   * Body: `{ "app_key": "...", "app_secret": "..." }`.
   * Returns: `{ "id_token": "...", "token_type": "Bearer", "expires_in": 3600 }`.
2. **Create Payment (`POST /tokenized/checkout/create`)**:
   * Headers: `Authorization: <id_token>`, `X-APP-Key: <app_key>`.
   * Body:
     ```json
     {
       "mode": "0011",
       "payerReference": "donor",
       "callbackURL": "https://shubban.org/donate/bkash/callback",
       "amount": "1000",
       "currency": "BDT",
       "intent": "sale",
       "merchantInvoiceNumber": "inv_65fa8901b2"
     }
     ```
   * Returns: `{ "paymentID": "...", "bkashURL": "..." }`.
3. **Execute Payment (`POST /tokenized/checkout/execute`)**:
   * Headers: `Authorization: <id_token>`, `X-APP-Key: <app_key>`.
   * Body: `{ "paymentID": "..." }`.
   * Returns: `{ "statusCode": "0000", "trxID": "BKA12345678", "transactionStatus": "Completed" }`.

### 1.4 Next.js / TypeScript bKash Service

```typescript
// lib/payments/bkash.ts
export class BkashService {
  private baseUrl: string;
  private appKey: string;
  private appSecret: string;
  private username: string;
  private password: string;

  constructor() {
    const isSandbox = process.env.BKASH_SANDBOX === 'true';
    this.baseUrl = isSandbox
      ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta'
      : 'https://tokenized.pay.bka.sh/v1.2.0-beta';
    this.appKey = process.env.BKASH_APP_KEY!;
    this.appSecret = process.env.BKASH_APP_SECRET!;
    this.username = process.env.BKASH_USERNAME!;
    this.password = process.env.BKASH_PASSWORD!;
  }

  async getToken(): Promise<string> {
    const res = await fetch(`${this.baseUrl}/tokenized/checkout/token/grant`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        username: this.username,
        password: this.password,
      },
      body: JSON.stringify({
        app_key: this.appKey,
        app_secret: this.appSecret,
      }),
    });
    const data = await res.json();
    return data.id_token;
  }

  async createPayment(amount: number, callbackUrl: string) {
    const token = await this.getToken();
    const res = await fetch(`${this.baseUrl}/tokenized/checkout/create`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: token,
        'X-APP-Key': this.appKey,
      },
      body: JSON.stringify({
        mode: '0011',
        payerReference: 'donor',
        callbackURL: callbackUrl,
        amount: amount.toString(),
        currency: 'BDT',
        intent: 'sale',
        merchantInvoiceNumber: `inv_${Date.now()}`,
      }),
    });
    return res.json();
  }

  async executePayment(paymentID: string) {
    const token = await this.getToken();
    const res = await fetch(`${this.baseUrl}/tokenized/checkout/execute`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Authorization: token,
        'X-APP-Key': this.appKey,
      },
      body: JSON.stringify({ paymentID }),
    });
    return res.json();
  }
}
```

---

## 2. Nagad Cryptographic Payment Gateway Integration

Nagad utilizes a custom cryptographic handshake involving 2048-bit RSA asymmetric encryption and digital signatures.

### 2.1 Configuration Keys
```env
NAGAD_SANDBOX=true
NAGAD_MERCHANT_ID=your_nagad_merchant_id
NAGAD_MERCHANT_NUMBER=your_nagad_merchant_number
NAGAD_PUBLIC_KEY="-----BEGIN PUBLIC KEY-----\n...\n-----END PUBLIC KEY-----"
NAGAD_PRIVATE_KEY="-----BEGIN RSA PRIVATE KEY-----\n...\n-----END RSA PRIVATE KEY-----"
NAGAD_CALLBACK_URL="https://shubban.org/api/payment/nagad/callback"
```

### 2.2 Base URLs
* **Sandbox**: `http://sandbox.nagad.com.bd/api/dfs`
* **Production (Live)**: `https://api.nagad.com.bd/api/dfs`

### 2.3 Cryptographic Handshake Protocol
1. **Initialize Payment**:
   * Generate random 32-byte hexadecimal challenge: `crypto.randomBytes(32).toString('hex')`.
   * Construct sensitive JSON: `{ merchantId, datetime: "YYYYMMDDHHmmss", orderId, challenge }`.
   * Encrypt payload using **Nagad Public Key** via RSA PKCS1 padding (`publicEncrypt`).
   * Sign encrypted payload using **Merchant Private Key** with SHA-256 (`sign('sha256')`).
   * Send payload and signature to `/check-out/initialize/{merchantId}/{orderId}`.
2. **Payment Confirmation Request**:
   * On initialize success, send complete payment parameters (`amount`, `currency: 'BDT'`, `challenge`, `callbackURL`).
   * Encrypt and sign payload, send to `callbackUrl` returned by Nagad.
   * Redirect user to Nagad Gateway URL.
3. **Callback Decryption**:
   * On callback, decrypt `payment_ref_id` payload using **Merchant Private Key** (`privateDecrypt`).
   * Parse decrypted order ID and status (`status === 'Success'`).

### 2.4 Next.js / Node.js Native Crypto Implementation

```typescript
// lib/payments/nagad.ts
import crypto from 'crypto';

export class NagadService {
  private baseUrl: string;
  private merchantId: string;
  private publicKey: string;
  private privateKey: string;
  private callbackUrl: string;

  constructor() {
    this.baseUrl = process.env.NAGAD_SANDBOX === 'true'
      ? 'http://sandbox.nagad.com.bd/api/dfs'
      : 'https://api.nagad.com.bd/api/dfs';
    this.merchantId = process.env.NAGAD_MERCHANT_ID!;
    this.publicKey = process.env.NAGAD_PUBLIC_KEY!;
    this.privateKey = process.env.NAGAD_PRIVATE_KEY!;
    this.callbackUrl = process.env.NAGAD_CALLBACK_URL!;
  }

  private encryptSensitiveData(data: string): string {
    const buffer = Buffer.from(data);
    const encrypted = crypto.publicEncrypt(
      {
        key: this.publicKey,
        padding: crypto.constants.RSA_PKCS1_PADDING,
      },
      buffer
    );
    return encrypted.toString('base64');
  }

  private decryptCallbackData(data: string): any {
    const buffer = Buffer.from(data, 'base64');
    const decrypted = crypto.privateDecrypt(
      {
        key: this.privateKey,
        padding: crypto.constants.RSA_PKCS1_PADDING,
      },
      buffer
    );
    return JSON.parse(decrypted.toString('utf8'));
  }

  private generateSignature(data: string): string {
    const sign = crypto.createSign('SHA256');
    sign.update(data);
    sign.end();
    return sign.sign(this.privateKey, 'base64');
  }
}
```

---

## 3. Firebase Cloud Messaging (FCM)

* **Current Implementation (`app/Services/FCMService.php`)**:
  * Calls legacy FCM HTTP v1 endpoint: `https://fcm.googleapis.com/fcm/send`.
  * Sends unicast push notifications to mobile tokens stored in `users.fcm_token`.
  * Sends broadcast notifications to topic: `/topics/{topic}`.
* **Next.js Modern Architecture**:
  * Google has deprecated the legacy HTTP server key endpoint in favor of the **Firebase Admin SDK (HTTP v1)**.
  * Integration package: `firebase-admin`.
  * Credentials stored in `storage/app/firebase/firebase-credentials.json` (as referenced in `config/fcm.php`).

```typescript
// lib/services/fcm.ts
import admin from 'firebase-admin';

if (!admin.apps.length) {
  admin.initializeApp({
    credential: admin.credential.cert({
      projectId: process.env.FIREBASE_PROJECT_ID,
      clientEmail: process.env.FIREBASE_CLIENT_EMAIL,
      privateKey: process.env.FIREBASE_PRIVATE_KEY?.replace(/\\n/g, '\n'),
    }),
  });
}

export async function sendPushNotification(token: string, title: string, body: string) {
  return admin.messaging().send({
    token,
    notification: { title, body },
  });
}
```

---

## 4. Bengali PDF Generation Engine

* **Current Laravel Implementation**:
  * `barryvdh/laravel-dompdf` (Dompdf v3.1).
  * HTML view: `training.pdf` and `admin.training.aref.pdf`.
  * Font: Embedded `Nikosh` and `SolaimanLipi` for Bengali script support.
* **Next.js 15+ Target Engine**:
  * **Option A (Recommended)**: Headless Puppeteer (`puppeteer-core` with Chromium on Linux/Vercel or AWS Lambda) rendering HTML/CSS to PDF with 100% pixel-perfect typographic fidelity for Bengali complex ligatures.
  * **Option B**: `@react-pdf/renderer` with registered TrueType font files:
    ```typescript
    Font.register({
      family: 'SolaimanLipi',
      src: '/fonts/SolaimanLipi.ttf',
    });
    ```

---

## 5. Mozilla PDF.js Publication Viewer

* **Current Architecture**:
  * Standalone PDF.js viewer directory located in `public/pdfjs/` containing `viewer.html` and `viewer.js`.
  * Readers render an `<iframe>` loading `/pdfjs/viewer.html?file=/storage/books/pdfs/...`.
* **Next.js Architecture**:
  * Maintain the standalone `viewer.html` inside `public/pdfjs/` for zero disruption and 100% reading experience fidelity.
  * Alternatively, embed `@react-pdf-viewer/core` for seamless React toolbar styling.

---

## 6. WYSIWYG Content Editing (TinyMCE)

* **Current Architecture**:
  * TinyMCE v5/v6 embedded in Blade views for `Article` body content.
  * Image upload callback routes to `/admin/publications/upload-image`, saving into `articles/content-images/` and returning JSON `{ location: "/storage/..." }`.
* **Next.js Architecture**:
  * Implement `@tinymce/tinymce-react` or modern headless **TipTap (ProseMirror)**.
  * Endpoint `POST /api/admin/upload-image` provides 100% backward-compatible `{ location: "..." }` response.
