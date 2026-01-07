<template>
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Background SVG Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Dot Grid Pattern -->
            <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="dot-grid" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1.5" fill="#F97316"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dot-grid)"/>
            </svg>

            <!-- Geometric Shapes -->
            <div class="absolute top-20 right-10 w-64 h-64 opacity-[0.02]">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="100" cy="100" r="80" stroke="#F97316" stroke-width="1" fill="none"/>
                    <circle cx="100" cy="100" r="60" stroke="#EF4444" stroke-width="1" fill="none"/>
                    <circle cx="100" cy="100" r="40" stroke="#F97316" stroke-width="1" fill="none"/>
                </svg>
            </div>

            <div class="absolute bottom-40 left-10 w-48 h-48 opacity-[0.02]">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <rect x="50" y="50" width="100" height="100" stroke="#F97316" stroke-width="1" fill="none" transform="rotate(45 100 100)"/>
                    <rect x="65" y="65" width="70" height="70" stroke="#EF4444" stroke-width="1" fill="none" transform="rotate(45 100 100)"/>
                </svg>
            </div>

            <div class="absolute top-1/2 right-1/4 w-32 h-32 opacity-[0.02]">
                <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <polygon points="50,10 90,90 10,90" stroke="#F97316" stroke-width="1" fill="none"/>
                    <polygon points="50,25 75,75 25,75" stroke="#EF4444" stroke-width="1" fill="none"/>
                </svg>
            </div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <p class="text-orange-500 font-semibold text-sm uppercase tracking-wider mb-4">
                    Success Stories
                </p>
                <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-slate-900 mb-6">
                    How We Made It <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-500">Happen</span>
                </h2>
                <p class="text-xl text-slate-600 max-w-3xl mx-auto">
                    Real businesses, real transformations, real results
                </p>
            </div>

            <!-- Success Stories Grid -->
            <div class="space-y-32">
                <!-- Story Card -->
                <div
                    v-for="(story, index) in stories"
                    :key="index"
                    class="group"
                >
                    <div
                        :class="[
                            'grid lg:grid-cols-2 gap-12 items-center',
                            index % 2 === 1 ? 'lg:flex-row-reverse' : ''
                        ]"
                    >
                        <!-- Image Side -->
                        <div
                            :class="[
                                'relative overflow-hidden rounded-3xl',
                                index % 2 === 1 ? 'lg:order-2' : ''
                            ]"
                        >
                            <div class="aspect-[4/3] bg-slate-100 relative overflow-hidden">
                                <img
                                    :src="story.image"
                                    :alt="story.company"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                />
                                <!-- Subtle Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent"></div>
                            </div>

                            <!-- Floating Tag -->
                            <div class="absolute top-6 left-6 px-4 py-2 bg-white/95 backdrop-blur-sm rounded-full shadow-lg">
                                <p class="text-sm font-semibold text-slate-700">{{ story.industry }}</p>
                            </div>
                        </div>

                        <!-- Content Side -->
                        <div :class="index % 2 === 1 ? 'lg:order-1' : ''">
                            <!-- Company Name -->
                            <h3 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                                {{ story.company }}
                            </h3>

                            <!-- Tagline -->
                            <p class="text-xl text-slate-600 mb-8 font-light leading-relaxed">
                                {{ story.tagline }}
                            </p>

                            <!-- Stats Bar (if available) -->
                            <div v-if="story.stats" class="grid grid-cols-3 gap-4 mb-10">
                                <div
                                    v-for="(stat, idx) in story.stats"
                                    :key="idx"
                                    class="text-center"
                                >
                                    <p class="text-3xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                                        {{ stat.value }}
                                    </p>
                                    <p class="text-sm text-slate-600 mt-1">{{ stat.label }}</p>
                                </div>
                            </div>

                            <!-- Accordion Sections -->
                            <div class="space-y-4">
                                <!-- Challenge -->
                                <div
                                    @click="toggleSection(index, 'challenge')"
                                    class="border border-slate-200 rounded-2xl overflow-hidden transition-all duration-300 hover:border-orange-500 cursor-pointer"
                                >
                                    <div class="flex items-center justify-between p-6 bg-white">
                                        <h4 class="text-lg font-semibold text-slate-900 flex items-center gap-3">
                                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                            The Challenge
                                        </h4>
                                        <svg
                                            :class="[
                                                'w-5 h-5 text-slate-600 transition-transform duration-300',
                                                activeSection[index]?.challenge ? 'rotate-180' : ''
                                            ]"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                    <transition name="accordion">
                                        <div v-if="activeSection[index]?.challenge" class="px-6 pb-6 pt-2 bg-slate-50/50">
                                            <p class="text-slate-600 leading-relaxed">{{ story.challenge }}</p>
                                        </div>
                                    </transition>
                                </div>

                                <!-- Solution -->
                                <div
                                    @click="toggleSection(index, 'solution')"
                                    class="border border-slate-200 rounded-2xl overflow-hidden transition-all duration-300 hover:border-orange-500 cursor-pointer"
                                >
                                    <div class="flex items-center justify-between p-6 bg-white">
                                        <h4 class="text-lg font-semibold text-slate-900 flex items-center gap-3">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                            The Solution
                                        </h4>
                                        <svg
                                            :class="[
                                                'w-5 h-5 text-slate-600 transition-transform duration-300',
                                                activeSection[index]?.solution ? 'rotate-180' : ''
                                            ]"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                    <transition name="accordion">
                                        <div v-if="activeSection[index]?.solution" class="px-6 pb-6 pt-2 bg-slate-50/50">
                                            <p class="text-slate-600 leading-relaxed">{{ story.solution }}</p>
                                        </div>
                                    </transition>
                                </div>

                                <!-- Outcome -->
                                <div
                                    @click="toggleSection(index, 'outcome')"
                                    class="border border-slate-200 rounded-2xl overflow-hidden transition-all duration-300 hover:border-orange-500 cursor-pointer"
                                >
                                    <div class="flex items-center justify-between p-6 bg-white">
                                        <h4 class="text-lg font-semibold text-slate-900 flex items-center gap-3">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                            The Outcome
                                        </h4>
                                        <svg
                                            :class="[
                                                'w-5 h-5 text-slate-600 transition-transform duration-300',
                                                activeSection[index]?.outcome ? 'rotate-180' : ''
                                            ]"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                    <transition name="accordion">
                                        <div v-if="activeSection[index]?.outcome" class="px-6 pb-6 pt-2 bg-slate-50/50">
                                            <p class="text-slate-600 leading-relaxed">{{ story.outcome }}</p>
                                        </div>
                                    </transition>
                                </div>
                            </div>

                            <!-- Motivational Takeaway -->
                            <div class="mt-8 p-6 bg-slate-50 rounded-2xl border-l-4 border-orange-500">
                                <p class="text-sm font-semibold text-orange-500 uppercase tracking-wider mb-2">
                                    Key Takeaway
                                </p>
                                <p class="text-slate-700 leading-relaxed italic">
                                    "{{ story.takeaway }}"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const activeSection = ref({});

