@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($roles->currentPage() - 1) * $roles->perPage() + 1 }}
                    -
                    {{ ($roles->currentPage() - 1) * $roles->perPage() + $roles->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $roles->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a style="float: left;" class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="{{ route('admin.roles.create') }}" style="float: right;"
                               class="btn text-right" data-popup="tooltip" title="Thêm vai trò">
                                <i class="icon-plus3 position-left"></i>
                            </a>

                            <a style="float: right;" class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                               href="{{ route('admin.roles.index') }}">
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
                                    <input class="form-control" name="keyword" placeholder="Tên vai trò / tên hiển thị"
                                           value="{{ request('keyword') }}" autocomplete="off">
                                </li>
                            </ul>
                            <div class="navbar-right hidden-xs">
                                <button data-popup="tooltip" title="Lọc" type="submit" class="btn btn-sucess">
                                    <i class="icon-search4 position-left"></i>
                                </button>

                                <a class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                                   href="{{ route('admin.roles.index') }}">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                </a>

                                <a class="btn text-primary" data-popup="tooltip"
                                   title="Thêm vai trò"
                                   href="{{ route('admin.roles.create') }}">
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
                            <th>Quyền</th>
                            <th class="text-center" width="80">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($roles && $roles->count())
                            @foreach($roles as $stt => $role)
                                <tr>
                                    <td class="text-center">
                                        {{ ($roles->currentPage() - 1) * $roles->perPage() + $stt + 1 }}
                                    </td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->display_name }}</td>
                                    <td>
                                        @php
                                            $maxDisplay   = 5;
                                            $totalPerms   = $role->permissions->count();
                                            $displayPerms = $role->permissions->take($maxDisplay);
                                            $hiddenPerms  = $role->permissions->slice($maxDisplay);
                                        @endphp

                                        @if($totalPerms === 0)
                                            <span class="text-muted">Chưa gán quyền</span>
                                        @else
                                            @foreach($displayPerms as $perm)
                                                <span class="label label-info"
                                                      style="margin-bottom: 2px; display:inline-block;">
                                                    {{ mb_strtoupper($perm->display_name ?? $perm->name) }}
                                                </span>
                                            @endforeach

                                            @if($totalPerms > $maxDisplay)
                                                @php
                                                    $hiddenNames = $hiddenPerms->map(function($p) {
                                                        return $p->display_name ?? $p->name;
                                                    })->implode(', ');
                                                @endphp
                                                <span class="label label-default"
                                                      title="{{ $hiddenNames }}"
                                                      style="margin-bottom: 2px; display:inline-block; cursor: help;">
                                                    +{{ $totalPerms - $maxDisplay }} quyền nữa
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li style="margin-right:10px;">
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.roles.delete', $role->id) }}"
                                                      method="POST" style="display:inline;"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xoá vai trò {{ $role->name }}?');">
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
                                <td colspan="5" class="text-center">Không có dữ liệu.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <div class="clear-fix" style="border-top:1px solid #ccc;"></div>
                    <div style="padding:10px 15px;text-align:center;">
                        {{ $roles->appends(request()->query())->links('pagination::bootstrap-4') }}
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
