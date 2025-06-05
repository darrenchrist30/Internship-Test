@extends('layouts.app')

@section('title', 'Report Pembelian Customer')

@section('content')
<div class="max-w-4xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
        <div class="flex items-center mb-6">
            <div class="bg-blue-100 text-blue-600 rounded-full p-3 mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3m-7 6h7a2 2 0 002-2v-5a2 2 0 00-2-2h-7a2 2 0 00-2 2v5a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-700">
                    Report Total Pembelian Per Customer
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Data Table untuk menunjukkan total pembelian dari setiap customer
                </p>
            </div>
        </div>
        <a href="{{ route('purchases.create') }}" class="mb-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Input Transaksi Baru
        </a>

        <div class="overflow-x-auto">
            <table id="customers-table" class="min-w-full bg-white rounded-lg overflow-hidden shadow text-sm" style="width:100%">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Customer ID</th>
                        <th class="px-4 py-3 text-left">Nama Customer</th>
                        <th class="px-4 py-3 text-left">Total Pembelian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.13.6/integration/tailwindcss/dataTables.tailwindcss.css">

<style>
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #cbd5e1;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        margin-left: 0.5rem;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #cbd5e1;
        padding: 0.5rem 2rem 0.5rem 0.75rem;
        border-radius: 0.375rem;
        margin-left: 0.5rem;
        margin-right: 0.5rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        outline: none;
    }
     .dataTables_wrapper .dataTables_length select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 1em;
        margin-left: 2px;
        border: 1px solid transparent;
        border-radius: 0.375rem; /* rounded-md */
        color: #374151; /* gray-700 */
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #2563eb !important; /* blue-600 */
        color: white !important;
        border-color: #2563eb !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #eff6ff; /* blue-50 */
        border-color: #dbeafe; /* blue-200 */
        color: #1d4ed8 !important; /* blue-700 */
    }
    .dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        margin-left: -100px;
        margin-top: -25px;
        text-align: center;
        padding: 1em 0;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        z-index: 1000;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.13.6/integration/tailwindcss/dataTables.tailwindcss.js"></script>

<script>
    $(document).ready(function () {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('report.customers.data.ajax') }}",
            columns: [
                { data: 'customer_id', name: 'customers.customer_id' },
                { data: 'customer_name', name: 'customers.customer_name' },
                {
                    data: 'total_purchases',
                    name: 'total_purchases',
                    render: function(data, type, row) {
                        return 'Rp ' + parseFloat(data).toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    },
                    searchable: false,
                    orderable: true
                }
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari customer...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                zeroRecords: "Tidak ada data yang cocok ditemukan",
                paginate: {
                    first: "<<",
                    last: ">>",
                    previous: "<",
                    next: ">"
                },
                processing: '<div class="dataTables_processing">Memproses...</div>'
            },
        });
    });
</script>
@endpush
