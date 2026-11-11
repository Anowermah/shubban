@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">দান করুন</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="donationForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">নাম *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">ইমেইল</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">ফোন নম্বর *</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">টাকার পরিমাণ *</label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                id="amount" name="amount" value="{{ old('amount') }}" min="1" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_method" class="form-label">পেমেন্ট মাধ্যম *</label>
                            <select class="form-select @error('payment_method') is-invalid @enderror" 
                                id="payment_method" name="payment_method" required>
                                <option value="">পেমেন্ট মাধ্যম নির্বাচন করুন</option>
                                @if(config('bkash.app_key'))
                                    <option value="bkash" {{ old('payment_method') == 'bkash' ? 'selected' : '' }}>বিকাশ (অনলাইন পেমেন্ট)</option>
                                @endif
                                <option value="bkash_manual" {{ old('payment_method') == 'bkash_manual' ? 'selected' : '' }}>বিকাশ (ম্যানুয়াল)</option>
                                <option value="nagad" {{ old('payment_method') == 'nagad' ? 'selected' : '' }}>নগদ</option>
                                <option value="rocket" {{ old('payment_method') == 'rocket' ? 'selected' : '' }}>রকেট</option>
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="manualPayment" class="mb-3" style="display: none;">
                            <label for="transaction_id" class="form-label">ট্রানজেকশন আইডি *</label>
                            <input type="text" class="form-control @error('transaction_id') is-invalid @enderror" 
                                id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}">
                            @error('transaction_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">মেসেজ</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                id="message" name="message" rows="3">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="manualPaymentInfo" class="alert alert-info" style="display: none;">
                            <h5>পেমেন্ট নম্বরসমূহ:</h5>
                            <p class="mb-1"><strong>বিকাশ:</strong> {{ $paymentNumbers['bkash']['number'] }} ({{ ucfirst($paymentNumbers['bkash']['type']) }})</p>
                            <p class="mb-1"><strong>নগদ:</strong> {{ $paymentNumbers['nagad']['number'] }} ({{ ucfirst($paymentNumbers['nagad']['type']) }})</p>
                            <p class="mb-1"><strong>রকেট:</strong> {{ $paymentNumbers['rocket']['number'] }} ({{ ucfirst($paymentNumbers['rocket']['type']) }})</p>
                            <small class="text-muted">* Send Money করার পর Transaction ID টি এখানে দিন</small>
                        </div>

                        <button type="submit" class="btn btn-primary">দান জমা দিন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(config('bkash.sandbox'))
    <script src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
@else
    <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('donationForm');
    const paymentMethod = document.getElementById('payment_method');
    const manualPayment = document.getElementById('manualPayment');
    const manualPaymentInfo = document.getElementById('manualPaymentInfo');
    const transactionId = document.getElementById('transaction_id');
    let paymentID = '';

    // Handle payment method change
    paymentMethod.addEventListener('change', function() {
        if (this.value === 'bkash') {
            manualPayment.style.display = 'none';
            manualPaymentInfo.style.display = 'none';
            transactionId.removeAttribute('required');
            form.action = '#';
        } else if (['bkash_manual', 'nagad', 'rocket'].includes(this.value)) {
            manualPayment.style.display = 'block';
            manualPaymentInfo.style.display = 'block';
            transactionId.setAttribute('required', 'required');
            form.action = '{{ route("donations.store") }}';
        } else {
            manualPayment.style.display = 'none';
            manualPaymentInfo.style.display = 'none';
            transactionId.removeAttribute('required');
            form.action = '{{ route("donations.store") }}';
        }
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (paymentMethod.value === 'bkash') {
            // Initialize bKash payment
            bKash.init({
                paymentMode: 'checkout',
                paymentRequest: {},
                createRequest: function(request) {
                    const formData = new FormData(form);
                    const data = {};
                    formData.forEach((value, key) => {
                        data[key] = value;
                    });

                    fetch('{{ route("bkash.create") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Create payment response:', data);
                        if (data && data.paymentID) {
                            paymentID = data.paymentID;
                            bKash.create().onSuccess(data);
                        } else {
                            console.error('Payment creation failed:', data);
                            bKash.create().onError();
                        }
                    })
                    .catch(error => {
                        console.error('Payment creation error:', error);
                        bKash.create().onError();
                    });
                },
                executeRequestOnAuthorization: function() {
                    fetch('{{ route("bkash.execute") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ paymentID: paymentID })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Execute payment response:', data);
                        if (data && data.statusCode === '0000') {
                            window.location.href = '{{ route("donations.index") }}?success=1';
                        } else {
                            console.error('Payment execution failed:', data);
                            bKash.execute().onError();
                        }
                    })
                    .catch(error => {
                        console.error('Payment execution error:', error);
                        bKash.execute().onError();
                    });
                },
                onClose: function() {
                    console.log('bKash popup closed');
                }
            });
            
            bKash.create().onSuccess();
        } else {
            form.submit();
        }
    });
});
</script>
@endpush
