@extends('layouts.admin')
@push('title')
    {{ __('User management') }}
@endpush
@push('styles')
    @include('admin.partials.style-list')
@endpush
@section('content')
    <x-admin.header title="{{ __('User management') }}" page="{{ __('User management') }}" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-2">

                            <x-action.delele-multiple route="{{ route('admin.admins.destroy.multiple') }}" />
                            <x-action.add-new route="{{ route('admin.admins.create') }}" />
                            <div class="row">
                                <x-search.select-date />

                                <x-search.input placeholder="{{ __('Filter by ID') }}" column="1" />
                                <x-search.input placeholder="{{ __('Filter by name') }}" column="2" />
                                <x-search.input placeholder="{{ __('Filter by email') }}" column="3" />
                                <x-search.input placeholder="{{ __('Filter by phone') }}" column="4" />
                            </div>
                            <table class="table table-hover table-border text-nowrap" id="datatable">
                                <thead style="text-align:center">
                                    <tr>
                                        <th width="50px"><input type="checkbox" id="master"></th>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Created at') }}</th>
                                        <th></th>
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
                    "url": "{{ route('api.admins.index') }}",
                    "data": function(d) {
                        d.date_filter = $('#filter-date').val();
                    }
                },
                "columns": [{
                        'data': 'id',
                        render: function(data, type, row) {
                            return `<input type="checkbox" class="sub_chk" data-id="${row.id}">`;
                        }
                    },
                    {
                        'data': 'id',
                        render: function(data, type, row) {
                            return `${row.id}`;
                        }
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
                        render: function(data, type, row) {
                            var d = new Date(row.created_at);
                            var options = {
                                // weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            return `${ d.toLocaleDateString(options) }`;
                        }
                    },
                ],
                "pageLength": 10,
                "lengthMenu": [10, 15, 25, 50, 75, 100],
                "order": [
                    [4, 'desc']
                ],
                columnDefs: [{
                        "targets": 0,
                        "orderable": false
                    },
                    {
                        targets: 6,
                        render: function(data, type, row) {
                            var urlEdit = '{{ route('admin.admins.edit', ':id') }}';
                            var urlDestroy = '{{ route('admin.admins.destroy', ':id') }}';
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
                    placeholder: "{{ __('Filter by date') }}",
                    allowClear: true
                });
            });
        });
    </script>
@endpush
