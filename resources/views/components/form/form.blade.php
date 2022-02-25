<form method="{{ $method ?? 'POST' }}" action="{{ $action }}"
    @if ($hasFile ?? null) enctype="multipart/form-data" @endif>
    @csrf
    @if ($modMethod ?? null)
        @method($modMethod)
    @endif
    <input type="hidden" name="save_locale" value="{{ request('edit_locale') }}">

    {{ $slot }}
