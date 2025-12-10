@extends('backend.layout')

@section('content')
    <form id="productForm"
<<<<<<< HEAD
=======
          data-model="{{ strtolower($model ?? '') }}"
>>>>>>> hieu/update-feature
          action="{{ isset($id) ? route('admin.products.update', $id) : route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif
        <div class="col-md-12">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">{{ $title }}</legend>
                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label" for="name">Tên sản phẩm</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="name"
                                       data-flag="0"
                                       value="{{ old('name', $product->name ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('name'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
<<<<<<< HEAD
=======
                            <div class="form-group @if($errors->first('note')) has-error @endif">
                                <label class="control-label" for="note">Lưu ý</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="note"
                                       value="{{ old('note', $product->note ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('note'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
>>>>>>> hieu/update-feature
                            <div class="form-group has-feedback @if($errors->first('description')) has-error @endif">
                                <label class="control-label text-semibold">Mô tả</label>
                                <textarea class="ck-editor"
                                          id="description"
                                          name="description">{{ old('description', $product->description ?? '') }}</textarea>
                                <div class="form-control-feedback">
                                    @if($errors->first('description'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('description') }}</span>
                            </div>
                            <div class="form-group has-feedback @if($errors->first('content')) has-error @endif">
                                <label class="control-label text-semibold">Nội dung</label>
                                <textarea class="ck-editor"
                                          id="content"
                                          name="content">{{ old('content', $product->content ?? '') }}</textarea>
                                <div class="form-control-feedback">
                                    @if($errors->first('content'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('content') }}</span>
                            </div>
                        </fieldset>
                    </div>
                </div>
<<<<<<< HEAD

=======
                @include('backend.components.album',['model' => $product ?? null])
>>>>>>> hieu/update-feature
                @include('backend.components.seo', ['model' => $product ?? null])
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>
                            <div class="form-group @if($errors->first('category_id')) has-error @endif">
                                <label class="control-label text-semibold">Danh mục</label>
                                <select name="category_id" class="form-control select2">
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (string)$category->id === (string)old('category_id', $product->category_id ?? '') ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-control-feedback">
                                    @if($errors->first('category_id'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('category_id') }}</span>
                            </div>
                            <div class="form-group @if($errors->first('brand_id')) has-error @endif">
                                <label class="control-label text-semibold">Thương hiệu</label>
                                <select name="brand_id" class="form-control select2">
                                    <option value="">-- Chọn thương hiệu --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ (string)$brand->id === (string)old('brand_id', $product->brand_id ?? '') ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-control-feedback">
                                    @if($errors->first('brand_id'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('brand_id') }}</span>
                            </div>
                            @include('backend.components.status_select', [
                                 'name'  => 'status',
                                 'label' => 'Trạng thái',
                                'value' => $product->status ?? 1,
                             ])
                            @include('backend.components.status_select', [
                                  'name'  => 'is_featured',
                                  'label' => 'Nổi bật',
                                  'value' => $product->is_featured ?? 1,
                              ])
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Thông số sản phẩm</legend>
                            <div class="form-group">
                                <label class="control-label" for="code">Mã sản phẩm (code)</label>
                                <input type="text"
                                       class="form-control"
                                       name="code"
                                       value="{{ old('code', $product->code ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="sku">Mã SKU</label>
                                <input type="text"
                                       class="form-control"
                                       name="sku"
                                       value="{{ old('sku', $product->sku ?? '') }}">
                            </div>
                            <div class="form-group @if($errors->first('quantity')) has-error @endif">
                                <label class="control-label" for="quantity">Số lượng</label>
                                <input type="number"
                                       class="form-control"
                                       name="quantity"
                                       min="0"
                                       value="{{ old('quantity', $product->quantity ?? 0) }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('quantity'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('quantity') }}</span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                @if(!empty($product->qr_code ?? null))
                    <div class="panel panel-flat">
                        <div class="panel-body text-center">
                            <fieldset class="content-group">
                                <legend class="text-bold">QR CODE</legend>
                                <img src="{{ asset('storage/'.$product->qr_code) }}"
                                     alt="QR {{ $product->name ?? '' }}"
                                     style="max-width: 100%; height: auto;">
                            </fieldset>
                        </div>
                    </div>
                @endif
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Hình ảnh</legend>
                            @include('backend.components.image', ['model' => $product ?? null])
                        </fieldset>
                    </div>
                </div>
<<<<<<< HEAD
=======
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Icon</legend>
                            @include('backend.components.icon', ['model' => $product ?? null])
                        </fieldset>
                    </div>
                </div>
>>>>>>> hieu/update-feature
            </div>
        </div>
        @include('backend.components.button')
    </form>
@endsection

@push('scripts')
    <script src="{{ URL::asset('backend/global_assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/selectboxit.min.js') }}"></script>
    @include('backend.partials.ckeditor')
@endpush
