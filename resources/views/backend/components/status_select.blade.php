@php
    $field = $name ?? 'status';
    $labelText = $label ?? 'Trạng thái';
    $default = $value ?? 1;
    $current = old($field, $default);
@endphp
<div class="form-group has-feedback @if($errors->first($field)) has-error @endif">
    <label class="control-label text-semibold">{{ $labelText }}</label>
    <select name="{{ $field }}" class="form-control select2">
        @foreach(config('apps.status') as $key => $text)
            <option value="{{ $key }}"
                {{ (string)$key === (string)$current ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    <div class="form-control-feedback">
        @if($errors->first($field))
            <i class="icon-notification2"></i>
        @endif
    </div>

    <span class="help-block">{{ $errors->first($field) }}</span>
</div>
