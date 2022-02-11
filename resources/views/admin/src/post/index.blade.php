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
                                    <td colspan="7">Tổng số bài viết: <b>{{ $posts->count() }}</b> </td>
                                    <tr style="text-align:center;background-color:rgb(244 246 249)">
                                        <th>ID</th>
                                        <th>Tên bài viết</th>
                                        <th>Danh mục</th>
                                        <th>Nổi bật</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $key=> $post)
                                        <tr style="text-align:center">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $post->limitTitle() }}</td>
                                            {{-- <td>
                                                <img src="{{ $post->getFirstMediaUrl('image_post', 'small') }}"
                                                    alt="{{ $post->name }}">
                                            </td> --}}
                                            <td>
                                                @foreach ($post->categories as $item)
                                                    <span class="badge badge-warning">{{ $item->name }}</span>
                                                @endforeach
                                            </td>
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
                                            <td>{{ $post->formatCreateAt() }}</td>
                                            <td>
                                                <a href="{{ route('admin.post.edit', $post->id) }}"
                                                    class="btn btn-outline-primary mr-2 btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-outline-danger btn-sm action_delete"
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
                                {{-- {{ $posts->links() }} --}}
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
