<div class="panel panel-flat">
    <div class="panel-body">
        <fieldset class="content-group">
            <legend class="text-bold">
                Sản phẩm có nhiều mẫu mã
            </legend>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="variant-checkbox flex flex-middle">
                            <input
                                type="checkbox"
                                value="1"
                                name="accept"
                                id="variantCheckbox"
                                class="variantInputCheckbox"
                                {{ (
                                    old('accept') == 1
                                        ||
                                        (
                                            isset($product)
                                            &&
                                            count($product->product_variants)  > 0
                                        )
                                    ) ? 'checked' : ''
                                }}
                            >
                            <label for="variantCheckbox" class="turnOnVariant">
                                Sản phẩm này có nhiều biến thể, ví dụ như nhiều màu sắc và kích cỡ khác nhau.
                            </label>
                        </div>
                    </div>
                </div>
                @php
                    $variantCatalogue = old('attributeCatalogue', (isset($product->attributeCatalogue)
                        ? json_decode($product->attributeCatalogue, TRUE)
                        : []
                    ));
                @endphp

                <div class="variant-wrapper {{ ($variantCatalogue && count($variantCatalogue)) ? '' : 'hidden' }}">
                    <div class="row variant-container">
                        <div class="col-lg-3">
                            <div class="attribute-title">{{__("Select properties")}}</div>
                        </div>
                        <div class="col-lg-9">
                            <div class="attribute-title">{{__("Select attribute value (enter 2 words to search)")}}</div>
                        </div>
                    </div>

                    <div class="variant-body">
                        @if($variantCatalogue && count($variantCatalogue))
                            @foreach($variantCatalogue as $keyAttr => $valAttr)
                                <div class="row mb20 variant-item">
                                    <div class="col-lg-3">
                                        <div class="attribute-catalogue">
                                            <select name="attributeCatalogue[]" id=""
                                                    class="choose-attribute niceSelect form-control select2">
                                                <option value="">{{__("Select Attribute Group")}}</option>
                                                @foreach($attributeCatalogue as $key => $val)
                                                    <option
                                                        {{ $valAttr == $val['id'] ? 'selected' : '' }}
                                                        value="{{ $val['id'] }}">
                                                        {{ $val['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="attribute[{{ $valAttr }}][]"
                                                class="selectVariant variant-{{ $valAttr }} form-control" multiple
                                                data-catid="{{ $valAttr }}" id=""></select>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="remove-attribute btn btn-danger">
                                            <svg data-icon="TrashSolidLarge" aria-hidden="true" focusable="false"
                                                 width="15"
                                                 height="16" viewBox="0 0 15 16" class="bem-Svg"
                                                 style="display: block;">
                                                <path fill="currentColor"
                                                      d="M2 14a1 1 0 001 1h9a1 1 0 001-1V6H2v8zM13 2h-3a1 1 0 01-1-1H6a1 1 0 01-1 1H1v2h13V2h-1z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="variant-foot mt10">
                        <button type="button" class="add-variant">{{__("Add new version")}}</button>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-body">
        <fieldset class="content-group">
            <legend class="text-bold">
                Danh sách phiên bản
            </legend>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped variantTable">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </fieldset>
    </div>
</div>

<script>
    const loadAttributeUrl = "{{ route('ajax.attribute.loadAttribute') }}";
    const getAttribute = "{{ route('ajax.attribute.getAttribute') }}";
    const uploadVariantImage = "{{ route('ajax.upload.variant') }}";
    const deleteVariantImage = "{{ route('ajax.delete.variant') }}";

    var attributeCatalogue = @json($attributeCatalogue);

    let attribute = '{{ base64_encode(json_encode(old('attribute') ?? (isset($product->attribute) ? json_decode($product->attribute, TRUE) : []))) }}';

    var variant = '{{ base64_encode(json_encode(old('variant') ?? (isset($product->variant) ? json_decode($product->variant, TRUE) : []))) }}';
</script>
