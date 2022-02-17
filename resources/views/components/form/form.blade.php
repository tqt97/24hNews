{{-- @props([
    'method' => 'POST',
    'action' => '',
    'hasFile' => '',
]) --}}

{{-- <form method="{{ $method === 'GET' ? 'GET' : 'POST' }}" action="{{ $action }}"
    @if ($hasFile ?? null) enctype="multipart/form-data" @endif>
    @csrf
    @if (!in_array($method, ['GET', 'POST']))
        @method($method)
    @endif
    {{ $slot }} --}}

<form method="{{ $method ?? 'POST' }}" action="{{ $action }}"
    @if ($hasFile ?? null) enctype="multipart/form-data" @endif>
    @csrf
    @if ($modMethod ?? null)
        @method($modMethod)
    @endif
    {{ $slot }}
