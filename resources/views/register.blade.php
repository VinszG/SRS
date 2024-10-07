<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 11 Multi Auth</title>
        <link rel="stylesheet" href="./global.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Serif:wght@500&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kadwa:wght@700&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Istok+Web:wght@400;700&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&display=swap" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="w-full relative bg-[#e1e1e1] overflow-hidden flex flex-row items-start justify-center py-[47px] pl-[24px] pr-[20px] box-border leading-[normal] tracking-[normal]">
            <main class="w-[1264px] h-[655px] shadow-[10px_10px_10px_rgba(0,_0,_0,_0.25)] rounded-[50px] bg-[#fff] flex flex-row items-start justify-start py-[0px] pl-[1px] pr-[0px] box-border relative gap-[87px] max-w-full text-left text-[25px] text-[rgba(255,255,255,0.8)] font-['Istok_Web'] mq725:gap-[43px] mq450:gap-[22px] mq1050:flex-wrap mq1050:pl-[20px] mq1050:pr-[20px] mq1050:pb-[20px] mq1050:box-border">
                <div class="self-stretch w-[1264px] relative shadow-[10px_10px_10px_rgba(0,_0,_0,_0.25)] rounded-[50px] bg-[#fff] hidden max-w-full z-[0]"></div>
                    <div class="w-[513px] flex flex-col items-start justify-start pt-[37px] px-[0px] pb-[0px] box-border min-w-[513px] max-w-full mq725:min-w-full mq1050:flex-1">
                        
                                <form class="m-[0px] self-stretch flex flex-col items-start justify-start gap-[26px] max-w-full" action="{{ route('processRegister') }}" method="post">
                                    
                                    <div class="flex flex-row items-start justify-start gap-[46px] pl-[20px] max-w-full mq725:flex-wrap mq450:gap-[23px]">
                                        <a href="{{ route('account.login') }}" class="cursor-pointer [border:none] py-[8px] pl-[15px] pr-[11px] bg-[#eb5b00] shadow-[4px_4px_4px_rgba(0,_0,_0,_0.25)] rounded-[20px] flex flex-row items-start justify-start z-[1] link-secondary text-decoration-none">
                                            <div class="h-[15px] relative text-[18px] font-medium font-['Roboto_Serif'] text-[#fff] text-left inline-block [text-shadow:0px_4px_4px_rgba(0,_0,_0,_0.25)] min-w-[53px] z-[2]">Back</div>
                                            <img class="h-[21px] w-[24px] relative overflow-hidden shrink-0 z-[1]" alt="" src="/images/skip-back.svg" />
                                        </a>
                                     </div>
                                    
                                    <div class="self-stretch flex flex-row items-start justify-end">
                                        <h3 class="m-[0px] relative text-[30px] font-bold font-[Kadwa] text-transparent !bg-clip-text [background:linear-gradient(90deg,_#eb5b00,_#ff0000)] [-webkit-background-clip:text] [-webkit-text-fill-color:transparent] text-left z-[1] mq450:text-[18px] mq1000:text-[24px]">
                                            Ayo Buat Akun Kamu Sendiri
                                        </h3>
                                    </div>

                                    @csrf
                                    
                                    {{-- Masukan Nama --}}
                                    <div class="self-stretch flex flex-row items-start justify-end pt-[0px] px-[16px] pb-[8px] box-border max-w-full">
                                        <div class="w-[429px] shadow-md rounded-lg bg-[#e9e7e7] flex flex-row items-center justify-between py-[10px] pl-[18px] pr-[12px] box-border gap-[10px] max-w-full z-[1] transition-all duration-300 ease-in-out hover:shadow-orange-200 hover:scale-105">
                                            <input type="text" value="{{ old('name') }}"
                                            w    class="w-full border-none outline-none font-['Istok_Web'] text-lg bg-transparent h-8 text-orange-500 placeholder-orange-600 z-[1] mq450:text-[16px] form-control @error('name') border-red-500 @enderror"
                                                name="name" id="name" placeholder="Masukan Nama Anda" autocomplete="off" autofocus>
                                            <div class="flex flex-col items-center justify-center">
                                                <img class="w-[25px] h-[25px] relative z-[2]" alt="" src="/images/user.svg" />
                                            </div>
                                            @error('name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Masukan Email --}}
                                    <div class="self-stretch flex flex-row items-start justify-end pt-[0px] px-[16px] pb-[8px] box-border max-w-full">
                                        <div class="w-[429px] shadow-md rounded-lg bg-[#e9e7e7] flex flex-row items-center justify-between py-[10px] pl-[18px] pr-[12px] box-border gap-[10px] max-w-full z-[1] transition-all duration-300 ease-in-out hover:shadow-orange-200 hover:scale-105">
                                            <input type="text" value="{{ old('email') }}"
                                                class="w-full border-none outline-none font-['Istok_Web'] text-lg bg-transparent h-8 text-orange-500 placeholder-orange-600 z-[1] mq450:text-[16px] form-control @error('email') border-red-500 @enderror"
                                                name="email" id="email" placeholder="Masukan Email Anda" autocomplete="off" autofocus>
                                            <div class="flex flex-col items-center justify-center">
                                                <img class="w-[25px] h-[25px] relative z-[2]" alt="" src="/images/user-check.svg" />
                                            </div>
                                            @error('email')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Masukan Password --}}
                                    <div class="self-stretch flex flex-row items-start justify-end pt-[0px] px-[16px] pb-[8px] box-border max-w-full">
                                        <div class="w-[429px] shadow-md rounded-lg bg-[#e9e7e7] flex flex-row items-center justify-between py-[10px] pl-[18px] pr-[12px] box-border gap-[10px] max-w-full z-[1] transition-all duration-300 ease-in-out hover:shadow-orange-200 hover:scale-105">
                                            <input type="password"
                                                class="w-full border-none outline-none font-['Istok_Web'] text-lg bg-transparent h-8 text-orange-500 placeholder-orange-600 z-[1] mq450:text-[16px] form-control @error('password') border-red-500 @enderror"
                                                name="password" id="password" placeholder="Masukan Password Anda" autocomplete="off">
                                            <div class="flex flex-col items-center justify-center">
                                                <img id="togglePassword" class="w-[25px] h-[25px] relative z-[2] cursor-pointer" alt="" src="/images/eye-off.svg" />
                                            </div>
                                            @error('password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Konfirmasi Password --}}
                                    <div class="self-stretch flex flex-row items-start justify-end pt-[0px] px-[16px] pb-[8px] box-border max-w-full">
                                        <div class="w-[429px] shadow-md rounded-lg bg-[#e9e7e7] flex flex-row items-center justify-between py-[10px] pl-[18px] pr-[12px] box-border gap-[10px] max-w-full z-[1] transition-all duration-300 ease-in-out hover:shadow-orange-200 hover:scale-105">
                                            <input type="password"
                                                class="w-full border-none outline-none font-['Istok_Web'] text-lg bg-transparent h-8 text-orange-500 placeholder-orange-600 z-[1] mq450:text-[16px] form-control"
                                                name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" autocomplete="off">
                                            <div class="flex flex-col items-center justify-center">
                                                <img id="toggleConfirmPassword" class="w-[25px] h-[25px] relative z-[2] cursor-pointer" alt="" src="/images/eye-off.svg" />
                                            </div>
                                        </div>
                                    </div>

                                        <div class="self-stretch flex flex-row items-start justify-end py-[0px] px-[16px] box-border max-w-full">
                                            <div class="w-[429px] flex flex-col items-start justify-start gap-[17px] max-w-full">
                                                <button class="cursor-pointer border-[#c00f0c] border-[1px] border-solid p-[20px] bg-[#eb5b00] self-stretch shadow-[4px_4px_4px_1px_rgba(0,_0,_0,_0.25)] rounded-[30px] overflow-hidden flex flex-row items-start justify-center gap-[8px] z-[1]" type="submit">
                                                    <img class="h-[16px] w-[16px] relative overflow-hidden shrink-0 hidden min-h-[16px]" alt="" src="/public/star.svg" />
                                                    <div class="relative text-[16px] leading-[100%] font-[Inter] text-[#fee9e7] text-left inline-block min-w-[40px]">Kirim</div>
                                                </button>
                                            </div>
                                        </div>

                                </form>

                            </div>

                            <div class="flex-1 h-[655px] rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] flex flex-row items-start justify-start bg-[url('/public/images/japfa.jpg')] bg-cover bg-no-repeat bg-[top] min-w-[411px] max-w-full z-[1] text-[25px] text-[rgba(255,255,255,0.8)] font-['Istok_Web'] mq750:min-w-full">
                                <div class="h-[655px] flex-1 relative rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-[#eb5b00] overflow-hidden opacity-[0.8] max-w-full z-[2]">
                                    <b class="absolute top-[386px] left-[196px] inline-block w-[261px] mq450:text-[20px]">PT. Ciomas Adisatwa</b>
                                    <img class="absolute top-[243px] left-[36px] w-[559px] h-[162px] object-cover z-[1]" loading="lazy" alt="" src="/images/tulisanJapfa.png" />
                                </div>
                            </div>
                            
                        </main>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                        const togglePassword = document.getElementById('togglePassword');
                        const password = document.getElementById('password');
                        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
                        const confirmPassword = document.getElementById('password_confirmation');  // Ubah ini

                        togglePassword.addEventListener('click', function () {
                            const type = password.type === 'password' ? 'text' : 'password';
                            password.type = type;
                            togglePassword.src = type === 'password' ? '/images/eye-off.svg' : '/images/eye.svg';
                        });

                        toggleConfirmPassword.addEventListener('click', function () {
                            const type = confirmPassword.type === 'password' ? 'text' : 'password';
                            confirmPassword.type = type;
                            toggleConfirmPassword.src = type === 'password' ? '/images/eye-off.svg' : '/images/eye.svg';
                        });
                    });

                    </script>
    </body>
</html>