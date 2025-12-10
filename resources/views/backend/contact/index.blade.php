@extends('backend.layout')

@section('content')
    @php
        use App\Models\ContactRequest;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($contactRequests->currentPage() - 1) * $contactRequests->perPage() + 1 }}
                    -
                    {{ ($contactRequests->currentPage() - 1) * $contactRequests->perPage() + $contactRequests->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $contactRequests->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a style="float: left;" class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>
                            <a style="float: right;" class="color-black btn" data-popup="tooltip"
                               href="{{ route('admin.contacts.index') }}">
                                <i class="icon-cancel-circle2 position-left"></i>
                            </a>

                            <button style="float: right;" data-popup="tooltip" type="submit"
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
                                <button data-popup="tooltip" type="submit" class="btn btn-sucess">
                                    <i class="icon-search4 position-left"></i>
                                </button>

                                <a class="color-black btn" data-popup="tooltip"
                                   href="{{ route('admin.contacts.index') }}">
                                    <i class="icon-cancel-circle2 position-left"></i>
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
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Sản phẩm</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($contactRequests && $contactRequests->count())
                            @foreach($contactRequests as $stt => $contactRequest)
                                @php
                                    $items = $contactRequest->items;
                                    $visibleItems = $items->take(2);
                                    $hiddenCount = $items->count() > 2 ? $items->count() - 2 : 0;
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        {{ ($contactRequests->currentPage() - 1) * $contactRequests->perPage() + $stt + 1 }}
                                    </td>

                                    <td>
                                        {{ $contactRequest->name ?? $contactRequest->customer->name ?? 'không tìm thấy' }}
                                    </td>

                                    <td>
                                        {{ $contactRequest->phone ?? 'không tìm thấy' }}
                                    </td>

                                    <td>
                                        {{ $contactRequest->address ?? 'không tìm thấy' }}
                                    </td>

                                    <td>
                                        <select
                                            class="form-control select2 contact-status"
                                            data-url="{{ route('ajax.contact-request.updateStatus', $contactRequest->id) }}"
                                        >
                                            @foreach(ContactRequest::statusList() as $key => $text)
                                                <option value="{{ $key }}"
                                                    {{ (string)$key === (string)$contactRequest->status ? 'selected' : '' }}>
                                                    {{ $text }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="items-cell">
                                        @foreach($visibleItems as $item)
                                            <div class="item-row">
                                                <div class="item-name">
                                                    {{ $item->product_name ?? optional($item->product)->name ?? '---' }}
                                                </div>
                                                <div class="item-meta">
                                                    <span class="item-meta-label">Số lượng:</span>
                                                    <span class="item-qty">{{ $item->qty ?? '' }}</span>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($hiddenCount > 0)
                                            <div class="items-more">
                                                + {{ $hiddenCount }} sản phẩm khác
                                            </div>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li style="margin-right:10px;">
                                                <a href="{{ route('admin.contacts.edit', $contactRequest->id) }}"
                                                   class="text-blue">
                                                    <i class="icon-pencil7"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('admin.contacts.delete', $contactRequest->id) }}"
                                                    method="POST"
                                                    style="display:inline;"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xoá {{ $contactRequest->name }}?');">
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
                        {{ $contactRequests->appends(request()->query())->links('pagination::bootstrap-4') }}
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

        .items-cell {
            min-width: 260px;
            max-width: 460px;
            max-height: 120px;
            overflow-y: auto;
        }

        .items-cell .item-row {
            padding-bottom: 4px;
            margin-bottom: 4px;
            border-bottom: 1px dashed #e5e7eb;
        }

        .items-cell .item-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .items-cell .item-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .items-cell .item-meta {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #6b7280;
        }

        .items-cell .item-meta-label {
            font-weight: 500;
        }

        .items-cell .item-qty {
            font-weight: 600;
            color: #d97706;
        }

        .items-cell .items-more {
            margin-top: 2px;
            font-size: 12px;
            font-style: italic;
            color: #4b5563;
        }

        .table tbody tr td.items-cell {
            vertical-align: top;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script src="{{ URL::asset('backend/assets/js/contact-request.js') }}"></script>
@endpush
