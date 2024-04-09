<div class="form-group">
    <label>{{ $text }}</label>
    <input type="{{ $type }}" class="form-control" id="{{ Str::slug($text) }}" name="{{ $name }}" placeholder="Masukkan {{ $text }}" value="{{ ($value) ?? '' }}">
</div>