@extends('layouts.admin')

@push('title')
    {{ __('Contact management') }}
@endpush
@push('styles')
    @include('admin.partials.style-list')
@endpush
@section('content')
    <x-admin.header title=" {{ __('Contact management') }}" page=" {{ __('Contact management') }}" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-2">
                            <div class="row">
                                <x-search.select-date />
                                <x-search.input placeholder="{{ __('Filter by ID') }}" column="0" />
                                <x-search.input placeholder="{{ __('Filter by name') }}" column="1" />
                                <x-search.input placeholder="{{ __('Filter by email') }}" column="2" />
                                <x-search.input placeholder="{{ __('Filter by phone') }}" column="3" />

                            </div>
                            <table class="table table-hover table-border text-nowrap" id="datatable">
                                <thead style="text-align:center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
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
@push('scripts')
    @include('admin.partials.script-list')
    <script>
        $(document).ready(function() {
            const table = $('#datatable').DataTable({
                "ajax": {
                    "url": "{{ route('api.contacts.index') }}",
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
                        'data': 'email',
                    },
                    {
                        'data': 'phone',
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
                    placeholder: "{{ __('Filter by status') }}",
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
                $(".select2_date").select2({
                    placeholder: "{{ __('Filter by date') }}",
                    allowClear: true
                });
            });
        });
    </script>
@endpush
