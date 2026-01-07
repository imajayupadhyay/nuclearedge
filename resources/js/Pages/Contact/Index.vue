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
                        <pattern id="contact-grid" x="0" y="0" width="50" height="50" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1.5" fill="#F97316"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#contact-grid)"/>
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
                        Get in Touch
                    </p>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6">
                        Contact
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                            Nuclear Edge
                        </span>
                    </h1>
                    <p class="text-xl text-slate-300 leading-relaxed max-w-3xl mx-auto">
                        Let's discuss how we can help transform your business
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Info Section -->
        <section class="py-20 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid md:grid-cols-3 gap-8 mb-16">
                        <!-- Email -->
                        <div class="text-center p-8 bg-white rounded-3xl border-2 border-slate-100 hover:border-orange-500/30 transition-all duration-300 group hover:shadow-xl hover:shadow-orange-500/10">
                            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Email Address</h3>
                            <a href="mailto:connect.nuclearedge@gmail.com" class="text-slate-600 hover:text-orange-500 transition-colors duration-300 block mb-2">
                                connect.nuclearedge@gmail.com
                            </a>
                            <a href="tel:+919315946467" class="text-slate-600 hover:text-orange-500 transition-colors duration-300 block">
                                +91 9315946467
                            </a>
                        </div>

                        <!-- Office Address -->
                        <div class="text-center p-8 bg-white rounded-3xl border-2 border-slate-100 hover:border-orange-500/30 transition-all duration-300 group hover:shadow-xl hover:shadow-orange-500/10">
                            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Office Address</h3>
                            <p class="text-slate-600 leading-relaxed">
                                1195 Salarpuriya IndiraNagar<br/>
                                Bangalore 560038
                            </p>
                        </div>

                        <!-- Phone Number -->
                        <div class="text-center p-8 bg-white rounded-3xl border-2 border-slate-100 hover:border-orange-500/30 transition-all duration-300 group hover:shadow-xl hover:shadow-orange-500/10">
                            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3">Phone Number</h3>
                            <a href="tel:+919315946467" class="text-slate-600 hover:text-orange-500 transition-colors duration-300 text-lg font-semibold">
                                +91 9315946467
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form & Map Section -->
        <section class="py-20 bg-slate-50 relative overflow-hidden">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid lg:grid-cols-2 gap-12">
                        <!-- Contact Form -->
                        <div>
                            <div class="mb-8">
                                <h2 class="text-4xl font-bold text-slate-900 mb-4">
                                    Drop Us a
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                        Line
                                    </span>
                                </h2>
                                <p class="text-slate-600">
                                    Your email address will not be published. Required fields are marked *
                                </p>
                            </div>

                            <form @submit.prevent="submitForm" class="space-y-6">
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-slate-900 mb-2">
                                        Enter your name <span class="text-orange-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="name"
                                        v-model="form.name"
                                        required
                                        class="w-full px-6 py-4 bg-white border-2 border-slate-200 rounded-2xl text-slate-900 placeholder:text-slate-400 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300"
                                        placeholder="John Doe"
                                    />
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-slate-900 mb-2">
                                        Enter your mail <span class="text-orange-500">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        id="email"
                                        v-model="form.email"
                                        required
                                        class="w-full px-6 py-4 bg-white border-2 border-slate-200 rounded-2xl text-slate-900 placeholder:text-slate-400 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300"
                                        placeholder="john@example.com"
                                    />
                                </div>

                                <!-- Services Field -->
                                <div>
                                    <label for="services" class="block text-sm font-semibold text-slate-900 mb-2">
                                        Services <span class="text-orange-500">*</span>
                                    </label>
                                    <select
                                        id="services"
                                        v-model="form.services"
                                        required
                                        class="w-full px-6 py-4 bg-white border-2 border-slate-200 rounded-2xl text-slate-900 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300"
                                    >
                                        <option value="" disabled>Select a service</option>
                                        <option value="Business Consulting">Business Consulting</option>
                                        <option value="Digital Transformation">Digital Transformation</option>
                                        <option value="Technology Solutions">Technology Solutions</option>
                                        <option value="Strategy & Planning">Strategy & Planning</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <!-- Phone Number Field -->
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-slate-900 mb-2">
                                        Enter Phone Number <span class="text-orange-500">*</span>
                                    </label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        v-model="form.phone"
                                        required
                                        class="w-full px-6 py-4 bg-white border-2 border-slate-200 rounded-2xl text-slate-900 placeholder:text-slate-400 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300"
                                        placeholder="+91 9876543210"
                                    />
                                </div>

                                <!-- Message Field -->
                                <div>
                                    <label for="message" class="block text-sm font-semibold text-slate-900 mb-2">
                                        Enter your Message <span class="text-orange-500">*</span>
                                    </label>
                                    <textarea
                                        id="message"
                                        v-model="form.message"
                                        required
                                        rows="5"
                                        class="w-full px-6 py-4 bg-white border-2 border-slate-200 rounded-2xl text-slate-900 placeholder:text-slate-400 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 resize-none"
                                        placeholder="Tell us about your project..."
                                    ></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button
                                    type="submit"
                                    class="group relative w-full px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-orange-500/50 hover:scale-[1.02]"
                                >
                                    <span class="relative z-10 flex items-center justify-center gap-2">
                                        Submit Now
                                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </button>
                            </form>
                        </div>

                        <!-- Google Map -->
                        <div>
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold text-slate-900 mb-2">
                                    Find Us on
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">
                                        Map
                                    </span>
                                </h3>
                                <p class="text-slate-600">Visit our office in Bangalore</p>
                            </div>

                            <!-- Map Container -->
                            <div class="relative rounded-3xl overflow-hidden shadow-2xl border-2 border-slate-200 h-[600px] group">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.8287095842394!2d77.63924507507652!3d12.971598587338795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBangalore%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1704789600000!5m2!1sen!2sin"
                                    width="100%"
                                    height="100%"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="grayscale hover:grayscale-0 transition-all duration-500"
                                ></iframe>

                                <!-- Overlay Badge -->
                                <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-sm rounded-2xl p-4 shadow-lg">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-sm">Nuclear Edge</p>
                                            <p class="text-xs text-slate-600">Bangalore, Karnataka</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cta-grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                            <circle cx="2" cy="2" r="1" fill="#F97316"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cta-grid)"/>
                </svg>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Ready to Start Your
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500 mt-2">
                            Journey?
                        </span>
                    </h2>
                    <p class="text-xl text-slate-300 mb-10 leading-relaxed">
                        Join hundreds of businesses that have transformed with Nuclear Edge
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link
                            href="/about"
                            class="px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-full backdrop-blur-sm hover:bg-white/10 hover:border-orange-400 transition-all duration-300"
                        >
                            Learn More About Us
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
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Header from '../../Components/Header.vue';
import Footer from '../../Components/Footer.vue';

const form = ref({
    name: '',
    email: '',
    services: '',
    phone: '',
    message: ''
});

const submitForm = () => {
    // In a real application, this would send the form data to the backend
    console.log('Form submitted:', form.value);

    // Show success message (in real app, handle this properly)
    alert('Thank you for contacting us! We will get back to you soon.');

    // Reset form
    form.value = {
        name: '',
        email: '',
        services: '',
        phone: '',
        message: ''
    };
};
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
