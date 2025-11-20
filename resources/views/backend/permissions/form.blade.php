@extends('backend.layout')

@section('content')
    <form action="{{ isset($id) ? route('admin.permissions.update', $id) : route('admin.permissions.store') }}"
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
                            <legend class="text-bold">{{ $title ?? (isset($id) ? 'Sửa Quyền' : 'Thêm Quyền') }}</legend>

                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label" for="name">Tên hệ thống (vd: view_product,
                                    create_product)</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $permission->name ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('name'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('display_name')) has-error @endif">
                                <label class="control-label" for="display_name">Tên hiển thị</label>
                                <input type="text"
                                       class="form-control"
                                       name="display_name"
                                       id="display_name"
                                       value="{{ old('display_name', $permission->display_name ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('display_name'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('display_name') }}</span>
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
                                Tên hệ thống dùng trong code (middleware, kiểm tra quyền).
                                Tên hiển thị dùng trong giao diện.
                            </p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.components.button')
    </form>
@endsection
