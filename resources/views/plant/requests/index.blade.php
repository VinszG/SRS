<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Dashboard</title>
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
    <!-- Sidebar -->
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6 space-y-5">
            <a href="dashboard" class="text-white text-3xl font-semibold uppercase hover:text-gray-300 block">
                Plant
            </a>
            <a href="{{ route('plant.requests.index') }}" class="w-full max-w-xs bg-white cta-btn font-semibold text-sm py-3 mt-5 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-between no-underline">
                <span class="flex-grow text-center">Request Non-Urgent</span>
            </a>            
            <a href="#" class="w-full max-w-xs bg-white cta-btn font-semibold text-sm py-3 mt-5 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-between no-underline">
                <span class="flex-grow text-center">Request Eksternal</span>
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="dashboard" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-home mr-3"></i>
                Dashboard
            </a>
            <br>
            <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-clipboard mr-3"></i>
                History Request
            </a>
            <br>
            <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-users mr-3"></i>
                User List
            </a>
            <br>
            <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tools mr-3"></i>
                List Teknisi
            </a>
            <br>
            <a href="#" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-file-alt mr-3"></i>
                Laporan Teknisi
            </a>        
        </nav>
        <a href="#" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-arrow-circle-up mr-3"></i>
            Service Request System
        </a>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Header -->
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
                    <a href="{{ route('plant.profile') }}" class="block px-4 py-2 account-link hover:text-white">Profile</a>
                    <a href="{{ route('account.logout') }}" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold pb-4">
                        <i class="fas fa-clipboard-list mr-3 text-blue-500"></i> Non-Urgent Requests
                    </h2>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-4 py-2 text-left">No. BPJ</th>
                                        <th class="px-4 py-2 text-left">Name</th>
                                        <th class="px-4 py-2 text-left">Departemen</th>
                                        <th class="px-4 py-2 text-left">Jabatan</th>
                                        <th class="px-4 py-2 text-left">Deskripsi Permasalahan</th>
                                        <th class="px-4 py-2 text-center">Status</th>
                                        <th class="px-4 py-2 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($plantsRequests as $request)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3">{{ $request->bpj_number }}</td>
                                            <td class="px-4 py-3">{{ $request->name }}</td>
                                            <td class="px-4 py-3">{{ $request->departemen }}</td>
                                            <td class="px-4 py-3">{{ $request->jabatan }}</td>
                                            <td class="px-4 py-3">
                                                <div class="truncate-text">
                                                    {{ $request->deskripsi_permasalahan }}
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="px-2 py-1 text-sm rounded-full 
                                                    {{ $request->status === 'plants' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <a href="{{ route('plant.requests.show', $request) }}" 
                                                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                                                Tidak ada request non-urgent
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
</body>
</html>
