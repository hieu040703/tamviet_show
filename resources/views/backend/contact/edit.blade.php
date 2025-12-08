@extends('backend.layout')

@section('content')
    @php
        use App\Models\ContactRequest;
    @endphp

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.contacts.update', $contactRequest->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="panel panel-flat panel-contact">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-user position-left"></i>
                            Thông tin liên hệ
                        </h5>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 border-right-dashed">
                                <div class="form-group @if($errors->first('name')) has-error @endif">
                                    <label class="control-label text-semibold" for="name">Tên khách hàng</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="form-control"
                                           placeholder="Nhập tên khách hàng"
                                           value="{{ old('name', $contactRequest->name ?? optional($contactRequest->customer)->name) }}">
                                    <div class="form-control-feedback">
                                        @if($errors->first('name'))
                                            <i class="icon-notification2"></i>
                                        @endif
                                    </div>
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                </div>

                                <div class="form-group @if($errors->first('phone')) has-error @endif">
                                    <label class="control-label text-semibold" for="phone">Số điện thoại</label>
                                    <input type="text"
                                           id="phone"
                                           name="phone"
                                           class="form-control"
                                           placeholder="Nhập số điện thoại"
                                           value="{{ old('phone', $contactRequest->phone) }}">
                                    <div class="form-control-feedback">
                                        @if($errors->first('phone'))
                                            <i class="icon-notification2"></i>
                                        @endif
                                    </div>
                                    <span class="help-block">{{ $errors->first('phone') }}</span>
                                </div>

                                <div class="form-group @if($errors->first('address')) has-error @endif">
                                    <label class="control-label text-semibold" for="address">Địa chỉ</label>
                                    <textarea id="address"
                                              name="address"
                                              rows="3"
                                              class="form-control"
                                              placeholder="Địa chỉ nhận hàng hoặc liên hệ">{{ old('address', $contactRequest->address) }}</textarea>
                                    <div class="form-control-feedback">
                                        @if($errors->first('address'))
                                            <i class="icon-notification2"></i>
                                        @endif
                                    </div>
                                    <span class="help-block">{{ $errors->first('address') }}</span>
                                </div>

                                <div class="form-group @if($errors->first('note')) has-error @endif">
                                    <label class="control-label text-semibold" for="note">Ghi chú nội bộ</label>
                                    <textarea id="note"
                                              name="note"
                                              rows="4"
                                              class="form-control"
                                              placeholder="Ghi chú cho bộ phận CSKH, nhân viên xử lý">{{ old('note', $contactRequest->note) }}</textarea>
                                    <div class="form-control-feedback">
                                        @if($errors->first('note'))
                                            <i class="icon-notification2"></i>
                                        @endif
                                    </div>
                                    <span class="help-block">{{ $errors->first('note') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->first('status')) has-error @endif">
                                            <label class="control-label text-semibold" for="status">Trạng thái</label>
                                            <select id="status" name="status" class="form-control select2">
                                                @foreach(ContactRequest::statusList() as $key => $text)
                                                    <option value="{{ $key }}"
                                                        {{ (string)$key === (string)old('status', $contactRequest->status) ? 'selected' : '' }}>
                                                        {{ $text }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-control-feedback">
                                                @if($errors->first('status'))
                                                    <i class="icon-notification2"></i>
                                                @endif
                                            </div>
                                            <span class="help-block">{{ $errors->first('status') }}</span>
                                            <span class="help-block" style="margin-top:5px;">
                                                Hiện tại:
                                                <span
                                                    class="label label-primary label-rounded">{{ $contactRequest->status_label }}</span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->first('save_info')) has-error @endif">
                                            <label class="control-label text-semibold">Lưu thông tin khách hàng</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                           name="save_info"
                                                           value="1"
                                                        {{ old('save_info', $contactRequest->save_info) ? 'checked' : '' }}>
                                                    Lưu cho các lần liên hệ sau
                                                </label>
                                            </div>
                                            <div class="form-control-feedback">
                                                @if($errors->first('save_info'))
                                                    <i class="icon-notification2"></i>
                                                @endif
                                            </div>
                                            <span class="help-block">{{ $errors->first('save_info') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row small-info">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-semibold">Kênh</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-earth"></i></span>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{ $contactRequest->channel ?? 'website' }}"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-semibold">IP</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-location4"></i></span>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{ data_get($contactRequest->meta, 'ip') }}"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row small-info">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-semibold">Ngày tạo</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{ $contactRequest->created_at }}"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label text-semibold">Cập nhật lần cuối</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-history"></i></span>
                                                <input type="text"
                                                       class="form-control"
                                                       value="{{ $contactRequest->updated_at }}"
                                                       disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($contactRequest->customer)
                                    <div class="panel panel-flat panel-mini">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">
                                                <i class="icon-user-check position-left"></i>
                                                Khách hàng hệ thống
                                            </h6>
                                        </div>
                                        <div class="panel-body">
                                            <div class="media">
                                                <div class="media-left">
                                                    <span class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
                                                        <i class="icon-user"></i>
                                                    </span>
                                                </div>
                                                <div class="media-body">
                                                    <div class="media-heading text-semibold">
                                                        {{ $contactRequest->customer->name }}
                                                    </div>
                                                    <div class="text-muted">
                                                        {{ $contactRequest->customer->email ?? 'Chưa có email' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-flat panel-contact">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-basket position-left"></i>
                            Sản phẩm trong yêu cầu
                        </h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-products">
                            <thead>
                            <tr>
                                <th class="text-center" width="50">#</th>
                                <th class="text-center" width="80">Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th class="text-center" width="120">Số lượng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($contactRequest->items as $index => $item)
                                @php
                                    $image = null;
                                    if ($item->product_image) {
                                        $image = asset('storage/' . $item->product_image);
                                    } elseif (optional($item->product)->image) {
                                        $image = asset('storage/' . $item->product->image);
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        @if($image)
                                            <a href="{{ $image }}" target="_blank">
                                                <img src="{{ $image }}"
                                                     alt="{{ $item->product_name ?? optional($item->product)->name }}"
                                                     class="img-thumbnail img-product-thumb">
                                            </a>
                                        @else
                                            <span class="text-muted">Không có ảnh</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-semibold">
                                            {{ $item->product_name ?? optional($item->product)->name ?? '---' }}
                                        </div>
                                        @if(optional($item->product)->sku)
                                            <div class="text-muted text-size-mini">
                                                Mã: {{ $item->product->sku }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="label label-success label-rounded label-qty">
                                            {{ $item->qty }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Không có sản phẩm nào.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-right" style="margin-top:15px;">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-default">
                        <i class="icon-arrow-left13 position-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-checkmark4 position-left"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .panel-contact {
            border-radius: 6px;
            overflow: hidden;
        }
        .panel-contact .panel-heading {
            background: #f5f7fb;
            border-bottom: 1px solid #e5e7eb;
        }
        .panel-contact .panel-title {
            font-weight: 600;
        }
        .border-right-dashed {
            border-right: 1px dashed #e5e7eb;
        }
        .small-info .form-group {
            margin-bottom: 12px;
        }
        .panel-mini {
            margin-top: 10px;
            margin-bottom: 0;
        }
        .panel-mini .panel-heading {
            padding: 8px 15px;
        }
        .panel-mini .panel-body {
            padding: 10px 15px;
        }
        .table-products tbody tr td {
            vertical-align: middle;
        }
        .img-product-thumb {
            max-width: 60px;
            max-height: 60px;
            object-fit: cover;
        }
        .label-qty {
            font-size: 13px;
            padding: 5px 12px;
        }
    </style>
@endpush
