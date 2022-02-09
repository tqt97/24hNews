@extends('admin.layouts.base')
@section('title', 'Quản lý người dùng')

@section('content')
    @include('admin.layouts.partials.header',[$title = 'Danh sách người dùng', $current_page = 'Danh mục'])
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
                            <a href="{{ route('admin.user.create') }}" style="color:#fff">
                                <btn class="btn btn-primary">
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
                                        <th>Tên người dùng</th>
                                        <th>Email</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr style="text-align:center">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->formatCreateAt() }}</td>
                                            <td>
                                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-outline-primary mr-2">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="" class="btn btn-outline-danger action_delete"
                                                    data-url="{{ route('admin.user.destroy', $user->id) }}">
                                                    <i class="fa fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr style="text-align: center">
                                            <td colspan="6">Data is empty !</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 col-xs-12">
                            <div class="float-right mr-1">
                                {{ $users->links() }}
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
