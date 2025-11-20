@extends('backend.layout')

@section('content')
    <form action="{{ isset($id) ? route('admin.roles.update', $id) : route('admin.roles.store') }}"
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
                                class="text-bold">{{ $title ?? (isset($id) ? 'Sửa Vai Trò' : 'Thêm Vai Trò') }}</legend>

                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label" for="name">Tên hệ thống (vd: admin, editor)</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $role->name ?? '') }}">
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
                                       value="{{ old('display_name', $role->display_name ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('display_name'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('display_name') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('permissions')) has-error @endif">
                                <label class="control-label text-semibold">Quyền được gán cho vai trò</label>
                                <div class="row">
                                    @foreach($permissions as $perm)
                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                           name="permissions[]"
                                                           value="{{ $perm->id }}"
                                                        {{ in_array($perm->id, $selectedPermissions ?? []) ? 'checked' : '' }}>
                                                    {{ $perm->display_name ?? $perm->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <span class="help-block">{{ $errors->first('permissions') }}</span>
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
                                Vai trò dùng để gom nhóm quyền và gán cho người dùng.
                            </p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.components.button')
    </form>
@endsection
