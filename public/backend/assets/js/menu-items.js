(function ($) {
    $(function () {
        var $tbody      = $('#menu-items-sortable');
        var $searchInput= $('#menu-router-search');
        var $moduleSel  = $('#menu-router-module');
        var $resultWrap = $('#menu-router-result');
        var $resultBody = $('#menu-router-result tbody');
        var searchUrl   = $searchInput.data('url');

        if ($tbody.length && $.fn.sortable) {
            $tbody.sortable({
                handle: '.sort-handle',
                helper: fixWidthHelper,
                update: rebuildIndex
            });
        }

        function fixWidthHelper(e, ui) {
            ui.children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        }

        function rebuildIndex() {
            $tbody.find('tr.menu-item-row').each(function (idx) {
                $(this).find('.index-col').text(idx + 1);
            });
        }

        rebuildIndex();

        $('#btnAddEmptyRow').on('click', function () {
            addRow({
                id: '',
                name: '',
                url: '',
                router_id: '',
                status: 1
            });
        });

        function addRow(item) {
            var idx = $tbody.find('tr.menu-item-row').length;
            var rowHtml =
                '<tr class="menu-item-row">' +
                '  <td class="text-center sort-handle"><i class="icon-menu"></i></td>' +
                '  <td><input type="text" name="items[' + idx + '][name]" class="form-control" value="' + (item.name || '') + '"></td>' +
                '  <td>' +
                '    <input type="text" name="items[' + idx + '][url]" class="form-control" value="' + (item.url || '') + '">' +
                '    <input type="hidden" name="items[' + idx + '][router_id]" value="' + (item.router_id || '') + '">' +
                '  </td>' +
                '  <td class="text-center index-col"></td>' +
                '  <td class="text-center">' +
                '    <input type="checkbox" name="items[' + idx + '][status]" value="1" ' + (item.status ? 'checked' : '') + '>' +
                '  </td>' +
                '  <td class="text-center">' +
                '    <a href="javascript:void(0)" class="text-danger btn-remove-row"><i class="icon-cross2"></i></a>' +
                '    <input type="hidden" name="items[' + idx + '][id]" value="' + (item.id || '') + '">' +
                '  </td>' +
                '</tr>';

            $tbody.append(rowHtml);
            rebuildIndex();
        }
        $tbody.on('click', '.btn-remove-row', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            rebuildIndex();
        });

        // SEARCH router
        var timer = null;
        $searchInput.on('keyup', function () {
            clearTimeout(timer);
            timer = setTimeout(doSearch, 300);
        });

        $moduleSel.on('change', function () {
            doSearch();
        });

        function doSearch() {
            var keyword = $searchInput.val().trim();
            var module  = $moduleSel.val() || 'all';

            if (!keyword.length) {
                $resultWrap.hide();
                $resultBody.empty();
                return;
            }

            $.ajax({
                url:  searchUrl,
                data: { keyword: keyword, module: module },
                dataType: 'json',
                beforeSend: function () {
                    $resultWrap.show();
                    $resultBody.html('<tr><td colspan="5" class="text-center">Đang tải...</td></tr>');
                },
                success: function (res) {
                    if (!res.status) return;

                    var routers = res.data || [];
                    var html = '';

                    var moduleLabels = {
                        categories: 'Danh mục',
                        products: 'Sản phẩm',
                        brands: 'Thương hiệu',
                        posts: 'Bài viết',
                        post_catalogues: 'Nhóm bài viết'
                    };

                    if (!routers.length) {
                        html = '<tr><td colspan="5" class="text-center text-muted">Không có dữ liệu</td></tr>';
                    } else {
                        $.each(routers, function (idx, item) {
                            var typeLabel = moduleLabels[item.module] || item.module || 'Custom';

                            html += '<tr>' +
                                '<td class="text-center">' + (idx + 1) + '</td>' +
                                '<td>' + (item.name || '') + '</td>' +
                                '<td>' + item.canonical + '</td>' +
                                '<td>' + typeLabel + '</td>' +
                                '<td class="text-center">' +
                                '  <button type="button" class="btn btn-xs btn-primary btn-add-from-router" ' +
                                '          data-id="' + item.id + '" ' +
                                '          data-name="' + (item.name || '') + '" ' +
                                '          data-url="' + item.canonical + '">Thêm</button>' +
                                '</td>' +
                                '</tr>';
                        });
                    }

                    $resultBody.html(html);
                },
                error: function () {
                    $resultBody.html('<tr><td colspan="5" class="text-center text-danger">Lỗi load dữ liệu</td></tr>');
                }
            });
        }

        $resultBody.on('click', '.btn-add-from-router', function () {
            var $btn = $(this);
            addRow({
                id: '',
                name: $btn.data('name') || '',
                url: $btn.data('url') || '',
                router_id: $btn.data('id'),
                status: 1
            });
        });
    });
})(jQuery);
