@php
    $mode = $mode ?? 'draft';
    $required = $required ?? false;
    $imageUrl = $imageUrl ?? null;
    $variant = $variant ?? 'desktop';
    $bannerName = $banner ?? '';
@endphp
<div
    class="paste-zone paste-zone-{{ $variant }} {{ $imageUrl ? 'has-image' : '' }}"
    tabindex="0"
    role="button"
    data-paste-zone
    data-mode="{{ $mode }}"
    data-field="{{ $field }}"
    data-label="{{ $label }}"
    data-banner="{{ $bannerName }}"
    @if(!empty($uploadUrl)) data-upload-url="{{ $uploadUrl }}" @endif
    aria-label="{{ $label }}. Clique e cole com Ctrl+V"
>
    <img class="paste-preview" alt="{{ $label }}" @if($imageUrl) src="{{ $imageUrl }}" @endif>
    <div class="paste-placeholder">
        <span class="paste-kicker">{{ $label }}</span>
        <strong>Clique e cole com Ctrl+V</strong>
        <span>ou arraste a imagem para cá</span>
    </div>
    <div class="paste-hud">
        <span class="paste-keys" aria-hidden="true"><kbd>Ctrl</kbd><kbd>V</kbd></span>
        <span class="paste-status" data-status>{{ $imageUrl ? 'Clique para trocar' : 'Aguardando imagem' }}</span>
        <button type="button" class="paste-file-btn" data-file-trigger>Arquivo</button>
    </div>
    <input
        type="file"
        @if($mode === 'draft') name="{{ $field }}" @endif
        @if(!empty($inputId)) id="{{ $inputId }}" @endif
        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
        class="paste-input"
        tabindex="-1"
        @if($required) required @endif
    >
</div>
