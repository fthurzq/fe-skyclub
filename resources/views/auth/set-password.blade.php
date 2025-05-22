@extends('layouts.auth')
@section('content')
    {{-- form set password --}}
    <div x-data="resetPasswordFormHandler()" class=" w-[512px]">
        <img class="mb-9" src="{{ asset('assets/images/icon_auth.svg') }}" alt="">
        <div class=" space-y-4 mb-12">
            <a href="/login" class="flex space-x-1">
                <img src="{{ asset('assets/icons/arrow_left.svg') }}" alt=""><span>Back to login</span>
            </a>
            <h4 class="text-4xl font-bold">Set a password</h4>
            <p class="text-base">Your previous password has been reseted. Please set a new password for your
                account.</p>

            {{-- alert --}}
            <div id="alert"
                class="hidden items-center p-4 mb-4 rounded-lg"
                :class="{'text-blue-800 bg-blue-50': !isError, 'text-red-800 bg-red-50': isError}"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div id="alert-message" class="ms-3 text-sm font-medium"></div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8"
                    :class="{'bg-blue-50 text-blue-500 hover:bg-blue-200 focus:ring-blue-400': !isError, 'bg-red-50 text-red-500 hover:bg-red-200 focus:ring-red-400': isError}"
                    onclick="hideAlert()" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            {{-- @if (session()->has('success_set_password'))
                <div id="alert-3"
                    class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session()->get('success_set_password') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            @error('password')
                <div id="alert-2"
                    class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ $message }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @enderror
        </div> --}}

            <form id="setPasswordForm" @submit.prevent="submitForm" method="POST">
                <input type="hidden" name="email" value="{{ request()->query('email') }}">
                <input type="hidden" name="token" :value="token" id="resetToken">
                
                <div class="space-y-6 mb-8">
                    <div x-data="{ showPassword: false }" class="relative">
                        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder=""
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                            required />
                        <label for="password"
                            class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 start-1">Create Password</label>
                        <span 
                            class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer"
                            @click="showPassword = !showPassword">
                            <img x-show="!showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye-off.svg') }}" alt="">
                            <img x-show="showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye.svg') }}" alt="">
                        </span>
                    </div>
                    <div x-data="{ showPassword: false }" class="relative">
                        <input :type="showPassword ? 'text' : 'password'" name="password_confirmation" placeholder=""
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            required />
                        <label for="password_confirmation"
                            class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 start-1">Re-enter Password</label>
                        <span 
                            class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer"
                            @click="showPassword = !showPassword">
                            <img x-show="!showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye-off.svg') }}" alt="">
                            <img x-show="showPassword" class="mx-auto" src="{{ asset('assets/icons/password-eye.svg') }}" alt="">
                        </span>
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="flex justify-center items-center bg-red-600 hover:bg-red-700 space-x-3 rounded py-2 font-semibold text-white w-full">
                    <div x-show="isLoading">
                        <img src="{{ asset('assets/icons/loading.gif') }}" width="20" alt="">
                    </div>
                    <span>Submit</span>
                </button>
            </form>
        </div>

        <div class="flex items-center mt-10">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="px-4 text-gray-400">atau masuk dengan</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>
        <div class="flex mt-10 space-x-4 ">
            <div class=" border w-full py-4 border-black">
                <img class="mx-auto" src="{{ asset('assets/icons/facebook.svg') }}" alt="">
            </div>
            <div class=" border w-full py-4 border-black">
                <img class="mx-auto" src="{{ asset('assets/icons/google.svg') }}" alt="">
            </div>
            <div class=" border w-full py-4 border-black">
                <img class="mx-auto" src="{{ asset('assets/icons/apple.svg') }}" alt="">
            </div>
        </div>
    </div>
    {{-- carousel --}}
    <x-auth-carousel />
@endsection

@push('scripts')
<script>
    function resetPasswordFormHandler() {
        return {
            isLoading: false,
            errors: {},
            isError: false,
            token: new URLSearchParams(window.location.search).get('token'),
            email: new URLSearchParams(window.location.search).get('email'),
            init() {
                this.isError = false;
            },
            async submitForm() {
                this.isLoading = true;
                this.errors = {};
                
                try {
                    const formData = new FormData(document.getElementById('setPasswordForm'));
                    const data = Object.fromEntries(formData.entries());

                    const response = await axios.post('http://127.0.0.1:8000/api/users/reset-password', data, {
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    });

                    if (response.status === 200) {
                        const alert = document.getElementById('alert');
                        const alertMessage = document.getElementById('alert-message');
                        this.isError = false;
                        alert.classList.remove('hidden');
                        alert.classList.add('flex');
                        alertMessage.innerText = response.data.message || 'Password berhasil dirubah.';

                        setTimeout(() => {
                            window.location.href = `/users/login`;
                        }, 2000);
                    }
                } catch (error) {
                    const alert = document.getElementById('alert');
                    const alertMessage = document.getElementById('alert-message');
                    
                    if (error.response) {
                        // Handle semua jenis error response
                        let errorMessage = '';
                        
                        // Untuk error 400 - ambil dari errors.message
                        if (error.response.status === 400) {
                            errorMessage = error.response.data.errors?.message || 
                                         error.response.data.message || 
                                         'Token is invalid or axpired.';
                        } 
                        // Untuk error 403/422 - ambil langsung dari message
                        else if (error.response.status === 403 || error.response.status === 422) {
                            errorMessage = error.response.data.message || 
                                         'Terjadi kesalahan pada proses verifikasi';
                        }
                        // Untuk error lainnya
                        else {
                            errorMessage = error.response.data.message || 
                                         'Terjadi kesalahan. Silakan coba lagi.';
                        }
                        
                        // Tampilkan alert error
                        alert.classList.remove('hidden');
                        alert.classList.add('flex');
                        alertMessage.innerText = errorMessage;
                        this.isError = true;
                        
                        // Jika ada error validasi field (422), tampilkan di field yang sesuai
                        if (error.response.status === 422 && error.response.data.errors) {
                            this.errors = error.response.data.errors;
                        }
                    } else {
                        // Handle network error
                        alert.classList.remove('hidden');
                        alert.classList.add('flex');
                        alertMessage.innerText = 'Koneksi bermasalah. Silakan cek koneksi internet Anda.';
                        this.isError = true;
                    }
                } finally {
                    this.isLoading = false;
                }
            }
        }
    }

    function hideAlert() {
        const alert = document.getElementById('alert');
        alert.classList.add('hidden');
    }
</script>
@endpush