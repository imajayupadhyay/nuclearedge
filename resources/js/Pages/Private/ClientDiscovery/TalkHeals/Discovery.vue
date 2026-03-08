<template>
    <div class="disc-root">
        <Head><title>TalkHeals · Deep Discovery</title></Head>

        <!-- ─── INTRO ─── -->
        <Transition name="screen-fade" mode="out-in">
            <div v-if="screen === 'intro'" key="intro" class="disc-shell">
                <div class="intro-wrap">
                    <div class="intro-card fade-up">
                        <div class="float-icon">🌿</div>
                        <h1 class="intro-title">TalkHeals<br><em>Deep Discovery</em></h1>
                        <p class="intro-meta">6 Sections · 28 Questions · ~10 Minutes · Fully Confidential</p>
                        <div class="intro-divider"></div>
                        <p class="intro-body">
                            This isn't a standard survey. This is a deep, psychological exploration of who you are,
                            who you serve, and what TalkHeals is truly meant to become.
                        </p>
                        <p class="intro-sub">
                            Your answers will be used to generate a
                            <strong class="terra-text">full strategic analysis report</strong>
                            — the foundation of everything we build together.
                        </p>
                        <div class="section-pills">
                            <span v-for="s in SECTIONS" :key="s.id" class="section-pill" :style="{ borderColor: s.color + '44', color: '#A8C9B7' }">
                                {{ s.icon }} {{ s.label }}
                            </span>
                        </div>
                        <button class="btn-start" @click="startQuiz">Begin My Discovery →</button>
                    </div>
                </div>
            </div>

            <!-- ─── QUIZ ─── -->
            <div v-else-if="screen === 'quiz'" key="quiz" class="disc-shell">
                <!-- Top bar -->
                <div class="topbar fade-up">
                    <span class="topbar-logo">TalkHeals <em>Discovery</em></span>
                    <div class="progress-track">
                        <div class="progress-fill" :style="{ width: progress + '%' }"></div>
                    </div>
                    <span class="progress-count">{{ totalAnswered }}/{{ QUESTIONS.length }}</span>
                </div>

                <!-- Section tabs -->
                <div class="section-tabs fade-up-2">
                    <div
                        v-for="(s, i) in SECTIONS"
                        :key="s.id"
                        class="section-tab"
                        :style="{
                            opacity: i === sectionIdx ? '1' : '0.4',
                            borderBottom: i === sectionIdx ? `2px solid ${s.color}` : '2px solid transparent',
                        }"
                    >{{ s.icon }}</div>
                </div>

                <!-- Quiz card with transition -->
                <Transition name="card-anim" mode="out-in">
                    <div class="quiz-card fade-up-2" :key="`${sectionIdx}-${qIdx}`" id="quizCard">

                        <!-- Section header -->
                        <div class="sec-head">
                            <span class="sec-badge" :style="{ background: currentSection.color + '22', color: currentSection.color }">
                                {{ currentSection.icon }} {{ currentSection.label }}
                            </span>
                            <span class="sec-count">{{ qIdx + 1 }} of {{ sectionQs.length }}</span>
                        </div>

                        <!-- Question text -->
                        <p class="q-text">{{ currentQ.q }}</p>

                        <!-- Answer area -->
                        <div class="answer-area fade-up-3">

                            <!-- TEXT -->
                            <textarea
                                v-if="currentQ.type === 'text'"
                                class="q-textarea"
                                :rows="currentQ.rows || 3"
                                :placeholder="currentQ.placeholder || ''"
                                :value="answers[currentQ.id] || ''"
                                @input="answers[currentQ.id] = $event.target.value"
                            ></textarea>

                            <!-- SINGLE SELECT -->
                            <div v-else-if="currentQ.type === 'single'" class="opts-list">
                                <button
                                    v-for="opt in currentQ.opts"
                                    :key="opt"
                                    class="opt-btn"
                                    :style="{
                                        borderColor: answers[currentQ.id] === opt ? currentSection.color : '#1E3028',
                                        background: answers[currentQ.id] === opt ? currentSection.color + '18' : '#0F1E16',
                                        color: answers[currentQ.id] === opt ? '#F5F0E8' : '#8AB09A',
                                    }"
                                    @click="answers[currentQ.id] = opt"
                                >
                                    <span class="opt-dot" :style="{
                                        border: `2px solid ${answers[currentQ.id] === opt ? currentSection.color : '#2A4535'}`,
                                        background: answers[currentQ.id] === opt ? currentSection.color : 'transparent',
                                    }"></span>
                                    {{ opt }}
                                </button>
                            </div>

                            <!-- MULTI SELECT -->
                            <div v-else-if="currentQ.type === 'multi'">
                                <p class="hint-text">Select all that apply</p>
                                <div class="opts-list">
                                    <button
                                        v-for="opt in currentQ.opts"
                                        :key="opt"
                                        class="opt-btn"
                                        :style="{
                                            borderColor: (answers[currentQ.id] || []).includes(opt) ? currentSection.color : '#1E3028',
                                            background: (answers[currentQ.id] || []).includes(opt) ? currentSection.color + '18' : '#0F1E16',
                                            color: (answers[currentQ.id] || []).includes(opt) ? '#F5F0E8' : '#8AB09A',
                                        }"
                                        @click="toggleMulti(currentQ.id, opt)"
                                    >
                                        <span class="opt-check" :style="{
                                            border: `2px solid ${(answers[currentQ.id] || []).includes(opt) ? currentSection.color : '#2A4535'}`,
                                            background: (answers[currentQ.id] || []).includes(opt) ? currentSection.color : 'transparent',
                                        }">{{ (answers[currentQ.id] || []).includes(opt) ? '✓' : '' }}</span>
                                        {{ opt }}
                                    </button>
                                </div>
                            </div>

                            <!-- COLORS -->
                            <div v-else-if="currentQ.type === 'colors'">
                                <p class="hint-text">Pick up to 3 colours</p>
                                <div class="color-grid">
                                    <div v-for="c in currentQ.colors" :key="c.hex" class="color-cell">
                                        <div
                                            class="color-swatch"
                                            :class="{ selected: (answers[currentQ.id] || []).includes(c.hex) }"
                                            :style="{
                                                background: c.hex,
                                                boxShadow: (answers[currentQ.id] || []).includes(c.hex) ? `0 0 16px ${c.hex}88` : 'none',
                                                borderColor: (answers[currentQ.id] || []).includes(c.hex) ? '#F5F0E8' : 'transparent',
                                            }"
                                            @click="toggleColor(currentQ.id, c.hex)"
                                        ></div>
                                        <p class="color-name">{{ c.name }}</p>
                                    </div>
                                </div>
                                <div v-if="(answers[currentQ.id] || []).length > 0" class="color-preview">
                                    <span class="hint-text" style="margin-bottom:0;">Selected:</span>
                                    <div
                                        v-for="hex in (answers[currentQ.id] || [])"
                                        :key="hex"
                                        class="color-preview-dot"
                                        :style="{ background: hex }"
                                    ></div>
                                </div>
                            </div>

                            <!-- SLIDER (scale buttons) -->
                            <div v-else-if="currentQ.type === 'slider'" class="slider-wrap">
                                <div class="scale-buttons">
                                    <button
                                        v-for="n in (currentQ.max - currentQ.min + 1)"
                                        :key="n + currentQ.min - 1"
                                        class="scale-btn"
                                        :class="{ active: (answers[currentQ.id] ?? null) === (n + currentQ.min - 1) }"
                                        :style="(answers[currentQ.id] ?? null) === (n + currentQ.min - 1)
                                            ? { background: currentSection.color, color: '#0E1A14', borderColor: currentSection.color }
                                            : { borderColor: currentSection.color + '40' }"
                                        @click="answers[currentQ.id] = n + currentQ.min - 1"
                                    >{{ n + currentQ.min - 1 }}</button>
                                </div>
                                <div class="scale-labels">
                                    <span>{{ currentQ.labels[0] }}</span>
                                    <span>{{ currentQ.labels[2] }}</span>
                                </div>
                                <div v-if="answers[currentQ.id] != null" class="slider-val-wrap">
                                    <span class="slider-val" :style="{ background: currentSection.color + '22', color: currentSection.color }">
                                        {{ answers[currentQ.id] }} / {{ currentQ.max }}
                                    </span>
                                    <p class="hint-text" style="text-align:center;margin-top:8px;">{{ currentQ.labels[1] }}</p>
                                </div>
                            </div>

                            <!-- RANKING -->
                            <div v-else-if="currentQ.type === 'ranking'">
                                <p class="hint-text">Use arrows to rank from most → least passionate</p>
                                <div class="rank-list">
                                    <div
                                        v-for="(item, i) in rankingState[currentQ.id] || []"
                                        :key="item"
                                        class="rank-item"
                                        :style="{ borderColor: i === 0 ? currentSection.color : '#1E3028' }"
                                    >
                                        <span class="rank-num" :style="{ color: currentSection.color }">{{ i + 1 }}</span>
                                        <span class="rank-label">{{ item }}</span>
                                        <div class="rank-arrows">
                                            <button class="rank-arrow" @click="rankMove(currentQ.id, i, -1)">▲</button>
                                            <button class="rank-arrow" @click="rankMove(currentQ.id, i, 1)">▼</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nav -->
                        <div class="quiz-nav fade-up-4">
                            <button class="btn-back" @click="goBack">← Back</button>
                            <button
                                class="btn-next"
                                :disabled="!canProceed"
                                :style="{
                                    background: canProceed ? currentSection.color : '#2A3F33',
                                    color: canProceed ? '#0E1A14' : '#3D6B52',
                                    cursor: canProceed ? 'pointer' : 'not-allowed',
                                }"
                                @click="goNext"
                            >{{ nextLabel }}</button>
                        </div>
                    </div>
                </Transition>

                <p class="quiz-footer">Confidential · TalkHeals Discovery Session · {{ year }}</p>
            </div>

            <!-- ─── NAME CAPTURE ─── -->
            <div v-else-if="screen === 'name'" key="name" class="disc-shell">
                <div class="intro-wrap">
                    <div class="intro-card fade-up">
                        <div class="float-icon">✨</div>
                        <h1 class="intro-title">Almost Done,<br><em>One Last Thing</em></h1>
                        <div class="intro-divider"></div>
                        <p class="intro-body" style="margin-bottom:28px;">
                            Before we save your responses, please share your name so our team can personalise your analysis.
                        </p>
                        <input
                            v-model="userName"
                            type="text"
                            class="name-input"
                            placeholder="Your full name..."
                            @keyup.enter="userName.trim() && submitAndFinish()"
                            autofocus
                        />
                        <button
                            class="btn-start"
                            style="margin-top:20px;"
                            :disabled="!userName.trim()"
                            :style="!userName.trim() ? { opacity: '0.45', cursor: 'not-allowed' } : {}"
                            @click="submitAndFinish"
                        >
                            Submit My Discovery ✨
                        </button>
                    </div>
                </div>
            </div>

            <!-- ─── THANK YOU ─── -->
            <div v-else-if="screen === 'results'" key="results" class="disc-shell">
                <div class="thankyou-wrap">
                    <div class="thankyou-card fade-up">
                        <div class="thankyou-icon">🌿</div>
                        <h1 class="thankyou-title">Thank You,<br><em>{{ userName }}.</em></h1>
                        <div class="intro-divider"></div>
                        <p class="thankyou-body">
                            Your responses have been received. Every answer you shared brings us
                            one step closer to building something truly meaningful for TalkHeals.
                        </p>
                        <p class="thankyou-sub">
                            Our team will carefully review your discovery and be in touch soon.
                        </p>

                        <div class="psychlab-nudge">
                            <div class="nudge-divider"></div>
                            <p class="nudge-text">
                                Kindly take the other set of questions — it will take just <strong>5 more minutes</strong> for better analysis for our team.
                            </p>
                            <a href="/private/clientdiscovery/talkheals/psychlab" class="nudge-btn">
                                Continue to PsychLab →
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { Head } from '@inertiajs/vue3';

