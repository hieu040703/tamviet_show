<<<<<<< HEAD
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
=======
<script src="{{ asset('backend/ckeditor4/ckeditor.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function initCkeditor(id, height) {
            var el = document.getElementById(id);
            if (!el) return;
            if (CKEDITOR.instances[id]) {
                CKEDITOR.instances[id].destroy(true);
            }
            CKEDITOR.replace(id, {
                language: 'vi',
                height: height || 300
            });
        }

        initCkeditor('description', 200);
        initCkeditor('content', 300);

        var target = document.querySelector('.image-target');
        var fileInp = document.getElementById('image');
        var preview = document.getElementById('preview-image');

        if (target && fileInp && preview) {
            target.addEventListener('click', function (e) {
                e.preventDefault();
                fileInp.click();
            });
            fileInp.addEventListener('change', function () {
                var file = this.files[0];
                if (!file) return;
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }

        var iconTarget = document.querySelector('.icon-target-1');
        var iconInp = document.getElementById('icon');
        var iconPreview = document.getElementById('preview-icon');

        if (iconTarget && iconInp && iconPreview) {
            iconTarget.addEventListener('click', function (e) {
                e.preventDefault();
                iconInp.click();
            });
            iconInp.addEventListener('change', function () {
                var file = this.files[0];
                if (!file) return;
                var reader = new FileReader();
                reader.onload = function (e) {
                    iconPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }

        var imageInputs = document.querySelectorAll('.upload-image');
        imageInputs.forEach(function (textInput, index) {
            var fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.style.display = 'none';
            fileInput.id = 'image_file_' + index;

            textInput.parentNode.insertBefore(fileInput, textInput.nextSibling);

            textInput.addEventListener('click', function (e) {
                e.preventDefault();
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                var file = this.files[0];
                if (!file) return;
                textInput.value = file.name;
            });
>>>>>>> hieu/update-feature
        });
    });
</script>
