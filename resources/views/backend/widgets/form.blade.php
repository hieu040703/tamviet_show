@extends('backend.layout')

@section('content')
    <div class="row">
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