const year = new Date().getFullYear();

/* ─── DATA ─── */
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
    { id:'bg1', section:'background', type:'text',   q:'In your own words — what brought you to psychotherapy? What was the moment or experience that made you say "this is my calling"?', placeholder:"Take your time. There's no right answer here...", rows:4 },
    { id:'bg2', section:'background', type:'single', q:'How long have you been practicing as a Registered Psychotherapist?', opts:['Under 2 years','2–5 years','5–10 years','10–15 years','15+ years'] },
    { id:'bg3', section:'background', type:'single', q:'Before TalkHeals — what did your professional life look like?', opts:['I came from social work / counselling','I transitioned from another healthcare field','I worked in corporate / non-clinical settings','Therapy has always been my career','I came from education / teaching'] },
    { id:'bg4', section:'background', type:'text',   q:'What is the one thing about your personal background — cultural, lived, immigrant experience — that shapes HOW you practice therapy?', placeholder:'This often becomes the most powerful part of a therapist\'s brand story...', rows:3 },
    { id:'bg5', section:'background', type:'multi',  q:'Which personal lived experiences do you draw from in your practice? (Select all that apply)', opts:['Immigration & cultural adjustment','Navigating racism & anti-oppression','Marriage / relationship challenges','Motherhood / parenting','Mental health stigma in South Asian communities','Religious / spiritual identity','Career transitions','Grief & loss'] },
    // CLIENTS
    { id:'cl1', section:'clients', type:'multi',  q:'Which communities make up the majority of your current client base?', opts:['South Asian (Indian, Pakistani, Sri Lankan, etc.)','East Asian','Middle Eastern / Arab','African / Caribbean','White / European Canadian','Indigenous / First Nations','Mixed / Multi-ethnic','Fairly diverse — no dominant group'] },
    { id:'cl2', section:'clients', type:'multi',  q:'What age groups do you most frequently work with?', opts:['Teens (13–17)','Young Adults (18–25)','Adults (26–40)','Mid-life (41–55)','Seniors (55+)','Children with parental involvement'] },
    { id:'cl3', section:'clients', type:'single', q:'What is the typical household income bracket of your clients?', opts:['Under $40K — lower income, often uninsured','$40K–$80K — working / middle class, partial coverage','$80K–$150K — established professionals, good coverage','$150K+ — high income, often self-paying','Very mixed — I serve a wide income range'] },
    { id:'cl4', section:'clients', type:'single', q:'How do most of your current clients find you?', opts:['Google / organic search','Psychology Today / GoodTherapy directory','Word of mouth / referrals','Social media (Instagram, Facebook)','Doctor / GP referrals','Community / cultural organizations'] },
    { id:'cl5', section:'clients', type:'multi',  q:'What are the TOP presenting issues your clients come to you with? (Choose up to 4)', opts:['Anxiety & panic','Depression','Relationship / marital conflict','Immigration trauma & adjustment','Parenting stress','Grief & loss','Low self-esteem','Post-partum depression','Work stress & burnout','Cultural identity conflict','Divorce / separation','Trauma & PTSD'] },
    { id:'cl6', section:'clients', type:'text',   q:'Describe your IDEAL client — the person you do your best work with. What are they like, what do they need, and why do they choose you over another therapist?', placeholder:'Think of your most rewarding client relationship...', rows:4 },
    { id:'cl7', section:'clients', type:'single', q:'What is a typical client\'s journey before they find you — emotionally speaking?', opts:['Desperate — they\'ve been struggling alone for too long','Curious — exploring therapy for the first time','Returning — they\'ve done therapy before elsewhere','Referred — someone they trust sent them to me','Crisis-adjacent — things just got unmanageable'] },
    // DESIGN
    { id:'ds1', section:'design', type:'colors', q:'Which colour palette speaks to the soul of TalkHeals? Pick up to 3.', colors:[{hex:'#2D5C45',name:'Deep Forest'},{hex:'#C4937A',name:'Warm Terra'},{hex:'#8BB5C4',name:'Still Water'},{hex:'#E8D5B0',name:'Warm Cream'},{hex:'#A882B0',name:'Soft Lavender'},{hex:'#C4B482',name:'Golden Sage'},{hex:'#4A4E69',name:'Twilight Blue'},{hex:'#D4A5A5',name:'Rose Petal'},{hex:'#7A9E7E',name:'Sage Green'},{hex:'#2C3E50',name:'Midnight'},{hex:'#F5E6D3',name:'Blush Sand'},{hex:'#6B4226',name:'Earthy Brown'}] },
    { id:'ds2', section:'design', type:'multi',  q:"Which words should someone use to describe TalkHeals' brand? (Choose 3–5)", opts:['Warm & nurturing','Professional & credible','Bold & modern','Calm & serene','Culturally rooted','Approachable & friendly','Sophisticated & refined','Honest & raw','Healing & hopeful','Empowering & strong','Gentle & soft','Trustworthy & safe'] },
    { id:'ds3', section:'design', type:'single', q:'When you think of a website that feels "like home" to you visually — which style resonates most?', opts:['Warm organic — earth tones, soft textures, nature imagery','Clean & airy — lots of white space, simple, modern','Elegant & editorial — rich typography, refined, magazine-like','Vibrant & energetic — bold colours, dynamic layouts','Dark & moody — deep tones, sophisticated, atmospheric'] },
    { id:'ds4', section:'design', type:'text',   q:'Is there a website, brand, or visual reference you admire — in therapy or outside — that captures a feeling you want for TalkHeals?', placeholder:'A URL, a brand name, a description... even a colour or feeling works.', rows:2 },
    { id:'ds5', section:'design', type:'multi',  q:'What do you absolutely NOT want your website to feel like?', opts:['Cold & clinical — like a hospital','Corporate & generic — cookie-cutter','Overly techy — robots and AI imagery','Too feminine / too masculine','Outdated or old-fashioned','Overwhelming with too much information','Too "wellness influencer" — fake positive'] },
    // SERVICES
    { id:'sv1', section:'services', type:'ranking', q:'Rank your services from most to least PASSIONATE about:', items:['Individual Psychotherapy','Couples Therapy','Family Therapy','Parenting Coaching','Pre-Marital Coaching','Clinical Supervision','Workshops & Group Programs'] },
    { id:'sv2', section:'services', type:'single',  q:'What is your PRIMARY therapeutic modality / approach?', opts:['CBT (Cognitive Behavioural Therapy)','Narrative Therapy','Solution-Focused Brief Therapy','Emotion-Focused Therapy','Trauma-Informed / Somatic','Integrative / Holistic — I blend approaches','Culturally-informed / Anti-oppression framework'] },
    { id:'sv3', section:'services', type:'text',    q:'What makes your therapeutic approach genuinely different from every other therapist in Brampton or the GTA? What do you offer that is uniquely Namrata?', placeholder:'Be honest and specific. This is the core of your brand voice.', rows:4 },
    { id:'sv4', section:'services', type:'multi',   q:'Which services do you want to GROW significantly in the next 12 months?', opts:['Online workshop series','Group therapy programs','Corporate / EAP partnerships','Supervision caseload','Pre-marital / couples intensives','Cultural competency training','Digital courses / self-paced programs','Community outreach programs'] },
    { id:'sv5', section:'services', type:'single',  q:'What is your current session capacity — and where do you WANT to be?', opts:['Under 10 clients/week — want to grow significantly','10–20 clients/week — want moderate growth','20–30 clients/week — near capacity, want to optimise','30+ clients/week — at capacity, want to scale differently'] },
    // VISION
    { id:'vs1', section:'vision', type:'text',   q:'In exactly ONE YEAR from today — what does TalkHeals look like? Be as specific and honest as possible.', placeholder:'Revenue, team, services, clients, lifestyle... describe the picture.', rows:4 },
    { id:'vs2', section:'vision', type:'text',   q:'In THREE YEARS — what is the biggest, boldest version of TalkHeals you can imagine?', placeholder:"Don't hold back. What would make you feel deeply proud?", rows:4 },
    { id:'vs3', section:'vision', type:'single', q:'What does financial success look like for TalkHeals in 3 years?', opts:['A stable solo income ($80K–$120K/yr) with low admin stress','A thriving solo practice ($120K–$200K/yr) with premium clients','A small group practice ($200K–$500K/yr) with associate therapists','A platform or brand ($500K+/yr) beyond just therapy sessions','Money is secondary — impact and reach matter most to me'] },
    { id:'vs4', section:'vision', type:'multi',  q:"What is TalkHeals' deeper mission beyond therapy sessions?", opts:['Destigmatising mental health in South Asian communities','Making therapy accessible for lower-income clients','Becoming a trusted voice in culturally-competent care','Training the next generation of therapists','Building bridges between culture and mental health','Creating community and belonging for isolated immigrants'] },
    { id:'vs5', section:'vision', type:'text',   q:'What is your biggest fear or concern about growing TalkHeals? What keeps you up at night?', placeholder:'Be real. This helps us understand what "success" must protect.', rows:3 },
    // STAKES
    { id:'st1', section:'stakes', type:'slider', q:'On a scale of 1–10, how important is this digital transformation to TalkHeals\' future?', min:1, max:10, labels:['Not urgent','Somewhat important','Critical priority'] },
    { id:'st2', section:'stakes', type:'single', q:'What happens if TalkHeals does NOT have a modern digital system in place 6 months from now?', opts:['I continue losing leads to competitors with better websites','I stay burned out on admin and can\'t grow','I miss the window to establish myself as a leading voice','I keep undercharging because I can\'t demonstrate my value','All of the above — it compounds'] },
    { id:'st3', section:'stakes', type:'single', q:'How quickly do you want Phase 1 to be live?', opts:['ASAP — within 4 weeks','Thoughtfully — 6–8 weeks with proper QA','2–3 months — I want to be very involved in every detail','No hard deadline — quality over speed'] },
    { id:'st4', section:'stakes', type:'multi',  q:'Which of these outcomes would make this project a resounding success for you personally?', opts:['I never have to chase a booking email again','New clients find me and book without me lifting a finger','My website finally reflects how good I actually am','I can take a week off and the practice still runs','My community trusts TalkHeals as THE destination for healing',"I'm proud to share my website with anyone, anywhere"] },
    { id:'st5', section:'stakes', type:'text',   q:'Last question — and the most important one. In your own voice: WHY does this matter so deeply to you, personally?', placeholder:'This is just between you and the people building your dream...', rows:5 },
];

