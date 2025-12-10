@extends('backend.layout')

@section('content')
    <div class="row">
<<<<<<< HEAD
        <div class="col-md-8">
            <form action="{{ $widget ? route('admin.widgets.update', $widget->id)
                                  : route('admin.widgets.store') }}"
                  method="POST">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ $widget ? 'Cập nhật Widget' : 'Thêm Widget' }}</h5>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tên widget</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $widget->name ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Code (unique, dùng trong code)</label>
                            <input type="text" name="code" class="form-control"
                                   value="{{ old('code', $widget->code ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Type (product / brand / post / custom...)</label>
                            <input type="text" name="type" class="form-control"
                                   value="{{ old('type', $widget->type ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label>Vị trí</label>
                            <input type="number" name="position" class="form-control"
                                   value="{{ old('position', $widget->position ?? 0) }}">
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="status" value="1"
                                    {{ old('status', $widget->status ?? 1) ? 'checked' : '' }}>
                                Hoạt động
                            </label>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                Lưu
                                <i class="icon-arrow-right14 position-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if($widget)
            <div class="col-md-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Widget Items</h5>
                        <div class="heading-elements">
                            <a href="{{ route('admin.widget_items.create', $widget->id) }}"
                               class="btn btn-xs btn-primary">
                                <i class="icon-plus3"></i> Thêm item
                            </a>
                        </div>
                    </div>

                    <div class="panel-body" style="padding:0;">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Sort</th>
                                <th width="120">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($widget->items as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->sort_order }}</td>
                                    <td>
                                        <a href="{{ route('admin.widget_items.edit', [$widget->id, $item->id]) }}"
                                           class="btn btn-xs btn-primary">
                                            Sửa
                                        </a>
                                        <form
                                            action="{{ route('admin.widget_items.delete', [$widget->id, $item->id]) }}"
                                            method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Xóa item này?')">
                                            @csrf
                                            <button type="submit" class="btn btn-xs btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Chưa có item</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
