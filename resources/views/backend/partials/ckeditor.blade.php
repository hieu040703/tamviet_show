<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    function initCkeditor(id, height) {
        var el = document.getElementById(id);
        if (!el) return;

        if (CKEDITOR.instances[id]) {
            CKEDITOR.instances[id].destroy(true);
        }

        CKEDITOR.replace(id, {
            language: 'vi',
            height: height || 300,
            versionCheck: false
        });
    }

    initCkeditor('description', 200);
    initCkeditor('content', 300);

    document.addEventListener('DOMContentLoaded', function () {
        var target   = document.querySelector('.image-target');
        var fileInput = document.getElementById('image');          // đổi từ image_file → image
        var preview  = document.getElementById('preview-image');

        if (!target || !fileInput || !preview) return;

        target.addEventListener('click', function () {
            fileInput.click();
        });

        fileInput.addEventListener('change', function () {
            if (!this.files || !this.files[0]) return;

            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        });
    });
</script>
