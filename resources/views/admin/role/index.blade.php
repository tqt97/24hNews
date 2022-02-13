@extends('layouts.admin')
@section('title', 'Quản lý vai trò')
@section('styles')
    @include('admin.partials.style-list')
@endsection
@section('content')
    @include('admin.partials.header',[$title = 'Danh sách vai trò', $current_page = 'Danh mục'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-2">
                            <a href="{{ route('admin.roles.create') }}" style="color:#fff">
                                <btn class="btn btn-primary mb-3 mt-1">
                                    <i class="fa fa-plus"></i>
                                    Thêm mới
                                </btn>
                            </a>
                            <div class="row">
                                <div class="form-group col-sm-2">
                                    <select class="col-sm form-control select2_date" name="filter-date" id="filter-date">
                                        <option value="">Lọc theo ngày</option>
                                        <option value="7">7 ngày trước</option>
                                        <option value="14">14 ngày trước</option>
                                        <option value="30">30 ngày trước</option>
                                        <option value="60">60 ngày trước</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <input type="text" class="form-control select2 filter-input"
                                        placeholder="Tìm kiếm theo ID" data-column="0">
                                </div>
                                <div class="form-group col-sm-2">
                                    <input type="text" class="form-control filter-input" placeholder="Tìm kiếm theo tên"
                                        data-column="1">
                                </div>

                            </div>
                            <table class="table table-hover table-border text-nowrap" id="datatable">
                                <thead style="text-align:center">
                                    <tr >
                                        <th>ID</th>
                                        <th>Chức danh</th>
                                        <th>Mô tả</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">

                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 col-xs-12">
                            <div class="float-right mr-1">
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    @include('admin.partials.script-list')
    <script>
        $(document).ready(function() {
            const table = $('#datatable').DataTable({
                "ajax": {
                    "url": "{{ route('api.roles.index') }}",
                    "data": function(d) {
                        d.date_filter = $('#filter-date').val();
                    }
                },
                "columns": [{
                        'data': 'id',
                    },
                    {
                        'data': 'name',
                    },
                    {
                        'data': 'display_name',
                    },
                    {
                        'data': 'created_at',
                    },
                ],
                "pageLength": 10,
                "lengthMenu": [10, 15, 25, 50, 75, 100],
                "order": [
                    [4, 'desc']
                ],
                columnDefs: [

                    {
                        targets: 3,
                        render: function(data, type, row) {
                            var d = new Date(row.created_at);
                            var options = {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            // return `${ d.getDate() }-${ d.getMonth() + 1 }-${ d.getFullYear()  }`;
                            return `${ d.toLocaleDateString('vi-Vi',options) }`;
                        }
                    },
                    {
                        targets: 4,
                        render: function(data, type, row) {
                            var urlEdit = '{{ route('admin.roles.edit', ':id') }}';
                            var urlDestroy = '{{ route('admin.roles.destroy', ':id') }}';
                            urlEdit = urlEdit.replace(':id', row.id);
                            urlDestroy = urlDestroy.replace(':id', row.id);
                            return '<a href="' + urlEdit +
                                '" class="btn btn-outline-primary mr-2 btn-sm"><i class="fas fa-edit"></i></a>' +
                                '<a href="" class="btn btn-outline-danger btn-sm action_delete" data-target="#deleteModal" data-url="' +
                                urlDestroy + '"><i class="fas fa-trash-alt"></i></a>';
                        }
                    },

                ]
            });
            $('.filter-input').keyup(function() {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
            $('.filter-select').change(function() {
                table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
            });
            $('#filter-date').change(function() {
                table.draw();
            });
            $(function() {
                $(".select2_status").select2({
                    placeholder: "-- Lọc theo trạng thái --",
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
                $(".select2_date").select2({
                    placeholder: "-- Lọc theo ngày --",
                    // tokenSeparators: [',', ' '],
                    allowClear: true
                });
            });
        });
    </script>
@endsection
