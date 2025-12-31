@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p style="margin: 0; padding: 5px 0;">
            <span class="text-semibold">
                {{ ($videos->currentPage() - 1) * $videos->perPage() + 1 }}
                -
                {{ ($videos->currentPage() - 1) * $videos->perPage() + $videos->count() }}
            </span>
                trong
                <span class="text-semibold">{{ $videos->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">
                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter">
                                <i class="icon-more"></i>
                            </a>
                            <a href="{{ route('admin.videos.create') }}"
                               class="btn text-right">
                                <i class="icon-plus3"></i>
                            </a>
                            <a class="color-black btn"
                               href="{{ route('admin.videos.index') }}">
                                <i class="icon-cancel-circle2"></i>
                            </a>
                            <button type="submit" class="btn btn-sucess">
                                <i class="icon-search4"></i>
                            </button>
                        </li>
                    </ul>
                    <div class="navbar-collapse collapse" id="navbar-filter">
                        <form action="" method="GET">
                            <ul class="nav navbar-nav">
                                <li>
                                    <input class="form-control"
                                           name="keyword"
                                           placeholder="Tên video"
                                           value="{{ request('keyword') }}">
                                </li>
                            </ul>

                            <div class="navbar-right hidden-xs">
                                <button type="submit" class="btn btn-sucess">
                                    <i class="icon-search4"></i>
                                </button>

                                <a class="color-black btn"
                                   href="{{ route('admin.videos.index') }}">
                                    <i class="icon-cancel-circle2"></i>
                                </a>

                                <a class="btn text-primary"
                                   href="{{ route('admin.videos.create') }}">
                                    <i class="icon-plus3"></i>
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
                            <th>Video</th>
                            <th class="text-center">Nổi bật</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($videos && $videos->count())
                            @foreach($videos as $stt => $video)
                                <tr>
                                    <td class="text-center">
                                        {{ ($videos->currentPage() - 1) * $videos->perPage() + $stt + 1 }}
                                    </td>

                                    <td>
                                        <div style="display:flex; gap:10px; align-items:center;">
                                            @if($video->image)
                                                <img src="{{ asset('storage/'.$video->image) }}"
                                                     style="width:60px;height:40px;object-fit:cover;">
                                            @endif
                                            <div>
                                                <strong>{{ $video->name }}</strong><br>
                                                <small class="text-muted">{{ $video->canonical }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        @include('backend.components.status', [
                                            'field' => 'is_featured',
                                            'model' => $model,
                                            'modelId' => $video->id,
                                            'value' => $video->is_featured
                                        ])
                                    </td>

                                    <td class="text-center">
                                        @include('backend.components.status', [
                                            'field' => 'status',
                                            'model' => $model,
                                            'modelId' => $video->id,
                                            'value' => $video->status
                                        ])
                                    </td>

                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li>
                                                <a href="{{ route('admin.videos.edit', $video->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.videos.delete', $video->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Xoá video {{ $video->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            style="border:none;background:none;color:red;">
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

                    <div style="padding:10px 15px;text-align:center;">
                        {{ $videos->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('styles')
    <style>
        .select-xs.select2-selection--single {
            height: 36px;
        }

        .table > tbody > tr > td,
        .table > tbody > tr > th,
        .table > tfoot > tr > td,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > thead > tr > th {
            padding: 5px 5px;
            white-space: normal !important;
        }

        .select-xs.select2-selection--multiple .select2-search--inline .select2-search__field {
            min-width: 200px;
        }

        .select2-selection--multiple .select2-search--inline .select2-search__field {
            padding: 5px 0 !important;
            max-width: 200px;
        }

        .modal-header .close {
            position: absolute;
            right: 10px;
            top: 9px;
            margin-top: 0;
        }

        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            min-width: 350px;
            height: 100%;
            top: 45%;
            right: -370px;
            transition: right 0.3s ease-in-out;
        }

        .modal.right.in .modal-dialog {
            right: 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
@endpush
