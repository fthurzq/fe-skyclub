@extends('layouts.master')
@section('content')
    <div class="flex justify-center min-h-full w-screen px-16 my-12" x-data="withdrawHandler()">
        {{-- <div class="min-h-full my-12"> --}}
        <div class="w-2/4">
            <h2 class=" font-bold text-3xl mb-4">Detail Withdraw</h2>
            <h4 class=" font-bold text-2xl mb-5" x-text="$store.user.data.name"></h4>
            <hr class="h-px my-4 bg-gray-400 border-0 ">
            <div x-data="{ dropDown: 'down' }">
                <div class="flex justify-between items-center mb-4">
                    <h5 class=" font-bold text-2xl">Masukkan Data</h5>
                    <svg x-show="dropDown == 'up'" @click="dropDown='down'" class="w-6 h-6 text-gray-800 justify-center"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 15 7-7 7 7" />
                    </svg>
                    <svg x-show="dropDown == 'down'" @click="dropDown='up'" class="w-6 h-6 text-gray-800 justify-center"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </div>
                <div x-show="dropDown == 'down'">
                    <form @submit.prevent="submitWithdraw">
                        <div class="shadow bg-white rounded-lg p-2.5 text-base mb-2">
                            <label for="bank_name" class="block mb-2 text-sm font-medium text-gray-900">Nama Bank</label>
                            <input type="text" id="bank_name" x-model="bank_name"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5"
                                placeholder="Nama Bank" required />
                        </div>
                        <div class="shadow bg-white rounded-lg items-center p-2.5 text-base mb-2" x-data="{ verify: false }">
                            <label for="rekening" class="block mb-2 text-sm font-medium text-gray-900">No. Rekening</label>
                            <div class="flex space-x-2">
                                <input type="number" id="rekening" x-model="rekening"
                                    class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5"
                                    placeholder="No. Rekening" required />
                                <button type="button"
                                    class="rounded-lg bg-green-500 text-white font-semibold text-sm py-1 px-3"
                                    @click="rekening ? verify = true : ''">Verify</button>
                            </div>
                            <p x-show="verify" class="text-green-500">Nomor Valid</p>
                        </div>
                        <div class="shadow bg-white rounded-lg items-center p-2.5 text-base mb-2">
                            <label for="nominal" class="block mb-2 text-sm font-medium text-gray-900">Nominal
                                Withdraw</label>
                            <input type="number" id="nominal" x-model="nominal"
                                class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5"
                                placeholder="Masukkan Nominal Rupiah" required />
                        </div>
                        <button type="submit"
                            class="rounded-lg bg-red-600 text-white font-semibold text-sm py-1 px-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script>
        function withdrawHandler() {
            return {
                bank_name: '',
                rekening: '',
                nominal: '',
                async submitWithdraw() {
                    try {
                        const response = await axios.post('/wallet/withdraw', {
                            bank_ewallet: this.bank_name,
                            number: this.rekening,
                            amount: this.nominal
                        });
                        await Alpine.store('user').refreshLocalStorage();
                        // Beri notifikasi sukses, redirect, atau reset form sesuai kebutuhan
                        window.location.href = '/wallet';
                    } catch (error) {
                        // Tampilkan pesan error
                        alert('Withdraw gagal: ' + (error.response?.data?.message || error.message));
                    }
                }
            };
        }
    </script>
@endsection
