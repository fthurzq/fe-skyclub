<!DOCTYPE html>
<html class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="h-full">
    <x-navbar></x-navbar>

    <div class="flex justify-center min-h-full w-screen px-16 my-12">
        {{-- <div class="min-h-full my-12"> --}}
        <div class="w-2/4">
                <h2 class=" font-bold text-3xl mb-4">Detail Transfer</h2>
                <h4 class=" font-bold text-2xl mb-5">{{ auth()->user()->name }}</h4>
                <hr class="h-px my-4 bg-gray-400 border-0 dark:bg-gray-700">
                <div x-data="{ dropDown: 'up' }">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class=" font-bold text-2xl">Masukkan Data</h5>
                        <svg x-show="dropDown == 'up'" @click="dropDown='down'"
                            class="w-6 h-6 text-gray-800 justify-center dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m5 15 7-7 7 7" />
                        </svg>
                        <svg x-show="dropDown == 'down'" @click="dropDown='up'"
                            class="w-6 h-6 text-gray-800 justify-center dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </div>
                    <div x-show="dropDown == 'down'" {{-- <div x-show="true" --}}>
                        <form action="">
                            <div class="shadow bg-white rounded-lg p-2.5 text-base mb-2">
                                <label for="bank_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Bank</label>
                                <input type="text" id="bank_name" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Nama Bank" required />
                            </div>
                            <div class="shadow bg-white rounded-lg items-center p-2.5 text-base mb-2">
                                <label for="rekening" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Rekening</label>
                                <div class="flex space-x-2">
                                    <input type="text" id="rekening" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="No. Rekening" required />
                                    <button class="rounded-lg bg-green-500 text-white font-semibold text-sm py-1 px-3">Verify</button>
                                </div>
                            </div>
                            <div class="shadow bg-white rounded-lg items-center p-2.5 text-base mb-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Penerima</label>
                                <input type="text" id="name" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Nama Penerima" required />
                            </div>
                            <div class="shadow bg-white rounded-lg items-center p-2.5 text-base mb-2">
                                <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal Top Up</label>
                                <input type="text" id="nominal" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Masukkan Nominal Rupiah" required />
                            </div>
                            <button class="rounded-lg bg-red-600 text-white font-semibold text-sm py-1 px-3">Submit</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
    {{-- @endsection --}}

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>