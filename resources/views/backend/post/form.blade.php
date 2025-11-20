@extends('backend.layout')

@section('content')
    <form id="productForm"
          action="{{ isset($id) ? route('admin.posts.update', $id) : route('admin.posts.store') }}"
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
                                <label class="control-label" for="name">Tên bài viết</label>
                                <input type="text"
                                       class="form-control change-title"
                                       name="name"
                                       data-flag="0"
                                       value="{{ old('name', $post->name ?? '') }}">
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
                                          name="description">{{ old('description', $post->description ?? '') }}</textarea>
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
                                          name="content">{{ old('content', $post->content ?? '') }}</textarea>
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

                @include('backend.components.seo', ['model' => $post ?? null])
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>
                            <div class="form-group @if($errors->first('post_catalogue_id ')) has-error @endif">
                                <label class="control-label text-semibold">Nhóm Bài Viết</label>
                                <select name="post_catalogue_id" class="form-control select2">
                                    <option value="">-- Chọn nhóm bài viết --</option>
                                    @foreach($catalogues as $catalogue)
                                        <option value="{{ $catalogue->id }}"
                                            {{ (string)$catalogue->id === (string)old('post_catalogue_id', $post->post_catalogue_id ?? '') ? 'selected' : '' }}>
                                            {{ $catalogue->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-control-feedback">
                                    @if($errors->first('post_catalogue_id'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('post_catalogue_id') }}</span>
                            </div>
                            @include('backend.components.status_select', [
                                 'name'  => 'status',
                                 'label' => 'Trạng thái',
                                'value' => $post->status ?? 1,
                             ])
                            @include('backend.components.status_select', [
                                  'name'  => 'is_featured',
                                  'label' => 'Nổi bật',
                                  'value' => $post->is_featured ?? 1,
                              ])
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Hình ảnh</legend>
                            @include('backend.components.image', ['model' => $post ?? null])
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
