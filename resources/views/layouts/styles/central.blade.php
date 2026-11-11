<!-- Central Committee Styles -->
<link rel="stylesheet" href="{{ asset('css/pages/central.css') }}">

<style>
/* Additional inline styles if needed */
.content-section {
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Print styles */
@media print {
    .member-card {
        break-inside: avoid;
        page-break-inside: avoid;
    }

    .member-info {
        page-break-inside: avoid;
    }
}
</style>
