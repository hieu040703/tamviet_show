@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($permissions->currentPage() - 1) * $permissions->perPage() + 1 }}
                    -
                    {{ ($permissions->currentPage() - 1) * $permissions->perPage() + $permissions->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $permissions->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a style="float: left;" class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="{{ route('admin.permissions.create') }}" style="float: right;"
                               class="btn text-right" data-popup="tooltip" title="Thêm quyền">
                                <i class="icon-plus3 position-left"></i>
                            </a>

                            <a style="float: right;" class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                               href="{{ route('admin.permissions.index') }}">
                                <i class="icon-cancel-circle2 position-left"></i>
                            </a>

                            <button style="float: right;" data-popup="tooltip" title="Lọc" type="submit"
                                    class="btn btn-sucess text-right">
                                <i class="icon-search4 position-left"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="navbar-collapse collapse" id="navbar-filter">
                        <form action="" method="GET">
                            <ul class="nav navbar-nav">
                                <li>
                                    <input class="form-control" name="keyword" placeholder="Tên quyền / tên hiển thị"
                                           value="{{ request('keyword') }}" autocomplete="off">
                                </li>
                            </ul>
                            <div class="navbar-right hidden-xs">
                                <button data-popup="tooltip" title="Lọc" type="submit" class="btn btn-sucess">
                                    <i class="icon-search4 position-left"></i>
                                </button>

                                <a class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                                   href="{{ route('admin.permissions.index') }}">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                </a>

                                <a class="btn text-primary" data-popup="tooltip"
                                   title="Thêm quyền"
                                   href="{{ route('admin.permissions.create') }}">
                                    <i class="icon-plus3 position-left"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="table-responsive" style="min-height:400px;">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="20">STT</th>
                            <th>Tên hệ thống</th>
                            <th>Tên hiển thị</th>
                            <th class="text-center" width="80">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($permissions && $permissions->count())
                            @foreach($permissions as $stt => $permission)
                                <tr>
                                    <td class="text-center">
                                        {{ ($permissions->currentPage() - 1) * $permissions->perPage() + $stt + 1 }}
                                    </td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->display_name }}</td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li style="margin-right:10px;">
                                                <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.permissions.delete', $permission->id) }}"
                                                      method="POST" style="display:inline;"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xoá quyền {{ $permission->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            style="border: none; background: none; color: red; cursor: pointer;">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Không có dữ liệu.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <div class="clear-fix" style="border-top:1px solid #ccc;"></div>
                    <div style="padding:10px 15px;text-align:center;">
                        {{ $permissions->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        .table > tbody > tr > td,
        .table > tbody > tr > th,
        .table > tfoot > tr > td,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > thead > tr > th {
            padding: 5px 5px;
            white-space: normal !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
@endpush
