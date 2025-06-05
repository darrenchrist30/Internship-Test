{{-- resources/views/purchases/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Input Transaksi Pembelian')

@section('content')
<div class="max-w-4xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
        <div class="flex items-center mb-6">
            <div class="bg-blue-100 text-blue-600 rounded-full p-3 mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17v-2a4 4 0 014-4h3m-7 6h7a2 2 0 002-2v-5a2 2 0 00-2-2h-7a2 2 0 00-2 2v5a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-700">
                    Input Transaksi Pembelian
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Form untuk menambah data baru
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('purchases.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="customer_id" class="block text-sm font-medium text-slate-700">Customer</label>
                <select
                    id="customer_id"
                    name="customer_id"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-md bg-white py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">Pilih Customer</option>
                    @foreach($customers as $customer)
                        <option
                            value="{{ $customer->customer_id }}"
                            {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}
                        >
                            {{ $customer->customer_name }} ({{ $customer->customer_id }})
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="purchase_date" class="block text-sm font-medium text-slate-700">Tanggal Transaksi</label>
                <input
                    type="date"
                    id="purchase_date"
                    name="purchase_date"
                    value="{{ old('purchase_date', date('Y-m-d')) }}"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-md bg-white py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
                @error('purchase_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="total_price" class="block text-sm font-medium text-slate-700">Total Transaksi (Rp)</label>
                <input
                    type="number"
                    id="total_price"
                    name="total_price"
                    value="{{ old('total_price') }}"
                    min="0"
                    step="any"
                    required
                    placeholder="Misal: 100"
                    class="mt-1 block w-full border border-gray-300 rounded-md bg-white py-2 px-3 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                >
                @error('total_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button
                    type="submit"
                    class="inline-flex justify-center items-center gap-x-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
                >
                    Simpan Transaksi
                </button>
                <a
                    href="{{ route('report.customers.page') }}"
                    class="inline-flex justify-center items-center gap-x-2 bg-gray-200 hover:bg-gray-300 text-slate-700 font-semibold py-2 px-4 rounded"
                >
                    Lihat Report
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
