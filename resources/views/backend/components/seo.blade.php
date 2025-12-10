<div class="panel panel-flat">
    <div class="panel-body">
        <fieldset class="content-group">
            <legend class="text-bold">
                PHẦN MỤC SEO
            </legend>
            <div class="ibox-content">
                <div class="seo-container">
                    <div class="meta-title">
                        {{
<<<<<<< HEAD
                            (old('seo_title', ($model->seo_title) ?? '')) ? old('seo_title', ($model->seo_title) ?? '') : 'Bạn chưa thêm tiêu đề SEO'
                        }}
                    </div>

                    <div
                        class="canonical">{{ (old('canonical', ($model->canonical) ?? '')) ? config('app.url').old('canonical', ($model->canonical) ?? '').config('apps.general.suffix') :config('app.url').old('canonical', ($model->canonical) ?? '').config('apps.general.suffix')  }}</div>
                    <div class="meta-description">
                        {{
                            (old('seo_description', ($model->seo_title) ?? '')) ? old('seo_description', ($model->seo_title) ?? '') : 'Bạn chưa thêm mô tả SEO
'
                        }}
                    </div>
                </div>
=======
                            (old('seo_title', ($model->seo_title) ?? ''))
                                ? old('seo_title', ($model->seo_title) ?? '')
                                : 'Bạn chưa thêm tiêu đề SEO'
                        }}
                    </div>

                    <div class="canonical">
                        {{
                            config('app.url')
                            . old('canonical', ($model->canonical) ?? '')
                            . config('apps.general.suffix')
                        }}
                    </div>

                    <div class="meta-description">
                        {{
                            (old('seo_description', ($model->seo_description) ?? ''))
                                ? old('seo_description', ($model->seo_description) ?? '')
                                : 'Bạn chưa thêm mô tả SEO'
                        }}
                    </div>
                </div>

>>>>>>> hieu/update-feature
                <div class="seo-wrapper">
                    <div class="row mb15">
                        <div class="col-md-12">
                            <label for="" class="control-label text-left">
                                <div class="flex flex-middle flex-between">
                                    <span class="control-label text-semibold">Tiêu Đề Seo</span>
<<<<<<< HEAD
                                    <span
                                        class="control-label text-semibold count_meta-title">0 {{ __("character") }}</span>
=======
                                    <span class="control-label text-semibold count_meta-title">
                                        0 {{ __("character") }}
                                    </span>
>>>>>>> hieu/update-feature
                                </div>
                            </label>
                            <input
                                type="text"
                                name="seo_title"
                                value="{{ old('seo_title', ($model->seo_title) ?? '' ) }}"
                                class="form-control"
<<<<<<< HEAD
                                placeholder=""
=======
>>>>>>> hieu/update-feature
                                autocomplete="off"
                                {{ (isset($disabled)) ? 'disabled' : '' }}
                            >
                        </div>
                    </div>
<<<<<<< HEAD
=======

>>>>>>> hieu/update-feature
                    <div class="row mb15">
                        <div class="col-lg-12">
                            <label for="" class="control-label text-left">
                                <span>Từ Khóa Seo</span>
                            </label>
                            <input
                                type="text"
                                name="seo_keyword"
                                value="{{ old('seo_keyword', ($model->seo_keyword) ?? '' ) }}"
                                class="form-control"
<<<<<<< HEAD
                                placeholder=""
=======
>>>>>>> hieu/update-feature
                                autocomplete="off"
                                {{ (isset($disabled)) ? 'disabled' : '' }}
                            >
                        </div>
                    </div>
<<<<<<< HEAD
=======

>>>>>>> hieu/update-feature
                    <div class="row mb15">
                        <div class="col-lg-12">
                            <label for="" class="control-label text-left">
                                <div class="flex flex-middle flex-between">
                                    <span>Mô Tả Seo</span>
<<<<<<< HEAD
                                    <span class="count_meta-description"><span class="countD">0</span> / 160 {{ __("character") }}</span>
=======
                                    <span class="count_meta-description">
                                        <span class="countD">0</span> / 160 {{ __("character") }}
                                    </span>
>>>>>>> hieu/update-feature
                                </div>
                            </label>
                            <textarea
                                name="seo_description"
                                class="form-control custom-textarea-height"
<<<<<<< HEAD
                                placeholder=""
                                autocomplete="off"
                            {{ (isset($disabled)) ? 'disabled' : '' }}
                        >{{ old('seo_description', ($model->seo_description) ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="row mb15">
                        <div class="col-lg-12 @if($errors->first('canonical')) has-error @endif">
                            <label for="" class="control-label text-left">
                                    <span>URL chuẩn (Loại bỏ phần đuôi .html)<span
                                            class="text-danger">*</span></span>
=======
                                autocomplete="off"
                                {{ (isset($disabled)) ? 'disabled' : '' }}
                            >{{ old('seo_description', ($model->seo_description) ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="row mb15">
                        <div class="col-lg-12 @if($errors->first('canonical')) has-error @endif">
                            <label for="" class="control-label text-left">
                                <span>
                                    URL chuẩn (Loại bỏ phần đuôi .html)
                                    <span class="text-danger">*</span>
                                </span>
>>>>>>> hieu/update-feature
                            </label>
                            <div class="input-wrapper">
                                <input
                                    type="text"
                                    name="canonical"
                                    value="{{ old('canonical', ($model->canonical) ?? '' ) }}"
                                    class="form-control seo-canonical"
<<<<<<< HEAD
                                    placeholder=""
=======
>>>>>>> hieu/update-feature
                                    autocomplete="off"
                                    {{ (isset($disabled)) ? 'disabled' : '' }}
                                >
                                <span class="baseUrl">{{ config('app.url') }}</span>
                                <div class="form-control-feedback">
                                    @if($errors->first('canonical'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('canonical') }}</span>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
=======

>>>>>>> hieu/update-feature
                </div>
            </div>
        </fieldset>
    </div>
</div>