/* ─── STATE ─── */
const screen     = ref('intro');
const sectionIdx = ref(0);
const qIdx       = ref(0);
const answers    = ref({});
const rankingState = ref({});
const userName   = ref('');

/* ─── DERIVED ─── */
const currentSection = computed(() => SECTIONS[sectionIdx.value]);
const sectionQs      = computed(() => QUESTIONS.filter(q => q.section === currentSection.value.id));
const currentQ       = computed(() => sectionQs.value[qIdx.value]);
const totalAnswered   = computed(() => Object.keys(answers.value).length);
const progress       = computed(() => (totalAnswered.value / QUESTIONS.length) * 100);

const canProceed = computed(() => {
    const q = currentQ.value;
    if (!q) return false;
    if (q.type === 'ranking') return true;
    if (q.type === 'slider')  return answers.value[q.id] != null;
    const a = answers.value[q.id];
    if (a === null || a === undefined) return false;
    if (typeof a === 'string')  return a.trim().length > 0;
    if (Array.isArray(a))       return a.length > 0;
    return false;
});

const nextLabel = computed(() => {
    const lastQ  = qIdx.value === sectionQs.value.length - 1;
    const lastSec = sectionIdx.value === SECTIONS.length - 1;
    if (lastSec && lastQ) return 'Generate My Analysis ✨';
    if (lastQ) return `Next Section: ${SECTIONS[sectionIdx.value + 1]?.label} →`;
    return 'Continue →';
});

