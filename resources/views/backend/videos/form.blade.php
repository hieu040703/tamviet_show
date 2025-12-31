@extends('backend.layout')

@section('content')
    <form id="productForm"
          data-model="{{ strtolower($model ?? '') }}"
          action="{{ isset($id) ? route('admin.videos.update', $id) : route('admin.videos.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif
        <input type="hidden" name="user_id" value="{{ auth('admin')->id() }}">
        <div class="col-md-12">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">{{ $title }}</legend>
                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label">Tên video</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="name"
                                       data-flag="0"
                                       value="{{ old('name', $video->name ?? '') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">YouTube ID</label>
                                <input type="text"
                                       class="form-control"
                                       name="youtube_id"
                                       placeholder="VD: dQw4w9WgXcQ"
                                       value="{{ old('youtube_id', $video->youtube_id ?? '') }}">
                            </div>
                            <div class="form-group @if($errors->first('description')) has-error @endif">
                                <label class="control-label text-semibold">Mô tả</label>
                                <textarea class="ck-editor"
                                          id="description"
                                          name="description">{{ old('description', $video->description ?? '') }}</textarea>
                                <span class="help-block">{{ $errors->first('description') }}</span>
                            </div>

                        </fieldset>
                    </div>
                </div>
                @include('backend.components.seo', ['model' => $video ?? null])
            </div>
            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>
                            @include('backend.components.status_select', [
                                'name'  => 'status',
                                'label' => 'Trạng thái',
                                'value' => $video->status ?? 1,
                            ])

                            @include('backend.components.status_select', [
                                'name'  => 'is_featured',
                                'label' => 'Nổi bật',
                                'value' => $video->is_featured ?? 0,
                            ])
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Ảnh đại diện</legend>
                            @include('backend.components.image', ['model' => $video ?? null])
                        </fieldset>
                    </div>
                </div>
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
