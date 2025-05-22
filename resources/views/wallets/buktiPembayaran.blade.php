<!DOCTYPE html>
<html class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/js/dropzonePayment.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-full">
    <x-navbar></x-navbar>
    @php
        $diffInSeconds = max(now()->addMinutes(5)->diffInSeconds(now()), 0);
    @endphp

    {{ gmdate('i:s', $diffInSeconds) }}

    <div class="my-10" x-data="countdownTimer({{ $diffInSeconds }})">
        {{-- <div class="my-10" x-data="countdownTimer(5 * 60)"> --}}
        <div class="border bg-white shadow p-5 rounded-xl px-[70px] py-[40px] mx-auto w-[765px] space-y-10">
            <div class="flex flex-col items-center text-center font-bold">
                <p class=" text-2xl ">Selesaikan pembayaran sebelum</p>
                <div
                    class="text-red-600 bg-gray-200 w-fit px-3 py-2 rounded-xl space-x-1 flex items-center text-2xl my-2">
                    <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p x-text="formattedTime"></p>
                </div>
                <p class=" text-lg">Kirim Bukti Pembayaran Sebelum</p>
                <p class=" text-lg">Rabu 18, September 2024 18.44</p>
            </div>
            <div class="p-3 border border-gray-500 rounded-lg text-lg">
                <div class="flex justify-between items-center">
                    <p class="font-bold">Wallet</p>
                    <img class="h-10 w-auto" src="{{ asset('assets/images/wallet.svg') }}" alt="">
                </div>
                <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
                <div class="flex justify-between items-center">
                    <div class=" space-y-1">
                        <p>Saldo Anda</p>
                        <p class=" font-bold">Rp 1.000.000</p>
                    </div>
                </div>
                <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
                <div class="flex justify-between items-center">
                    <div class=" space-y-1">
                        <p>Total Tagihan</p>
                        <a class="flex items-center space-x-2" href="#">
                            <p class=" font-bold">Rp 705.000</p>
                            <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 0.5H5C2.79086 0.5 1 2.29086 1 4.5V12.5" stroke="#222222"/>
                                <path d="M4.5 9C4.5 7.81558 4.50074 6.96912 4.57435 6.31625C4.64681 5.67346 4.78457 5.28051 5.01662 4.9781C5.14962 4.80477 5.30477 4.64962 5.4781 4.51662C5.78051 4.28457 6.17346 4.14681 6.81625 4.07435C7.46912 4.00074 8.31558 4 9.5 4C10.6844 4 11.5309 4.00074 12.1837 4.07435C12.8265 4.14681 13.2195 4.28457 13.5219 4.51662C13.6952 4.64962 13.8504 4.80477 13.9834 4.9781C14.2154 5.28051 14.3532 5.67346 14.4257 6.31625C14.4993 6.96912 14.5 7.81558 14.5 9V13C14.5 14.1844 14.4993 15.0309 14.4257 15.6837C14.3532 16.3265 14.2154 16.7195 13.9834 17.0219C13.8504 17.1952 13.6952 17.3504 13.5219 17.4834C13.2195 17.7154 12.8265 17.8532 12.1837 17.9257C11.5309 17.9993 10.6844 18 9.5 18C8.31558 18 7.46912 17.9993 6.81625 17.9257C6.17346 17.8532 5.78051 17.7154 5.4781 17.4834C5.30477 17.3504 5.14962 17.1952 5.01662 17.0219C4.78457 16.7195 4.64681 16.3265 4.57435 15.6837C4.50074 15.0309 4.5 14.1844 4.5 13V9Z" stroke="#222222"/>
                            </svg>
                        </a>
                    </div>
                    <a href="/" class="font-semibold">Lihat Detail</a>
                </div>
            </div>
            <button id="upload-button" class="flex items-center justify-center w-full mt-4 px-4 py-2 bg-red-600 font-semibold text-white rounded hover:bg-red-700">Kirim</button>
        </div>
    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script>
        function countdownTimer(duration) {
            return {
                time: duration,
                formattedTime: '',
                init() {
                    this.updateFormattedTime();
                    this.startCountdown();
                },
                startCountdown() {
                    const interval = setInterval(() => {
                        if (this.time > 0) {
                            this.time--;
                            this.updateFormattedTime();
                        } else {
                            clearInterval(interval);
                        }
                    }, 1000);
                },
                updateFormattedTime() {
                    const minutes = Math.floor(this.time / 60);
                    const seconds = this.time % 60;
                    this.formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                }
            };
        }
    </script>
</body>
</html>
