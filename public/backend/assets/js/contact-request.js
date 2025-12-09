$(function () {
    $('.select2').select2();

    $(document).on('change', '.contact-status', function () {
        const $select = $(this);
        const url = $select.data('url');
        const status = $select.val();
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                status: status,
                _token: _token
            },
            success: function (res) {
                if (res.success === true) {
                    $select.closest('td').find('.status-label').text(res.label);
                    toastr.success(res.message || 'Cập nhật trạng thái thành công.');
                } else {
                    toastr.error(res.message || 'Có lỗi xảy ra!');
                }
            },
            error: function (xhr) {
                console.log('AJAX Error:', xhr.responseText);

                let msg = 'Có lỗi xảy ra, vui lòng thử lại!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                toastr.error(msg);
            }
        });
    });
});
