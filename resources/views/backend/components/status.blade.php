<input
    type="checkbox"
    class="js-switch status"
    data-field="{{ $field }}"
    data-model="{{ $model }}"
    data-modelId="{{ $modelId }}"
    value="{{ $value }}"
    {{ ($value == 1) ? 'checked' : '' }}
/>
