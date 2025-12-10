@extends('backend.layout')

@section('content')
    <form id="productForm"
<<<<<<< HEAD
=======
          data-model="{{ strtolower($model ?? '') }}"
>>>>>>> hieu/update-feature
          action="{{ isset($id) ? route('admin.brands.update', $id) : route('admin.brands.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif
<<<<<<< HEAD

=======
>>>>>>> hieu/update-feature
        <div class="col-md-12">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">{{ $title }}</legend>
                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label" for="name">Tên thương hiệu</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="name"
                                       data-flag="0"
                                       value="{{ old('name', $brand->name ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('name'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group has-feedback @if($errors->first('description')) has-error @endif">
                                <label class="control-label text-semibold">Mô tả</label>
                                <textarea class="ck-editor"
                                          id="description"
                                          name="description">{{ old('description', $brand->description ?? '') }}</textarea>
                                <div class="form-control-feedback">
                                    @if($errors->first('description'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('description') }}</span>
                            </div>
                        </fieldset>
                    </div>
                </div>

                @include('backend.components.seo', ['model' => $brand ?? null])
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>
                            @include('backend.components.status_select', [
                             'name'  => 'status',
                             'label' => 'Trạng thái',
                            'value' => $brand->status ?? 1,
                         ])
                            @include('backend.components.status_select', [
                                  'name'  => 'is_featured',
                                  'label' => 'Nổi bật',
                                  'value' => $brand->is_featured ?? 1,
                              ])
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Hình Ảnh</legend>
                            @include('backend.components.image', ['model' => $brand ?? null])
                        </fieldset>
                    </div>
                </div>
<<<<<<< HEAD
=======
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Icon</legend>
                            @include('backend.components.icon', ['model' => $brand ?? null])
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