=======
        <div class="col-md-12">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form
                action="{{ isset($widget) ? route('admin.widgets.update', $widget->id) : route('admin.widgets.store') }}"
                method="post">
                @csrf
                @if(isset($widget))
                    @method('PUT')
                @endif

                <div class="col-md-9">

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Thông tin Widget</h5>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Mô tả ngắn</label>
                                <textarea name="description" rows="5"
                                          id="description"
                                          class="form-control">{{ old('description', $widget->description ?? '') }}</textarea>
                            </div>

                            @php
                                $album = old('album', isset($widget) && is_array($widget->album) ? $widget->album : []);
                                if (is_string($album)) {
                                    $album = json_decode($album, true) ?: [];
                                }
                            @endphp

                            <div class="form-group">
                                <label>Album ảnh</label>

                                <div class="panel panel-body border dashed" id="album-dropzone"
                                     style="text-align:center; padding:40px 20px;">
                                    <p>Sử dụng nút <strong>Thêm ảnh</strong>, nhập đường dẫn dạng
                                        <code>products/ten-file.jpg</code>,
                                        <code>brands/ten-file.png</code>
                                        (đã nằm trong <code>storage/app/public</code>).
                                    </p>
                                    <button type="button" class="btn btn-default" id="album-add-image">
                                        Thêm ảnh
                                    </button>
                                </div>

                                <table class="table table-bordered table-striped" id="album-table"
                                       style="margin-top:15px;">
                                    <thead>
                                    <tr>
                                        <th width="80">Ảnh</th>
                                        <th>Đường dẫn</th>
                                        <th width="50" class="text-center">Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($album as $img)
                                        @php $url = asset('storage/'.$img); @endphp
                                        <tr data-src="{{ $img }}">
                                            <td>
                                                <img src="{{ $url }}"
                                                     style="width:70px;height:70px;object-fit:cover;border-radius:4px;">
                                            </td>
                                            <td>{{ $img }}</td>
                                            <td class="text-center">
                                                <a href="#" class="text-danger js-album-remove">
                                                    <i class="icon-cross2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <input type="hidden" name="album" id="album-input" value='@json($album)'>
                            </div>
                        </div>
                    </div>

                    @php
                        $currentModel = old('model', $widget->model ?? 'products');
                        $currentIds   = old('model_id', isset($widget) && is_array($widget->model_id) ? $widget->model_id : []);
                        if (is_string($currentIds)) {
                            $currentIds = json_decode($currentIds, true) ?: [];
                        }

                        $moduleLabels = [
                            'products'        => 'Sản phẩm',
                            'categories'      => 'Danh mục',
                            'brands'          => 'Thương hiệu',
                            'posts'           => 'Bài viết',
                            'post_catalogues' => 'Nhóm bài viết',
                        ];
                        $moduleLabel = $moduleLabels[$currentModel] ?? $currentModel;
                    @endphp

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Cấu hình nội dung widget</h5>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label>Chọn module</label>
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name="model"
                                               value="post_catalogues" {{ $currentModel == 'post_catalogues' ? 'checked' : '' }}>
                                        Nhóm Bài Viết
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="model"
                                               value="posts" {{ $currentModel == 'posts' ? 'checked' : '' }}>
                                        Bài Viết
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="model"
                                               value="categories" {{ $currentModel == 'categories' ? 'checked' : '' }}>
                                        Danh mục
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="model"
                                               value="products" {{ $currentModel == 'products' ? 'checked' : '' }}>
                                        Sản phẩm
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="model"
                                               value="brands" {{ $currentModel == 'brands' ? 'checked' : '' }}>
                                        Thương hiệu
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Tìm kiếm</label>
                                <input type="text"
                                       id="widget-search"
                                       class="form-control"
                                       data-search-url="{{ route('ajax.widgets.searchItems') }}"
                                       placeholder="Nhập từ khóa để tìm...">
                            </div>

                            <h5 class="mt-10">
                                Danh sách đã chọn
                                <small class="text-muted" id="widget-module-label">({{ $moduleLabel }})</small>
                            </h5>

                            <table class="table table-bordered table-striped" id="widget-selected-table">
                                <thead>
                                <tr>
                                    <th style="width:60px;" class="text-center">STT</th>
                                    <th style="width:70px;">Ảnh</th>
                                    <th>Tên</th>
                                    <th style="width:80px;">ID</th>
                                    <th style="width:50px;" class="text-center">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(($selectedItems ?? []) as $index => $item)
                                    @php
                                        $imgPath = $item->image ?? null;
                                        $imgUrl  = $imgPath ? asset('storage/'.$imgPath) : null;
                                    @endphp
                                    <tr data-id="{{ $item->id }}">
                                        <td class="text-center js-order">
                                            {{ $index + 1 }}
                                        </td>
                                        <td>
                                            @if($imgUrl)
                                                <img src="{{ $imgUrl }}"
                                                     style="width:60px;height:60px;object-fit:cover;border-radius:4px;">
                                            @endif
                                        </td>
                                        <td class="js-drag-handle" style="cursor:move;">
                                            {{ $item->name }}
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td class="text-center">
                                            <a href="#" class="text-danger js-remove-selected">
                                                <i class="icon-cross2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <input type="hidden" name="model_id" id="widget-model-id"
                                   value='@json($currentIds)'>

                            <hr>

                            <div id="widget-search-result"
                                 class="list-group"
                                 style="display:none; max-height: 260px; overflow-y: auto;"></div>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <fieldset class="content-group">
                                <legend class="text-bold">Cài đặt cơ bản</legend>

                                <div class="form-group">
                                    <label>Tên Widget</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('name', $widget->name ?? '') }}">
                                </div>

                                <div class="form-group">
                                    <label>Từ khóa Widget</label>
                                    <input type="text" name="keyword" class="form-control"
                                           value="{{ old('keyword', $widget->keyword ?? '') }}">
                                </div>

                                <div class="form-group">
                                    <label>Thứ tự hiển thị</label>
                                    <input type="number" name="sort_order" class="form-control"
                                           value="{{ old('sort_order', $widget->sort_order ?? 0) }}">
                                </div>

                                @include('backend.components.status_select', [
                                    'name'  => 'status',
                                    'label' => 'Trạng thái',
                                    'value' => old('status', $widget->status ?? 1),
                                ])
                            </fieldset>
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <fieldset class="content-group">
                                <legend class="text-bold">Short code</legend>
                                <div class="form-group">
                                    <label>Short code</label>
                                    <input type="text" readonly class="form-control"
                                           value="{{ isset($widget) ? $widget->short_code : '[widget-id=&quot;slug&quot;]' }}">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary">
                            {{ isset($widget) ? 'Cập nhật' : 'Lưu' }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @include('backend.partials.ckeditor')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('backend/assets/js/widget-form.js') }}"></script>
@endpush
>>>>>>> hieu/update-feature