/* ─── WATCH: init ranking & slider ─── */
watch(currentQ, (q) => {
    if (!q) return;
    if (q.type === 'ranking' && !rankingState.value[q.id]) {
        rankingState.value[q.id] = [...q.items];
        answers.value[q.id] = [...q.items];
    }
    // slider: no auto-init, user must pick a value
}, { immediate: true });

/* ─── ACTIONS ─── */
function startQuiz() {
    screen.value = 'quiz';
}

function goNext() {
    if (!canProceed.value) return;
    if (qIdx.value < sectionQs.value.length - 1) {
        qIdx.value++;
    } else if (sectionIdx.value < SECTIONS.length - 1) {
        sectionIdx.value++;
        qIdx.value = 0;
    } else {
        screen.value = 'name';
    }
}

function submitAndFinish() {
    if (!userName.value.trim()) return;
    try {
        const token = document.cookie
            .split(';')
            .map(c => c.trim())
            .find(c => c.startsWith('XSRF-TOKEN='))
            ?.split('=')[1];

        fetch('/private/clientdiscovery/talkheals/discovery/submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-XSRF-TOKEN': token ? decodeURIComponent(token) : '',
            },
            body: JSON.stringify({ name: userName.value.trim(), answers: answers.value }),
        }).catch(() => {});
    } catch {
        // silent
    }
    screen.value = 'results';
}

