@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($brands->currentPage() - 1) * $brands->perPage() + 1 }}
                    -
                    {{ ($brands->currentPage() - 1) * $brands->perPage() + $brands->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $brands->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a style="float: left;" class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="{{ route('admin.brands.create') }}" style="float: right;"
                               class="btn text-right" data-popup="tooltip" title="">
                                <i class="icon-plus3 position-left"></i>
                            </a>

                            <a style="float: right;" class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                               href="{{ route('admin.brands.index') }}">
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
                                    <input class="form-control" name="keyword" placeholder="Name"
                                           value="{{ request('keyword') }}" autocomplete="off">
                                </li>
                            </ul>
                            <div class="navbar-right hidden-xs">
                                <button data-popup="tooltip" title="Lọc" type="submit" class="btn btn-sucess">
                                    <i class="icon-search4 position-left"></i>
                                </button>

                                <a class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                                   href="{{ route('admin.brands.index') }}">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                </a>

                                <a class="btn text-primary" data-popup="tooltip"
                                   title="{{ __('Create New Brand') }}"
                                   href="{{ route('admin.brands.create') }}">
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
                            <th>Tên thương hiệu</th>
                            <th class="text-center">Trạng Thái</th>
                            <th class="text-center">Nổi Bật</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($brands && $brands->count())
                            @foreach($brands as $stt => $brand)
                                <tr>
                                    <td class="text-center">
                                        {{ ($brands->currentPage() - 1) * $brands->perPage() + $stt + 1 }}
                                    </td>
                                    <td>
                                        {{ str_repeat('|----', ($brand->level > 0 ? $brand->level - 1 : 0)) . $brand->name }}
                                    </td>
                                    <td class="text-center">
                                        @include('backend.components.status', ['field' => 'status',  'model' => $model,  'modelId' => $brand->id, 'value' => $brand->status,  ])
                                    </td>
                                    <td class="text-center">
                                        @include('backend.components.status', ['field' => 'is_featured',  'model' => $model,  'modelId' => $brand->id, 'value' => $brand->is_featured,  ])
                                    </td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li style="margin-right:10px;">
                                                <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.brands.delete', $brand->id) }}"
                                                      method="POST" style="display:inline;"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xoá {{ $brand->name }}?');">
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
                        {{ $brands->appends(request()->query())->links('pagination::bootstrap-4') }}
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
<<<<<<< HEAD
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
=======
>>>>>>> hieu/update-feature
@endpush
