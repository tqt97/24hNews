@extends('layouts.admin')
@section('title', 'Quản lý tags')
@section('styles')
    @include('admin.partials.style-list')
@endsection
@section('content')
    @include('admin.partials.header',[$title = 'Danh sách tags', $current_page = 'Danh mục'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-2">
                            <a href="{{ route('admin.tags.create') }}" style="color:#fff">
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
                                <thead>
                                    <tr style="text-align:center">
                                        <th>ID</th>
                                        <th>Tag</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center">
                                </tbody>
                            </table>
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
                    "url": "{{ route('api.tags.index') }}",
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
                        'data': 'created_at',
                    },
                ],
                "pageLength": 10,
                "lengthMenu": [10, 15, 25, 50, 75, 100],
                "order": [
                    [2, 'desc']
                ],
                columnDefs: [{
                        targets: 2,
                        render: function(data, type, row) {
                            var d = new Date(row.created_at);
                            var options = {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            return `${ d.toLocaleDateString('vi-Vi',options) }`;
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row) {
                            var urlEdit = '{{ route('admin.tags.edit', ':id') }}';
                            var urlDestroy = '{{ route('admin.tags.destroy', ':id') }}';
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
                $(".select2_date").select2({
                    placeholder: "-- Lọc theo theo ngày --",
                    allowClear: true
                });
            });
        });
    </script>
@endsection
