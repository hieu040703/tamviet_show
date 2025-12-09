@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($users->currentPage() - 1) * $users->perPage() + 1 }}
                    -
                    {{ ($users->currentPage() - 1) * $users->perPage() + $users->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $users->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a style="float: left;" class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="{{ route('admin.users.create') }}" style="float: right;"
                               class="btn text-right" data-popup="tooltip" title="Thêm thành viên">
                                <i class="icon-plus3 position-left"></i>
                            </a>

                            <a style="float: right;" class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                               href="{{ route('admin.users.index') }}">
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
                                    <input class="form-control" name="keyword" placeholder="Tên / Email"
                                           value="{{ request('keyword') }}" autocomplete="off">
                                </li>
                            </ul>
                            <div class="navbar-right hidden-xs">
                                <button data-popup="tooltip" title="Lọc" type="submit" class="btn btn-sucess">
                                    <i class="icon-search4 position-left"></i>
                                </button>

                                <a class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                                   href="{{ route('admin.users.index') }}">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                </a>

                                <a class="btn text-primary" data-popup="tooltip"
                                   title="Thêm thành viên"
                                   href="{{ route('admin.users.create') }}">
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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th class="text-center" width="80">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users && $users->count())
                            @foreach($users as $stt => $user)
                                <tr>
                                    <td class="text-center">
                                        {{ ($users->currentPage() - 1) * $users->perPage() + $stt + 1 }}
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @php
                                            $maxDisplay   = 3;
                                            $totalRoles   = $user->roles->count();
                                            $displayRoles = $user->roles->take($maxDisplay);
                                            $hiddenRoles  = $user->roles->slice($maxDisplay);
                                        @endphp

                                        @if($totalRoles === 0)
                                            <span class="text-muted">Chưa gán vai trò</span>
                                        @else
                                            @foreach($displayRoles as $role)
                                                <span class="label label-info"
                                                      style="margin-bottom: 2px; display:inline-block;">
                                                    {{ $role->display_name ?? $role->name }}
                                                </span>
                                            @endforeach

                                            @if($totalRoles > $maxDisplay)
                                                @php
                                                    $hiddenNames = $hiddenRoles->map(function($r) {
                                                        return $r->display_name ?? $r->name;
                                                    })->implode(', ');
                                                @endphp
                                                <span class="label label-default"
                                                      title="{{ $hiddenNames }}"
                                                      style="margin-bottom: 2px; display:inline-block; cursor: help;">
                                                    +{{ $totalRoles - $maxDisplay }} vai trò nữa
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li style="margin-right:10px;">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.users.delete', $user->id) }}"
                                                      method="POST" style="display:inline;"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xoá thành viên {{ $user->name }}?');">
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
                        {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<<<<<<< HEAD
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
=======
>>>>>>> hieu/update-feature
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
<<<<<<< HEAD
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
=======
>>>>>>> hieu/update-feature
@endpush
