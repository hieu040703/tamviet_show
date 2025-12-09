(function ($) {
    $(function () {

        var $searchInput  = $('#menu-router-search');
        var $moduleSelect = $('#menu-router-module');
        var $resultWrap   = $('#menu-router-result');
        var $resultBody   = $('#menu-router-result tbody');
        var $nestable     = $('#menuNestable');
        var $rootList     = $('#menu-items-root');
        var $saveBtn      = $('#menu-save-items');
        var csrfToken     = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();
        var searchUrl     = $searchInput.data('url');
        var saveUrl       = $saveBtn.data('save-url');

        var moduleLabels = {
            categories: 'Danh mục',
            products: 'Sản phẩm',
            brands: 'Thương hiệu',
            posts: 'Bài viết',
            post_catalogues: 'Nhóm bài viết'
        };

        /* NESTABLE */
        if ($.fn.nestable) {
            $nestable.nestable({
                maxDepth: 5
            });
        }

        // ================== SEARCH ROUTER ==================
        var timer = null;

        $searchInput.on('keyup', function () {
            clearTimeout(timer);
            timer = setTimeout(doSearch, 300);
        });

        $moduleSelect.on('change', function () {
            doSearch();
        });

        function doSearch() {
            var keyword = $searchInput.val().trim();
            var module  = $moduleSelect.val();

            if (!keyword.length) {
                $resultWrap.hide();
                $resultBody.empty();
                return;
            }

            $.ajax({
                url: searchUrl,
                data: { keyword: keyword, module: module },
                dataType: 'json',
                beforeSend: function () {
                    $resultWrap.show();
                    $resultBody.html('<tr><td colspan="5" class="text-center">Đang tải...</td></tr>');
                },
                success: function (res) {
                    if (!res.status) return;

                    var routers = res.data || [];
                    if (!routers.length) {
                        $resultBody.html('<tr><td colspan="5" class="text-center text-muted">Không có dữ liệu</td></tr>');
                        return;
                    }

                    var html = '';
                    $.each(routers, function (i, item) {
                        var label = moduleLabels[item.module] || item.module || 'Custom';
                        html += '<tr>';
                        html += '  <td class="text-center">'+(i+1)+'</td>';
                        html += '  <td>'+ (item.name || '') +'</td>';
                        html += '  <td>'+ item.canonical +'</td>';
                        html += '  <td>'+ label +'</td>';
                        html += '  <td class="text-center">';
                        html += '    <button type="button" class="btn btn-xs btn-primary js-add-menu-item" ' +
                            'data-router-id="'+item.id+'" ' +
                            'data-name="'+_.escape(item.name || '')+'" ' +
                            'data-url="'+_.escape(item.canonical)+'" ' +
                            'data-type="'+label+'">Thêm</button>';
                        html += '  </td>';
                        html += '</tr>';
                    });

                    $resultBody.html(html);
                    $resultWrap.show();
                },
                error: function () {
                    $resultBody.html('<tr><td colspan="5" class="text-center text-danger">Lỗi tải dữ liệu</td></tr>');
                }
            });
        }

        // ================== ADD ITEM FROM SEARCH ==================
        // _.escape fallback nếu không có lodash
        if (typeof _ === 'undefined') {
            window._ = {
                escape: function (str) {
                    if (str == null) return '';
                    return String(str)
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#39;');
                }
            };
        }

        $resultBody.on('click', '.js-add-menu-item', function () {
            var $btn   = $(this);
            var rid    = $btn.data('router-id');
            var name   = $btn.data('name') || '';
            var url    = $btn.data('url') || '';
            var type   = $btn.data('type') || 'Custom';

            // tạo li
            var liHtml = '';
            liHtml += '<li class="dd-item" data-router-id="'+rid+'">';
            liHtml += '  <div class="dd-handle">'+ name +' <span class="badge-type">'+ type +'</span></div>';
            liHtml += '  <div class="menu-item-box">';
            liHtml += '    <div class="row">';
            liHtml += '      <div class="col-sm-6">';
            liHtml += '        <label>Tiêu đề hiển thị</label>';
            liHtml += '        <input type="text" class="form-control js-menu-title" value="'+name+'">';
            liHtml += '      </div>';
            liHtml += '      <div class="col-sm-4">';
            liHtml += '        <label>URL</label>';
            liHtml += '        <input type="text" class="form-control js-menu-url" value="'+url+'">';
            liHtml += '      </div>';
            liHtml += '      <div class="col-sm-1">';
            liHtml += '        <label>Thứ tự</label>';
            liHtml += '        <input type="number" class="form-control js-menu-sort" value="1">';
            liHtml += '      </div>';
            liHtml += '      <div class="col-sm-1">';
            liHtml += '        <label>&nbsp;</label>';
            liHtml += '        <div>';
            liHtml += '          <label><input type="checkbox" class="js-menu-status" checked> Hiện</label>';
            liHtml += '          <a href="#" class="text-danger js-menu-remove" style="margin-left:8px;"><i class="icon-trash"></i></a>';
            liHtml += '        </div>';
            liHtml += '      </div>';
            liHtml += '    </div>';
            liHtml += '  </div>';
            liHtml += '</li>';

            if (!$rootList.length) {
                $rootList = $('<ol class="dd-list" id="menu-items-root"></ol>').appendTo($nestable);
            }

            $rootList.append(liHtml);
            $nestable.nestable('refresh');

            $btn.prop('disabled', true).text('Đã thêm');
        });

        // ================== REMOVE ITEM ==================
        $nestable.on('click', '.js-menu-remove', function (e) {
            e.preventDefault();
            var $li = $(this).closest('li.dd-item');
            $li.remove();
            $nestable.nestable('refresh');
        });

        // ================== BUILD TREE & SAVE ==================
        function buildTree($list) {
            var result = [];
            if (!$list || !$list.length) return result;

            $list.children('li.dd-item').each(function (index) {
                var $li = $(this);
                var node = {
                    router_id: parseInt($li.data('router-id')) || null,
                    title:     ($li.find('.js-menu-title').val() || '').trim(),
                    url:       ($li.find('.js-menu-url').val() || '').trim(),
                    sort_order: parseInt($li.find('.js-menu-sort').val()) || (index + 1),
                    status:    $li.find('.js-menu-status').is(':checked') ? 1 : 0,
                    children:  buildTree($li.children('ol.dd-list'))
                };
                result.push(node);
            });

            return result;
        }

        $saveBtn.on('click', function () {
            if (!saveUrl) {
                alert('Bạn cần lưu thông tin menu (tạo menu) trước khi cấu hình mục menu.');
                return;
            }

            var items = buildTree($rootList);

            $.ajax({
                url: saveUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: csrfToken,
                    items: items
                },
                success: function (res) {
                    if (res.status) {
                        alert(res.message || 'Đã lưu menu.');
                    } else {
                        alert(res.message || 'Có lỗi xảy ra.');
                    }
                },
                error: function (xhr) {
                    var msg = 'Lỗi khi lưu menu.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });
    });
})(jQuery);
