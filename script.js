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
