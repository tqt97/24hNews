@extends('admin.layouts.base')
@section('title', 'Quản lý bài viết')

@section('content')
    @include('admin.layouts.partials.header',[$title = 'Danh sách bài viết', $current_page = 'Danh mục'])
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
                            <a href="{{ route('admin.post.create') }}" style="color:#fff">
                                <btn class="btn btn-primary px-3">
                                    <i class="fa fa-plus"></i>
                                    Thêm mới
                                </btn>
                            </a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-stripeda text-nowrap">
                                <thead>
                                    <tr style="text-align:center;background-color:rgb(244 246 249)">
                                        <th>ID</th>
                                        <th>Tên bài viết</th>
                                        <th>Hình ảnh</th>
                                        <th>Danh mục</th>
                                        <th>Người tạo</th>
                                        <th>Lượt xem</th>
                                        <th>Nổi bật</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr style="text-align:center">
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>
                                                @if ($post->image)
                                                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->name }}"
                                                        width="70px">
                                                @endif
                                            </td>
                                            <td>{{ $post->category->name }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>
                                                @if ($post->is_highlight == 1)
                                                    <span class="badge badge-pill badge-success">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">
                                                        <i class="fa fa-times"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($post->status == 1)
                                                    <span class="badge badge-pill badge-success">Hiện</span>
                                                @else
                                                    <span class="badge badge-pill badge-secondary">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.post.edit', $post->id) }}"
                                                    class="btn btn-outline-primary mr-2">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-outline-danger action_delete"
                                                    data-url="{{ route('admin.post.destroy', $post->id) }}">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr style="text-align: center">
                                            <td colspan="10">Data is empty !</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 col-xs-12">
                            <div class="float-right mr-1">
                                {{ $posts->links() }}
                            </div>
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