function goBack() {
    if (qIdx.value > 0) {
        qIdx.value--;
    } else if (sectionIdx.value > 0) {
        sectionIdx.value--;
        qIdx.value = sectionQs.value.length - 1;
    }
}

function retake() {
    screen.value     = 'intro';
    sectionIdx.value = 0;
    qIdx.value       = 0;
    answers.value    = {};
    rankingState.value = {};
}

/* ─── MULTI & COLOR TOGGLES ─── */
function toggleMulti(id, opt) {
    const cur = answers.value[id] || [];
    answers.value[id] = cur.includes(opt) ? cur.filter(x => x !== opt) : [...cur, opt];
}

function toggleColor(id, hex) {
    const cur = answers.value[id] || [];
    if (cur.includes(hex)) {
        answers.value[id] = cur.filter(x => x !== hex);
    } else if (cur.length < 3) {
        answers.value[id] = [...cur, hex];
    }
}

/* ─── RANKING ─── */
function rankMove(id, i, dir) {
    const items = [...(rankingState.value[id] || [])];
    const j = i + dir;
    if (j < 0 || j >= items.length) return;
    [items[i], items[j]] = [items[j], items[i]];
    rankingState.value[id] = items;
    answers.value[id] = [...items];
}

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

/* ── Root ── */
.disc-root {
    min-height: 100vh;
    background: #0E1A14;
    font-family: 'DM Sans', sans-serif;
    color: #F5F0E8;
    -webkit-font-smoothing: antialiased;
}
.disc-shell {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 16px 60px;
}

