(function ($) {
    "use strict";
    var HT = {};

    HT.setupProductVariant = () => {
        if ($('.turnOnVariant').length) {
            $(document).on('click', '.turnOnVariant', function () {
                let _this = $(this)
                let import_price = $('input[name=import_price]').val()
                let sale_price = $('input[name=sale_price]').val()
                let code = $('input[name=code]').val()

                if (import_price == '' || code == '' || sale_price == '') {
                    alert(
                        window.trans.You_must_enter_the_Import_Price + '\n' +
                        window.trans.Selling_Price_and_Product_Code_to_use_this_function
                    );
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
        html = html + '<option value="">' + window.trans.Select_the_attribute_group + '</option>';
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

            // console.log(attributes);

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


        // let html = HT.renderTableHtml(attributes, attributeTitle, variants);
        // $('table.variantTable').html(html)
    }

    HT.createVariantRow = (attributeItem, variantItem) => {
        let attributeString = Object.values(attributeItem).join(', ')
        let attributeId = Object.values(variantItem).join(', ')
        let classModified = attributeId.replace(/, /g, '-')

        let $row = $('<tr>').addClass('variant-row tr-variant-' + classModified)
        let $td

        $td = $('<td>').append(
            $('<span>').addClass('image img-cover').append(
                $('<img>').attr('src', 'https://daks2k3a4ib2z.cloudfront.net/6343da4ea0e69336d8375527/6343da5f04a965c89988b149_1665391198377-image16-p-500.jpg').addClass('imageSrc')
            )
        )
        $row.append($td)

        Object.values(attributeItem).forEach(value => {
            $td = $('<td>').text(value)
            $row.append($td)
        })

        $td = $('<td>').addClass('hidden td-variant')


        let mainImportPrice = $('input[name=import_price]').val()
        let mainSalePrice = $('input[name=sale_price]').val()
        let mainSku = $('input[name=code]').val()
        let inputHiddenFields = [
            {name: 'variant[quantity][]', class: 'variant_quantity'},
            {name: 'variant[sku][]', class: 'variant_sku', value: mainSku + '-' + classModified},
            {name: 'variant[import_price][]', class: 'variant_import_price', value: mainImportPrice},
            {name: 'variant[sale_price][]', class: 'variant_sale_price', value: mainSalePrice},
            {name: 'productVariant[name][]', value: attributeString},
            {name: 'productVariant[id][]', value: attributeId},
        ]

        $.each(inputHiddenFields, function (_, field) {
            let $input = $('<input>').attr('type', 'text').attr('name', field.name).addClass(field.class)
            if (field.value) {
                $input.val(field.value)
            }
            $td.append($input)
        })
        $row.append($('<td>').addClass('td-quantity').text('-'))
            .append($('<td>').addClass('td-import-price').text(mainImportPrice))
            .append($('<td>').addClass('td-sale-price').text(mainSalePrice))
            .append($('<td>').addClass('td-sku').text(mainSku + '-' + classModified))
            .append($td)
        return $row
    }

    HT.createTableHeader = (attributeTitle) => {
        let $thead = $('table.variantTable thead')
        let $row = $('<tr>')
        $row.append($('<td>').text(window.trans.Image))
        for (let i = 0; i < attributeTitle.length; i++) {
            $row.append($('<td>').text(attributeTitle[i]))
        }

        $row.append($('<td>').text(window.trans.Quantity))
        $row.append($('<td>').text(window.trans.Import_Price))
        $row.append($('<td>').text(window.trans.Selling_price))
        $row.append($('<td>').text(window.trans.SKU))

        $thead.html($row)
        return $thead

    }


    HT.getSelect2 = (object) => {
        let option = {
            'attributeCatalogueId': object.attr('data-catid')
        }
        $(object).select2({
            minimumInputLength: 0,
            placeholder: window.trans.Enter_at_least_2_characters_to_search,
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
            $('.variant-foot').html('<button type="button" class="add-variant">' + window.trans.Add_new_version + '</button>')
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

    HT.browseVariantServerAlbum = () => {
        var type = 'Images';
        var finder = new CKFinder();

        finder.resourceType = type;
        finder.selectActionFunction = function (data, allFiles) {
            let html = '';
            for (var i = 0; i < allFiles.length; i++) {
                var image = allFiles[i].url
                html += '<li class="ui-state-default">'
                html += ' <div class="thumb">'
                html += ' <span class="span image img-scaledown">'
                html += '<img src="' + image + '" alt="' + image + '">'
                html += '<input type="hidden" name="variantAlbum[]" value="' + image + '">'
                html += '</span>'
                html += '<button class="variant-delete-image"><i class="fa fa-trash"></i></button>'
                html += '</div>'
                html += '</li>'
            }

            $('.click-to-upload-variant').addClass('hidden')
            $('#sortable2').append(html)
            $('.upload-variant-list').removeClass('hidden')
        }
        finder.popup();
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

            let updateVariantBox = HT.updateVariantHtml(variantData)
            if ($('.updateVariantTr').length == 0) {
                _this.after(updateVariantBox)
                HT.switchery()
            }
        })
    }

    HT.switchery = () => {
        $('.js-switch').each(function () {
            // let _this = $(this)
            var switchery = new Switchery(this, {color: '#1AB394', size: 'small'});
        })
    }
    HT.updateVariantHtml = (variantData) => {
        let html = ''
        let colspan = $('.variantTable thead tr td').length
        html = html + '<tr class="updateVariantTr">'
        html = html + '<td colspan="' + colspan + '">'
        html = html + '<div class="updateVariant ibox">'
        html = html + '<div class="ibox-title">'
        html = html + '<div class="uk-flex uk-flex-middle uk-flex-space-between">'
        html = html + '<h5>' + window.trans.Update_version_information + '</h5>'
        html = html + '<div class="button-group">'
        html = html + '<div class="uk-flex uk-flex-middle">'
        html = html + '<button type="button" class="cancleUpdate btn btn-danger mr10">' + window.trans.Cancel + '</button>'
        html = html + '<button type="button" class="saveUpdateVariant btn btn-success">' + window.trans.Stay + '</button>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '</div>'
        html = html + '<div class="ibox-content">'
        html = html + '<div class="row mt20 uk-flex uk-flex-middle mb-20">'
        html = html + '<div class="col-lg-2 uk-flex uk-flex-middle mt-30">'
        html = html + '<label for="" class="mr10">' + window.trans.Inventory + '</label>'
        html = html + '<input type="checkbox" class="js-switch" ' + ((variantData.variant_quantity !== '') ? 'checked' : '') + ' data-target="variantQuantity">'
        html = html + '</div>'
        html = html + '<div class="col-lg-10">'
        html = html + '<div class="row">'
        html = html + '<div class="col-lg-3">'
        html = html + '<label for="" class="control-label">Số lượng</label>'
        html = html + '<input type="text" ' + ((variantData.variant_quantity == '') ? 'disabled' : '') + '  name="variant_quantity" value="' + variantData.variant_quantity + '" class="form-control ' + ((variantData.variant_quantity == '') ? 'disabled' : '') + ' int">'
        html = html + '</div>'
        html = html + '<div class="col-lg-3">'
        html = html + '<label for="" class="control-label">'+ window.trans.SKU +'</label>'
        html = html + '<input type="text" name="variant_sku" value="' + variantData.variant_sku + '" class="form-control text-right">'
        html = html + '</div>'
        html = html + '<div class="col-lg-3">'
        html = html + '<label for="" class="control-label">Giá</label>'
        html = html + '<input type="text" name="variant_import_price" value="' + HT.addCommas(variantData.variant_import_price) + '" class="form-control int">'
        html = html + '</div>'
        html = html + '<div class="col-lg-3">'
        html = html + '<label for="" class="control-label">Biá bán</label>'
        html = html + '<input type="text" name="variant_sale_price" value="' + variantData.variant_sale_price + '" class="form-control text-right">'
        html = html + '</div>'
        html = html + '</div>'
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

            let variant = {
                'quantity': $('input[name=variant_quantity]').val(),
                'sku': $('input[name=variant_sku]').val(),
                'import_price': $('input[name=variant_import_price]').val(),
                'sale_price': $('input[name=variant_sale_price]').val(),
            }

            $.each(variant, function (index, value) {
                $('.updateVariantTr').prev().find('.variant_' + index).val(value)
            })

            HT.previewVariantTr(variant)
            HT.closeUpdateVariantBox()
        })
    }

    HT.previewVariantTr = (variant) => {
        let option = {
            'quantity': variant.quantity,
            'import-price': variant.import_price,
            'sale-price': variant.sale_price,
            'sku': variant.sku,
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
                        $.get('ajax/attribute/loadAttribute', {
                            attribute: attribute,
                            attributeCatalogueId: attributeCatalogueId
                        }, function (json) {
                            if (json.items !== 'undefined' && json.items.length) {
                                for (let i = 0; i < json.items.length; i++) {
                                    var option = new Option(json.items[i].text, json.items[i].id, true, true);
                                    _this.append(option).trigger('change');
                                }
                            }
                            if (--count === 0) {
                                resolve();
                            }
                        });
                    }
                    HT.getSelect2(_this);
                });
            } else {
                resolve();
            }
        });
    };

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
                {name: 'variant[sku][]',      class: 'variant_sku',      value: variant.sku[idx]},
                {name: 'variant[import_price][]', class: 'variant_import_price', value: variant.import_price[idx]},
                {name: 'variant[sale_price][]',   class: 'variant_sale_price',   value: variant.sale_price[idx]},
            ];
            for (const f of inputHiddenFields) {
                _this.find('.' + f.class).val(f.value || 0);
            }
            _this.find('.td-quantity').html(HT.addCommas(variant.quantity[idx]));
            _this.find('.td-import-price').html(HT.addCommas(variant.import_price[idx]));
            _this.find('.td-sale-price').html(HT.addCommas(variant.sale_price[idx]));
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
        // HT.setupSelectMultiple(
        //     () => {
        //         HT.productVariant()
        //     }
        // )

        HT.setupSelectMultiple().then(() => {
            HT.productVariant();
        });

        // HT.productVariant()

    });
    document.addEventListener('input', function (e) {
        if (e.target.name === 'variant_quantity') {
            let val = e.target.value.replace(/\D/g, '');
            e.target.value = val.slice(0, 6);
        }
    });

})(jQuery);

