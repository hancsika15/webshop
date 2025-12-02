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

            <script>
                function heroSlider() {
                    return {
                        currentSlide: 0,
                        autoplay: true,
                        interval: null,
                        slides: [{
                                title: "Objavte nové obzory",
                                description: "Cestovateľské zážitky, ktoré vám zmenia život",
                                buttonText: "Rezervovať",
                                buttonUrl: "#",
                                image: "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80"
                            },
                            {
                                title: "Prírodné krásy",
                                description: "Nádherné výhľady a čistá príroda",
                                buttonText: "Pozrieť ponuku",
                                buttonUrl: "#",
                                image: "https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80"
                            },
                            {
                                title: "Mestské dobrodružstvo",
                                description: "Moderné mestá plné života a kultúry",
                                buttonText: "Viac informácií",
                                buttonUrl: "#",
                                image: "https://images.unsplash.com/photo-1487958449943-2429e8be8625?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80"
                            }
                        ],
                        init() {
                            this.startAutoplay();
                        },
                        next() {
                            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                        },
                        prev() {
                            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                        },
                        goTo(index) {
                            this.currentSlide = index;
                        },
                        startAutoplay() {
                            this.interval = setInterval(() => {
                                if (this.autoplay) {
                                    this.next();
                                }
                            }, 5000);
                        },
                        replaceBrokenImage(event) {
                            // Fallback obrázky z iného zdroja
                            const fallbacks = [
                                'https://picsum.photos/id/1018/1920/1080',
                                'https://picsum.photos/id/1015/1920/1080',
                                'https://picsum.photos/id/1019/1920/1080'
                            ];
                            event.target.src = fallbacks[this.currentSlide % fallbacks.length];
                        }
                    }
                }
            </script>
    </header>
    <!-- Tartalom -->

    <?php include("footer.html") ?>

</body>

</html>