/* ── Screen transitions ── */
.screen-fade-enter-active,
.screen-fade-leave-active { transition: opacity 0.3s ease; }
.screen-fade-enter-from,
.screen-fade-leave-to     { opacity: 0; }

/* ── Card transitions ── */
.card-anim-enter-active { animation: cardIn  0.45s cubic-bezier(0.22,1,0.36,1) both; }
.card-anim-leave-active { animation: cardOut 0.28s ease forwards; }
@keyframes cardIn  { from { opacity:0; transform:translateY(20px) } to { opacity:1; transform:translateY(0) } }
@keyframes cardOut { from { opacity:1; transform:translateY(0) }  to { opacity:0; transform:translateY(-10px) } }

/* ── Fade-up animations ── */
@keyframes fadeUp { from { opacity:0; transform:translateY(28px) } to { opacity:1; transform:translateY(0) } }
@keyframes floatIcon { 0%,100% { transform:translateY(0) } 50% { transform:translateY(-6px) } }
@keyframes spin { to { transform:rotate(360deg) } }

.fade-up   { animation: fadeUp 0.55s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-2 { animation: fadeUp 0.55s 0.1s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-3 { animation: fadeUp 0.55s 0.2s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-4 { animation: fadeUp 0.55s 0.3s cubic-bezier(0.22,1,0.36,1) both; }

/* ── Shared card ── */
.card-base {
    background: #121F18;
    border: 1px solid #1E3028;
    border-radius: 24px;
    box-shadow: 0 24px 80px rgba(0,0,0,.45);
}

/* ─────────────── INTRO ─────────────── */
.intro-wrap {
    display: flex;
    justify-content: center;
    padding-top: 60px;
    width: 100%;
}
.intro-card {
    background: #121F18;
    border: 1px solid #1E3028;
    border-radius: 24px;
    box-shadow: 0 24px 80px rgba(0,0,0,.45);
    max-width: 520px;
    width: 100%;
    padding: 52px 44px;
    text-align: center;
}
.float-icon {
    font-size: 64px;
    margin-bottom: 16px;
    display: block;
    animation: floatIcon 3s ease-in-out infinite;
}
.intro-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 44px;
    font-weight: 300;
    color: #F5F0E8;
    line-height: 1.2;
    margin-bottom: 8px;
}
.intro-title em { color: #6BAF89; font-style: italic; }
.intro-meta {
    color: #3D6B52;
    font-size: 12px;
    letter-spacing: .1em;
    text-transform: uppercase;
    margin-bottom: 24px;
}
.intro-divider {
    width: 60px;
    height: 1px;
    background: #1E3028;
    margin: 0 auto 24px;
}
.intro-body {
    color: #8AB09A;
    line-height: 1.75;
    font-size: 15px;
    margin-bottom: 12px;
}
.intro-sub {
    color: #5A7A6A;
    line-height: 1.75;
    font-size: 14px;
    margin-bottom: 28px;
}
.terra-text { color: #C4937A; }
.section-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
    margin-bottom: 32px;
}
.section-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border: 1px solid;
    border-radius: 100px;
    font-size: 12px;
}
/* Name input */
.name-input {
    width: 100%;
    padding: 16px 20px;
    background: #1E3028;
    border: 1.5px solid #3D6B52;
    border-radius: 12px;
    color: #E8F5EE;
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    outline: none;
    transition: border-color 0.2s ease;
    box-sizing: border-box;
}
.name-input::placeholder { color: #4A7A5A; }
.name-input:focus { border-color: #6BAF89; box-shadow: 0 0 0 3px rgba(107,175,137,0.15); }

.btn-start {
    width: 100%;
    padding: 16px;
    border-radius: 100px;
    border: none;
    background: #6BAF89;
    color: #0E1A14;
    font-size: 16px;
    font-weight: 700;
    font-family: 'DM Sans', sans-serif;
    cursor: pointer;
    transition: all .25s ease;
}
.btn-start:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(107,175,137,.4); }
.intro-credit { color: #3D6B52; font-size: 12px; margin-top: 16px; }

/* ─────────────── QUIZ ─────────────── */
.topbar {
    width: 100%;
    max-width: 680px;
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px 0 12px;
}
.topbar-logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: 18px;
    font-weight: 600;
    color: #F5F0E8;
    white-space: nowrap;
}
.topbar-logo em { color: #6BAF89; font-style: normal; }
.progress-track {
    flex: 1;
    height: 3px;
    background: #1E3028;
    border-radius: 3px;
    overflow: hidden;
}
.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #6BAF89, #C4937A);
    border-radius: 3px;
    transition: width .5s ease;
}
.progress-count { color: #3D6B52; font-size: 12px; white-space: nowrap; }

.section-tabs {
    width: 100%;
    max-width: 680px;
    display: flex;
    gap: 4px;
    margin-bottom: 24px;
}
.section-tab {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px 4px;
    font-size: 16px;
    transition: all .3s ease;
    cursor: default;
}

.quiz-card {
    background: #121F18;
    border: 1px solid #1E3028;
    border-radius: 24px;
    box-shadow: 0 24px 80px rgba(0,0,0,.45);
    width: 100%;
    max-width: 640px;
    padding: 36px 36px 32px;
}

.sec-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.sec-badge {
    padding: 5px 14px;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .06em;
}
.sec-count { color: #2A4535; font-size: 12px; }

.q-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: 24px;
    font-weight: 600;
    color: #F5F0E8;
    line-height: 1.45;
    margin-bottom: 0;
}

.answer-area { margin-top: 24px; }

.q-textarea {
    width: 100%;
    background: #0A1510;
    border: 1px solid #1E3028;
    border-radius: 14px;
    padding: 16px 18px;
    color: #C8D9CE;
    font-size: 15px;
    line-height: 1.7;
    font-family: 'DM Sans', sans-serif;
    resize: vertical;
    transition: border-color .2s;
    outline: none;
}
.q-textarea:focus { border-color: #3D6B52; }

.opts-list { display: flex; flex-direction: column; gap: 10px; }
.opt-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px 16px;
    border-radius: 12px;
    border: 1px solid;
    cursor: pointer;
    text-align: left;
    font-size: 14px;
    line-height: 1.4;
    transition: all .2s ease;
    width: 100%;
    font-family: 'DM Sans', sans-serif;
}
.opt-btn:hover { border-color: #6BAF89 !important; background: rgba(107,175,137,.08) !important; }

.opt-dot {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    flex-shrink: 0;
    display: inline-block;
    transition: all .2s;
}
.opt-check {
    width: 18px;
    height: 18px;
    border-radius: 5px;
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 800;
    color: #0E1A14;
    transition: all .2s;
}

.hint-text { color: #2A4535; font-size: 12px; font-style: italic; margin-bottom: 12px; }

/* Colors */
.color-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
    margin-bottom: 12px;
}
.color-cell { text-align: center; }
.color-swatch {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    cursor: pointer;
    border: 3px solid transparent;
    transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    margin: 0 auto;
}
.color-swatch:hover  { transform: scale(1.12); }
.color-swatch.selected { border-color: #F5F0E8 !important; }
.color-name { color: #4A7A5A; font-size: 10px; margin-top: 6px; line-height: 1.2; }
.color-preview {
    display: flex;
    gap: 8px;
    align-items: center;
    margin-top: 8px;
}
.color-preview-dot {
    width: 28px;
    height: 28px;
    border-radius: 8px;
    border: 2px solid #2A4535;
}

/* Scale (slider replacement) */
.slider-wrap { display: flex; flex-direction: column; gap: 0; }
.scale-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 14px;
}
.scale-btn {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    border: 1.5px solid #3D6B5240;
    background: #121F18;
    color: #A8C9B5;
    font-size: 17px;
    font-family: 'Cormorant Garamond', serif;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.18s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.scale-btn:hover:not(.active) {
    background: #1E3028;
    color: #E8F5EE;
    border-color: #6BAF8980;
    transform: translateY(-2px);
}
.scale-btn.active {
    transform: translateY(-3px);
    box-shadow: 0 4px 14px #6BAF8940;
    font-size: 19px;
}
.scale-labels {
    display: flex;
    justify-content: space-between;
    color: #3D6B52;
    font-size: 12px;
    margin-bottom: 12px;
    padding: 0 4px;
}
.slider-val-wrap { text-align: center; margin-top: 4px; }
.slider-val {
    display: inline-block;
    padding: 8px 24px;
    border-radius: 100px;
    font-size: 28px;
    font-family: 'Cormorant Garamond', serif;
    font-weight: 700;
}

/* Ranking */
.rank-list { display: flex; flex-direction: column; gap: 8px; }
.rank-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: #0F1E16;
    border-radius: 12px;
    border: 1px solid;
    transition: all .2s;
}
.rank-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 20px;
    font-weight: 700;
    width: 24px;
    flex-shrink: 0;
}
.rank-label { flex: 1; color: #8AB09A; font-size: 14px; }
.rank-arrows { display: flex; flex-direction: column; gap: 2px; }
.rank-arrow {
    background: none;
    border: none;
    color: #3D6B52;
    cursor: pointer;
    font-size: 14px;
    padding: 1px 4px;
    transition: color .2s;
}
.rank-arrow:hover { color: #6BAF89; }

/* Nav */
.quiz-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 28px;
}
.btn-back {
    background: none;
    border: none;
    color: #2A4535;
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    padding: 10px 0;
    cursor: pointer;
    transition: color .2s;
}
.btn-back:hover { color: #A8C9B7; }
.btn-next {
    padding: 13px 28px;
    border-radius: 100px;
    border: none;
    font-size: 15px;
    font-weight: 700;
    font-family: 'DM Sans', sans-serif;
    letter-spacing: .01em;
    transition: all .25s ease;
}
.btn-next:not(:disabled):hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(107,175,137,.35); }

.quiz-footer {
    margin-top: 24px;
    color: #1E3028;
    font-size: 11px;
    letter-spacing: .1em;
    text-transform: uppercase;
}

/* ─────────────── THANK YOU ─────────────── */
.thankyou-wrap {
    display: flex;
    justify-content: center;
    padding-top: 60px;
    width: 100%;
}
.thankyou-card {
    background: #121F18;
    border: 1px solid #1E3028;
    border-radius: 24px;
    box-shadow: 0 24px 80px rgba(0,0,0,.45);
    max-width: 520px;
    width: 100%;
    padding: 52px 44px;
    text-align: center;
}
.thankyou-icon {
    font-size: 64px;
    display: block;
    margin-bottom: 16px;
    animation: floatIcon 3s ease-in-out infinite;
}
.thankyou-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 44px;
    font-weight: 300;
    color: #F5F0E8;
    line-height: 1.2;
    margin-bottom: 0;
}
.thankyou-title em { color: #6BAF89; font-style: italic; }
.thankyou-body {
    color: #8AB09A;
    line-height: 1.75;
    font-size: 15px;
    margin-bottom: 12px;
}
.thankyou-sub {
    color: #5A7A6A;
    line-height: 1.75;
    font-size: 14px;
    margin-bottom: 24px;
}
.thankyou-meta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    border: 1px solid rgba(107,175,137,0.2);
    border-radius: 100px;
    font-size: 12px;
    color: #4A7A5A;
    margin-bottom: 28px;
}
.meta-check { color: #6BAF89; font-weight: 700; }

/* PsychLab nudge */
.psychlab-nudge { margin-top: 32px; width: 100%; }
.nudge-divider {
    width: 60px;
    height: 1px;
    background: linear-gradient(90deg, transparent, #3D6B52, transparent);
    margin: 0 auto 24px;
}
.nudge-text {
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: #5A8A6A;
    line-height: 1.6;
    margin-bottom: 16px;
    text-align: center;
    padding: 0 8px;
}
.nudge-text strong { color: #6BAF89; font-weight: 600; }
.nudge-btn {
    display: inline-block;
    padding: 12px 32px;
    border: 1.5px solid #6BAF89;
    border-radius: 100px;
    color: #6BAF89;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.03em;
    text-decoration: none;
    transition: all 0.22s ease;
}
.nudge-btn:hover {
    background: #6BAF89;
    color: #0E1A14;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(107,175,137,0.35);
}

/* ─── Responsive ─── */
@media (max-width: 560px) {
    .intro-card  { padding: 36px 24px; }
    .intro-title { font-size: 36px; }
    .quiz-card   { padding: 28px 20px; }
    .q-text      { font-size: 20px; }
    .color-grid  { grid-template-columns: repeat(4, 1fr); }
    .color-swatch { width: 44px; height: 44px; }
    .analysis-panel { padding: 24px 20px; }
    .results-title  { font-size: 32px; }
}
</style>
