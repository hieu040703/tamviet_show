@extends('backend.layout')

@section('content')
    <form id="productForm"
          action="{{ isset($item) ? route('admin.banner_items.update', $item->id) : route('admin.banner_items.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($item))
            @method('PUT')
        @endif

        <div class="col-md-12">

            {{-- LEFT --}}
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">

                        <fieldset class="content-group">
                            <legend class="text-bold">{{ $title }}</legend>

                            {{-- Nhóm banner --}}
                            <div class="form-group @error('banner_id') has-error @enderror">
                                <label class="control-label">Nhóm Banner</label>
                                <select name="banner_id" class="form-control">
                                    <option value="">-- Chọn nhóm --</option>
                                    @foreach($banners as $b)
                                        <option value="{{ $b->id }}"
                                            {{ old('banner_id', $item->banner_id ?? $banner_id ?? '') == $b->id ? 'selected' : '' }}>
                                            {{ $b->name }} ({{ $b->code }})
                                        </option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('banner_id') }}</span>
                            </div>

                            {{-- Title --}}
                            <div class="form-group @error('title') has-error @enderror">
                                <label class="control-label">Tiêu đề</label>
                                <input type="text" class="form-control"
                                       name="title"
                                       value="{{ old('title', $item->title ?? '') }}">
                                <span class="help-block">{{ $errors->first('title') }}</span>
                            </div>

                            {{-- Subtitle --}}
                            <div class="form-group @error('subtitle') has-error @enderror">
                                <label class="control-label">Phụ đề</label>
                                <input type="text" class="form-control"
                                       name="subtitle"
                                       value="{{ old('subtitle', $item->subtitle ?? '') }}">
                                <span class="help-block">{{ $errors->first('subtitle') }}</span>
                            </div>

                            {{-- Link --}}
                            <div class="form-group @error('link') has-error @enderror">
                                <label class="control-label">Link</label>
                                <input type="text" class="form-control"
                                       name="link"
                                       value="{{ old('link', $item->link ?? '') }}">
                                <span class="help-block">{{ $errors->first('link') }}</span>
                            </div>

                            {{-- Sort order --}}
                            <div class="form-group @error('sort_order') has-error @enderror">
                                <label class="control-label">Thứ tự</label>
                                <input type="number" class="form-control"
                                       name="sort_order"
                                       value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                                <span class="help-block">{{ $errors->first('sort_order') }}</span>
                            </div>

                        </fieldset>

                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-md-3">

                {{-- Status --}}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN</legend>

                            @include('backend.components.status_select', [
                                'name'  => 'status',
                                'label' => 'Trạng thái',
                                'value' => old('status', $item->status ?? 1),
                            ])

                        </fieldset>
                    </div>
                </div>

                {{-- Image --}}
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">

                            <legend class="text-bold">Hình ảnh</legend>

                            @include('backend.components.image', [
                                'model' => $item ?? null,
                                'name'  => 'image'
                            ])

                        </fieldset>
                    </div>
                </div>

            </div>
        </div>

        @include('backend.components.button')
    </form>
@endsection
