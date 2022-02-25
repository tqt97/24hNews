@extends('layouts.admin')

@push('title')
    {{ __('Manage category') }}
@endpush
@push('styles')
    @include('admin.partials.style-list')
@endpush
@section('content')
    <x-admin.header title="{{ __('Manage category') }}" page="{{ __('Manage category') }}" />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- @can('category-create') --}}
                        {{-- @endcan --}}
                        <div class="card-body table-responsive p-2">
                            <x-action.delele-multiple route="{{ route('admin.categories.destroy.multiple') }}" />
                            <x-action.add-new route="{{ route('admin.categories.create') }}" />
                            <div class="row">
                                <x-search.select-date />
                                <x-search.input placeholder="{{ __('Filter by ID') }}" column="1" />
                                <x-search.input placeholder="{{ __('Filter by name') }}" column="2" />
                                <x-search.select-foreach column="3">
                                    @foreach ($highlights as $item)
                                        <option value="{{ $item }}">
                                            {{ $item == 1 ? __('Highlight') : __('None') }}
                                        </option>
                                    @endforeach
                                </x-search.select-foreach>
                                <x-search.select-foreach column="4">
                                    @foreach ($status as $item)
                                        <option value="{{ $item }}">
                                            {{ $item == 1 ? __('Show') : __('Hide') }}
                                        </option>
                                    @endforeach
                                </x-search.select-foreach>
                            </div>
                            <table class="table table-hover table-border text-nowrap" id="datatable">
                                <thead>
                                    <tr style="text-align:center;">
                                        <th width="50px"><input type="checkbox" id="master"></th>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Category name') }}</th>
                                        <th>{{ __('Highlight') }}</th>
                                        <th>{{ __('Status') }}</th>
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
                    "url": "{{ route('api.categories.index') }}",
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
                        render: function(data, type, row) {
                            var locate = '{!! config('app.locale') !!}';
                            return `${locate == 'en' ? row.name.en : row.name.vi}`;
                        }
                    },
                    {
                        'data': 'is_highlight',
                        render: function(data, type, row) {
                            return `${row.is_highlight == 1 ? '<span class="badge badge-success"><i class="fa fa-check"></i></span>' : '<span class="badge badge-secondary"><i class="fa fa-times"></span>'}`;
                        }
                    },
                    {
                        'data': 'status',
                        render: function(data, type, row) {
                            return `${row.status == 1 ? '<span class="badge badge-success"><i class="fa fa-check"></i></span>' : '<span class="badge badge-secondary"><i class="fa fa-times"></span>'}`;
                        }
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
                            var urlEdit = '{{ route('admin.categories.edit', ':id') }}';
                            var urlDestroy = '{{ route('admin.categories.destroy', ':id') }}';
                            urlEdit = urlEdit.replace(':id', row.id);
                            urlDestroy = urlDestroy.replace(':id', row.id);
                            return '<a href="' + urlEdit +
                                '" class="btn btn-outline-primary mr-2 btn-sm"><i class="fas fa-edit"></i></a>' +
                                '<a href="" class="btn btn-outline-danger btn-sm action_delete" data-target="#deleteModal" data-url="' +
                                urlDestroy + '"><i class="fas fa-trash-alt"></i></a>';
                        }
                    }
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
                $(".select2_highlight").select2({
                    placeholder: "{{ __('Filter by highlight') }}",
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
