@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <p style="margin:0; padding:5px 0;">
            <span class="text-semibold">
                {{ ($widgets->currentPage() - 1) * $widgets->perPage() + 1 }}
                -
                {{ ($widgets->currentPage() - 1) * $widgets->perPage() + $widgets->count() }}
            </span>
                trong
                <span class="text-semibold">{{ $widgets->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a class="text-left collapsed" data-toggle="collapse" data-target="#navbar-filter">
                                <i class="icon-more"></i>
                            </a>
                            <a href="{{ route('admin.widgets.create') }}" class="btn text-right">
                                <i class="icon-plus3 position-left"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="navbar-collapse collapse" id="navbar-filter">
                        <div class="navbar-form navbar-left">
                            <form action="{{ route('admin.widgets.index') }}" method="GET">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="keyword" autocomplete="off"
                                           placeholder="Tìm kiếm theo tên / code"
                                           value="{{ request('keyword') }}">
                                </div>
                                <button type="submit" class="btn btn-info">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="navbar-form navbar-right">
                            <a href="{{ route('admin.widgets.create') }}" class="btn btn-primary">
                                <i class="icon-plus3 position-left"></i> Thêm mới
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Tên</th>
                            <th>Code</th>
                            <th>Type</th>
                            <th width="80">Vị trí</th>
                            <th width="80">Trạng thái</th>
                            <th width="200" class="text-center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($widgets as $widget)
                            <tr>
                                <td>{{ $widget->id }}</td>
                                <td>{{ $widget->name }}</td>
                                <td>{{ $widget->code }}</td>
                                <td>{{ $widget->type }}</td>
                                <td>{{ $widget->position }}</td>
                                <td>
                                    @if($widget->status)
                                        <span class="label label-success">Hoạt động</span>
                                    @else
                                        <span class="label label-default">Tắt</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.widgets.edit', $widget->id) }}"
                                       class="btn btn-xs btn-primary">
                                        <i class="icon-pencil7"></i> Sửa / Item
                                    </a>
                                    <form action="{{ route('admin.widgets.delete', $widget->id) }}"
                                          method="POST"
                                          style="display:inline-block;"
                                          onsubmit="return confirm('Xóa widget này?')">
                                        @csrf
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="icon-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="panel-body text-right">
                    {{ $widgets->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
