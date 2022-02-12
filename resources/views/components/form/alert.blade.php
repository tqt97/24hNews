@error('{{ $slot }}')
    <span class="invalid-feedback" role="alert">
        <strong> {{ $slot }}</strong>
    </span>
@enderror
