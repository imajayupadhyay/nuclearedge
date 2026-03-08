<template>
    <Head><title>Discovery Response #{{ response.id }} - Admin Portal</title></Head>

    <AdminLayout :user="$page.props.auth.user">
        <!-- Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="/admin/talkheals-discovery"
                    class="flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    All Responses
                </a>
                <span class="text-slate-300">/</span>
                <h1 class="text-xl font-bold text-slate-900">Response #{{ response.id }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <span :class="['inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium',
                    response.is_reviewed ? 'bg-emerald-100 text-emerald-800' : 'bg-orange-100 text-orange-800']">
                    <span :class="['w-1.5 h-1.5 rounded-full mr-2',
                        response.is_reviewed ? 'bg-emerald-600' : 'bg-orange-500']"></span>
                    {{ response.is_reviewed ? 'Reviewed' : 'Unreviewed' }}
                </span>
                <button v-if="response.is_reviewed" @click="markUnreviewed"
                    class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors text-sm font-medium">
                    Mark Unreviewed
                </button>
                <button v-else @click="markReviewed"
                    class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm font-medium">
                    Mark Reviewed
                </button>
                <button @click="showDeleteModal = true"
                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                    Delete
                </button>
            </div>
        </div>

        <!-- Flash -->
        <div v-if="$page.props.flash.success" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center">
            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-green-800">{{ $page.props.flash.success }}</span>
        </div>

        <!-- Meta card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-6 flex flex-wrap gap-6">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Submitted</p>
                <p class="text-sm font-medium text-slate-900">{{ formatDate(response.created_at) }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Questions Answered</p>
                <p class="text-sm font-medium text-slate-900">
                    <span class="text-emerald-600 font-bold">{{ Object.keys(response.answers).length }}</span> / 28
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Form</p>
                <p class="text-sm font-medium text-slate-900">TalkHeals Deep Discovery</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Client</p>
                <p class="text-sm font-medium text-slate-900">Namrata · TalkHeals Psychotherapy</p>
            </div>
        </div>

        <!-- Sections -->
        <div class="space-y-6">
            <div v-for="section in SECTIONS" :key="section.id"
                class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <!-- Section header -->
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100"
                    :style="{ background: section.color + '0A' }">
                    <span class="text-2xl">{{ section.icon }}</span>
                    <div>
                        <h2 class="font-semibold text-slate-900">{{ section.label }}</h2>
                        <p class="text-xs text-slate-500">{{ getSectionAnsweredCount(section.id) }} of {{ getSectionTotalCount(section.id) }} answered</p>
                    </div>
                    <div class="ml-auto">
                        <div class="w-24 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all"
                                :style="{
                                    background: section.color,
                                    width: (getSectionAnsweredCount(section.id) / getSectionTotalCount(section.id) * 100) + '%'
                                }">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Questions -->
                <div class="divide-y divide-slate-50">
                    <div v-for="q in getQuestions(section.id)" :key="q.id" class="px-6 py-5">
                        <div class="flex items-start gap-3">
                            <span class="mt-0.5 w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center text-xs font-bold text-white"
                                :style="{ background: response.answers[q.id] !== undefined ? section.color : '#CBD5E1' }">
                                {{ response.answers[q.id] !== undefined ? '✓' : '–' }}
                            </span>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-700 mb-2">{{ q.q }}</p>
                                <div v-if="response.answers[q.id] !== undefined">
                                    <!-- Text answer -->
                                    <div v-if="q.type === 'text'"
                                        class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-800 whitespace-pre-wrap leading-relaxed">
                                        {{ response.answers[q.id] }}
                                    </div>
                                    <!-- Single -->
                                    <div v-else-if="q.type === 'single'">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium"
                                            :style="{ background: section.color + '18', color: section.color }">
                                            ● {{ response.answers[q.id] }}
                                        </span>
                                    </div>
                                    <!-- Multi -->
                                    <div v-else-if="q.type === 'multi'" class="flex flex-wrap gap-2">
                                        <span v-for="opt in response.answers[q.id]" :key="opt"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium"
                                            :style="{ background: section.color + '18', color: section.color }">
                                            ✓ {{ opt }}
                                        </span>
                                    </div>
                                    <!-- Colors -->
                                    <div v-else-if="q.type === 'colors'" class="flex items-center gap-3 flex-wrap">
                                        <div v-for="hex in response.answers[q.id]" :key="hex"
                                            class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-lg border-2 border-white shadow-md"
                                                :style="{ background: hex }"></div>
                                            <span class="text-xs text-slate-500 font-mono">{{ hex }}</span>
                                        </div>
                                    </div>
                                    <!-- Slider -->
                                    <div v-else-if="q.type === 'slider'" class="flex items-center gap-3">
                                        <div class="flex-1 max-w-xs bg-slate-100 rounded-full h-2">
                                            <div class="h-2 rounded-full"
                                                :style="{ background: section.color, width: ((response.answers[q.id] - (q.min||1)) / ((q.max||10) - (q.min||1)) * 100) + '%' }">
                                            </div>
                                        </div>
                                        <span class="text-xl font-bold" :style="{ color: section.color }">
                                            {{ response.answers[q.id] }} / {{ q.max || 10 }}
                                        </span>
                                    </div>
                                    <!-- Ranking -->
                                    <div v-else-if="q.type === 'ranking'" class="space-y-1.5">
                                        <div v-for="(item, i) in response.answers[q.id]" :key="item"
                                            class="flex items-center gap-3 px-3 py-2 bg-slate-50 rounded-lg border border-slate-200">
                                            <span class="text-sm font-bold w-5 text-center" :style="{ color: section.color }">{{ i + 1 }}</span>
                                            <span class="text-sm text-slate-700">{{ item }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div v-else>
                                    <span class="text-xs text-slate-400 italic">Not answered</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom nav -->
        <div class="mt-8 flex justify-between">
            <a href="/admin/talkheals-discovery"
                class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors text-sm font-medium shadow-sm">
                ← Back to All Responses
            </a>
            <button @click="showDeleteModal = true"
                class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 border border-red-200 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                Delete This Response
            </button>
        </div>

        <!-- Delete Modal -->
        <Transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0" enter-to-class="opacity-100"
                    leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
            <div v-if="showDeleteModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full mx-auto mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900 text-center mb-2">Delete Response</h3>
                    <p class="text-slate-600 text-center mb-6">This will permanently delete this discovery response. This cannot be undone.</p>
                    <div class="flex space-x-3">
                        <button @click="showDeleteModal = false"
                            class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors font-medium">
                            Cancel
                        </button>
                        <button @click="confirmDelete"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Components/Admin/AdminLayout.vue';

const props = defineProps({
    response: Object,
});

const showDeleteModal = ref(false);

/* ─── Section & Question definitions ─── */
const SECTIONS = [
    { id: 'background', label: 'Her Story',        icon: '🌿', color: '#6BAF89' },
    { id: 'clients',    label: 'Her Clients',       icon: '👥', color: '#C4937A' },
    { id: 'design',     label: 'Brand & Design',    icon: '🎨', color: '#8B9DC3' },
    { id: 'services',   label: 'Services & Craft',  icon: '🧠', color: '#C4B482' },
    { id: 'vision',     label: 'Ambition & Vision', icon: '🚀', color: '#A882B0' },
    { id: 'stakes',     label: 'Stakes & Urgency',  icon: '⚡', color: '#C47A7A' },
];

const QUESTIONS = [
    // BACKGROUND
    { id:'bg1', section:'background', type:'text',    q:'In your own words — what brought you to psychotherapy? What was the moment or experience that made you say "this is my calling"?' },
    { id:'bg2', section:'background', type:'single',  q:'How long have you been practicing as a Registered Psychotherapist?' },
    { id:'bg3', section:'background', type:'single',  q:'Before TalkHeals — what did your professional life look like?' },
    { id:'bg4', section:'background', type:'text',    q:'What is the one thing about your personal background — cultural, lived, immigrant experience — that shapes HOW you practice therapy?' },
    { id:'bg5', section:'background', type:'multi',   q:'Which personal lived experiences do you draw from in your practice?' },
    // CLIENTS
    { id:'cl1', section:'clients', type:'multi',   q:'Which communities make up the majority of your current client base?' },
    { id:'cl2', section:'clients', type:'multi',   q:'What age groups do you most frequently work with?' },
    { id:'cl3', section:'clients', type:'single',  q:'What is the typical household income bracket of your clients?' },
    { id:'cl4', section:'clients', type:'single',  q:'How do most of your current clients find you?' },
    { id:'cl5', section:'clients', type:'multi',   q:'What are the TOP presenting issues your clients come to you with?' },
    { id:'cl6', section:'clients', type:'text',    q:'Describe your IDEAL client — the person you do your best work with.' },
    { id:'cl7', section:'clients', type:'single',  q:"What is a typical client's journey before they find you — emotionally speaking?" },
    // DESIGN
    { id:'ds1', section:'design', type:'colors',  q:'Which colour palette speaks to the soul of TalkHeals?' },
    { id:'ds2', section:'design', type:'multi',   q:"Which words should someone use to describe TalkHeals' brand?" },
    { id:'ds3', section:'design', type:'single',  q:'When you think of a website that feels "like home" to you visually — which style resonates most?' },
    { id:'ds4', section:'design', type:'text',    q:'Is there a website, brand, or visual reference you admire that captures a feeling you want for TalkHeals?' },
    { id:'ds5', section:'design', type:'multi',   q:'What do you absolutely NOT want your website to feel like?' },
    // SERVICES
    { id:'sv1', section:'services', type:'ranking', q:'Rank your services from most to least PASSIONATE about:' },
    { id:'sv2', section:'services', type:'single',  q:'What is your PRIMARY therapeutic modality / approach?' },
    { id:'sv3', section:'services', type:'text',    q:'What makes your therapeutic approach genuinely different from every other therapist in Brampton or the GTA?' },
    { id:'sv4', section:'services', type:'multi',   q:'Which services do you want to GROW significantly in the next 12 months?' },
    { id:'sv5', section:'services', type:'single',  q:'What is your current session capacity — and where do you WANT to be?' },
    // VISION
    { id:'vs1', section:'vision', type:'text',   q:'In exactly ONE YEAR from today — what does TalkHeals look like?' },
    { id:'vs2', section:'vision', type:'text',   q:'In THREE YEARS — what is the biggest, boldest version of TalkHeals you can imagine?' },
    { id:'vs3', section:'vision', type:'single', q:'What does financial success look like for TalkHeals in 3 years?' },
    { id:'vs4', section:'vision', type:'multi',  q:"What is TalkHeals' deeper mission beyond therapy sessions?" },
    { id:'vs5', section:'vision', type:'text',   q:'What is your biggest fear or concern about growing TalkHeals?' },
    // STAKES
    { id:'st1', section:'stakes', type:'slider', q:'On a scale of 1–10, how important is this digital transformation to TalkHeals\' future?', min:1, max:10 },
    { id:'st2', section:'stakes', type:'single', q:'What happens if TalkHeals does NOT have a modern digital system in place 6 months from now?' },
    { id:'st3', section:'stakes', type:'single', q:'How quickly do you want Phase 1 to be live?' },
    { id:'st4', section:'stakes', type:'multi',  q:'Which of these outcomes would make this project a resounding success for you personally?' },
    { id:'st5', section:'stakes', type:'text',   q:'Last question — and the most important one. In your own voice: WHY does this matter so deeply to you, personally?' },
];

const getQuestions  = (sectionId) => QUESTIONS.filter(q => q.section === sectionId);

const getSectionAnsweredCount = (sectionId) =>
    getQuestions(sectionId).filter(q => props.response.answers[q.id] !== undefined).length;

const getSectionTotalCount = (sectionId) => getQuestions(sectionId).length;

const formatDate = (d) => new Date(d).toLocaleDateString('en-US', {
    year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit',
});

const markReviewed = () => router.post(`/admin/talkheals-discovery/${props.response.id}/mark-reviewed`);
const markUnreviewed = () => router.post(`/admin/talkheals-discovery/${props.response.id}/mark-unreviewed`);

const confirmDelete = () => {
    router.delete(`/admin/talkheals-discovery/${props.response.id}`, {
        onSuccess: () => { showDeleteModal.value = false; },
    });
};
</script>
