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
        .truncate-text {
            max-width: 300px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .expanded {
            white-space: pre-wrap;
            word-break: break-word;
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
        <a href="dashboard" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
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
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">User</a>
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
                <a href="{{ route('user.requests.index') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    History Request
                </a>
                <a href="{{ route('account.logout') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
                <a href="{{ route('user.requests.create') }}" class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-3"></i> New Report
                </a>
                <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-arrow-circle-up mr-3"></i>
                    Service Request System
                </button>
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <a class="text-3xl text-black pb-6" href="{{ route('account.user.dashboard') }}">
                    Dashboard
                </a>
                <div class="w-full mt-12">
                    <p class="text-2xl font-semibold pb-4 flex items-center">
                        <i class="fas fa-clipboard-list mr-3 text-blue-500"></i> Latest Request
                    </p>
                    <form action="{{ route('account.user.dashboard') }}" method="GET" class="mb-4">
                        <div class="flex items-center">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Cari berdasarkan No. BPJ atau Deskripsi" value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </form>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="overflow-x-auto max-h-96">
                            <table class="w-full table-auto">
                                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal sticky top-0">
                                    <tr>
                                        <th class="py-3 px-6 text-left whitespace-nowrap">No. BPJ</th>
                                        <th class="py-3 px-6 text-left">Permasalahan</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Jenis</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Bukti Foto</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Tanggal Dibuat</th>
                                        <th class="py-3 px-6 text-center whitespace-nowrap">Status</th>
                                    </tr>
                                </thead>    
                                <tbody class="text-gray-600 text-sm font-light">
                                    @if($recentRequests->isEmpty())
                                        <tr>
                                            <td colspan="6" class="py-4 px-6 text-center">
                                                <p class="text-gray-500 text-lg">You haven't made any requests yet.</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($recentRequests as $request)
                                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300">
                                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <span class="font-medium">{{ $request->no_bpj }}</span>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-left">
                                                    <div class="flex flex-col items-start">
                                                        <div class="truncate-text w-full" id="text-{{ $request->id }}">{{ $request->deskripsi_permasalahan }}</div>
                                                        <button onclick="toggleExpand('{{ $request->id }}')" class="text-blue-500 hover:text-blue-700 text-xs mt-1 focus:outline-none" id="btn-{{ $request->id }}">
                                                            Read more
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex justify-center">
                                                        @if(strtolower($request->jenis) == 'urgent')
                                                            <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs whitespace-nowrap">Urgent</span>
                                                        @else
                                                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs whitespace-nowrap">Non-Urgent</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="py-3 px-6 text-center flex flex-col items-center">
                                                   @if($request->bukti_foto)
                                                        <img src="{{ url('storage/' . $request->bukti_foto) }}" alt="" class="w-16 h-16 object-cover rounded mt-2">
                                                    @else
                                                        <span class="text-gray-400 mt-2">Tidak ada foto</span>
                                                    @endif 
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <span>{{ $request->request_date }}</span>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    @switch($request->status)
                                                        @case('Pending')
                                                            <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Pending</span>
                                                            @break
                                                        @case('In Progress')
                                                            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">In Progress</span>
                                                            @break
                                                        @case('Completed')
                                                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Completed</span>
                                                            @break
                                                        @default
                                                            <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs">{{ $request->status }}</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>

    <script>
        function toggleExpand(id) {
            const textElement = document.getElementById(`text-${id}`);
            const btnElement = document.getElementById(`btn-${id}`);
            
            if (textElement.classList.contains('truncate-text')) {
                textElement.classList.remove('truncate-text');
                textElement.classList.add('expanded');
                btnElement.textContent = 'Show less';
            } else {
                textElement.classList.add('truncate-text');
                textElement.classList.remove('expanded');
                btnElement.textContent = 'Read more';
            }
        }
    </script>
</body>
</html>