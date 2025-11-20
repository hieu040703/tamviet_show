@extends('backend.layout')

@section('content')
    <form action="{{ isset($id) ? route('admin.users.update', $id) : route('admin.users.store') }}"
          method="POST">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif

        <div class="col-md-12">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend
                                class="text-bold">{{ $title ?? (isset($id) ? 'Sửa Thành Viên' : 'Thêm Thành Viên') }}</legend>

                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label" for="name">Tên</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $user->name ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('name'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('email')) has-error @endif">
                                <label class="control-label" for="email">Email</label>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       id="email"
                                       value="{{ old('email', $user->email ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('email'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('password')) has-error @endif">
                                <label class="control-label" for="password">
                                    {{ isset($id) ? 'Mật khẩu (bỏ trống nếu không đổi)' : 'Mật khẩu' }}
                                </label>
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       id="password">
                                <div class="form-control-feedback">
                                    @if($errors->first('password'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="password_confirmation">Nhập lại mật khẩu</label>
                                <input type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       id="password_confirmation">
                            </div>

                            <div class="form-group @if($errors->first('roles')) has-error @endif">
                                <label class="control-label text-semibold">Vai trò</label>
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                           name="roles[]"
                                                           value="{{ $role->id }}"
                                                        {{ in_array($role->id, $selectedRoles ?? []) ? 'checked' : '' }}>
                                                    {{ $role->display_name ?? $role->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <span class="help-block">{{ $errors->first('roles') }}</span>
                            </div>

                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN KHÁC</legend>
                            <p class="text-muted">
                                Gán 1 hoặc nhiều vai trò cho thành viên để họ có các quyền tương ứng.
                            </p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.components.button')
    </form>
@endsection
