@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <p style="margin: 0; padding: 5px 0;">
                <span class="text-semibold">
                    {{ ($items->currentPage() - 1) * $items->perPage() + 1 }}
                    -
                    {{ ($items->currentPage() - 1) * $items->perPage() + $items->count() }}
                </span>
                trong
                <span class="text-semibold">{{ $items->total() }}</span> bản ghi.
            </p>

            <div class="panel panel-flat">

                <div class="navbar navbar-default navbar-xs fillter padding-0">
                    <ul class="nav navbar-nav no-border visible-xs-block">
                        <li>
                            <a class="text-left collapsed" data-toggle="collapse"
                               data-target="#navbar-filter"><i class="icon-more"></i></a>

                            <a href="{{ route('admin.banner_items.create') }}"
                               class="btn text-right"><i class="icon-plus3"></i></a>

                            <a href="{{ route('admin.banner_items.index') }}"
                               class="btn color-black"><i class="icon-cancel-circle2"></i></a>

                            <button type="submit" class="btn btn-sucess text-right">
                                <i class="icon-search4"></i>
                            </button>
                        </li>
                    </ul>

                    <div class="navbar-collapse collapse" id="navbar-filter">
                        <form action="" method="GET">
                            <ul class="nav navbar-nav">

                                <li style="padding-right:10px;">
                                    <select class="form-control" name="banner_id">
                                        <option value="">-- Chọn nhóm banner --</option>
                                        @foreach($banners as $b)
                                            <option value="{{ $b->id }}"
                                                {{ request('banner_id') == $b->id ? 'selected' : '' }}>
                                                {{ $b->name }} ({{ $b->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </li>

                                <li>
                                    <input type="text" name="keyword"
                                           value="{{ request('keyword') }}"
                                           class="form-control"
                                           placeholder="Tìm tiêu đề...">
                                </li>

                            </ul>

                            <div class="navbar-right hidden-xs">
                                <button type="submit" class="btn btn-sucess">
                                    <i class="icon-search4"></i>
                                </button>

                                <a href="{{ route('admin.banner_items.index') }}"
                                   class="btn color-black">
                                    <i class="icon-cancel-circle2"></i>
                                </a>

                                <a href="{{ route('admin.banner_items.create') }}"
                                   class="btn text-primary">
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
                            <th width="20" class="text-center">STT</th>
                            <th width="100">Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Link</th>
                            <th width="100" class="text-center">Thứ tự</th>
                            <th width="80" class="text-center">Trạng thái</th>
                            <th class="text-center" width="80">Thao tác</th>
                        </tr>
                        </thead>

                        <tbody id="sortable-banner">
                        @forelse($items as $stt => $item)
                            <tr data-id="{{ $item->id }}">
                                <td class="text-center">
                                    {{ ($items->currentPage() - 1) * $items->perPage() + $stt + 1 }}
                                </td>

                                <td class="text-center">
                                    @if($item->image)
                                        <img src="{{ asset('storage/'.$item->image) }}"
                                             style="height:60px;border-radius:4px;">
                                    @else
                                        <span class="text-muted">Không có</span>
                                    @endif
                                </td>

                                <td>{{ $item->title }}</td>
                                <td>{{ $item->link }}</td>

                                <td class="text-center">
                                    <input type="number"
                                           name="orders[{{ $item->id }}]"
                                           class="form-control text-center"
                                           value="{{ $item->sort_order }}">
                                </td>

                                <td class="text-center">
                                    @include('backend.components.status', [
                                        'model'   => $model,
                                        'field'   => 'status',
                                        'value'   => $item->status,
                                        'modelId' => $item->id
                                    ])
                                </td>

                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li style="margin-right:10px;">
                                            <a href="{{ route('admin.banner_items.edit', $item->id) }}"
                                               class="text-blue">
                                                <i class="icon-pencil7"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST"
                                                  action="{{ route('admin.banner_items.delete', $item->id) }}"
                                                  onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button style="background:none;border:none;color:red;cursor:pointer;">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>

                    <div style="border-top:1px solid #ccc;"></div>

                    <div style="padding:10px 15px;text-align:center;">
                        {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ URL::asset('backend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>

    <script>
        $(function () {
            var $tbody = $("#sortable-banner");

            $tbody.sortable({
                placeholder: "sortable-placeholder",
                handle: "td",
                update: function () {
                    // Cập nhật lại số thứ tự trong input
                    var orders = {};
                    $tbody.find("tr").each(function (index) {
                        var id = $(this).data('id');
                        var order = index + 1;
                        orders[id] = order;
                        $(this).find("input[name='orders[" + id + "]']").val(order);
                    });

                    // Gửi AJAX cập nhật thứ tự
                    $.ajax({
                        url: "{{ route('admin.banner_items.sort') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            orders: orders
                        },
                        success: function (res) {
                            // Nếu muốn báo nhỏ thì console hoặc sau này dùng toastr
                            console.log('Cập nhật thứ tự thành công');
                        },
                        error: function () {
                            alert('Có lỗi khi cập nhật thứ tự');
                        }
                    });
                }
            });

            $tbody.disableSelection();
        });
    </script>

    <style>
        #sortable-banner tr {
            cursor: move;
        }

        .sortable-placeholder {
            height: 60px;
            background: #f5f5f5;
            border: 2px dashed #ccc;
            margin: 4px 0;
        }
    </style>
@endpush
