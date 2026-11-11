<!-- TinyMCE Community Edition (No API Key Required, 100% Free & Clean) -->
<style>
    /* Suppress TinyMCE Cloud API Key warning banners globally across all admin pages */
    .tox-notifications-container,
    .tox-notification--warning,
    .tox-notification--error,
    .tox-notification,
    .tox-silver-sink .tox-notification {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        min-height: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        border: 0 !important;
        overflow: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="no-referrer"></script>
<script>
    if (typeof tinymce === 'undefined') {
        document.write('<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"><\/script>');
    }
</script>
<script>
    (function () {
        function initAppTinyMCE() {
            if (typeof tinymce === 'undefined') return;
            const textareas = document.querySelectorAll('.tinymce-editor');
            if (!textareas.length) return;

            // Check if already initialized by a page-specific script
            const uninitialized = Array.from(textareas).filter(el => !el.classList.contains('tinymce-initialized'));
            if (!uninitialized.length) return;

            const isDark = document.documentElement.getAttribute('data-theme') === 'dark' || 
                           document.documentElement.getAttribute('data-bs-theme') === 'dark';

            uninitialized.forEach(el => el.classList.add('tinymce-initialized'));

            tinymce.init({
                selector: '.tinymce-editor',
                height: 420,
                menubar: 'file edit view insert format tools table help',
                skin: isDark ? 'oxide-dark' : 'oxide',
                content_css: isDark ? 'dark' : 'default',
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount', 'codesample'
                ],
                toolbar1: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify',
                toolbar2: 'bullist numlist outdent indent | link image media table codesample | removeformat code fullscreen',
                toolbar_mode: 'sliding',
                content_style: 'body { font-family: "Bornomala", "Kalpurush", "Hind Siliguri", -apple-system, BlinkMacSystemFont, Arial, sans-serif; font-size: 16px; line-height: 1.75; }',
                branding: false,
                promotion: false,
                images_upload_url: '{{ route("admin.publications.upload.image") }}',
                images_upload_credentials: true,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                setup: function (editor) {
                    editor.on('change keyup NodeChange blur', function () {
                        editor.save();
                    });
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAppTinyMCE);
        } else {
            initAppTinyMCE();
        }
    })();
</script>
