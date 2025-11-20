@php
    $imagePath = !empty($model->image)? asset('storage/' . $model->image): asset('backend/img/not-found.jpg');
@endphp
<div class="ibox-content">
    <div class="col-md-12">
        <div class="form-row">
            <span class="image img-cover image-target">
                <img
                    id="preview-image"
                    src="{{ $imagePath }}"
                    alt=""
                >
            </span>
            <input type="file" id="image" name="image" class="hidden">

            <span class="help-block text-danger">{{ $errors->first('image') }}</span>
        </div>
    </div>
</div>
