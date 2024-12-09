<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    
    <!-- Inter Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        .font-family-inter { font-family: 'Inter', sans-serif; }
        .bg-sidebar { background: #ff6200; }
        .cta-btn { color: #ff6200; }
        .upgrade-btn { background: #eb5b00; }
        .upgrade-btn:hover { background: #a74000; }
        .active-nav-link { background: #eb5b00; }
        .nav-item:hover { background: #eb5b00; }
        .account-link:hover { background: #ff6200; }
        .long-text {
            max-width: 100%;
            word-wrap: break-word;
            white-space: pre-wrap;
            overflow-wrap: break-word;
        }
    </style>
</head>
<body class="bg-gray-100 font-family-inter flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="dashboard" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">User</a>
            <a href="{{ route('user.requests.create') }}" class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center no-underline">
                <i class="fas fa-plus mr-3"></i> New Report
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('account.user.dashboard') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <br>
            <a href="{{ route('user.requests.index') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                History Request
            </a>
        </nav>
        <a href="#" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-arrow-circle-up mr-3"></i>
            Service Request System
        </a>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-full flex items-center">
                <h1 class="text-xl sm:text-2xl font-bold flex flex-wrap items-center">
                    <span class="inline-block" style="background: linear-gradient(to right, #EB5B00, #FF0000); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 0.5px 0.5px 1px rgba(0,0,0,0.1);">
                        SERVICE REQUEST SYSTEM
                    </span>
                    <span class="text-gray-700 ml-2 whitespace-nowrap">| PT. CIOMAS ADISATWA</span>
                </h1>
            </div>
        
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="{{ asset('images/user.svg') }}" class="w-full h-full object-cover">
                </button>                
        
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="{{ route('user.profile') }}" class="block px-4 py-2 account-link hover:text-white">Profile</a>
                    <a href="{{ route('account.logout') }}" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="dashboard" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('account.logout') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
                <a href="{{ route('user.requests.create') }}" class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center no-underline">
                    <i class="fas fa-plus mr-3"></i> New Report
                </a>
                <button class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-arrow-circle-up mr-3"></i>
                    Service Request System
                </button>
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Request Details</h1>
                
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Request #{{ $request->no_bpj }}</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-700 font-bold mb-2">Name:</p>
                            <p class="text-gray-600">{{ $request->name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-700 font-bold mb-2">Status:</p>
                            <p class="text-gray-600">
                            @switch($request->status)
                                @case('pending')
                                    <span class="bg-yellow-300 text-yellow-800 py-1 px-3 rounded-full text-xs">Pending</span>
                                    @break
                                @case('ongoing')
                                    <span class="bg-blue-300 text-blue-800 py-1 px-3 rounded-full text-xs">In Progress</span>
                                    @break
                                @case('canceled')
                                    <span class="bg-gray-300 text-gray-800 py-1 px-3 rounded-full text-xs">Canceled</span>
                                    @break
                                @case('done')
                                    <span class="bg-teal-300 text-teal-800 py-1 px-3 rounded-full text-xs">Selesai</span>
                                    @break
                                @case('rejected')
                                    <span class="bg-red-300 text-red-800 py-1 px-3 rounded-full text-xs">Ditolak</span>
                                    @break
                                @case('admins')
                                    <span class="bg-indigo-300 text-indigo-800 py-1 px-3 rounded-full text-xs">Di Admin</span>
                                    @break
                                @case('spv')
                                    <span class="bg-orange-300 text-orange-800 py-1 px-3 rounded-full text-xs">Di SPV</span>
                                    @break
                                @case('plants')
                                    <span class="bg-lime-300 text-lime-800 py-1 px-3 rounded-full text-xs">Di Plants</span>
                                    @break
                                @default
                                    <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs">{{ $request->status }}</span>
                            @endswitch
                            </p>
                        </div>
                        
                        <div>
                            <p class="text-gray-700 font-bold mb-2">Departemen:</p>
                            <p class="text-gray-600">{{ $request->departemen }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-700 font-bold mb-2">Jabatan:</p>
                            <p class="text-gray-600">{{ $request->jabatan }}</p>
                        </div>
                        
                        <div>
                            <p class="text-gray-700 font-bold mb-2">Request Date:</p>
                            <p class="text-gray-600">{{ $request->request_date->format('d/m/Y') }} | Jam {{ $request->request_date->format('H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <p class="text-gray-700 font-bold mb-2">Deskripsi Permasalahan:</p>
                        <p class="text-gray-600 long-text">{{ $request->deskripsi_permasalahan }}</p>
                    </div>
                    
                    @if($request->bukti_foto)
                        <div class="mt-6">
                            <p class="text-gray-700 font-bold mb-2">Bukti Foto:</p>
                            <img src="{{ asset('storage/'.$request->bukti_foto) }}" alt="Bukti Foto" class="max-w-md h-auto rounded-lg shadow-lg">
                        </div>
                    @endif
                    
                    <div class="mt-8">
                        <a href="{{ route('user.requests.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to History
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>