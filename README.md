# শুববান ওয়েবসাইট (Shubban Website)

## প্রজেক্ট বর্ণনা (Project Description)

শুববান একটি ইসলামিক সংগঠনের জন্য তৈরি করা একটি ডাইনামিক ওয়েবসাইট। এই ওয়েবসাইটে রয়েছে:

- 🏠 ডাইনামিক হোম পেজ
- 👥 অ্যাডমিন প্যানেল
- 📚 পাবলিকেশন ম্যানেজমেন্ট (বই, ম্যাগাজিন, আর্টিকেল)
- 📸 গ্যালারি ম্যানেজমেন্ট
- 📰 নিউজ ও নোটিশ ম্যানেজমেন্ট
- 👥 সদস্য ম্যানেজমেন্ট
- 📝 ইভেন্ট ম্যানেজমেন্ট
- 📞 যোগাযোগ ফর্ম

## টেকনিক্যাল স্ট্যাক (Technical Stack)

- **ফ্রেমওয়ার্ক:** Laravel 10.x
- **ডাটাবেস:** MySQL
- **ফ্রন্টএন্ড:** Bootstrap 5, jQuery
- **অথেনটিকেশন:** Laravel Breeze
- **ফাইল স্টোরেজ:** Laravel Storage
- **ইমেজ প্রসেসিং:** Intervention Image
- **এডিটর:** TinyMCE

## সিস্টেম রিকোয়ারমেন্ট (System Requirements)

- PHP >= 8.1
- MySQL >= 5.7
- Node.js >= 14
- Composer
- NPM

## ইনস্টলেশন (Installation)

1. রিপোজিটরি ক্লোন করুন:
```bash
git clone https://your-repository-url.git
cd shubban
```

2. কম্পোজার ডিপেন্ডেন্সি ইনস্টল করুন:
```bash
composer install
```

3. NPM ডিপেন্ডেন্সি ইনস্টল করুন:
```bash
npm install
```

4. এনভায়রনমেন্ট ফাইল কপি করুন:
```bash
cp .env.example .env
```

5. অ্যাপ্লিকেশন কী জেনারেট করুন:
```bash
php artisan key:generate
```

6. `.env` ফাইলে ডাটাবেস কনফিগারেশন আপডেট করুন:
```env
DB_DATABASE=shubban
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. মাইগ্রেশন এবং সীডিং চালান:
```bash
php artisan migrate --seed
```

8. স্টোরেজ লিংক তৈরি করুন:
```bash
php artisan storage:link
```

9. অ্যাসেট কম্পাইল করুন:
```bash
npm run dev
```

## সিপ্যানেল ডিপ্লয়মেন্ট (cPanel Deployment)

1. **ফাইল আপলোড:**
   - সমস্ত ফাইল cPanel এ আপলোড করুন
   - public ফোল্ডারের কনটেন্ট public_html এ রাখুন
   - বাকি ফাইলগুলো public_html এর বাইরে রাখুন

2. **PHP সেটিংস:**
   - PHP 8.1 সিলেক্ট করুন
   - প্রয়োজনীয় এক্সটেনশন এনাবল করুন

3. **ডাটাবেস সেটআপ:**
   - MySQL ডাটাবেস তৈরি করুন
   - ডাটাবেস ইউজার তৈরি করুন
   - .env ফাইলে ডাটাবেস কনফিগারেশন আপডেট করুন

4. **কমান্ড লাইন কমান্ডস:**
```bash
composer install --no-dev
php artisan storage:link
php artisan migrate --force
php artisan db:seed
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

5. **পারমিশন সেটিংস:**
```bash
storage symlink রিমুভ করে
rm -rf storage
আবার তৈরি করুন
php artisan storage:link




chmod -R 775 storage bootstrap/cache
```

## অ্যাডমিন লগইন (Admin Login)

- **ইমেইল:** admin@shubban.org
- **পাসওয়ার্ড:** admin123

## ফিচার লিস্ট (Feature List)

### অ্যাডমিন প্যানেল
- ড্যাশবোর্ড
- পাবলিকেশন ম্যানেজমেন্ট
- গ্যালারি ম্যানেজমেন্ট
- নিউজ ম্যানেজমেন্ট
- নোটিশ ম্যানেজমেন্ট
- ইভেন্ট ম্যানেজমেন্ট
- সদস্য ম্যানেজমেন্ট
- যোগাযোগ ম্যানেজমেন্ট

### ফ্রন্টএন্ড
- রেসপনসিভ ডিজাইন
- পাবলিকেশন ভিউ
- গ্যালারি ভিউ
- নিউজ ও নোটিশ
- ইভেন্ট ক্যালেন্ডার
- যোগাযোগ ফর্ম

## ডিরেক্টরি স্ট্রাকচার (Directory Structure)

```
shubban/
├── app/                 # অ্যাপ্লিকেশন লজিক
│   ├── Http/           # কন্ট্রোলার ও মিডলওয়্যার
│   └── Models/         # এলোকোয়েন্ট মডেল
├── config/             # কনফিগারেশন ফাইল
├── database/           # মাইগ্রেশন ও সীডার
├── public/            # পাবলিক অ্যাসেট
├── resources/         # ভিউ ও অ্যাসেট
├── routes/            # রাউট ডেফিনিশন
├── storage/           # আপলোড ফাইল
└── tests/             # টেস্ট কেস
```

## সাপোর্ট (Support)

যদি কোন সমস্যা বা প্রশ্ন থাকে, অনুগ্রহ করে যোগাযোগ করুন:

- **ইমেইল:** support@shubban.org
- **ফোন:** +880-XX-XXXXXXXX

## লাইসেন্স (License)

কপিরাইট © ২০২৫ শুববান। সর্বস্বত্ব সংরক্ষিত।
