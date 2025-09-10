@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daffa Tani POS</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center px-6">
        <div class="text-center space-y-2">
            <img src="{{ asset('images/daffatani.png') }}" alt="daffatani" class="w-64 mx-auto" />

            <p class="text-lg text-gray-600 max-w-xl mx-auto">
                A modern Point of Sale system for agricultural shops. It is designed to manage inventory, sales, and reports with ease.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}"
                   class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="bg-white border border-green-600 text-green-700 px-6 py-2 rounded hover:bg-green-50 transition">
                    Register
                </a>
            </div>
        </div>
        {{-- <div class="visible-print mt-8">
            {!! QrCode::size(100)->generate(url('/login')) !!}
        </div> --}}
        <footer class="mt-8 text-xs text-gray-400 text-center">
            &copy; {{ date('Y') }} Daffa Tani POS. All rights reserved.
        </footer>
    </div>

</body>
</html>
