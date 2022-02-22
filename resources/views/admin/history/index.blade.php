@extends('layouts.admin')

@push('title')
    {{ __('Lịch sử') }}
@endpush
@push('styles')
    {{-- @include('admin.partials.style-list') --}}
@endpush
@section('content')
    @include('admin.partials.header',[$title = 'Lịch sử', $current_page = 'Lịch sử'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if ($categories->count() > 0)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header border-transparent bg-gradient-blue">
                                <h3 class="card-title">Danh mục bài viết</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <tbody>
                                            <thead style="justify-content: center;align: center;items-aligned:center;">
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    <th>
                                                        <button class="btn btn-danger mr-3 delete_all"
                                                            data-url="{{ route('admin.categories.destroy.force.multiple') }}">
                                                            <i class="fa fa-trash-alt  mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                    <th>
                                                        <button class="btn btn-success mr-3 restore_all"
                                                            data-url="{{ route('admin.categories.restore.multiple') }}">
                                                            <i class="fa fa-trash-restore mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="sub_chk"
                                                            data-id="{{ $category->id }}">
                                                    </td>
                                                    <td>
                                                        <img src="{{ $category->getFirstMediaUrl('categories', 'thumb') }}"
                                                            width="50px">
                                                    </td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.categories.restore', $category->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </a>
                                                        <a href="{{ route('admin.categories.destroy.force', $category->id) }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No items</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfooter>
                                            {{ $categories->links() }}
                                        </tfooter>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                @if ($posts->count() > 0)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header border-transparent bg-gradient-blue">
                                <h3 class="card-title">Bài viết</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <tbody>
                                            <thead style="justify-content: center;align: center;items-aligned:center;">
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    <th>
                                                        <button class="btn btn-danger mr-3 delete_all"
                                                            data-url="{{ route('admin.posts.destroy.force.multiple') }}">
                                                            <i class="fa fa-trash-alt  mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                    <th>
                                                        <button class="btn btn-success mr-3 restore_all"
                                                            data-url="{{ route('admin.posts.restore.multiple') }}">
                                                            <i class="fa fa-trash-restore mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            @forelse ($posts as $post)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="sub_chk"
                                                            data-id="{{ $post->id }}">
                                                    </td>
                                                    <td>
                                                        <img src="{{ $post->getFirstMediaUrl('posts', 'thumb') }}"
                                                            width="50px">
                                                    </td>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ $post->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.posts.restore', $post->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </a>
                                                        <a href="{{ route('admin.posts.destroy.force', $post->id) }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No items</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfooter>
                                            {{ $posts->links() }}
                                        </tfooter>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                @if ($admins->count() > 0)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header border-transparent bg-gradient-blue">
                                <h3 class="card-title">Bài viết</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <tbody>
                                            <thead style="justify-content: center;align: center;items-aligned:center;">
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    <th>
                                                        <button class="btn btn-danger mr-3 delete_all"
                                                            data-url="{{ route('admin.admins.destroy.force.multiple') }}">
                                                            <i class="fa fa-trash-alt  mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                    <th>
                                                        <button class="btn btn-success mr-3 restore_all"
                                                            data-url="{{ route('admin.admins.restore.multiple') }}">
                                                            <i class="fa fa-trash-restore mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            @forelse ($admins as $admin)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="sub_chk"
                                                            data-id="{{ $admin->id }}">
                                                    </td>
                                                    <td>
                                                        <img src="{{ $admin->getFirstMediaUrl('admins', 'thumb') }}"
                                                            width="50px">
                                                    </td>
                                                    <td>{{ $admin->title }}</td>
                                                    <td>{{ $admin->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.admins.restore', $admin->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </a>
                                                        <a href="{{ route('admin.admins.destroy.force', $admin->id) }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No items</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfooter>
                                            {{ $admins->links() }}
                                        </tfooter>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($sliders->count() > 0)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header border-transparent bg-gradient-blue">
                                <h3 class="card-title">Sliders</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <tbody>
                                            <thead style="justify-content: center;align: center;items-aligned:center;">
                                                <tr>
                                                    <th><input type="checkbox" id="master"></th>
                                                    <th>
                                                        <button class="btn btn-danger mr-3 delete_all"
                                                            data-url="{{ route('admin.sliders.destroy.force.multiple') }}">
                                                            <i class="fa fa-trash-alt  mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                    <th>
                                                        <button class="btn btn-success mr-3 restore_all"
                                                            data-url="{{ route('admin.sliders.restore.multiple') }}">
                                                            <i class="fa fa-trash-restore mr-2"></i>Chọn bản ghi
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>
                                            @forelse ($sliders as $slider)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="sub_chk"
                                                            data-id="{{ $slider->id }}">
                                                    </td>
                                                    <td>
                                                        <img src="{{ $slider->getFirstMediaUrl('sliders', 'thumb') }}"
                                                            width="50px">
                                                    </td>
                                                    <td>{{ $slider->title }}</td>
                                                    <td>{{ $slider->deleted_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.sliders.restore', $slider->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fa fa-trash-restore"></i>
                                                        </a>
                                                        <a href="{{ route('admin.sliders.destroy.force', $slider->id) }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No items</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfooter>
                                            {{ $sliders->links() }}
                                        </tfooter>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    @include('admin.partials.script-list')
@endpush
