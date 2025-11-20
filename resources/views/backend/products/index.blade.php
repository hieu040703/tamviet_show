@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($products->currentPage() - 1) * $products->perPage() + 1 }}
                    -
                    {{ ($products->currentPage() - 1) * $products->perPage() + $products->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $products->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a style="float: left;" class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="{{ route('admin.products.create') }}" style="float: right;"
                               class="btn text-right" data-popup="tooltip" title="">
                                <i class="icon-plus3 position-left"></i>
                            </a>

                            <a style="float: right;" class="color-black btn" data-popup="tooltip" title="Huỷ lọc"
                               href="{{ route('admin.products.index') }}">
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
                                   href="{{ route('admin.products.index') }}">
                                    <i class="icon-cancel-circle2 position-left"></i>
                                </a>

                                <a class="btn text-primary" data-popup="tooltip"
                                   title="{{ __('Create New Brand') }}"
                                   href="{{ route('admin.products.create') }}">
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
                            <th>Tên sản phẩm</th>
                            <th class="text-center">Trạng Thái</th>
                            <th class="text-center">Nổi Bật</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products && $products->count())
                            @foreach($products as $stt => $product)
                                <tr>
                                    <td class="text-center">
                                        {{ ($products->currentPage() - 1) * $products->perPage() + $stt + 1 }}
                                    </td>
                                    <td>
                                        <div class="flex items-center h-[70px] space-x-4">
                                            <div class="image-list">
                                                <div class="img-scaledown image-product">
                                                    <img
                                                        src="{{ $product->image
                                                            ? asset('storage/'.$product->image)
                                                            : asset('backend/img/not-found.jpg') }}"
                                                        alt="{{ $product->canonical }}"
                                                        class="w-16 h-16 object-cover rounded border border-gray-200">

                                                </div>
                                            </div>
                                            <div class="main-info w-full sm:max-w-[250px] overflow-hidden">
                                                <div class="name">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                       class="main-title text-sm font-semibold hover:underline">
                                                        {{ $product->name }}
                                                    </a>
                                                </div>
                                                <div class="category text-xs mt-1">
                                                    <span class="text-danger font-semibold">Nhóm danh mục: </span>
                                                    @if($product->categories && $product->categories->count())
                                                        @foreach($product->categories as $idx => $category)
                                                            <a href="#"
                                                               title="{{ $category->name }}">
                                                                {{ $category->name }}@if(!$loop->last)
                                                                    ,
                                                                @endif
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <span>Chưa gán danh mục</span>
                                                    @endif
                                                </div>
                                                <div class="brand text-xs mt-1">
                                                    <span class="text-danger font-semibold">Nhóm thương hiệu: </span>
                                                    @if($product->brands && $product->brands->count())
                                                        @foreach($product->brands as $brand)
                                                            <a href="#"
                                                               title="{{ $brand->name }}">
                                                                {{ $brand->name }}@if(!$loop->last)
                                                                    ,
                                                                @endif
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <span>Chưa gán thương hiệu</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @include('backend.components.status', ['field' => 'status',  'model' => $model,  'modelId' => $product->id, 'value' => $product->status,  ])
                                    </td>
                                    <td class="text-center">
                                        @include('backend.components.status', ['field' => 'is_featured',  'model' => $model,  'modelId' => $product->id, 'value' => $product->is_featured,  ])
                                    </td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li style="margin-right:10px;">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.products.delete', $product->id) }}"
                                                      method="POST" style="display:inline;"
                                                      onsubmit="return confirm('Bạn có chắc chắn muốn xoá {{ $product->name }}?');">
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
                        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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

        .table .media {
            align-items: center;
        }

        .table .media-left {
            padding-right: 10px;
        }

        .main-title {
            font-size: 14px;
            line-height: 17px;
            font-weight: 400;
            color: #2962ff;
        }

        .category {
            font-size: 11px;
            line-height: 14px;
        }

        .category span {
            font-weight: 600;
        }

        .brand {
            font-size: 11px;
            line-height: 14px;
        }

        .brand span {
            font-weight: 600;
        }

        .flex {
            display: flex;
        }

        .flex-middle {
            align-items: center;
        }

        .h-50 {
            height: 50px;
        }

        .image-list .image-product {
            width: 100px;
            background: #fff;
            margin-right: 8px;
            border: 1px solid #eaeaea;
            padding: 2px;
        }

        .img-scaledown img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: scale-down;
        }

        .img-scaledown {
            display: block;
            width: 100%;
            height: 100%;
        }

        table .image-list {
            height: 50px;
            display: block;
            margin-right: 5px;
        }

        .select-xs.select2-selection--single {
            height: 36px;
        }

        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            padding: 5px 5px;
            white-space: normal !important;
        }

        .select-xs.select2-selection--multiple .select2-search--inline .select2-search__field {
            min-width: 200px;
        }

        .select2-selection--multiple .select2-search--inline .select2-search__field {
            padding: 5px 0px !important;
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

        .category span {
            font-weight: 600;
            color: #0b76cc;
        }

        .brand span {
            font-weight: 600;
            color: #0b76cc;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endpush
