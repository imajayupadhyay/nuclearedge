<template>
    <div class="min-h-screen bg-slate-950 flex flex-col overflow-hidden relative">
        <Head>
            <title>404 - Page Not Found | Nuclear Edge</title>
            <meta name="description" content="The page you're looking for doesn't exist or has been moved." />
            <meta name="robots" content="noindex, nofollow" />
        </Head>

        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Gradient Orbs -->
            <div class="absolute top-1/4 -left-20 w-96 h-96 bg-orange-500/20 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-red-500/20 rounded-full blur-3xl animate-pulse-slow animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-orange-600/10 rounded-full blur-3xl animate-pulse-slow animation-delay-4000"></div>

            <!-- Grid Pattern -->
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:100px_100px]"></div>

            <!-- Floating Particles -->
            <div v-for="i in 20" :key="i"
                class="absolute w-1 h-1 bg-orange-500/30 rounded-full animate-float"
                :style="{
                    left: `${Math.random() * 100}%`,
                    top: `${Math.random() * 100}%`,
                    animationDelay: `${Math.random() * 5}s`,
                    animationDuration: `${3 + Math.random() * 4}s`
                }"
            ></div>
        </div>

        <!-- Header -->
        <header class="relative z-10 p-6">
            <Link href="/" class="inline-block">
                <img
                    src="/images/nuclear-edge-logo.webp"
                    alt="Nuclear Edge"
                    class="h-12 w-auto hover:scale-105 transition-transform duration-300"
                />
            </Link>
        </header>

        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center relative z-10 px-4">
            <div class="text-center max-w-2xl mx-auto">
                <!-- Animated 404 Text -->
                <div class="relative mb-8">
                    <!-- Glitch Effect Background -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-[180px] md:text-[250px] font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500/20 to-red-500/20 select-none animate-glitch-1">
                            404
                        </span>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-[180px] md:text-[250px] font-black text-transparent bg-clip-text bg-gradient-to-r from-red-500/20 to-orange-500/20 select-none animate-glitch-2">
                            404
                        </span>
                    </div>
                    <!-- Main 404 Text -->
                    <h1 class="relative text-[180px] md:text-[250px] font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 bg-[length:200%_auto] animate-gradient leading-none">
                        404
                    </h1>
                </div>

                <!-- Animated Robot/Icon -->
                <div class="mb-8 flex justify-center">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center animate-bounce-slow shadow-2xl shadow-orange-500/30">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <!-- Orbit Ring -->
                        <div class="absolute inset-0 animate-spin-slow">
                            <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-3 h-3 bg-orange-400 rounded-full shadow-lg shadow-orange-400/50"></div>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="space-y-4 mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white animate-fade-in-up">
                        Page Not Found
                    </h2>
                    <p class="text-lg text-white/60 animate-fade-in-up animation-delay-200 max-w-md mx-auto">
                        Oops! The page you're looking for seems to have vanished into the digital void.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up animation-delay-400">
                    <Link
                        href="/"
                        class="group relative px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-orange-500/30 hover:scale-105"
                    >
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Go Home
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </Link>

                    <button
                        @click="goBack"
                        class="group px-8 py-4 bg-white/5 text-white font-semibold rounded-xl border border-white/10 backdrop-blur-sm transition-all duration-300 hover:bg-white/10 hover:border-orange-500/50 hover:scale-105"
                    >
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Go Back
                        </span>
                    </button>
                </div>

                <!-- Helpful Links -->
                <div class="mt-12 pt-8 border-t border-white/10 animate-fade-in-up animation-delay-600">
                    <p class="text-white/40 text-sm mb-4">Or try one of these:</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <Link href="/blog" class="text-orange-400 hover:text-orange-300 transition-colors text-sm font-medium">
                            Browse Blog
                        </Link>
                        <span class="text-white/20">•</span>
                        <Link href="/about" class="text-orange-400 hover:text-orange-300 transition-colors text-sm font-medium">
                            About Us
                        </Link>
                        <span class="text-white/20">•</span>
                        <Link href="/contact" class="text-orange-400 hover:text-orange-300 transition-colors text-sm font-medium">
                            Contact
                        </Link>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="relative z-10 p-6 text-center">
            <p class="text-white/30 text-sm">
                © {{ new Date().getFullYear() }} Nuclear Edge. All rights reserved.
            </p>
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/';
    }
};
</script>

<style scoped>
/* Gradient Animation */
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient {
    animation: gradient 3s ease infinite;
}

/* Pulse Slow */
@keyframes pulse-slow {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.1); }
}

.animate-pulse-slow {
    animation: pulse-slow 4s ease-in-out infinite;
}

/* Bounce Slow */
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.animate-bounce-slow {
    animation: bounce-slow 2s ease-in-out infinite;
}

/* Spin Slow */
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-spin-slow {
    animation: spin-slow 8s linear infinite;
}

/* Float Animation */
@keyframes float {
    0%, 100% { transform: translateY(0) translateX(0); opacity: 0.3; }
    25% { transform: translateY(-20px) translateX(10px); opacity: 0.6; }
    50% { transform: translateY(-40px) translateX(-10px); opacity: 0.3; }
    75% { transform: translateY(-20px) translateX(5px); opacity: 0.6; }
}

.animate-float {
    animation: float 5s ease-in-out infinite;
}

/* Glitch Effect */
@keyframes glitch-1 {
    0%, 100% { transform: translate(0); }
    20% { transform: translate(-3px, 3px); }
    40% { transform: translate(-3px, -3px); }
    60% { transform: translate(3px, 3px); }
    80% { transform: translate(3px, -3px); }
}

@keyframes glitch-2 {
    0%, 100% { transform: translate(0); }
    20% { transform: translate(3px, -3px); }
    40% { transform: translate(3px, 3px); }
    60% { transform: translate(-3px, -3px); }
    80% { transform: translate(-3px, 3px); }
}

.animate-glitch-1 {
    animation: glitch-1 2s ease-in-out infinite;
}

.animate-glitch-2 {
    animation: glitch-2 2s ease-in-out infinite reverse;
}

/* Fade In Up */
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
}

/* Animation Delays */
.animation-delay-200 {
    animation-delay: 0.2s;
    opacity: 0;
}

.animation-delay-400 {
    animation-delay: 0.4s;
    opacity: 0;
}

.animation-delay-600 {
    animation-delay: 0.6s;
    opacity: 0;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
