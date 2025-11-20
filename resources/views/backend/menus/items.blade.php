@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <h4 style="margin-bottom:15px;">
                Cập nhật menu con cho mục
                <strong>{{ $parentItem->name ?? $menu->name }}</strong>
            </h4>

            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Liên kết tự tạo</h6>
                        </div>
                        <div class="panel-body">
                            <p class="text-danger" style="font-size:12px;">
                                * Tiêu đề và đường dẫn không được bỏ trống.<br>
                                * Hệ thống hỗ trợ tối đa 5 cấp menu (quản lý lần lượt từng cấp).
                            </p>

                            <button type="button" class="btn btn-primary btn-block" id="btnAddEmptyRow">
                                + Thêm đường dẫn
                            </button>

                            <hr>

                            <div class="form-group">
                                <label>Loại dữ liệu</label>
                                <select id="menu-router-module" class="form-control">
                                    <option value="all">-- Tất cả --</option>
                                    <option value="categories">Danh mục</option>
                                    <option value="products">Sản phẩm</option>
                                    <option value="brands">Thương hiệu</option>
                                    <option value="posts">Bài viết</option>
                                    <option value="post_catalogues">Nhóm bài viết</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tìm router (canonical / tên)</label>
                                <input type="text"
                                       id="menu-router-search"
                                       class="form-control"
                                       data-url="{{ route('ajax.menus.searchRouter') }}"
                                       placeholder="Nhập từ khóa để tìm...">
                            </div>

                            <div id="menu-router-result"
                                 class="table-responsive"
                                 style="display:none; max-height:260px; overflow-y:auto;">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Đường dẫn</th>
                                        <th>Loại</th>
                                        <th width="70">Thêm</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('admin.menus.edit', $menu->id) }}">← Quay lại menu chính</a>
                </div>

                {{-- CỘT PHẢI: BẢNG MENU CON --}}
                <div class="col-md-9">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Tên menu</h6>
                        </div>
                        <div class="panel-body">

                            <form method="POST"
                                  action="{{ route('admin.menus.items.save', $menu->id) }}"
                                  id="menu-items-form">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $parentId }}">

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="40"></th>
                                            <th>Tên menu</th>
                                            <th width="320">Đường dẫn</th>
                                            <th width="70" class="text-center">Vị trí</th>
                                            <th width="60" class="text-center">Hiển</th>
                                            <th width="50" class="text-center">Xóa</th>
                                        </tr>
                                        </thead>
                                        <tbody id="menu-items-sortable">
                                        @foreach($items as $index => $item)
                                            <tr class="menu-item-row">
                                                <td class="text-center sort-handle">
                                                    <i class="icon-menu"></i>
                                                </td>
                                                <td>
                                                    <input type="text" name="items[{{ $index }}][name]"
                                                           class="form-control"
                                                           value="{{ $item->name }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="items[{{ $index }}][url]"
                                                           class="form-control"
                                                           value="{{ $item->url }}">
                                                    <input type="hidden" name="items[{{ $index }}][router_id]"
                                                           value="{{ $item->router_id }}">
                                                </td>
                                                <td class="text-center index-col">
                                                    {{ $index + 1 }}
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox"
                                                           name="items[{{ $index }}][status]" value="1"
                                                        {{ $item->status ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <a class="text-danger btn-remove-row"><i class="icon-cross2"></i></a>
                                                </td>
                                                <input type="hidden" name="items[{{ $index }}][id]"
                                                       value="{{ $item->id }}">
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">
                                        Lưu lại
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        #menu-items-sortable .menu-item-row {
            cursor: move;
        }

        .sort-handle {
            cursor: move;
        }

        .index-col {
            vertical-align: middle;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{URL::asset('backend/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/menu-items.js') }}"></script>
@endpush
