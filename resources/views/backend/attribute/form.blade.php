@extends('backend.layout')

@section('content')
    <form action="{{ isset($id)
        ? route('admin.attributes.update', $id)
        : route('admin.attributes.store') }}"
          method="POST">
        @csrf
        @if(isset($id))
            @method('PUT')
        @endif
        <input type="hidden" name="user_id" value="{{ auth('admin')->id() }}">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <fieldset class="content-group">
                            <legend class="text-bold">{{ $title }}</legend>
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <label class="control-label">Tên thuộc tính</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name', $attribute->name ?? '') }}">
                                <span class="help-block">{{ $errors->first('name') }}</span>
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
                            <div class="form-group {{ $errors->first('attribute_catalogue_id') ? 'has-error' : '' }}">
                                <label class="control-label text-semibold">Nhóm thuộc tính</label>
                                <select name="attribute_catalogue_id" class="form-control select2">
                                    <option value="">-- Chọn nhóm thuộc tính --</option>
                                    @foreach($attribute_catalogues as $attribute_catalogue)
                                        <option value="{{ $attribute_catalogue->id }}"
                                            {{ (string)$attribute_catalogue->id === (string) old('attribute_catalogue_id', $attribute->attribute_catalogue_id ?? '') ? 'selected' : '' }}>
                                            {{ $attribute_catalogue->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-control-feedback">
                                    @if($errors->first('attribute_catalogue_id'))
                                        <i class="icon-notification2"></i>
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('attribute_catalogue_id') }}</span>
                            </div>
                            @include('backend.components.status_select', [
                                'name'  => 'status',
                                'label' => 'Trạng thái',
                                'value' => $attribute->status ?? 1,
                            ])
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.components.button')
    </form>
@endsection
