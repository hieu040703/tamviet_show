@php
    $name = $name ?? 'parent_id';
    $label = $label ?? 'Chọn Root nếu không có danh mục cha';
    $dropdown = $dropdown ?? [];
    $selected = old($name, $selected ?? 0);
@endphp
<div class="form-group has-feedback @if($errors->first($name)) has-error @endif">
    <label class="control-label text-semibold">
        <span class="text-danger">
            {{ $label }}
        </span>
    </label>
    <select name="{{ $name }}"
            class="form-control select2"
            id="{{ $id ?? $name }}"
            data-allow-clear="true">
        @foreach($dropdown as $key => $val)
            <option value="{{ $key }}" {{ (string)$key === (string)$selected ? 'selected' : '' }}>
                {{ $val }}
            </option>
        @endforeach
    </select>
    <div class="form-control-feedback">
        @if($errors->first($name))
            <i class="icon-notification2"></i>
        @endif
    </div>
    <span class="help-block">{{ $errors->first($name) }}</span>
</div>
