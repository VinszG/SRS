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
                <i class="fas fa-list mr-3"></i> 
                <span class="flex-grow text-center">Request Non-Urgent</span>
            </a>
            <!-- Sidebar content lainnya -->
        </div>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <!-- Header content -->
        </header>

        <!-- Content -->
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold pb-4">
                        <i class="fas fa-clipboard-list mr-3 text-blue-500"></i> Detail Request
                    </h2>
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-600 mb-2">No. BPJ</p>
                                <p class="font-semibold">{{ $request->bpj_number }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-2">Name</p>
                                <p class="font-semibold">{{ $request->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-2">Departemen</p>
                                <p class="font-semibold">{{ $request->departemen }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-2">Jabatan</p>
                                <p class="font-semibold">{{ $request->jabatan }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-600 mb-2">Deskripsi Permasalahan</p>
                                <p class="font-semibold">{{ $request->deskripsi_permasalahan }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-2">Status</p>
                                <span class="px-2 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-gray-600 mb-2">Request Date</p>
                                <p class="font-semibold">{{ $request->request_date }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-600 mb-2">Bukti Foto</p>
                                @if($request->bukti_foto)
                                    <img src="{{ asset('storage/' . $request->bukti_foto) }}" 
                                         alt="Bukti Foto" 
                                         class="max-w-md rounded-lg shadow">
                                @else
                                    <p class="text-gray-500">Tidak ada foto</p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-8 flex space-x-4">
                            <form action="{{ route('plant.requests.updateStatus', $request) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="accept">
                                <button type="submit" 
                                        class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                                    Accept
                                </button>
                            </form>

                            <form action="{{ route('plant.requests.updateStatus', $request) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="reject">
                                <button type="submit" 
                                        class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">
                                    Reject
                                </button>
                            </form>

                            <a href="{{ route('plant.requests.index') }}" 
                            class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                            Back
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<script>
    // Notification handling
    function closeNotification() {
        var notification = document.getElementById('notification');
        if (notification) {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.5s ease-in-out';
            setTimeout(function() {
                notification.remove();
            }, 500);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            closeNotification();
        }, 5000);
    });
</script>
</body>
</html>
0 text-white px-6