const toggleSection = (storyIndex, section) => {
    if (!activeSection.value[storyIndex]) {
        activeSection.value[storyIndex] = {};
    }
    activeSection.value[storyIndex][section] = !activeSection.value[storyIndex][section];
};

const stories = ref([
    {
        company: 'Rajah Foods',
        industry: 'FMCG',
        tagline: 'Transforming a Local FMCG Brand into a Market Leader',
        image: '/images/rajah-food.png',
        stats: [
            { value: '300%', label: 'Sales Increase' },
            { value: '6 Mo', label: 'Timeline' },
            { value: '3 States', label: 'Expansion' }
        ],
        challenge: 'Rajah Foods, a family-owned FMCG brand based in Delhi, had been in business for years but struggled to make a mark in a saturated market dominated by national giants. Despite having a superior product, they couldn\'t break through, and sales were inconsistent. They needed more than just marketing—they needed a comprehensive transformation.',
        solution: 'Nuclear Edge took Rajah Foods on a journey of rediscovery, focusing first on their brand identity. We helped them reposition themselves with a story that resonated with their audience: a heritage brand delivering authentic, local flavors. Next, we rebuilt their e-commerce platform from the ground up, ensuring it was user-friendly, visually compelling, and optimized for sales. Our digital marketing team launched a multi-channel campaign, utilizing SEO, targeted ads, and social media influencers to build brand awareness. We also tapped into regional pride, focusing on how Rajah Foods supported local farmers and used traditional methods in their production processes.',
        outcome: 'Within 6 months, Rajah Foods saw a 300% increase in online sales, and they were able to expand their market reach beyond Delhi to Punjab and Haryana. Their loyal customer base grew exponentially, and their website became the cornerstone of their business strategy. Today, they\'re one of the fastest-growing FMCG brands in the region, and the best part—they\'re staying true to their roots.',
        takeaway: 'Rajah Foods\' story proves that a good product isn\'t enough—you need a powerful brand story, a digital presence, and the right strategy to thrive. They embraced the challenge, trusted the process, and are now reaping the rewards.'
    },
    {
        company: 'Brainscape Academy',
        industry: 'EdTech',
        tagline: 'EdTech Revolution: Empowering the Next Generation of Learners',
        image: '/images/brainscape-academy.png',
        stats: [
            { value: '150%', label: 'Engagement' },
            { value: '200%', label: 'Enrollments' },
            { value: '1 Year', label: 'Timeline' }
        ],
        challenge: 'Brainscape Academy had the vision to break into the highly competitive Kota IIT and Delhi IAS coaching markets. With their EdTech platform, they aimed to make high-quality education accessible to students across India. But they lacked the technical expertise and market penetration to compete with the established players. Their platform struggled with low user engagement, and they needed a unique edge to make a breakthrough.',
        solution: 'Nuclear Edge partnered with Brainscape Academy to reimagine their platform. We introduced AI-driven personalized learning tools, interactive live classes, and performance dashboards that allowed students to track their progress. The platform became a personalized tutor in the pocket of every student. But technology alone wasn\'t enough—our team worked on a strategic go-to-market plan, forging partnerships with top coaching institutes in Kota and Delhi. We leveraged these partnerships to give Brainscape Academy credibility and access to student communities, further supported by a comprehensive digital marketing campaign targeting students and parents.',
        outcome: 'Within a year, Brainscape Academy saw a 150% increase in user engagement and a 200% rise in enrollments. The platform quickly became a favorite among students, standing out from the competition due to its personalized and interactive approach. Today, they\'re on track to become a market leader in both the IIT-JEE and IAS prep spaces.',
        takeaway: 'Brainscape Academy is proof that even in competitive industries, innovation and persistence pay off. They didn\'t shy away from the challenge—they embraced it and turned their vision into a reality.'
    },
    {
        company: 'Harman Industries',
        industry: 'Manufacturing',
        tagline: 'Industrial Excellence in Punjab: Driving Operational Efficiency',
        image: '/images/harman.png',
        stats: [
            { value: '20%', label: 'Cost Reduction' },
            { value: '30%', label: 'Output Increase' },
            { value: '1 Year', label: 'Timeline' }
        ],
        challenge: 'Harman Industries, a mid-sized manufacturing firm based in Ludhiana, Punjab, was facing severe operational inefficiencies. Their outdated machinery, unoptimized supply chain, and rising costs were putting them on the back foot. Despite having strong demand, they couldn\'t meet production targets efficiently and were losing potential contracts to more agile competitors.',
        solution: 'Nuclear Edge stepped in with a three-fold approach. First, we conducted an in-depth operational audit to identify key bottlenecks. Then, we implemented state-of-the-art automation technologies to streamline their production processes, cutting down on manual labor and reducing human error. Next, we optimized their supply chain management system, leveraging digital tools to improve coordination and reduce delays. Lastly, we invested in upskilling their workforce, ensuring they were fully equipped to manage the new technologies.',
        outcome: 'In just one year, Harman Industries reduced operational costs by 20% and increased production output by 30%. This allowed them to meet demand more efficiently and secure larger contracts, expanding their market share across northern India. Their new streamlined operations enabled them to focus on innovation and growth, putting them back in the game as a competitive force in the manufacturing sector.',
        takeaway: 'Harman Industries\' transformation shows that even traditional industries can benefit from modernization and innovation. Businesses that are willing to evolve are the ones that will thrive.'
    },
    {
        company: 'Tandoori Junction',
        industry: 'Food & Beverage',
        tagline: 'Crafting a Digital Identity for Growth',
        image: '/images/tandoori-junction.png',
        stats: [
            { value: '200%', label: 'Digital Orders' },
            { value: '400%', label: 'Social Media' },
            { value: '2', label: 'New Locations' }
        ],
        challenge: 'Tandoori Junction, a beloved family-owned chain of Punjabi dhabas, had built a strong local reputation for their authentic food. However, they were struggling to transition into the digital age. Their loyal customer base wasn\'t enough to sustain growth, and they had no online ordering system or digital marketing strategy to attract new customers.',
        solution: 'Nuclear Edge worked closely with Tandoori Junction to create an engaging online presence. We developed a mobile app and a website that allowed customers to order food online, cutting out third-party platforms and reducing commission fees. In addition to building their digital infrastructure, we launched a targeted social media campaign showcasing their "authentic Punjabi flavors" and their rich culinary heritage, connecting them with a new, younger audience.',
        outcome: 'Digital orders surged by 200% in the first quarter, and Tandoori Junction became a local favorite not only offline but online as well. Their social media engagement increased by 400%, and they\'ve now opened two new locations to meet the growing demand. Today, their brand is expanding beyond Haryana into neighboring states, with a loyal customer base both online and in-store.',
        takeaway: 'Tandoori Junction\'s story is a testament to the power of embracing change. Tradition and innovation can go hand in hand, and the businesses that find that balance will flourish.'
    },
    {
        company: 'Allure Innovations',
        industry: 'Corporate Services',
        tagline: 'Web Development for a Leading Corporate Group',
        image: '/images/allure-engineering.png',
        stats: [
            { value: '60%', label: 'Lead Increase' },
            { value: '100%', label: 'Mobile Optimized' },
            { value: '3 Mo', label: 'Timeline' }
        ],
        challenge: 'Allure Innovations, a corporate services firm, was struggling with an outdated website that no longer met modern standards. Poor functionality, lack of mobile responsiveness, and a dated design were costing them leads and hurting their reputation.',
        solution: 'Nuclear Edge completely revamped Allure Innovations\' website with a sleek, modern design that was fully optimized for mobile devices. We integrated a CRM system to streamline their sales process and added advanced analytics to track user behavior. Lead capture forms and enhanced SEO were built into the site, ensuring Allure Innovations was attracting and converting new business effectively.',
        outcome: 'The redesigned site led to a 60% increase in lead generation, significantly boosting their conversion rates. With improved visitor engagement and a sleek user experience, the website became a powerful tool for Allure Innovations to attract and retain clients. Today, their digital presence reflects the professionalism and innovation of their brand.',
        takeaway: 'Your digital presence is more than just a face for your business—it\'s a powerful tool for growth. Don\'t underestimate the importance of investing in your digital infrastructure.'
    }
]);
</script>

<style scoped>
/* Smooth Accordion animation */
.accordion-enter-active {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    max-height: 800px;
    overflow: hidden;
}

.accordion-leave-active {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    max-height: 800px;
    overflow: hidden;
}

.accordion-enter-from {
    max-height: 0;
    opacity: 0;
    transform: translateY(-10px);
}

.accordion-leave-to {
    max-height: 0;
    opacity: 0;
    transform: translateY(-10px);
}

.accordion-enter-to,
.accordion-leave-from {
    max-height: 800px;
    opacity: 1;
    transform: translateY(0);
}
</style>
