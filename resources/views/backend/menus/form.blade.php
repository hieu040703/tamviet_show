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

            <form action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}"
                  method="POST">
                @csrf
                @if(isset($menu))
                    @method('PUT')
                @endif
                <div class="col-md-4">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Thông tin menu</h5>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Tên menu (*)</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $menu->name ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label>Keyword menu (*)</label>
                                <input type="text" name="keyword" class="form-control"
                                       value="{{ old('keyword', $menu->keyword ?? '') }}"
                                       placeholder="VD: main-menu, footer-menu">
                            </div>

                            <div class="form-group">
                                <label>Loại menu</label>
                                <input type="text" name="type" class="form-control"
                                       value="{{ old('type', $menu->type ?? 'main') }}"
                                       placeholder="VD: main, footer">
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                @php $status = old('status', $menu->status ?? 1); @endphp
                                <select name="status" class="form-control">
                                    <option value="1" {{ $status ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="0" {{ !$status ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>

                            <div class="text-right">
                                <button class="btn btn-primary">
                                    {{ isset($menu) ? 'Cập nhật thông tin' : 'Lưu & cấu hình menu' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($menu))
                    <div class="col-md-8">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Menu chính</h5>
                                <div class="heading-elements">
                                    <a href="{{ route('admin.menus.items', ['menu' => $menu->id, 'parent_id' => 0]) }}"
                                       class="btn btn-primary btn-xs">
                                        Cập nhật Menu cấp 1
                                    </a>
                                </div>
                            </div>

                            <div class="panel-body">
                                @if($items->isEmpty())
                                    <p class="text-muted">Chưa có mục menu nào.</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="50">#</th>
                                            <th>Tên menu</th>
                                            <th width="150">Quản lý menu con</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.menus.items', ['menu' => $menu->id, 'parent_id' => $item->id]) }}"
                                                       class="btn btn-xs btn-default">
                                                        Quản lý menu con
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
