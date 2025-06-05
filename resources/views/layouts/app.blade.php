<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Penjualan')</title>

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- datatable css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen antialiased">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#" class="text-2xl font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                    PT Avia Avian Internship Test
                </a>

                <div class="flex items-center space-x-3 md:space-x-5">
                    <a href="{{ route('purchases.create') }}"
                        class="px-4 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('purchases.create') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'text-slate-700 hover:text-indigo-600 hover:bg-indigo-50' }}
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-150 ease-in-out">
                        Input Transaksi
                    </a>
                    <a href="{{ route('report.customers.page') }}"
                        class="px-4 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('report.customers.page') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'text-slate-700 hover:text-indigo-600 hover:bg-indigo-50' }}
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 transition-all duration-150 ease-in-out">
                        Lihat Report
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 mt-12">
        <div class="container mx-auto px-6 py-6 text-center text-sm text-slate-500">
            © {{ date('Y') }} Internship Tes Avian @DarrenChristopher
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @stack('scripts')
</body>
</html>
