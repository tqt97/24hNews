@extends('admin.layouts.base')
@section('title', 'Quản lý danh mục')

@section('content')
    @include('admin.layouts.partials.header',[$title = 'Danh sách danh mục', $current_page = 'Danh mục'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('success'))
                    <div>
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="card">
                        @can('category-create')
                            <div class="card-header">
                                <a href="{{ route('admin.category.create') }}" style="color:#fff">
                                    <btn class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        Thêm mới
                                    </btn>
                                </a>
                            </div>
                        @endcan
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-stripeda text-nowrap">
                                <thead>
                                    <tr style="text-align:center;background-color:rgb(244 246 249)">
                                        <th>ID</th>
                                        <th>Tên danh mục</th>
                                        <th>Hình ảnh</th>
                                        <th>Người tạo</th>
                                        <th>Nổi bật</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr style="text-align:center">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if ($category->image)
                                                    <img src="{{ $category->imageUrl() }}" alt="{{ $category->name }}"
                                                        width="70px">
                                                @endif
                                            </td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>
                                                @if ($category->is_highlight == 1)
                                                    <span class="badge badge-pill badge-success">Nổi bật</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">x</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($category->status == 1)
                                                    <span class="badge badge-pill badge-success">Hiện</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->formatCreateAt() }}</td>
                                            <td>
                                                @can('category-update')
                                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                                        class="btn btn-outline-primary mr-2">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('category-delete')
                                                    <a href="" class="btn btn-outline-danger action_delete"
                                                        data-url="{{ route('admin.category.destroy', $category->id) }}">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr style="text-align: center">
                                            <td colspan="8">Data is empty !</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 col-xs-12">
                            <div class="float-right mr-1">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh mục</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="border-0">183</td>
                                    </tr>
                                    <tr data-widget="expandable-table" aria-expanded="true">
                                        <td>
                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                            219
                                        </td>
                                    </tr>
                                    <tr class="expandable-body">
                                        <td>
                                            <div class="p-0">
                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>
                                                                <i
                                                                    class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                                219-1
                                                            </td>
                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td>
                                                                <div class="p-0" style="display: none;">
                                                                    <table class="table table-hover">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>219-1-1</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr data-widget="expandable-table" aria-expanded="false">
                                                            <td>
                                                                <i class="expandable-table-caret fas fa-caret-right fa-fw">
                                                                </i>
                                                                219-2
                                                            </td>
                                                        </tr>
                                                        <tr class="expandable-body d-none">
                                                            <td>
                                                                <div class="p-0" style="display: none;">
                                                                    <table class="table table-hover">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>219-2-1</td>
                                                                                <td>hi</td>
                                                                                <td>hi</td>
                                                                                <td>
                                                                                    <a href="">Links</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>219-3</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('admin/dist/js/deleteModel.js') }}"></script>
@endsection
