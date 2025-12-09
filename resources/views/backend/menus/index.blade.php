@extends('backend.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($menus->currentPage() - 1) * $menus->perPage() + 1 }}
                    -
                    {{ ($menus->currentPage() - 1) * $menus->perPage() + $menus->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $menus->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="{{ route('admin.menus.create') }}" class="btn text-right">
                                <i class="icon-plus3 position-left"></i>
                            </a>

                            <a href="{{ route('admin.menus.index') }}" class="btn color-black">
                                <i class="icon-cancel-circle2 position-left"></i>
                            </a>

                            <button type="submit" class="btn btn-sucess text-right">
                                <i class="icon-search4 position-left"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="navbar-collapse collapse" id="navbar-filter">
                        <form action="" method="GET">
                            <ul class="nav navbar-nav">
                                <li>
                                    <input class="form-control"
                                           name="keyword"
                                           placeholder="Tìm theo tên / keyword"
                                           value="{{ request('keyword') }}"
                                           autocomplete="off">
                                </li>
                            </ul>

                            <div class="navbar-right hidden-xs">
                                <button type="submit" class="btn btn-sucess">
                                    <i class="icon-search4 position-left"></i>
                                </button>

                                <a href="{{ route('admin.menus.index') }}" class="btn color-black">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                </a>

                                <a href="{{ route('admin.menus.create') }}" class="btn text-primary">
                                    <i class="icon-plus3 position-left"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive" style="min-height:400px;">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="20">STT</th>
                            <th>Tên menu</th>
                            <th>Keyword</th>
                            <th>Loại</th>
                            <th class="text-center" width="80">Trạng thái</th>
                            <th class="text-center" width="120">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($menus as $stt => $menu)
                            <tr>
                                <td class="text-center">
                                    {{ ($menus->currentPage() - 1) * $menus->perPage() + $stt + 1 }}
                                </td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->keyword }}</td>
                                <td>{{ $menu->type }}</td>
                                <td class="text-center">
                                    @include('backend.components.status', ['field' => 'status',  'model' => $model,  'modelId' => $menu->id, 'value' => $menu->status,  ])
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li style="margin-right:10px;">
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                               class="text-blue">
                                                <i class="icon-pencil7"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.menus.delete', $menu->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Xoá menu này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        style="border:none;background:none;color:red;cursor:pointer;">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Không có dữ liệu.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <div style="border-top:1px solid #ccc;"></div>
                    <div style="padding:10px 15px;text-align:center;">
                        {{ $menus->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
