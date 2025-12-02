<?php include("head.html") ?>

<body class="bg-[#111111]">
    <?php include("navbar.html") ?>

    <header>
            <div x-data="heroSlider()" class="relative overflow-hidden" @mouseenter="autoplay = false" @mouseleave="autoplay = true">
                <div class="relative h-[80vh] min-h-[500px]">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div
                            x-show="currentSlide === index"
                            x-transition.opacity.duration.800ms
                            class="absolute inset-0">
                            <div class="absolute inset-0 bg-gray-800">
                                <img
                                    :src="slide.image"
                                    :alt="slide.title"
                                    class="w-full h-full object-cover opacity-80"
                                    @error="replaceBrokenImage($event)"
                                    loading="lazy">
                            </div>

                            <div class="container mx-auto px-6 h-full flex items-center">
                                <div
                                    class="max-w-2xl text-white slide-content"
                                    :class="{
                                'translate-x-0 opacity-100': currentSlide === index,
                                'translate-x-10 opacity-0': currentSlide !== index
                            }">
                                    <h2 x-text="slide.title" class="text-4xl md:text-5xl font-bold mb-4"></h2>
                                    <p x-text="slide.description" class="text-xl md:text-2xl mb-8"></p>
                                    <a
                                        :href="slide.buttonUrl"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors fade-in"
                                        x-text="slide.buttonText"></a>
                                </div>
                            </div>
                        </div>
                    </template>

                    <button
                        @click="prev()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-10 h-10 md:w-12 md:h-12 flex items-center justify-center z-10 transition-all"
                        aria-label="Previous slide">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        @click="next()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-10 h-10 md:w-12 md:h-12 flex items-center justify-center z-10 transition-all"
                        aria-label="Next slide">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
                        <template x-for="(slide, index) in slides" :key="index">
                            <button
                                @click="goTo(index)"
                                class="w-2 h-2 md:w-3 md:h-3 rounded-full transition-all"
                                :class="{
                            'bg-white w-4 md:w-6': currentSlide === index,
                            'bg-white/50': currentSlide !== index
                        }"
                                :aria-label="`Go to slide ${index + 1}`"></button>
                        </template>
                    </div>
                </div>
            </div>
    </header>
    <main>
        
    </main>

    <?php include("footer.html") ?>

    <script src="script.js"></script>

</body>

</html>