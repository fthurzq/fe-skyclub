<div x-data="{ activeSlide: 0, slides: ['{{ asset('assets/images/slider/album_1.svg') }}', '{{ asset('assets/images/slider/album_2.svg') }}', '{{ asset('assets/images/slider/album_3.svg') }}'] }" x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)"
    class="relative w-2/5 min-h-[800px] bg-cover overflow-hidden container hidden lg:block :">
    {{-- <img src="{{ asset('assets/images/album_1.svg') }}" alt=""> --}}
    <p class="text-3xl" x-text="activeSlide"></p>
    <img :src="slides[0]" x-show="activeSlide === 0" alt="">

    <!-- Carousel Slide -->
    <div class="items-stretch bg-cover rounded-xl overflow-hidden w-full h-full">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" class="absolute inset-0">
                <img :src="slide"
                    x-transition:enter="transform transition-transform duration-700 ease-in-out"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition-transform duration-700 ease-in-out"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    class=" rounded-3xl w-full h-full object-cover" alt="" />
            </div>
        </template>
    </div>

    <!-- Indicators -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <div :class="{ 'bg-red-600 w-6': activeSlide === index, 'bg-gray-400': activeSlide !== index }"
                class="w-3 h-3 rounded-full"></div>
        </template>
    </div>
</div>
