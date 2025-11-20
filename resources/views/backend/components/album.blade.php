<div class="panel panel-flat">
    <div class="panel-body">
        <fieldset class="content-group">
            <legend class="text-bold">Album ảnh sản phẩm</legend>

            <div class="mb15">
                <a href="#" class="btn btn-default" id="btn-choose-album">
                    <i class="icon-image2"></i> Chọn hình
                </a>
                <input type="file"
                       id="album-files-input"
                       name="album_files[]"
                       accept="image/*"
                       multiple
                       style="display:none;">
            </div>
            @php
                $gallery = isset($product->album) && is_array($product->album)
                    ? $product->album
                    : (array) old('album', []);
            @endphp

            @if(!count($gallery))
                <div id="album-empty-box" class="album-empty-box">
                    <div class="album-empty-inner">
                        <i class="icon-image2" style="font-size:48px;color:#c3cbd3"></i>
                        <p class="text-muted">Sử dụng nút chọn hình hoặc click vào đây để thêm hình ảnh</p>
                    </div>
                </div>
            @endif

            <div id="album-list-wrapper" class="{{ count($gallery) ? '' : 'hidden' }}">
                <div class="row" id="album-list">
                    @foreach($gallery as $img)
                        <div class="col-md-3 col-sm-4 col-xs-6 album-item">
                            <div class="album-thumb">
                                <img src="{{ asset('storage/'.$img) }}" alt="" class="album-image">
                                <button type="button" class="delete-image js-remove-album-image">
                                    <i class=" icon-bin2"></i>
                                </button>
                                <input type="hidden" name="album[]" value="{{ $img }}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <span class="help-block m-t">Ảnh bị xóa sẽ không được lưu sau khi cập nhật.</span>

        </fieldset>
    </div>
</div>

<style>
    .album-empty-box {
        border: 1px dashed #d3dbe2;
        padding: 30px 10px;
        text-align: center;
        cursor: pointer;
        border-radius: 4px;
        background: #fafbfc;
        margin-bottom: 15px;
    }

    .album-empty-inner p {
        margin-top: 10px;
        color: #9ea7b3;
    }

    #album-list {
        margin-left: -8px;
        margin-right: -8px;
    }

    #album-list .album-item {
        padding: 0 8px;
        margin-bottom: 16px;
        cursor: move;
    }

    .album-thumb {
        border: 1px solid #e5e5e5;
        border-radius: 4px;
        overflow: hidden;
        position: relative;
        background: #fff;
        height: 160px;
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .album-image {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        display: block;
    }

    .js-remove-album-image {
        position: absolute;
        top: 6px;
        right: 6px;
        padding: 5px 6px;
        background: rgba(255, 255, 255, .9);
        border: none;
        color: #d9534f;
        border-radius: 3px;
        cursor: pointer;
    }

    .album-sortable-placeholder {
        border: 1px dashed #cbd3dc;
        background: #f5f7fa;
        visibility: visible !important;
    }
</style>

@push('scripts')
    <script>
        (function () {
            var fileInput = document.getElementById('album-files-input');
            var emptyBox = document.getElementById('album-empty-box');
            var listWrapper = document.getElementById('album-list-wrapper');
            var albumList = document.getElementById('album-list');
            var chooseBtn = document.getElementById('btn-choose-album');

            function openPicker(e) {
                e.preventDefault();
                if (fileInput) fileInput.click();
            }

            if (chooseBtn) chooseBtn.addEventListener('click', openPicker);
            if (emptyBox) emptyBox.addEventListener('click', openPicker);

            if (fileInput) {
                fileInput.addEventListener('change', function (e) {
                    var files = e.target.files;
                    if (!files || !files.length) return;

                    if (emptyBox) emptyBox.classList.add('hidden');
                    if (listWrapper) listWrapper.classList.remove('hidden');

                    Array.prototype.forEach.call(files, function (file) {
                        if (!file.type || !file.type.match(/^image\//)) return;

                        var reader = new FileReader();
                        reader.onload = function (ev) {
                            var col = document.createElement('div');
                            col.className = 'col-md-3 col-sm-4 col-xs-6 album-item';
                            col.innerHTML =
                                '<div class="album-thumb">' +
                                '<img src="' + ev.target.result + '" class="album-image">' +
                                '<button type="button" class="delete-image js-remove-album-image">' +
                                '<i class=" icon-bin2"></i>' +
                                '</button>' +
                                '</div>';
                            albumList.appendChild(col);
                        };
                        reader.readAsDataURL(file);
                    });

                    if (window.jQuery && jQuery.fn.sortable) {
                        jQuery('#album-list').sortable('refresh');
                    }
                });
            }

            document.addEventListener('click', function (e) {
                var btn = e.target.closest('.js-remove-album-image');
                if (!btn) return;
                var item = btn.closest('.album-item');
                if (item) item.remove();

                if (!albumList.querySelector('.album-item')) {
                    if (listWrapper) listWrapper.classList.add('hidden');
                    if (emptyBox) emptyBox.classList.remove('hidden');
                }
            });

            if (window.jQuery && jQuery.fn.sortable) {
                jQuery('#album-list').sortable({
                    placeholder: 'album-sortable-placeholder'
                });
            }
        })();
    </script>
@endpush
