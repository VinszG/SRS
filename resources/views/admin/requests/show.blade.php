<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            max-width: 300px;
        }
        .long-text {
            max-width: 100%;
            word-wrap: break-word;
            white-space: pre-wrap;
            overflow-wrap: break-word;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            border: 1px solid #e9ecef;
            line-height: 1.5;
        }

    </style>
</head>
<body class="bg-gray-100 font-family-inter flex">

    @if (session('loginSuccess'))
        <div id="loginSuccessNotification" class="notification bg-green-500 text-white px-4 py-2 rounded shadow-lg flex justify-between items-center">
            <span>{{ session('loginSuccess') }}</span>
            <button onclick="closeNotification()" class="text-white hover:text-gray-200 focus:outline-none">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="dashboard" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <a href="{{ route('admin.requests.index') }}" class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center no-underline">
                <i class="fas fa-list mr-3"></i> Request Masuk
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
            <a href="{{ route('admin.register') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-user-plus mr-3"></i>
                Add Account
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
                    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 account-link hover:text-white">Profile</a>
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
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    History Request
                </a>
                <a href="{{ route('account.logout') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
                <a href="#" class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
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
                <h1 class="text-3xl text-black pb-6">Detail Request</h1>
                
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <!-- Header -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Request #{{ $request->no_bpj }}</h2>
                    </div>
                    
                    <!-- Basic Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 font-bold mb-2">Nama:</p>
                            <p class="text-gray-600">{{ $request->name }}</p>
                        </div>
            
                        <!-- Status -->
                        <div class="bg-gray-50 p-4 rounded-lg">
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
                        
                        <!-- Department -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 font-bold mb-2">Departemen:</p>
                            <p class="text-gray-600">{{ $request->departemen }}</p>
                        </div>
                        
                        <!-- Position -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 font-bold mb-2">Jabatan:</p>
                            <p class="text-gray-600">{{ $request->jabatan }}</p>
                        </div>
                        
                        <!-- Request Date -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 font-bold mb-2">Tanggal Request:</p>
                            <p class="text-gray-600">{{ $request->request_date->format('d/m/Y') }} | Jam {{ $request->request_date->format('H:i') }}</p>
                        </div>
            
                        <!-- Type -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 font-bold mb-2">Jenis:</p>
                            <p class="text-gray-600">
                                @if($request->jenis === 'urgent')
                                    <span class="bg-red-300 text-red-800 py-1 px-3 rounded-full text-xs">Urgent</span>
                                @else
                                    <span class="bg-green-300 text-green-800 py-1 px-3 rounded-full text-xs">Non-Urgent</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Problem Description -->
                    <div class="mt-8 bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700 font-bold mb-2">Deskripsi Permasalahan:</p>
                        <p class="text-gray-600 whitespace-pre-line break-words">{{ $request->deskripsi_permasalahan }}</p>
                    </div>
                    
                    <!-- Photo Evidence -->
                    @if($request->bukti_foto)
                        <div class="mt-8">
                            <p class="text-gray-700 font-bold mb-2">Bukti Foto:</p>
                            <div class="relative">
                                <!-- Thumbnail -->
                                <img src="{{ asset('storage/'.$request->bukti_foto) }}" 
                                    alt="Bukti Foto" 
                                    class="h-48 w-48 object-cover rounded-lg shadow-lg cursor-pointer hover:opacity-90 transition-opacity" 
                                    onclick="openLightbox(this.src)"
                                >
                            </div>
                        </div>
                    
                        <!-- Lightbox Modal -->
                        <div id="lightbox" 
                            class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50" 
                            onclick="closeLightbox()">
                            <div class="relative bg-white p-1 rounded-lg">
                                <img id="lightbox-img" 
                                    src="" 
                                    class="h-96 w-96 object-cover rounded" 
                                    alt="Bukti Foto Full Size">
                            </div>
                        </div>
                    @endif

                    <div class="mt-8 bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-bold mb-4">Penugasan Teknisi</h3>
                        
                        <form action="{{ route('admin.requests.assign', $request->id) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Pilih Teknisi
                                </label>
                                <select name="teknisi_id" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                    <option value="">Pilih Teknisi</option>
                                    @foreach(\App\Models\User::where('role', 'teknisi')->get() as $teknisi)
                                        <option value="{{ $teknisi->id }}">{{ $teknisi->name }}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Jenis Tugas
                                </label>
                                <select name="tugas" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="pengecekan">Pengecekan</option>
                                    <option value="perbaikan">Perbaikan</option>
                                </select>
                            </div>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Tugaskan Teknisi
                            </button>
                        </form>
                    </div>
                    
                    <!-- Back Button -->
                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.requests.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
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

        // Auto-hide notification after 5 seconds
        function closeNotification() {
            var notification = document.getElementById('loginSuccessNotification');
            if (notification) {
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.5s ease-in-out';
                setTimeout(function() {
                    notification.remove();
                }, 500);
            }
        }

        function openLightbox(imgSrc) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = imgSrc;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('flex');
            lightbox.classList.add('hidden');
        }

        // Auto-hide notification after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                closeNotification();
            }, 5000);
        });
    </script>
</body>
</html>