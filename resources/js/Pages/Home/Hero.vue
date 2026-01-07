<template>
    <section class="relative h-screen w-full overflow-hidden bg-slate-900">
        <!-- Background Video -->
        <div class="absolute inset-0 w-full h-full z-0">
            <video
                ref="videoRef"
                autoplay
                muted
                loop
                playsinline
                preload="auto"
                class="w-full h-full object-cover"
                @loadeddata="onVideoLoaded"
                @error="onVideoError"
            >
                <source :src="videoUrl" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
            <!-- Overlay for better text readability -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60 z-10"></div>
        </div>

        <!-- Content Container -->
        <div class="relative z-20 flex items-center justify-center h-full px-4">
            <div class="text-center max-w-5xl mx-auto">
                <!-- Main Headline with Orange-Red Glow Effect & Typewriter -->
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white mb-4 leading-tight">
                    <span class="inline-block">
                        {{ typedText1 }}
                    </span>
                    <br />
                    <span class="inline-block bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 bg-clip-text text-transparent drop-shadow-[0_0_30px_rgba(239,68,68,0.6)]">
                        {{ typedText2 }}<span class="typewriter-cursor">|</span>
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-xl md:text-2xl lg:text-3xl text-white/90 mb-10 font-light tracking-wide">
                    Powerful Ideas, Nuclear Results
                </p>

                <!-- CTA Button with Orange-Red Theme -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <Link
                        href="/about"
                        class="group relative px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full overflow-hidden transition-all duration-300 hover:shadow-[0_0_30px_rgba(239,68,68,0.7)] hover:scale-105"
                    >
                        <span class="relative z-10">Discover Our Story</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </Link>

                    <a
                        href="#services"
                        class="px-8 py-4 border-2 border-slate-300 text-white font-semibold rounded-full backdrop-blur-sm hover:bg-white/10 hover:border-orange-500 transition-all duration-300"
                    >
                        Explore Services
                    </a>
                </div>

                <!-- Scroll Indicator -->
                <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                    <svg
                        class="w-6 h-6 text-orange-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"
                        ></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Atomic/Nuclear Theme Decorative Elements -->
        <div class="absolute top-20 right-20 w-32 h-32 opacity-20 pointer-events-none hidden lg:block z-20">
            <svg viewBox="0 0 200 200" class="text-orange-500 animate-spin-slow">
                <circle cx="100" cy="100" r="80" fill="none" stroke="currentColor" stroke-width="2" opacity="0.3"/>
                <circle cx="100" cy="100" r="60" fill="none" stroke="currentColor" stroke-width="2" opacity="0.5"/>
                <circle cx="100" cy="100" r="40" fill="none" stroke="currentColor" stroke-width="2" opacity="0.7"/>
                <circle cx="100" cy="20" r="8" fill="currentColor"/>
                <circle cx="180" cy="100" r="8" fill="currentColor"/>
                <circle cx="100" cy="180" r="8" fill="currentColor"/>
                <circle cx="20" cy="100" r="8" fill="currentColor"/>
            </svg>
        </div>

        <div class="absolute bottom-20 left-20 w-24 h-24 opacity-20 pointer-events-none hidden lg:block z-20">
            <svg viewBox="0 0 200 200" class="text-red-500 animate-pulse">
                <circle cx="100" cy="100" r="60" fill="none" stroke="currentColor" stroke-width="3" opacity="0.4"/>
                <circle cx="100" cy="100" r="40" fill="none" stroke="currentColor" stroke-width="3" opacity="0.6"/>
                <circle cx="100" cy="100" r="10" fill="currentColor"/>
            </svg>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    videoUrl: {
        type: String,
        default: '/videos/hero-background.mp4'
    }
});

const videoRef = ref(null);
const typedText1 = ref('');
const typedText2 = ref('');

const fullText1 = 'Innovation at the';
const fullText2 = 'Nuclear Edge';

const onVideoLoaded = () => {
    console.log('Video loaded successfully');
};

const onVideoError = (error) => {
    console.error('Video failed to load:', error);
    console.error('Video URL:', props.videoUrl);
};

// Typewriter effect function
const typeWriter = (text, targetRef, speed = 100, delay = 0) => {
    return new Promise((resolve) => {
        setTimeout(() => {
            let i = 0;
            const interval = setInterval(() => {
                if (i < text.length) {
                    targetRef.value += text.charAt(i);
                    i++;
                } else {
                    clearInterval(interval);
                    resolve();
                }
            }, speed);
        }, delay);
    });
};

onMounted(() => {
    // Force video to play in case autoplay is blocked
    if (videoRef.value) {
        videoRef.value.play().catch(err => {
            console.log('Autoplay prevented:', err);
        });
    }

    // Start typewriter effect (faster)
    typeWriter(fullText1, typedText1, 50, 300).then(() => {
        // After first line is done, type the second line
        typeWriter(fullText2, typedText2, 60, 100);
    });
});
</script>

<style scoped>
@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

/* Typewriter cursor blink animation */
@keyframes blink {
    0%, 50% {
        opacity: 1;
    }
    51%, 100% {
        opacity: 0;
    }
}

.typewriter-cursor {
    display: inline-block;
    animation: blink 1s step-end infinite;
    margin-left: 2px;
}
</style>
