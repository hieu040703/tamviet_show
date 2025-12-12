(function ($) {
    $(function () {
        var $tbody  = $('#sortable-banner');
        if (!$tbody.length) return;

        var sortUrl = $tbody.data('sort-url');
        var token   = $tbody.data('token');

        $tbody.sortable({
            placeholder: 'sortable-placeholder',
            handle: 'td',
            update: function () {
                var orders = {};
                $tbody.find('tr').each(function (index) {
                    var id    = $(this).data('id');
                    var order = index + 1;
                    orders[id] = order;
                    $(this).find("input[name='orders[" + id + "]']").val(order);
                });

                $.ajax({
                    url: sortUrl,
                    type: 'POST',
                    data: {
                        _token: token,
                        orders: orders
                    },
                    success: function () {
                        console.log('Cập nhật thứ tự thành công');
                    },
                    error: function () {
                        alert('Có lỗi khi cập nhật thứ tự');
                    }
                });
            }
        });

        $tbody.disableSelection();
    });
})(jQuery);

