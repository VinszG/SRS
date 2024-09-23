<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 Multi Auth</title>
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kadwa:wght@700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Itim:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Istok+Web:wght@400;700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
    @vite('resources/css/app.css')
    <style>
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: auto;
            max-width: 90%;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .notification.show {
            opacity: 1;
        }
    </style>
</head>

<body>
    <!-- Popup Notifications -->
    @if ($errors->any())
        <div id="errorNotification" class="notification bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-md mb-4 text-center">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div id="successNotification" class="notification bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('loginSuccess'))
        <div id="loginSuccessNotification" class="notification bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md mb-4 text-center">
            {{ session('loginSuccess') }}
        </div>
    @endif

    <!-- Kontainer utama -->
    <div class="w-full relative bg-[#e1e1e1] overflow-hidden flex flex-row items-start justify-center py-[47px] pl-[24px] pr-[20px] box-border leading-[normal] tracking-[normal]">
        <!-- Konten utama -->
        <main class="w-[1264px] shadow-[10px_10px_10px_rgba(0,_0,_0,_0.25)] rounded-[50px] bg-[#fff] flex flex-row items-start justify-start py-[0px] pl-[115px] pr-[0px] box-border gap-[106px] max-w-full text-left text-[27px] text-[#000] font-[Kadwa] lg:pl-[57px] lg:box-border mq750:gap-[53px] mq450:gap-[26px] mq1050:flex-wrap mq1050:pl-[20px] mq1050:pr-[20px] mq1050:pb-[20px] mq1050:box-border">
            <div class="self-stretch w-[1264px] relative shadow-[10px_10px_10px_rgba(0,_0,_0,_0.25)] rounded-[50px] bg-[#fff] hidden max-w-full"></div>
            <div class="w-[411px] flex flex-col items-start justify-start pt-[115px] px-[0px] pb-[0px] box-border min-w-[411px] max-w-full mq750:pt-[96px] mq750:box-border mq750:min-w-full mq1050:flex-1">
                <div class="self-stretch flex flex-col items-start justify-start gap-[38px] max-w-full mq450:gap-[19px]">
                    {{-- Upper --}}
                    <div class="self-stretch flex flex-col items-center justify-start py-0 pl-3 pr-2 max-w-full">
                        <div class="flex-1 flex flex-col items-center justify-start gap-1.5 max-w-full">
                            <div class="self-stretch flex flex-row items-center justify-center py-0 pl-5 pr-5">
                                <b class="relative text-transparent bg-clip-text bg-gradient-to-r from-[#eb5b00] to-[#ff0000] z-1 text-[40px] mq450:text-[24px] mq1050:text-[30px]">
                                    WELCOME TO
                                </b>                                
                            </div>
                            <div class="relative font-[Itim] z-1 mq450:text-[16px] mq1050:text-[22px] text-center">
                                SERVICE REQUEST SYSTEM
                            </div>
                        </div>
                    </div>
                    
                    <!-- Formulir login -->
                    <form class="self-stretch flex flex-col items-start justify-start gap-5 max-w-full text-[16px] text-[#304463] font-['Open_Sans']"
                        action="{{ route('account.authenticate') }}" method="post">
                        @csrf

                        {{-- Input Container --}}
                        <div class="w-full max-w-md mx-auto space-y-4">
                            {{-- Masukan Email --}}
                            <div class="input-container shadow-md rounded-lg bg-[#e9e7e7] flex flex-col items-start justify-between p-3 transition-all duration-300 ease-in-out hover:shadow-orange-200 hover:scale-105">
                                <div class="flex flex-row items-center justify-between w-full">
                                    <input type="text" value="{{ old('email') }}"
                                        class="flex-1 border-none outline-none bg-transparent h-8 font-['Istok_Web'] text-lg text-orange-500 placeholder-orange-600 @error('email') border-red-500 @enderror"
                                        name="email" id="email" placeholder="Masukan Email Anda">
                                    <img class="h-8 w-8 relative z-10" loading="lazy" alt=""
                                        src="/images/user-check.svg" />
                                </div>
                            </div>

                            {{-- Masukan Password --}}
                            <div class="input-container shadow-md rounded-lg bg-[#e9e7e7] flex flex-col items-start justify-between p-3 transition-all duration-300 ease-in-out hover:shadow-orange-200 hover:scale-105">
                                <div class="flex flex-row items-center justify-between w-full">
                                    <input type="password"
                                        class="flex-1 border-none outline-none bg-transparent h-8 font-['Istok_Web'] text-lg text-orange-600 placeholder-orange-600 @error('password') border-red-600 @enderror"
                                        name="password" id="password" placeholder="Masukan Password Anda">
                                    <img id="togglePassword" class="h-8 w-8 relative z-10 cursor-pointer" alt=""
                                        src="/images/eye-off.svg" />
                                </div>
                            </div>
                        </div>

                        {{-- Signup / Lupa Password --}}
                        <div class="self-stretch flex flex-row items-start justify-start py-0 pl-[13px] pr-0 max-w-full">
                            <div class="flex-1 flex flex-row items-start justify-between max-w-full gap-[20px] mq450:flex-wrap">
                                <a href="{{ route('account.register') }}"
                                    class="relative inline-block min-w-[66px] whitespace-nowrap z-[1]">Sign
                                    Up</a>
                                <a href="/lupaPw" class="relative z-[1]">Lupa Password?</a>
                            </div>
                        </div>

                        {{-- Button Login --}}
                        <button type="submit"
                            class="cursor-pointer border-[#c00f0c] border-[1px] border-solid p-[20px] bg-[#eb5b00] self-stretch shadow-lg rounded-[30px] flex flex-row items-start justify-center gap-[8px] z-[1]">
                            <div class="relative text-[16px] leading-[100%] font-[Inter] text-[#fee9e7] text-left inline-block min-w-[42px]">
                                Login
                            </div>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Side Logo --}}
            <div class="flex-1 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] flex flex-row items-start justify-start bg-[url('/public/images/japfa.jpg')] bg-cover bg-no-repeat bg-[top] min-w-[411px] max-w-full z-[1] text-[22px] text-[rgba(255,255,255,0.8)] font-['Istok_Web'] mq750:min-w-full">
                <div class="h-[657px] flex-1 relative rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-[#eb5b00] overflow-hidden opacity-[0.8] max-w-full z-[2]">
                    <img class="absolute top-[218px] left-[70px] w-[503px] h-[130px] object-cover z-[1]" loading="lazy" alt="" src="/images/tulisanJapfa.png" />
                    <b class="absolute top-[350px] left-[215px] inline-block w-[235px] mq450:text-[18px]">PT. Ciomas Adisatwa</b>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.src = '/images/eye.svg';
            } else {
                passwordField.type = 'password';
                toggleIcon.src = '/images/eye-off.svg';
            }
        });

        // Show and hide notifications
        function showNotification(elementId) {
            const notification = document.getElementById(elementId);
            if (notification) {
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 5000); // Hide after 5 seconds
            }
        }

        // Show notifications on page load
        window.addEventListener('load', () => {
            showNotification('errorNotification');
            showNotification('successNotification');
            showNotification('loginSuccessNotification');
        });
    </script>
</body>
</html>
