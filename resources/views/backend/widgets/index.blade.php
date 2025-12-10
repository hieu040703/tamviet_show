@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <p style="margin: 0; padding: 5px 0;">
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
                            <a style="float: left;" class="text-left collapsed"
                               data-toggle="collapse" data-target="#navbar-filter">
                                <i class="icon-more"></i>
                            </a>

                            <a href="{{ route('admin.widgets.create') }}" style="float: right;"
                               class="btn text-right">
                                <i class="icon-plus3 position-left"></i>
                            </a>

                            <a href="{{ route('admin.widgets.index') }}" style="float: right;"
                               class="color-black btn">
                                <i class="icon-cancel-circle2 position-left"></i>
                            </a>

                            <button type="submit" style="float: right;" class="btn btn-sucess text-right">
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
                                           placeholder="Tìm theo tên hoặc từ khóa"
                                           value="{{ request('keyword') }}"
                                           autocomplete="off">
                                </li>
                            </ul>

                            <div class="navbar-right hidden-xs">
                                <button type="submit" class="btn btn-sucess">
                                    <i class="icon-search4 position-left"></i>
                                </button>

                                <a href="{{ route('admin.widgets.index') }}" class="btn color-black">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                </a>

                                <a href="{{ route('admin.widgets.create') }}" class="btn text-primary">
                                    <i class="icon-plus3 position-left"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="clearfix"></div>

                {{-- TABLE --}}
                <div class="table-responsive" style="min-height:400px;">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="20">STT</th>
                            <th>Tên Widget</th>
                            <th>Từ khóa</th>
                            <th>Short code</th>
                            <th>Module</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($widgets && $widgets->count())
                            @foreach($widgets as $stt => $widget)
                                <tr>
                                    <td class="text-center">
                                        {{ ($widgets->currentPage() - 1) * $widgets->perPage() + $stt + 1 }}
                                    </td>

                                    <td>{{ $widget->name }}</td>
                                    <td>{{ $widget->keyword }}</td>
                                    <td>{{ $widget->short_code }}</td>
                                    <td>{{ $widget->model ?? '-' }}</td>

                                    <td class="text-center">
                                        @include('backend.components.status', [
                                            'field'   => 'status',
                                            'model'   => $model ?? \App\Models\Widget::class,
                                            'modelId' => $widget->id,
                                            'value'   => $widget->status
                                        ])
                                    </td>

                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li style="margin-right:10px;">
                                                <a href="{{ route('admin.widgets.edit', $widget->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.widgets.delete', $widget->id) }}"
                                                      method="POST" style="display:inline;"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xoá {{ $widget->name }}?');">
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
                                <td colspan="7" class="text-center">Không có dữ liệu.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <div class="clear-fix" style="border-top:1px solid #ccc;"></div>
                    <div style="padding:10px 15px;text-align:center;">
                        {{ $widgets->appends(request()->query())->links('pagination::bootstrap-4') }}
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
