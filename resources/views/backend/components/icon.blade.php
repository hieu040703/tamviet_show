@php
    $iconPath = (isset($model) && !empty($model->icon))
        ? asset('storage/' . $model->icon)
        : asset('backend/img/not-found.jpg');
@endphp

<div class="ibox-content">
    <div class="col-md-12">
        <div class="form-row">
            <span class="image img-cover icon-target-1">
                <img id="preview-icon" src="{{ $iconPath }}" alt="">
            </span>
            <input type="file" id="icon" name="icon" class="hidden">
            <span class="help-block text-danger">{{ $errors->first('icon') }}</span>
        </div>
    </div>
</div>
