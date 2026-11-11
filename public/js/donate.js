document.addEventListener('DOMContentLoaded', function() {
    // Amount buttons
    const amountButtons = document.querySelectorAll('.amount-btn');
    const amountInput = document.getElementById('amount');

    amountButtons.forEach(button => {
        button.addEventListener('click', function() {
            const amount = this.dataset.amount;
            amountInput.value = amount;
            
            // Remove active class from all buttons
            amountButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
        });
    });

    // Form validation
    const form = document.getElementById('donationForm');
    form.addEventListener('submit', function(e) {
        const amount = parseInt(amountInput.value);
        if (amount < 10) {
            e.preventDefault();
            alert('দানের পরিমাণ ন্যূনতম ১০ টাকা হতে হবে।');
        }
    });
});
