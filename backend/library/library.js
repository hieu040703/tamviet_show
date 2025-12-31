(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');
    HT.int = () => {
        $(document).on('change keyup blur', '.int', function () {
            let _this = $(this)
            let value = _this.val()
            if (value === '') {
                $(this).val('0')
            }
            value = value.replace(/\./gi, "")
            _this.val(HT.addCommas(value))
            if (isNaN(value)) {
                _this.val('0')
            }
        })

        $(document).on('keydown', '.int', function (e) {
            let _this = $(this)
            let data = _this.val()
            if (data == 0) {
                let unicode = e.keyCode || e.which;
                if (unicode != 190) {
                    _this.val('')
                }
            }
        })
    }


    HT.addCommas = (nStr) => {
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str = '';
        for (let i = nStr.length; i > 0; i -= 3) {
            let a = ((i - 3) < 0) ? 0 : (i - 3);
            str = nStr.slice(a, i) + '.' + str;
        }
        str = str.slice(0, str.length - 1);
        return str;
    }
    HT.changeStatus = () => {
        $(document).on('change', '.status', function (e) {
            let _this = $(this);
            let option = {
                value: _this.val(),
                modelId: _this.attr('data-modelId'),
                model: _this.attr('data-model'),
                field: _this.attr('data-field'),
                _token: _token
            };

            $.ajax({
                url: changeStatus,
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function (res) {
                    if (res.flag === true) {
                        let inputValue = (option.value == 1) ? 0 : 1;
                        _this.val(inputValue);
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message || 'Có lỗi xảy ra!');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error('Lỗi máy chủ: ' + textStatus);
                }
            });

            e.preventDefault();
        });
    };
    HT.changeStatused = () => {
        $(document).on('change', '.statused', function (e) {
            let _this = $(this);
            let option = {
                value: _this.val() == 0 ? 1 : 0,
                modelId: _this.attr('data-modelId'),
                model: _this.attr('data-model'),
                field: _this.attr('data-field'),
                _token: _token
            };

            $.ajax({
                url: changeStatused,
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function (res) {
                    if (res.flag === true) {
                        let inputValue = option.value;
                        _this.val(inputValue);
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message || 'Có lỗi xảy ra!');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error('Lỗi máy chủ: ' + textStatus);
                }
            });

            e.preventDefault();
        });
    };
    HT.JsSwitch = () => {
        $('.js-switch').each(function () {
            new Switchery(this, {size: 'small'});
        });
    }
    HT.JsSwitched = () => {
        $('.js-switched').each(function () {
            new Switchery(this, {size: 'small'});
        });
    }

    $(document).ready(function () {
        HT.int()
        HT.JsSwitch()
        HT.changeStatus()
        HT.JsSwitched()
        HT.changeStatused()
    });


})(jQuery);


addCommas = (nStr) => {
    nStr = String(nStr);
    nStr = nStr.replace(/\./gi, "");
    let str = '';
    for (let i = nStr.length; i > 0; i -= 3) {
        let a = ((i - 3) < 0) ? 0 : (i - 3);
        str = nStr.slice(a, i) + '.' + str;
    }
    str = str.slice(0, str.length - 1);
    return str;
}
