@extends('admin.layouts.base')
@section('title', 'Quản lý tags')

@section('content')
    @include('admin.layouts.partials.header',[$title = 'Danh sách tags', $current_page = 'Danh mục'])
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
                            <a href="{{ route('admin.tag.create') }}" style="color:#fff">
                                <btn class="btn btn-primary">
                                    <i class="fa fa-plus"></i>
                                    Thêm mới
                                </btn>
                            </a>
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                Thêm tag
                            </button> --}}
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-bordered table-stripeda text-nowrap">
                                <thead>
                                    <tr style="text-align:center;background-color:rgb(244 246 249)">
                                        <th>ID</th>
                                        <th>Tag</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tags as $tag)
                                        <tr style="text-align:center">
                                            <td>{{ $tag->id }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td>{{ $tag->formatCreateAt() }}</td>
                                            <td>
                                                <a href="{{ route('admin.tag.edit', $tag->id) }}"
                                                    class="btn btn-outline-primary mr-2">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-outline-danger action_delete"
                                                    data-url="{{ route('admin.tag.destroy', $tag->id) }}">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr style="text-align: center">
                                            <td colspan="4">Data is empty !</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 col-xs-12">
                            <div class="float-right mr-1">
                                {{ $tags->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Add-->
    {{-- <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.tag.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên tag :</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="Điền tên tag" autofocus required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mr-3">
                            <i class="fa fa-save"></i>
                            Tạo mới
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </form>

            </div>
        </div>
    </div> --}}
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('admin/dist/js/deleteModel.js') }}"></script>
@endsection
