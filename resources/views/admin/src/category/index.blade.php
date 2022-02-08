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
                        <div class="card-header">
                            <btn class="btn btn-primary">
                                <i class="fa fa-plus"></i>
                                <a href="{{ route('admin.category.create') }}" style="color:#fff">Thêm mới</a>
                            </btn>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-stripeda text-nowrap">
                                <thead>
                                    <tr style="text-align:center;background-color:rgb(244 246 249)">
                                        <th>ID</th>
                                        <th>Tên danh mục</th>
                                        <th>Hình ảnh</th>
                                        <th>Người tạo</th>
                                        <th>Is New</th>
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
                                                @if ($category->is_new == 1)
                                                    <span class="badge badge-pill badge-success">is_new</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($category->status == 1)
                                                    <span class="badge badge-pill badge-success">Hiện</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                                    class="btn btn-outline-primary mr-2">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-outline-danger action_delete"
                                                    data-url="{{ route('admin.category.destroy', $category->id) }}">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
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
                        <div class="mt-4 p-3 float-right">
                            {!! $categories->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('admin/dist/js/deleteModel.js') }}"></script>
@endsection
