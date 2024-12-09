<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details</title>
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
    </style>
</head>
<body class="bg-gray-100 font-family-inter flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('super.dashboard') }}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">SPV</a>
            <a href="{{ route('super.request.index') }}" class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center no-underline">
                <i class="fas fa-list mr-3"></i> Request List
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('super.dashboard') }}" class="flex items-center text-white py-4 pl-6 nav-item">
                <i class="fas fa-home mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('super.request.index') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-clipboard mr-3"></i>
                Pending Request
            </a>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="relative z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="{{ asset('images/user.svg') }}">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="{{ route('super.profile') }}" class="block px-4 py-2 account-link hover:text-white">Profile</a>
                    <a href="{{ route('account.logout') }}" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="{{ route('super.dashboard') }}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">SPV</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="{{ route('super.dashboard') }}" class="flex items-center text-white py-2 pl-4 nav-item">
                    <i class="fas fa-home mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('super.request.index') }}" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-clipboard mr-3"></i>
                    Pending Request
                </a>
                <a href="{{ route('account.logout') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Request Details</h1>

                <div class="w-full mt-6">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="no_bpj">
                                No. BPJ
                            </label>
                            <p class="text-gray-700 text-base">{{ $request->no_bpj }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <p class="text-gray-700 text-base">{{ $request->name}}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="department">
                                Department
                            </label>
                            <p class="text-gray-700 text-base">{{ $request->department }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Description
                            </label>
                            <p class="text-gray-700 text-base">{{ $request->description }}</p>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                                Status
                            </label>
                            <p class="text-gray-700 text-base">
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
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="created_at">
                                Created At
                            </label>
                            <p class="text-gray-700 text-base">{{ $request->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <form action="{{ route('super.request.updateJenis', $request) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis">
                                        Update Jenis
                                    </label>
                                    <select name="jenis" id="jenis" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="urgent">Urgent</option>
                                        <option value="non-urgent">Non-Urgent</option>
                                    </select>
                                </div>
                            
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Update Jenis
                                </button>
                            </form>
                            
                            <a href="{{ route('super.request.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Back to List
                            </a>
                        </div>
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
