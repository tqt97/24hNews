@extends('layouts.admin')
@section('title', 'Quản lý danh mục')
@section('styles')
    @include('admin.partials.style-list')
@endsection
@section('content')
    @include('admin.partials.header',[$title = 'Danh sách danh mục', $current_page = 'Danh mục'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- @can('category-create') --}}
                        {{-- @endcan --}}
                        <div class="card-body table-responsive p-2">
                            <a href="{{ route('admin.categories.create') }}" style="color:#fff">
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
                                <div class="form-group col-sm-2">
                                    <select data-column="2" class="form-control select2_highlight filter-select"
                                        style="width:100%">
                                        <option value=""></option>
                                        @foreach ($highlights as $item)
                                            <option value="{{ $item }}">
                                                {{ $item == 1 ? 'Nổi bật' : 'Không' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <select data-column="3" class="form-control select2_status filter-select"
                                        style="width:100%">
                                        <option value="">-- Tìm kiếm theo trạng thái --</option>
                                        @foreach ($status as $item)
                                            <option value="{{ $item }}">
                                                {{ $item == 1 ? 'Hiện' : 'Ẩn' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-hover table-border text-nowrap" id="datatable">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th>ID</th>
                                        <th>Tên danh mục</th>
                                        <th>Nổi bật</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Thao tác</th>
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
                    "url": "{{ route('api.categories.index') }}",
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
                        'data': 'is_highlight',
                    },
                    {
                        'data': 'status',
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
                columnDefs: [{
                        targets: 2,
                        render: function(data, type, row) {
                            return `${row.is_highlight == 1 ? '<span class="badge badge-success"><i class="fa fa-check"></i></span>' : '<span class="badge badge-secondary"><i class="fa fa-times"></span>'}`;
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row) {
                            return `${row.status == 1 ? '<span class="badge badge-success"><i class="fa fa-check"></i></span>' : '<span class="badge badge-secondary"><i class="fa fa-times"></span>'}`;
                        }
                    },
                    {
                        targets: 4,
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
                        targets: 5,
                        render: function(data, type, row) {
                            var urlEdit = '{{ route('admin.categories.edit', ':id') }}';
                            var urlDestroy = '{{ route('admin.categories.destroy', ':id') }}';
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
                    placeholder: "-- Tìm kiếm theo trạng thái --",
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
                $(".select2_highlight").select2({
                    placeholder: "-- Tìm kiếm theo nổi bật --",
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
                $(".select2_date").select2({
                    placeholder: "-- Tìm kiếm theo ngày --",
                    // tokenSeparators: [',', ' '],
                    allowClear: true
                });
            });
        });
    </script>
@endsection
