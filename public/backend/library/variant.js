(function ($) {
    "use strict";
    var HT = {};

    HT.setupProductVariant = () => {
        if ($('.turnOnVariant').length) {
            $(document).on('click', '.turnOnVariant', function () {
                let _this = $(this)
                let code = $('input[name=code]').val()
                if (code == '') {
                    alert('Bạn phải mã sản phẩm để sử dụng chức năng này');
                    return false
                }

                if (_this.siblings('input:checked').length == 0) {
                    $('.variant-wrapper').removeClass('hidden')
                } else {
                    $('.variant-wrapper').addClass('hidden')
                }
            })
        }
    }

    HT.addVariant = () => {
        if ($('.add-variant').length) {
            $(document).on('click', '.add-variant', function () {
                let html = HT.renderVariantItem(attributeCatalogue)
                $('.variant-body').append(html)
                $('.variantTable thead').html('')
                $('.variantTable tbody').html('')
                HT.checkMaxAttributeGroup(attributeCatalogue);
                HT.disabledAttributeCatalogueChoose();
            })
        }
    }

    HT.renderVariantItem = (attributeCatalogue) => {
        let html = '';
        html = html + '<div class="row mb20 variant-item">';
        html = html + '<div class="col-lg-3">';
        html = html + '<div class="attribute-catalogue">';
        html = html + '<select name="attributeCatalogue[]" id="" class="choose-attribute select2 form-control">';
        html = html + '<option value="">' + 'Nhóm thuộc tính' + '</option>';
        for (let i = 0; i < attributeCatalogue.length; i++) {
            html = html + '<option class="form-control" value="' + attributeCatalogue[i].id + '">' + attributeCatalogue[i].name + '</option>';
        }
        html = html + '</select>';
        html = html + '</div>';
        html = html + '</div>';
        html = html + '<div class="col-lg-8">';
        html = html + '<input type="text" name="" disabled class="fake-variant form-control">';
        html = html + '</div>';
        html = html + '<div class="col-lg-1">';
        html = html + '<button type="button" class="remove-attribute btn btn-danger"><svg data-icon="TrashSolidLarge" aria-hidden="true" focusable="false" width="15" height="16" viewBox="0 0 15 16" class="bem-Svg" style="display: block;"><path fill="currentColor" d="M2 14a1 1 0 001 1h9a1 1 0 001-1V6H2v8zM13 2h-3a1 1 0 01-1-1H6a1 1 0 01-1 1H1v2h13V2h-1z"></path></svg></button>';
        html = html + '</div>';
        html = html + '</div>';

        return html;
    }

    HT.chooseVariantGroup = () => {
        $(document).on('change', '.choose-attribute', function () {
            let _this = $(this)
            let attributeCatalogueId = _this.val()
            if (attributeCatalogueId != 0) {
                _this.parents('.col-lg-3').siblings('.col-lg-8').html(HT.select2Variant(attributeCatalogueId))
                $('.selectVariant').each(function (key, index) {
                    HT.getSelect2($(this))
                })
            } else {
                _this.parents('.col-lg-3').siblings('.col-lg-8').html('<input type="text" name="attribute[' + attributeCatalogueId + '][]" disabled="" class="fake-variant form-control">')
            }

            HT.disabledAttributeCatalogueChoose();
        })
    }

    HT.createProductVariant = () => {
        $(document).on('change', '.selectVariant', function () {
            let _this = $(this)
            HT.createVariant()
        })
    }

    HT.createVariant = (remove) => {
        let attributes = []
        let variants = []
        let attributeTitle = []
        if ($('.variant-item').length) {
            $('.variant-item').each(function () {
                let _this = $(this)
                let attr = []
                let attrVariant = []
                let attributeCatalogueId = _this.find('.choose-attribute').val()
                let optionText = _this.find('.choose-attribute option:selected').text()
                let attribute = $('.variant-' + attributeCatalogueId).select2('data')
                for (let i = 0; i < attribute.length; i++) {
                    let item = {}
                    let itemVariant = {}
                    item[optionText] = attribute[i].text
                    itemVariant[attributeCatalogueId] = attribute[i].id
                    attr.push(item)
                    attrVariant.push(itemVariant)
                }
                attributeTitle.push(optionText)
                attributes.push(attr)
                variants.push(attrVariant)
            })

            attributes = attributes.reduce(
                (a, b) => a.flatMap(d => b.map(e => ({...d, ...e})))
            )

            variants = variants.reduce(
                (a, b) => a.flatMap(d => b.map(e => ({...d, ...e})))
            )

            HT.createTableHeader(attributeTitle)

            let trClass = []
            attributes.forEach((item, index) => {
                let $row = HT.createVariantRow(item, variants[index])
                let classModified = 'tr-variant-' + Object.values(variants[index]).join(', ').replace(/, /g, '-')
                trClass.push(classModified)

                if (!$('table.variantTable tbody tr').hasClass(classModified)) {
                    $('table.variantTable tbody').append($row)
                }
            });

            $('table.variantTable tbody tr').each(function () {
                const $row = $(this)
                const rowClasses = $row.attr('class')
                if (rowClasses) {
                    const rowClassArray = rowClasses.split(' ')
                    let shouldRemove = false
                    rowClassArray.forEach(rowClass => {
                        if (rowClass == 'variant-row') {
                            return;
                        } else if (!trClass.includes(rowClass)) {
                            shouldRemove = true
                        }
                    })
                    if (shouldRemove) {
                        $row.remove()
                    }
                }
            })
        } else {
            $('.Product-variant .ibox-content').html('')
        }
    }

    HT.createVariantRow = (attributeItem, variantItem) => {
        let attributeString = Object.values(attributeItem).join(', ')
        let attributeId = Object.values(variantItem).join(', ')
        let classModified = attributeId.replace(/, /g, '-')

        let $row = $('<tr>').addClass('variant-row tr-variant-' + classModified)
        let $td
        $row.append($td)

        Object.values(attributeItem).forEach(value => {
            $td = $('<td>').text(value)
            $row.append($td)
        })

        $td = $('<td>').addClass('hidden td-variant')

        let mainSku = $('input[name=code]').val()
        let inputHiddenFields = [
            {name: 'variant[quantity][]', class: 'variant_quantity'},
            {name: 'variant[sku][]', class: 'variant_sku', value: mainSku + '-' + classModified},
            {name: 'productVariant[name][]', value: attributeString},
            {name: 'productVariant[id][]', value: attributeId},
            {name: 'variant[album][]', class: 'variant_album', value: '[]'}
        ]

        $.each(inputHiddenFields, function (_, field) {
            let $input = $('<input>').attr('type', 'text').attr('name', field.name).addClass(field.class)
            if (field.value) {
                $input.val(field.value)
            }
            $td.append($input)
        })
        $row.append($('<td>').addClass('td-quantity').text('-'))
            .append($('<td>').addClass('td-sku').text(mainSku + '-' + classModified))
            .append($td)
        return $row
    }

    HT.createTableHeader = (attributeTitle) => {
        let $thead = $('table.variantTable thead')
        let $row = $('<tr>')
        for (let i = 0; i < attributeTitle.length; i++) {
            $row.append($('<td>').text(attributeTitle[i]))
        }

        $row.append($('<td>').text('Số lượng'))
        $row.append($('<td>').text('SKU'))

        $thead.html($row)
        return $thead
    }

    HT.getSelect2 = (object) => {
        let option = {
            'attributeCatalogueId': object.attr('data-catid')
        }
        $(object).select2({
            minimumInputLength: 0,
            placeholder: 'Nhập ít nhất 2 ký tự để tìm kiếm',
            ajax: {
                url: getAttribute,
                type: 'GET',
                dataType: 'json',
                deley: 250,
                data: function (params) {
                    return {
                        search: params.term,
                        option: option,
                    }
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    }
                },
                cache: true
            }
        });
    }

    HT.select2 = () => {
        $('.select2').select2();
    }

    HT.destroyselect2 = () => {
        $('.select2').each(function () {
            $(this).select2('destroy');
        });
    }

    HT.disabledAttributeCatalogueChoose = () => {
        let id = [];

        $('.choose-attribute').each(function () {
            let _this = $(this);
            let selected = _this.find('option:selected').val();
            if (selected !== "0") {
                id.push(selected);
            }
        });
        $('.choose-attribute option').prop('disabled', false);
        for (let i = 0; i < id.length; i++) {
            $('.choose-attribute option[value="' + id[i] + '"]').prop('disabled', true);
        }
        $('.choose-attribute').each(function () {
            if ($(this).hasClass('select2-hidden-accessible')) {
                $(this).select2('destroy');
            }
        });
        $('.choose-attribute').select2();
        $('.choose-attribute').each(function () {
            $(this).find('option:selected').prop('disabled', false);
        });
    };

    HT.checkMaxAttributeGroup = (attributeCatalogue) => {
        let variantItem = $('.variant-item').length
        if (variantItem >= attributeCatalogue.length) {
            $('.add-variant').remove()
        } else {
            $('.variant-foot').html('<button type="button" class="add-variant">' + 'Thêm mới phiên bản' + '</button>')
        }
    }

    HT.removeAttribute = () => {
        $(document).on('click', '.remove-attribute', function () {
            let _this = $(this)
            _this.parents('.variant-item').remove()
            HT.checkMaxAttributeGroup(attributeCatalogue)
            HT.createVariant(true)
        })
    }

    HT.select2Variant = (attributeCatalogueId) => {
        let html = '<select class="selectVariant variant-' + attributeCatalogueId + ' form-control" name="attribute[' + attributeCatalogueId + '][]" multiple data-catid="' + attributeCatalogueId + '"></select>'
        return html
    }

    HT.variantAlbum = () => {
        $(document).on('click', '.click-to-upload-variant', function (e) {
            HT.browseVariantServerAlbum()
            e.preventDefault();
        })
    }

    HT.switchChange = () => {
        $(document).on('change', '.js-switch', function () {
            let _this = $(this)
            let isChecked = _this.prop('checked');
            if (isChecked == true) {
                _this.parents('.col-lg-2').siblings('.col-lg-10').find('.disabled').removeAttr('disabled')
            } else {
                _this.parents('.col-lg-2').siblings('.col-lg-10').find('.disabled').attr('disabled', true)
            }
        })
    }

    HT.updateVariant = () => {
        $(document).on('click', '.variant-row', function () {
            let _this = $(this)
            let variantData = {}
            _this.find(".td-variant input[type=text][class^='variant_']").each(function () {
                let className = $(this).attr('class')
                variantData[className] = $(this).val()
            })
            let albumJson = _this.find('.variant_album').val() || '[]';
            try {
                variantData.album = JSON.parse(albumJson);
            } catch (e) {
                variantData.album = [];
            }

            let updateVariantBox = HT.updateVariantHtml(variantData)
            if ($('.updateVariantTr').length == 0) {
                _this.after(updateVariantBox)
                HT.switchery()
                HT.initVariantAlbumSortable()
                HT.loadSavedAlbum(variantData.album)
            }
        })
    }

    HT.loadSavedAlbum = (albumImages) => {
        if (!albumImages || albumImages.length === 0) {
            return;
        }

        let variantId = $('.updateVariantTr').find('.variant-album-list').data('variant-id');

        $('.variant-album-empty-box[data-variant-id="' + variantId + '"]').addClass('hidden');
        $('.variant-album-list-wrapper[data-variant-id="' + variantId + '"]').removeClass('hidden');

        let albumList = $('.variant-album-list[data-variant-id="' + variantId + '"]');
        albumList.empty();

        albumImages.forEach(function (imageSrc) {
            let col = $('<div class="col-md-3 col-sm-4 col-xs-6 variant-album-item"></div>');
            let html = '<div class="variant-album-thumb">' +
                '<img src="' + imageSrc + '" class="variant-album-image">' +
                '<button type="button" class="variant-delete-image js-remove-variant-album-image">' +
                '<i class="icon-bin2"></i>' +
                '</button>' +
                '<input type="hidden" class="variant-album-path" value="' + imageSrc + '">' +
                '</div>';
            col.html(html);
            albumList.append(col);
        });

        HT.initVariantAlbumSortable();
    }

    HT.uploadVariantImage = (file, variantId, callback) => {
        let formData = new FormData();
        formData.append('file', file);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            url: uploadVariantImage,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success && response.path) {
                    callback(response.path);
                } else {
                    alert('Upload thất bại: ' + (response.message || 'Unknown error'));
                }
            },
            error: function (xhr) {
                alert('Lỗi upload: ' + xhr.responseText);
            }
        });
    }

    HT.initVariantAlbumHandler = () => {
        $(document).on('click', '.btn-choose-variant-album', function (e) {
            e.preventDefault();
            let variantId = $(this).data('variant-id');
            $('.variant-album-files-input[data-variant-id="' + variantId + '"]').click();
        });

        $(document).on('click', '.variant-album-empty-box', function () {
            let variantId = $(this).data('variant-id');
            $('.variant-album-files-input[data-variant-id="' + variantId + '"]').click();
        });

        $(document).on('change', '.variant-album-files-input', function (e) {
            let files = e.target.files;
            let variantId = $(this).data('variant-id');
            if (!files || !files.length) return;
            $('.variant-album-empty-box[data-variant-id="' + variantId + '"]').addClass('hidden');
            $('.variant-album-list-wrapper[data-variant-id="' + variantId + '"]').removeClass('hidden');
            let albumList = $('.variant-album-list[data-variant-id="' + variantId + '"]');
            Array.prototype.forEach.call(files, function (file) {
                if (!file.type || !file.type.match(/^image\//)) return;
                let col = $('<div class="col-md-3 col-sm-4 col-xs-6 variant-album-item uploading"></div>');
                let loadingHtml = '<div class="variant-album-thumb">' +
                    '<div class="loading-spinner"><i class="fa fa-spinner fa-spin"></i></div>' +
                    '<p class="upload-status">Đang upload...</p>' +
                    '</div>';
                col.html(loadingHtml);
                albumList.append(col);

                HT.uploadVariantImage(file, variantId, function (imagePath) {
                    let html = '<div class="variant-album-thumb">' +
                        '<img src="' + imagePath + '" class="variant-album-image">' +
                        '<button type="button" class="variant-delete-image js-remove-variant-album-image">' +
                        '<i class="icon-bin2"></i>' +
                        '</button>' +
                        '<input type="hidden" class="variant-album-path" value="' + imagePath + '">' +
                        '</div>';
                    col.removeClass('uploading').html(html);
                });
            });

            $(this).val('');
            HT.initVariantAlbumSortable();
        });

        $(document).on('click', '.js-remove-variant-album-image', function (e) {
            e.stopPropagation();
            if (!confirm('Bạn có chắc muốn xóa ảnh này?')) {
                return;
            }
            let item = $(this).closest('.variant-album-item');
            let variantId = $(this).closest('.variant-album-list').data('variant-id');
            let imagePath = item.find('.variant-album-path').val();
            if (imagePath && imagePath.indexOf('/uploads/') !== -1) {
                $.ajax({
                    url: deleteVariantImage,
                    type: 'POST',
                    data: {
                        path: imagePath,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            item.remove();

                            let albumList = $('.variant-album-list[data-variant-id="' + variantId + '"]');
                            if (albumList.find('.variant-album-item').length === 0) {
                                $('.variant-album-list-wrapper[data-variant-id="' + variantId + '"]').addClass('hidden');
                                $('.variant-album-empty-box[data-variant-id="' + variantId + '"]').removeClass('hidden');
                            }

                            if (typeof toastr !== 'undefined') {
                                toastr.success('Đã xóa ảnh thành công!');
                            }
                        }
                    },
                    error: function (xhr) {
                        alert('Lỗi xóa ảnh: ' + xhr.responseText);
                    }
                });
            } else {
                item.remove();

                let albumList = $('.variant-album-list[data-variant-id="' + variantId + '"]');
                if (albumList.find('.variant-album-item').length === 0) {
                    $('.variant-album-list-wrapper[data-variant-id="' + variantId + '"]').addClass('hidden');
                    $('.variant-album-empty-box[data-variant-id="' + variantId + '"]').removeClass('hidden');
                }
            }
        });
    }

    HT.initVariantAlbumSortable = () => {
        if (typeof $.fn.sortable !== 'undefined') {
            $('.variant-album-list').sortable({
                items: '.variant-album-item:not(.uploading)',
                placeholder: 'variant-album-sortable-placeholder',
                cursor: 'move',
                opacity: 0.6,
                tolerance: 'pointer',
                update: function (event, ui) {
                }
            });
        }
    }

    HT.switchery = () => {
        $('.js-switch').each(function () {
            if (!$(this).data('switchery')) {
                var switchery = new Switchery(this, {color: '#1AB394', size: 'small'});
                $(this).data('switchery', switchery);
            }
        })
    }

    HT.updateVariantHtml = (variantData) => {
        let html = ''
        let colspan = $('.variantTable thead tr td').length
        let variantId = 'variant_' + Date.now();

        html = html + '<tr class="updateVariantTr">'
        html = html + '<td colspan="' + colspan + '">'
        html = html + '<div class="updateVariant ibox">'
        html = html + '<div class="ibox-title variant-update-header">'
        html = html + '<div class="uk-flex uk-flex-middle uk-flex-space-between">'
        html = html + '<h5><i class="fa fa-edit"></i> Cập nhật thông tin phiên bản</h5>'
        html = html + '<div class="button-group">'
        html = html + '<div class="uk-flex uk-flex-middle">'
        html = html + '<button type="button" class="cancleUpdate btn btn-danger btn-sm mr10"><i class="fa fa-times"></i> Hủy</button>'
        html = html + '<button type="button" class="saveUpdateVariant btn btn-success btn-sm"><i class="fa fa-save"></i> Lưu</button>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '<div class="ibox-content variant-update-content">'
        html = html + '<div class="row mt20 uk-flex uk-flex-middle mb-20">'
        html = html + '<div class="col-lg-2 uk-flex uk-flex-middle mt-30">'
        html = html + '<label for="" class="mr-15 ml10 control-label-bold">Tồn kho</label>'
        html = html + '<input type="checkbox" class="js-switch" ' + ((variantData.variant_quantity !== '') ? 'checked' : '') + ' data-target="variantQuantity">'
        html = html + '</div>'
        html = html + '<div class="col-lg-10">'
        html = html + '<div class="row">'
        html = html + '<div class="col-lg-6">'
        html = html + '<label for="" class="control-label">Số lượng <span class="text-danger">*</span></label>'
        html = html + '<input type="text" ' + ((variantData.variant_quantity == '') ? 'disabled' : '') + ' name="variant_quantity" value="' + variantData.variant_quantity + '" class="form-control input-modern ' + ((variantData.variant_quantity == '') ? 'disabled' : '') + ' int" placeholder="Nhập số lượng">'
        html = html + '</div>'
        html = html + '<div class="col-lg-6">'
        html = html + '<label for="" class="control-label">SKU <span class="text-danger">*</span></label>'
        html = html + '<input type="text" name="variant_sku" value="' + variantData.variant_sku + '" class="form-control input-modern text-right" placeholder="Nhập mã SKU">'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '<div class="row mt30">'
        html = html + '<div class="col-lg-12">'
        html = html + '<fieldset class="variant-content-group">'
        html = html + '<legend class="text-bold legend-modern"><i class="fa fa-images"></i> Album ảnh phiên bản</legend>'
        html = html + '<div class="mb15 upload-section">'
        html = html + '<button type="button" class="btn btn-primary btn-modern btn-choose-variant-album" data-variant-id="' + variantId + '">'
        html = html + '<i class="fa fa-cloud-upload"></i> Chọn hình ảnh'
        html = html + '</button>'
        html = html + '<span class="help-text ml10"><i class="fa fa-info-circle"></i> Hỗ trợ: JPG, PNG, GIF (Tối đa 5MB/ảnh)</span>'
        html = html + '<input type="file" class="variant-album-files-input" data-variant-id="' + variantId + '" accept="image/*" multiple style="display:none;">'
        html = html + '</div>'
        html = html + '<div class="variant-album-empty-box" data-variant-id="' + variantId + '">'
        html = html + '<div class="album-empty-inner">'
        html = html + '<div class="empty-icon"><i class="fa fa-image"></i></div>'
        html = html + '<p class="empty-title">Chưa có hình ảnh</p>'
        html = html + '<p class="empty-description">Click vào nút "Chọn hình ảnh" hoặc kéo thả ảnh vào đây</p>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '<div class="variant-album-list-wrapper hidden" data-variant-id="' + variantId + '">'
        html = html + '<div class="row variant-album-list" data-variant-id="' + variantId + '">'
        html = html + '</div>'
        html = html + '<div class="album-footer">'
        html = html + '<i class="fa fa-hand-rock-o"></i> Kéo thả để sắp xếp thứ tự hiển thị'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</fieldset>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</td>'
        html = html + '</tr>'

        return html
    }

    HT.cancleVariantUpdate = () => {
        $(document).on('click', '.cancleUpdate', function () {
            HT.closeUpdateVariantBox()
        })
    }

    HT.closeUpdateVariantBox = () => {
        $('.updateVariantTr').remove()
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

    HT.saveVariantUpdate = () => {
        $(document).on('click', '.saveUpdateVariant', function () {

            if ($('.variant-album-item.uploading').length > 0) {
                alert('Vui lòng đợi upload ảnh hoàn tất!');
                return false;
            }

            let variant = {
                'quantity': $('input[name=variant_quantity]').val(),
                'sku': $('input[name=variant_sku]').val(),
            }

            let albumImages = [];
            $('.updateVariantTr').find('.variant-album-path').each(function () {
                let path = $(this).val();
                if (path && path.trim() !== '') {
                    albumImages.push(path);
                }
            });
            variant.album = albumImages;

            $.each(variant, function (index, value) {
                if (index !== 'album') {
                    $('.updateVariantTr').prev().find('.variant_' + index).val(value)
                }
            })
            let albumJson = JSON.stringify(albumImages);
            let hiddenAlbumInput = $('.updateVariantTr').prev().find('.variant_album');
            hiddenAlbumInput.val(albumJson);
            HT.previewVariantTr(variant)
            HT.closeUpdateVariantBox()

            if (typeof toastr !== 'undefined') {
                toastr.success('Đã lưu thông tin phiên bản thành công!');
            }
        })
    }

    HT.previewVariantTr = (variant) => {
        let option = {
            'quantity': variant.quantity || '-',
            'sku': variant.sku || '-',
        }
        $.each(option, function (index, value) {
            $('.updateVariantTr').prev().find('.td-' + index).html(value)
        })
    }

    HT.setupSelectMultiple = () => {
        return new Promise((resolve) => {
            if ($('.selectVariant').length) {
                let count = $('.selectVariant').length;

                $('.selectVariant').each(function () {
                    let _this = $(this);
                    let attributeCatalogueId = _this.attr('data-catid');

                    if (attributeCatalogueId !== '') {
                        $.get(loadAttributeUrl, {
                            attribute: attribute,
                            attributeCatalogueId: attributeCatalogueId
                        }, function (json) {
                            if (json.items && json.items.length > 0) {
                                for (let i = 0; i < json.items.length; i++) {
                                    let option = new Option(json.items[i].text, json.items[i].id, true, true);
                                    _this.append(option);
                                }
                                _this.trigger('change');
                            }
                            if (--count === 0) {
                                resolve();
                            }
                        });
                    } else {
                        if (--count === 0) {
                            resolve();
                        }
                    }

                    HT.getSelect2(_this);
                });
            } else {
                resolve();
            }
        });
    };

    HT.productVariant = () => {
        variant = JSON.parse(atob(variant));
        let idx = -1;
        $('.variant-row').each(function () {
            idx++;
            if (!variant.sku[idx]) return;
            let _this = $(this);

            const inputHiddenFields = [
                {name: 'variant[quantity][]', class: 'variant_quantity', value: variant.quantity[idx]},
                {name: 'variant[sku][]', class: 'variant_sku', value: variant.sku[idx]},
            ];

            for (const f of inputHiddenFields) {
                _this.find('.' + f.class).val(f.value || 0);
            }

            if (variant.album && variant.album[idx]) {
                let albumJson = JSON.stringify(variant.album[idx]);
                _this.find('.variant_album').val(albumJson);
            }

            _this.find('.td-quantity').html(HT.addCommas(variant.quantity[idx]));
            _this.find('.td-sku').html(variant.sku[idx]);
        });
    };

    $(document).ready(function () {
        HT.setupProductVariant()
        HT.addVariant()
        HT.select2()
        HT.chooseVariantGroup()
        HT.removeAttribute()
        HT.createProductVariant()
        HT.variantAlbum()
        HT.switchChange()
        HT.updateVariant()
        HT.cancleVariantUpdate()
        HT.saveVariantUpdate()
        HT.initVariantAlbumHandler()
        HT.setupSelectMultiple().then(() => {
            HT.productVariant();
        });
    });

    document.addEventListener('input', function (e) {
        if (e.target.name === 'variant_quantity') {
            let val = e.target.value.replace(/\D/g, '');
            e.target.value = val.slice(0, 6);
        }
    });
})(jQuery);
