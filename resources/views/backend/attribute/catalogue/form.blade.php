@extends('backend.layout')

@section('content')
    <form action="{{ isset($id)
        ? route('admin.attribute.catalogues.update', $id)
        : route('admin.attribute.catalogues.store') }}"
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
                                <label class="control-label">Tên nhóm thuộc tính</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name', $attributeCatalogue->name ?? '') }}">
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
                            @include('backend.components.status_select', [
                                'name'  => 'status',
                                'label' => 'Trạng thái',
                                'value' => $attributeCatalogue->status ?? 1,
                            ])

                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        @include('backend.components.button')
    </form>
@endsection
