@extends('layouts.admin')

@push('title')
    {{ __('Slider management') }}
@endpush
@push('styles')
    @include('admin.partials.style-list')
@endpush
@section('content')
    <x-admin.header title="{{ __('Slider management') }}" page="{{ __('Slider management') }}" />

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- @can('category-create') --}}
                        {{-- @endcan --}}
                        <div class="card-body table-responsive p-2">
                            <x-action.delele-multiple route="{{ route('admin.sliders.destroy.multiple') }}" />
                            <x-action.add-new route="{{ route('admin.sliders.create') }}" />
                            <table class="table table-hover table-border text-nowrap" id="datatable">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th width="50px"><input type="checkbox" id="master"></th>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('URL') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Created at') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                    @forelse ($sliders as $slider)
                                        <tr>
                                            <td><input type="checkbox" class="sub_chk" data-id="{{ $slider->id }}">
                                            </td>
                                            <td>{{ $slider->id }}</td>
                                            <td>
                                                {{ $slider->title }}
                                            </td>
                                            </td>
                                            <td>
                                                <img src="{{ $slider->slider_image_thumb }}"
                                                    alt="{{ $slider->title }}">
                                            </td>
                                            <td>
                                                <a href=" {{ $slider->url }}" target="_blank"
                                                    title="{{ $slider->url }}">
                                                    <i class="fa fa-link"></i>{{ $slider->url }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($slider->status == 1)
                                                    <span class="badge badge-success">{{ __('Show') }}</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ __('Hide') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $slider->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                    class="btn btn-outline-primary mr-2 btn-sm"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="" class="btn btn-outline-danger btn-sm action_delete"
                                                    data-target="#deleteModal"
                                                    data-url={{ route('admin.sliders.destroy', $slider->id) }}""><i
                                                        class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">{{ __('No Data') }}</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @include('admin.partials.script-list')
@endpush
