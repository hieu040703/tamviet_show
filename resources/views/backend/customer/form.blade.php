@extends('backend.layout')

@section('content')
    <form id="customerForm"
          action="{{ isset($customer) ? route('admin.customers.update', $customer->id) : route('admin.customers.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($customer))
            @method('PUT')
        @endif

        <div class="col-md-12">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">{{ isset($customer) ? 'Cập nhật khách hàng' : 'Thêm khách hàng' }}</legend>

                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label" for="name">Tên khách hàng</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $customer->name ?? '') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('email')) has-error @endif">
                                <label class="control-label" for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $customer->email ?? '') }}">
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('phone')) has-error @endif">
                                <label class="control-label" for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $customer->phone ?? '') }}">
                                <span class="help-block">{{ $errors->first('phone') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('birthday')) has-error @endif">
                                <label class="control-label" for="birthday">Ngày sinh</label>
                                <input type="date" class="form-control" name="birthday" value="{{ old('birthday', isset($customer->birthday) ? $customer->birthday->format('Y-m-d') : '') }}">
                                <span class="help-block">{{ $errors->first('birthday') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('address')) has-error @endif">
                                <label class="control-label" for="address">Địa chỉ</label>
                                <textarea class="form-control" name="address">{{ old('address', $customer->address ?? '') }}</textarea>
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('password')) has-error @endif">
                                <label class="control-label" for="password">Mật khẩu</label>
                                <input type="password" class="form-control" name="password">
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('password_confirmation')) has-error @endif">
                                <label class="control-label" for="password_confirmation">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            </div>

                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">Trạng thái</legend>
                            @include('backend.components.status_select', [
                                'name' => 'status',
                                'label' => 'Trạng thái',
                                'value' => $customer->status ?? 1,
                            ])
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.components.button')
    </form>
@endsection
