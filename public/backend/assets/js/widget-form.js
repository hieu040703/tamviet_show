(function ($) {
    var $albumInput = $('#album-input');
    var $albumTableBody = $('#album-table tbody');
    var albumImages = [];

    try {
        albumImages = JSON.parse($albumInput.val() || '[]');
    } catch (e) {
        albumImages = [];
    }

    function syncAlbumHidden() {
        $albumInput.val(JSON.stringify(albumImages));
    }

    $('#album-add-image').on('click', function () {
        var path = prompt('Nhập đường dẫn ảnh (ví dụ: products/ten-file.jpg):');
        if (!path) return;

        albumImages.push(path);

        var row = '' +
            '<tr data-src="' + path + '">' +
            '<td><img src="/storage/' + path + '" style="width:70px;height:70px;object-fit:cover;border-radius:4px;"></td>' +
            '<td>' + path + '</td>' +
            '<td class="text-center">' +
            '<a href="#" class="text-danger js-album-remove"><i class="icon-cross2"></i></a>' +
            '</td>' +
            '</tr>';

        $albumTableBody.append(row);
        syncAlbumHidden();
    });

    $albumTableBody.on('click', '.js-album-remove', function (e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        var src = $tr.data('src');
        albumImages = albumImages.filter(function (v) {
            return v !== src;
        });
        $tr.remove();
        syncAlbumHidden();
    });

    syncAlbumHidden();

    var $searchInput = $('#widget-search');
    var searchUrl = $searchInput.data('search-url');
    var $resultBox = $('#widget-search-result').hide();
    var $selectedBody = $('#widget-selected-table tbody');
    var $modelInputs = $('input[name="model"]');
    var $moduleLabel = $('#widget-module-label');
    var $modelIdHidden = $('#widget-model-id');

    var selectedIds = [];
    try {
        selectedIds = JSON.parse($modelIdHidden.val() || '[]');
    } catch (e) {
        selectedIds = [];
    }

    function syncModelHidden() {
        $modelIdHidden.val(JSON.stringify(selectedIds));
    }

    function syncSelectedIdsFromDom() {
        var ids = [];
        $selectedBody.find('tr').each(function () {
            var id = parseInt($(this).data('id'));
            if (!isNaN(id)) {
                ids.push(id);
            }
        });
        selectedIds = ids;
        syncModelHidden();
    }

    function updateRowOrder() {
        $selectedBody.find('tr').each(function (index) {
            $(this).find('.js-order').text(index + 1);
        });
    }

    syncSelectedIdsFromDom();
    updateRowOrder();

    $selectedBody.sortable({
        handle: '.js-drag-handle',
        helper: function (e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function (index) {
                $(this).width($originals.eq(index).width());
            });
            return $helper;
        },
        update: function () {
            syncSelectedIdsFromDom();
            updateRowOrder();
        }
    });

    var timer = null;
    $searchInput.on('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(doSearch, 300);
    });

    function doSearch() {
        var keyword = $searchInput.val();
        var module = $('input[name="model"]:checked').val();

        if (!module || !keyword.trim()) {
            $resultBox.hide().html('');
            return;
        }

        $.ajax({
            url: searchUrl,
            data: {module: module, keyword: keyword},
            dataType: 'json',
            beforeSend: function () {
                $resultBox.show().html('<div class="list-group-item">Đang tải...</div>');
            },
            success: function (res) {
                if (!res.status) return;
                var html = '';
                if (!res.data.length) {
                    html = '<div class="list-group-item">Không có dữ liệu</div>';
                } else {
                    res.data.forEach(function (item) {
                        var disabled = selectedIds.indexOf(item.id) !== -1 ? ' disabled' : '';
                        html += '' +
                            '<a href="#" class="list-group-item js-add-item' + disabled + '" ' +
                            'data-id="' + item.id + '" data-name="' + item.name + '" data-image="' + (item.image_url || '') + '">' +
                            (item.image_url ? '<img src="' + item.image_url + '" style="width:40px;height:40px;margin-right:10px;object-fit:cover;border-radius:4px;">' : '') +
                            '<strong>' + item.name + '</strong>' +
                            ' <span class="text-muted">(#' + item.id + ')</span>' +
                            '</a>';
                    });
                }
                $resultBox.html(html);
            },
            error: function () {
                $resultBox.html('<div class="list-group-item text-danger">Lỗi load dữ liệu</div>');
            }
        });
    }

    $resultBox.on('click', '.js-add-item', function (e) {
        e.preventDefault();
        var $a = $(this);
        if ($a.hasClass('disabled')) return;

        var id = parseInt($a.data('id'));
        var name = $a.data('name');
        var image = $a.data('image');

        if ($('#widget-selected-table tbody tr[data-id="' + id + '"]').length) return;

        var row = '' +
            '<tr data-id="' + id + '">' +
            '<td class="text-center js-order"></td>' +
            '<td>' + (image ? '<img src="' + image + '" style="width:60px;height:60px;object-fit:cover;border-radius:4px;">' : '') + '</td>' +
            '<td class="js-drag-handle" style="cursor:move;">' + name + '</td>' +
            '<td>' + id + '</td>' +
            '<td class="text-center">' +
            '<a href="#" class="text-danger js-remove-selected"><i class="icon-cross2"></i></a>' +
            '</td>' +
            '</tr>';

        $selectedBody.append(row);
        syncSelectedIdsFromDom();
        updateRowOrder();
        $a.addClass('disabled');
    });

    $selectedBody.on('click', '.js-remove-selected', function (e) {
        e.preventDefault();
        var $tr = $(this).closest('tr');
        var id = parseInt($tr.data('id'));
        $tr.remove();
        syncSelectedIdsFromDom();
        updateRowOrder();
        $resultBox.find('[data-id="' + id + '"]').removeClass('disabled');
    });

    $modelInputs.on('change', function () {
        var text = $(this).parent().text().trim();
        $moduleLabel.text('(' + text + ')');
        $resultBox.empty().hide();
        selectedIds = [];
        syncModelHidden();
        $selectedBody.empty();
        updateRowOrder();
    });
})(jQuery);
