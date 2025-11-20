@extends('backend.layout')

@section('content')
    <form id="productForm"
          action="{{ isset($id) ? route('admin.banners.update', $id) : route('admin.banners.store') }}"
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
                            <legend class="text-bold">{{ $title }}</legend>

                            <div class="form-group @if($errors->first('name')) has-error @endif">
                                <label class="control-label" for="name">Tên nhóm banner</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', $banner->name ?? '') }}">
                                <div class="form-control-feedback">
                                    @if($errors->first('name'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            </div>

                            <div class="form-group @if($errors->first('code')) has-error @endif">
                                <label class="control-label" for="code">Code (duy nhất)</label>
                                <input type="text"
                                       class="form-control"
                                       name="code"
                                       id="code"
                                       value="{{ old('code', $banner->code ?? '') }}"
                                       placeholder="VD: home_main, home_right_top">
                                <div class="form-control-feedback">
                                    @if($errors->first('code'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('code') }}</span>
                                <span class="help-block text-muted">
                                    Dùng code để gọi banner trong code PHP (VD: home_main).
                                </span>
                            </div>

                            <div class="form-group @if($errors->first('position')) has-error @endif">
                                <label class="control-label" for="position">Vị trí hiển thị</label>
                                <input type="text"
                                       class="form-control"
                                       name="position"
                                       id="position"
                                       value="{{ old('position', $banner->position ?? '') }}"
                                       placeholder="VD: main, right_top, right_bottom">
                                <div class="form-control-feedback">
                                    @if($errors->first('position'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('position') }}</span>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">THÔNG TIN CHUNG</legend>

                            @include('backend.components.status_select', [
                                'name'  => 'status',
                                'label' => 'Trạng thái',
                                'value' => old('status', $banner->status ?? 1),
                            ])
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.components.button')
    </form>
@endsection
