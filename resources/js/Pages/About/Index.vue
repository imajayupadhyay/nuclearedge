<template>
    <div class="min-h-screen bg-white">
        <!-- Header -->
        <Header :isTransparent="false" logoUrl="/images/nuclear-edge-logo.webp" />

        <!-- Hero Section -->
        <section class="pt-32 pb-20 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="about-grid" x="0" y="0" width="50" height="50" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1.5" fill="#F97316"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#about-grid)"/>
                </svg>
            </div>

            <!-- Decorative Atoms -->
            <div class="absolute top-20 right-20 w-64 h-64 opacity-10">
                <svg viewBox="0 0 200 200" class="animate-spin-slow" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="100" r="80" stroke="#F97316" stroke-width="1" fill="none"/>
                    <circle cx="100" cy="100" r="60" stroke="#EF4444" stroke-width="1" fill="none"/>
                    <circle cx="100" cy="100" r="40" stroke="#F97316" stroke-width="1" fill="none"/>
                    <circle cx="100" cy="20" r="6" fill="#F97316"/>
                    <circle cx="180" cy="100" r="6" fill="#EF4444"/>
                    <circle cx="100" cy="180" r="6" fill="#F97316"/>
                    <circle cx="20" cy="100" r="6" fill="#EF4444"/>
                </svg>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-4">
                        Who We Are
                    </p>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
                        About
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                            Nuclear Edge
                        </span>
                    </h1>
                    <p class="text-xl text-slate-300 leading-relaxed max-w-3xl mx-auto">
                        Powerful, efficient, and always pushing the limits of innovation
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Intro Section -->
        <section class="py-20 relative overflow-hidden">
            <!-- Background SVG -->
            <div class="absolute inset-0 pointer-events-none opacity-[0.02]">
                <div class="absolute bottom-20 left-10 w-48 h-48">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <rect x="50" y="50" width="100" height="100" stroke="#F97316" stroke-width="1" fill="none" transform="rotate(45 100 100)"/>
                    </svg>
                </div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-5xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6 leading-tight">
                            At Nuclear Edge, we embody the spirit of
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                nuclear energy
                            </span>
                        </h2>
                        <p class="text-xl text-slate-600 leading-relaxed">
                            Powerful, efficient, and always pushing the limits of innovation. The "edge" in our name stands for our commitment to staying ahead, constantly evolving, and delivering cutting-edge solutions to our clients.
                        </p>
                    </div>

                    <!-- Stats -->
                    <div class="grid md:grid-cols-3 gap-8 mt-16">
                        <div class="text-center p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-500/20 transition-all duration-300 group">
                            <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mb-2">
                                1989
                            </div>
                            <p class="text-slate-600 font-medium">Founded in Ambala</p>
                        </div>
                        <div class="text-center p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-500/20 transition-all duration-300 group">
                            <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mb-2">
                                35+
                            </div>
                            <p class="text-slate-600 font-medium">Years of Excellence</p>
                        </div>
                        <div class="text-center p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:border-orange-500/20 transition-all duration-300 group">
                            <div class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mb-2">
                                100+
                            </div>
                            <p class="text-slate-600 font-medium">Businesses Transformed</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Journey Section -->
        <section class="py-20 bg-slate-50 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <!-- Left: Image/Visual -->
                        <div class="relative">
                            <div class="aspect-square rounded-3xl bg-gradient-to-br from-orange-500 to-red-500 p-1">
                                <div class="w-full h-full rounded-3xl bg-slate-900 flex items-center justify-center p-12">
                                    <div class="text-center">
                                        <div class="text-8xl font-bold text-white mb-4">1989</div>
                                        <div class="text-3xl text-orange-500 font-bold mb-2">↓</div>
                                        <div class="text-6xl font-bold text-white">2026</div>
                                        <p class="text-slate-400 mt-6 text-lg">Our Journey</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Content -->
                        <div>
                            <div class="mb-6">
                                <span class="px-4 py-2 bg-orange-500/10 text-orange-600 font-semibold rounded-full text-sm">
                                    Our Journey
                                </span>
                            </div>
                            <h3 class="text-4xl font-bold text-slate-900 mb-6">
                                A Legacy Built on
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                    Trust & Innovation
                                </span>
                            </h3>
                            <div class="space-y-6 text-lg text-slate-600 leading-relaxed">
                                <p>
                                    Our journey began in <strong class="text-slate-900">1989 in Ambala, Haryana</strong>, as one of the oldest family-run businesses in the region. The Goel family's next generation took the reins in 2016, formalizing the venture into what is now known as <strong class="text-slate-900">Nuclear Edge</strong>.
                                </p>
                                <p>
                                    With decades of experience under our belt, we've been consulting and providing tailored solutions to businesses across industries, helping them thrive in a rapidly changing world.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Excellence Section -->
        <section class="py-20 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <!-- Left: Content -->
                        <div class="order-2 lg:order-1">
                            <div class="mb-6">
                                <span class="px-4 py-2 bg-orange-500/10 text-orange-600 font-semibold rounded-full text-sm">
                                    Our Excellence
                                </span>
                            </div>
                            <h3 class="text-4xl font-bold text-slate-900 mb-6">
                                Grounded in Culture,
                                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                    Driven by Results
                                </span>
                            </h3>
                            <div class="space-y-6 text-lg text-slate-600 leading-relaxed">
                                <p>
                                    We pride ourselves on our grounded, sustainable, and <strong class="text-slate-900">'desi Punjabi'</strong> approach. Our clients know us for delivering results with a personal touch, rooted in the culture and values we hold dear.
                                </p>
                                <p>
                                    Over the years, we've helped hundreds of businesses reach new heights, working on the <strong class="text-slate-900">smallest details – the atoms</strong> – to deliver the big picture and the final product.
                                </p>
                            </div>

                            <!-- Feature List -->
                            <div class="mt-8 space-y-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900 mb-1">Personal Touch</h4>
                                        <p class="text-slate-600">Every project gets our undivided attention and care</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900 mb-1">Sustainable Approach</h4>
                                        <p class="text-slate-600">Building solutions that last and grow with you</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900 mb-1">Attention to Detail</h4>
                                        <p class="text-slate-600">From atoms to the big picture</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Image -->
                        <div class="order-1 lg:order-2">
                            <div class="relative">
                                <div class="aspect-square rounded-3xl overflow-hidden">
                                    <img
                                        src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=800&q=80"
                                        alt="Team collaboration"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <!-- Floating Badge -->
                                <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-2xl p-6">
                                    <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                        100+
                                    </div>
                                    <p class="text-slate-600 font-medium">Happy Clients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Section -->
        <section class="py-20 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-5">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="vision-grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1" fill="#F97316"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#vision-grid)"/>
                </svg>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    <div class="mb-8">
                        <span class="px-4 py-2 bg-orange-500/20 text-orange-400 font-semibold rounded-full text-sm">
                            Our Vision
                        </span>
                    </div>
                    <h3 class="text-4xl md:text-5xl font-bold text-white mb-8">
                        Passionate About Your
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                            Success
                        </span>
                    </h3>
                    <p class="text-xl text-slate-300 leading-relaxed mb-12">
                        And while we're serious about helping your business grow, we're also a fun bunch to work with! If you're passionate about business and want a partner that's just as excited as you are about success, let's connect.
                    </p>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a
                            href="#contact"
                            class="group relative px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/50 hover:scale-105"
                        >
                            <span class="relative z-10 flex items-center gap-2">
                                Join the Nuclear Edge Family
                                <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </a>

                        <Link
                            href="/blog"
                            class="px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-full backdrop-blur-sm hover:bg-white/10 hover:border-orange-400 transition-all duration-300"
                        >
                            Read Our Stories
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';
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
    animation: spin-slow 30s linear infinite;
}
</style>
