<template>
    <div class="lab-root">
        <Head><title>TalkHeals · PsychLab</title></Head>

        <Transition name="sf" mode="out-in">

            <!-- ══════════════ INTRO ══════════════ -->
            <div v-if="screen === 'intro'" key="intro" class="lab-shell">
                <div class="intro-wrap">
                    <div class="intro-card fade-up">
                        <div class="float-icon">🔬</div>
                        <h1 class="lab-h1">PsychLab</h1>
                        <p class="lab-sub green">TalkHeals · Psychological Profiling Suite</p>
                        <div class="intro-divider"></div>
                        <p class="lab-body">7 carefully designed psychological games. Each one looks like play. Each one reveals something real.</p>
                        <p class="lab-body-dim">Word associations · Inkblots · Moral dilemmas · Memory tests · Story endings · Forced choices · Emotion mapping</p>
                        <div class="game-pills">
                            <span v-for="g in GAMES" :key="g.id" class="game-pill"
                                :style="{ background: g.color+'18', color: g.color }">
                                {{ g.icon }} {{ g.title }}
                            </span>
                        </div>
                        <button class="btn-primary" @click="screen = 'hub'">Enter the Lab →</button>
                        <p class="fine-print">No right answers · Fully confidential · ~12 minutes</p>
                    </div>
                </div>
            </div>

            <!-- ══════════════ HUB ══════════════ -->
            <div v-else-if="screen === 'hub'" key="hub" class="lab-shell">
                <!-- Top bar -->
                <div class="topbar fade-up">
                    <span class="logo-txt">Psych<span class="green">Lab</span></span>
                    <div class="dot-row">
                        <div v-for="g in GAMES" :key="g.id" class="prog-dot"
                            :style="{ background: completed.includes(g.id) ? g.color : '#1A1A2E', borderColor: completed.includes(g.id) ? g.color : '#2A2A3E' }">
                        </div>
                    </div>
                    <span class="prog-count">{{ completed.length }}/{{ GAMES.length }}</span>
                </div>

                <!-- Hub title -->
                <div class="hub-title fade-up-2">
                    <h1 class="lab-h1" style="font-size:30px;margin-bottom:8px;">7 Games. 1 True Profile.</h1>
                    <p class="lab-body">Each game reveals something you didn't know you were sharing.</p>
                </div>

                <!-- Game grid -->
                <div class="game-grid fade-up-3">
                    <div v-for="g in GAMES" :key="g.id" class="game-card"
                        :class="{ done: completed.includes(g.id) }"
                        :style="{ borderColor: completed.includes(g.id) ? g.color+'55' : '#1A1A2E' }"
                        @click="enterGame(g.id)">
                        <div class="game-icon-wrap" :style="{ background: g.color+'18', color: g.color }">{{ g.icon }}</div>
                        <div class="game-title">{{ g.title }}</div>
                        <div class="game-sub-txt">{{ g.subtitle }}</div>
                        <span v-if="g.timed" class="mini-pill" :style="{ background: g.color+'18', color: g.color }">⏱ Timed</span>
                        <span v-if="completed.includes(g.id)" class="mini-pill done-pill" :style="{ background: g.color+'18', color: g.color }">✓ Done</span>
                    </div>
                </div>

                <!-- Live trait bars -->
                <div class="scores-panel fade-up-4">
                    <p class="lab-sub" style="margin-bottom:14px;">Live Trait Profile</p>
                    <div v-for="k in TRAIT_KEYS" :key="k" class="trait-row">
                        <span class="trait-icon">{{ TRAITS[k].icon }}</span>
                        <span class="trait-label">{{ TRAITS[k].label }}</span>
                        <div class="trait-bar-track">
                            <div class="trait-bar-fill"
                                :style="{ background: `linear-gradient(90deg,${TRAITS[k].color}88,${TRAITS[k].color})`, width: scores[k] + '%' }">
                            </div>
                        </div>
                        <span class="trait-val" :style="{ color: TRAITS[k].color }">{{ Math.round(scores[k]) }}</span>
                    </div>
                </div>

                <!-- CTA -->
                <div v-if="allDone" class="cta-wrap fade-up-4">
                    <button class="btn-primary" @click="generateProfile">Submit Report ✨</button>
                </div>
                <p v-else class="cta-hint">Complete all 7 games to unlock your full profile</p>
            </div>

            <!-- ══════════════ GAME SCREEN ══════════════ -->
            <div v-else-if="screen === 'game'" key="game" class="lab-shell">
                <div class="game-shell-wrap">

                    <!-- Shell header -->
                    <div class="game-shell-hdr fade-up">
                        <span class="gpill-hdr" :style="{ background: activeGameData.color+'18', color: activeGameData.color }">
                            {{ activeGameData.icon }} {{ activeGameData.title }}
                        </span>
                        <div class="progress-track">
                            <div class="progress-fill" :style="{ background: activeGameData.color, width: gameProgress + '%' }"></div>
                        </div>
                        <button class="btn-ghost" @click="exitGame">skip</button>
                    </div>

                    <!-- Game content card with transition between rounds -->
                    <Transition name="ga" mode="out-in">
                        <div class="game-card-inner fade-up-2" :key="roundKey">

                            <!-- ── WORD FLASH ── -->
                            <div v-if="activeGame === 'word'" class="gi tc">
                                <div class="word-flash">{{ WORD_ROUNDS[wordIdx].w }}</div>
                                <p class="game-hint">First word that comes to mind</p>
                                <!-- Timer ring -->
                                <div class="timer-wrap">
                                    <svg width="64" height="64" viewBox="0 0 64 64" style="transform:rotate(-90deg);">
                                        <circle cx="32" cy="32" r="20" fill="none" stroke="#0A0A14" stroke-width="3"/>
                                        <circle cx="32" cy="32" r="20" fill="none" stroke="#6BAF89"
                                            stroke-width="3" stroke-linecap="round"
                                            :stroke-dasharray="TIMER_CIRC"
                                            :stroke-dashoffset="TIMER_CIRC * (1 - timerVal / 10)"
                                            style="transition:stroke-dashoffset 0.9s linear;"/>
                                    </svg>
                                    <span class="timer-num">{{ timerVal }}</span>
                                </div>
                                <div class="word-opts-grid">
                                    <button v-for="opt in WORD_ROUNDS[wordIdx].opts" :key="opt"
                                        class="choice-btn" @click="pickWord(opt)">{{ opt }}</button>
                                </div>
                            </div>

                            <!-- ── INKBLOT ── -->
                            <div v-else-if="activeGame === 'inkblot'" class="gi tc">
                                <p class="game-hint">Don't think. Just react.</p>
                                <div class="inkblot-float" v-html="INKBLOTS[inkIdx].svg"></div>
                                <p class="game-serif" style="color:#8AB09A;font-size:20px;margin:12px 0 22px;">{{ INKBLOTS[inkIdx].prompt }}</p>
                                <div class="opts-col">
                                    <button v-for="opt in INKBLOTS[inkIdx].opts" :key="opt"
                                        class="choice-btn" @click="pickInkblot(opt)">{{ opt }}</button>
                                </div>
                            </div>

                            <!-- ── DILEMMA ── -->
                            <div v-else-if="activeGame === 'dilemma'" class="gi">
                                <div class="timer-wrap" style="margin:0 auto 0;">
                                    <svg width="64" height="64" viewBox="0 0 64 64" style="transform:rotate(-90deg);">
                                        <circle cx="32" cy="32" r="20" fill="none" stroke="#0A0A14" stroke-width="3"/>
                                        <circle cx="32" cy="32" r="20" fill="none" stroke="#F59E0B"
                                            stroke-width="3" stroke-linecap="round"
                                            :stroke-dasharray="TIMER_CIRC"
                                            :stroke-dashoffset="TIMER_CIRC * (1 - timerVal / 10)"
                                            style="transition:stroke-dashoffset 0.9s linear;"/>
                                    </svg>
                                    <span class="timer-num" style="color:#C4937A;">{{ timerVal }}</span>
                                </div>
                                <p class="game-serif dilemma-q">"{{ DILEMMAS[dilIdx].q }}"</p>
                                <div class="opts-col">
                                    <button v-for="opt in DILEMMAS[dilIdx].opts" :key="opt"
                                        class="choice-btn sm" @click="pickDilemma(opt)">{{ opt }}</button>
                                </div>
                            </div>

                            <!-- ── MEMORY: STUDY ── -->
                            <div v-else-if="activeGame === 'memory' && memPhase === 'study'" class="gi tc">
                                <p class="game-hint">Study these 9 symbols carefully.</p>
                                <p style="color:#2A4535;font-size:12px;margin-bottom:16px;font-style:italic;">Your brain will naturally remember what matters most to you.</p>
                                <div class="timer-wrap">
                                    <svg width="64" height="64" viewBox="0 0 64 64" style="transform:rotate(-90deg);">
                                        <circle cx="32" cy="32" r="20" fill="none" stroke="#0A0A14" stroke-width="3"/>
                                        <circle cx="32" cy="32" r="20" fill="none" stroke="#10B981"
                                            stroke-width="3" stroke-linecap="round"
                                            :stroke-dasharray="TIMER_CIRC"
                                            :stroke-dashoffset="TIMER_CIRC * (1 - timerVal / 10)"
                                            style="transition:stroke-dashoffset 0.9s linear;"/>
                                    </svg>
                                    <span class="timer-num" style="color:#6BAF89;">{{ timerVal }}</span>
                                </div>
                                <div class="mem-grid" style="margin-top:20px;">
                                    <div v-for="(e, i) in MEM_ITEMS" :key="e" class="mem-study-cell">
                                        <div class="mem-emoji">{{ e }}</div>
                                        <div class="mem-lbl">{{ MEM_LABELS[i] }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- ── MEMORY: RECALL ── -->
                            <div v-else-if="activeGame === 'memory' && memPhase === 'recall'" class="gi tc">
                                <p class="game-serif" style="color:#A8C9B7;font-size:22px;margin-bottom:6px;">Which symbols do you remember?</p>
                                <p class="game-hint">Pick up to 4. What stuck is what matters to you.</p>
                                <div class="mem-grid">
                                    <div v-for="(e, i) in MEM_ITEMS" :key="e"
                                        class="mem-item"
                                        :class="{ selected: memSelected.includes(e) }"
                                        :style="{ borderColor: memSelected.includes(e) ? '#10B981' : '#1A1A2E', background: memSelected.includes(e) ? 'rgba(16,185,129,.12)' : '#0A0A14' }"
                                        @click="toggleMem(e)">
                                        <div class="mem-emoji">{{ e }}</div>
                                        <div class="mem-lbl">{{ MEM_LABELS[i] }}</div>
                                    </div>
                                </div>
                                <button class="btn-primary" style="margin-top:20px;width:100%;padding:13px;"
                                    :disabled="memSelected.length === 0"
                                    @click="finishMemory">
                                    These are the ones I remember →
                                </button>
                            </div>

                            <!-- ── STORY COMPASS ── -->
                            <div v-else-if="activeGame === 'story'" class="gi tc">
                                <p class="game-hint">Read the story. Choose the ending that feels TRUE to you.</p>
                                <div class="story-block">
                                    <p class="game-serif story-txt">{{ STORIES[storyIdx].setup }}</p>
                                </div>
                                <div class="opts-col">
                                    <button v-for="opt in STORIES[storyIdx].opts" :key="opt"
                                        class="choice-btn sm" style="text-align:left;" @click="pickStory(opt)">{{ opt }}</button>
                                </div>
                            </div>

                            <!-- ── DESERT ISLAND ── -->
                            <div v-else-if="activeGame === 'desert'" class="gi tc">
                                <p class="game-hint">Forced choice — pick ONE. Your gut knows.</p>
                                <div class="desert-emoji float-anim">🏝️</div>
                                <p class="game-serif desert-q">{{ DESERT[desertIdx].q }}</p>
                                <div class="opts-col">
                                    <button v-for="opt in DESERT[desertIdx].opts" :key="opt"
                                        class="choice-btn" @click="pickDesert(opt)">{{ opt }}</button>
                                </div>
                            </div>

                            <!-- ── EMOTION MIRROR ── -->
                            <div v-else-if="activeGame === 'mirror'" class="gi">
                                <p class="game-hint" style="text-align:center;margin-bottom:20px;">
                                    How often do you experience each emotion IN YOUR WORK? Slide honestly.
                                </p>
                                <div v-for="e in EMOTIONS" :key="e.label" class="emotion-row">
                                    <span class="emotion-emoji">{{ e.emoji }}</span>
                                    <div style="flex:1;">
                                        <div class="emotion-top">
                                            <span class="emotion-lbl">{{ e.label }}</span>
                                            <span class="emotion-val mono">{{ EMOTION_LABELS[mirrorRatings[e.label] - 1] }}</span>
                                        </div>
                                        <input type="range" min="1" max="5"
                                            :value="mirrorRatings[e.label]"
                                            style="accent-color:#6BAF89;"
                                            @input="mirrorRatings[e.label] = Number($event.target.value)" />
                                    </div>
                                </div>
                                <button class="btn-primary" style="width:100%;margin-top:24px;padding:13px;"
                                    @click="submitMirror">
                                    Submit My Emotional Profile →
                                </button>
                            </div>

                        </div>
                    </Transition>
                </div>
            </div>

            <!-- ══════════════ NAME + NOTE CAPTURE ══════════════ -->
            <div v-else-if="screen === 'name'" key="name" class="lab-shell">
                <div class="intro-wrap">
                    <div class="intro-card fade-up">
                        <div class="float-icon">✨</div>
                        <h1 class="lab-h1" style="font-size:32px;">Almost There</h1>
                        <p class="lab-sub green">One last step before your profile</p>
                        <div class="intro-divider"></div>
                        <p class="lab-body" style="margin-bottom:24px;">
                            Please share your name so our team can personalise your psychological analysis.
                        </p>

                        <input
                            v-model="userName"
                            type="text"
                            class="lab-name-input"
                            placeholder="Your full name..."
                            @keyup.enter="userName.trim() && submitAndFinish()"
                            autofocus
                        />

                        <div style="margin-top:24px;width:100%;">
                            <p class="note-label">💬 Anything we may have missed?</p>
                            <textarea
                                v-model="userNote"
                                class="note-textarea"
                                placeholder="If something is missed you can tell us here..."
                                rows="3"
                            ></textarea>
                        </div>

                        <button
                            class="btn-primary"
                            style="margin-top:24px;width:100%;"
                            :disabled="!userName.trim()"
                            :style="!userName.trim() ? { opacity: '0.4', cursor: 'not-allowed' } : {}"
                            @click="submitAndFinish"
                        >
                            Submit Report ✨
                        </button>
                    </div>
                </div>
            </div>

            <!-- ══════════════ THANK YOU ══════════════ -->
            <div v-else-if="screen === 'report'" key="report" class="lab-shell">
                <div class="thankyou-wrap">
                    <div class="thankyou-card fade-up">
                        <div class="ty-icon">🔬</div>
                        <h1 class="lab-h1 ty-title">Thank You,<br><em>{{ userName }}.</em></h1>
                        <div class="ty-divider"></div>
                        <p class="lab-body ty-body">
                            All 7 games completed. Your psychological responses have been captured
                            and will inform every design and strategy decision we make for TalkHeals.
                        </p>
                        <p class="lab-body-dim ty-sub">
                            Our team will be in touch soon with what we've discovered.
                        </p>
                        <div class="ty-meta">
                            <span class="ty-check">✓</span>
                            {{ completed.length }} of 7 games completed · Fully confidential
                        </div>
                        <button class="btn-primary" style="margin-top:4px;" @click="screen = 'hub'">← Back to Hub</button>
                        <p class="ty-credit">Nuclear Edge · TalkHeals PsychLab · Brampton, Ontario</p>
                    </div>
                </div>
            </div>

        </Transition>
    </div>
</template>

<script setup>
import { ref, computed, watch, onUnmounted, reactive } from 'vue';
import { Head } from '@inertiajs/vue3';

/* ══════════════════════════════════
   DATA
══════════════════════════════════ */
const TRAITS = {
    openness:   { label: 'Openness',      icon: '🌀', desc: 'Curiosity & comfort with ambiguity',    color: '#8A5CF6' },
    risk:       { label: 'Risk Appetite', icon: '⚡', desc: 'Boldness under uncertainty',             color: '#F59E0B' },
    empathy:    { label: 'Empathy',       icon: '🫀', desc: 'Depth of emotional attunement',          color: '#EC4899' },
    control:    { label: 'Locus',         icon: '🧭', desc: 'Internal vs external locus of control',  color: '#10B981' },
    optimism:   { label: 'Optimism',      icon: '☀️', desc: 'Default orientation toward possibility', color: '#F97316' },
    intuition:  { label: 'Intuition',     icon: '💡', desc: 'Trust in gut over logic',                color: '#06B6D4' },
    resilience: { label: 'Resilience',    icon: '🌿', desc: 'Bounce-back capacity & grit',            color: '#84CC16' },
};
const TRAIT_KEYS = Object.keys(TRAITS);

const GAMES = [
    { id: 'word',    title: 'Word Flash',     subtitle: 'First instinct only',         icon: '⚡', color: '#8A5CF6', timed: true },
    { id: 'inkblot', title: 'Shape Stories',  subtitle: 'What do you see?',            icon: '🔮', color: '#EC4899', timed: false },
    { id: 'dilemma', title: 'Split Seconds',  subtitle: '10 seconds to decide',         icon: '⚖️', color: '#F59E0B', timed: true },
    { id: 'memory',  title: 'Memory Imprint', subtitle: 'What stays with you?',        icon: '🧠', color: '#10B981', timed: false },
    { id: 'story',   title: 'Story Compass',  subtitle: 'You choose the ending',       icon: '📖', color: '#F97316', timed: false },
    { id: 'desert',  title: 'Desert Island',  subtitle: 'Forced choices reveal truth', icon: '🏝️', color: '#06B6D4', timed: false },
    { id: 'mirror',  title: 'Emotion Mirror', subtitle: 'Rate your inner weather',     icon: '🪞', color: '#84CC16', timed: false },
];

const WORD_ROUNDS = [
    { w: 'FAILURE', opts: ['Lesson','Fear','Opportunity','Shame'],         scores: { Lesson:{ resilience:2,optimism:1 }, Fear:{ risk:-2,resilience:-1 }, Opportunity:{ openness:2,optimism:2 }, Shame:{ empathy:-1,resilience:-2 } } },
    { w: 'MONEY',   opts: ['Freedom','Stress','Tool','Success'],           scores: { Freedom:{ control:2,optimism:1 }, Stress:{ resilience:-1,risk:-1 }, Tool:{ control:1,intuition:1 }, Success:{ risk:1,optimism:1 } } },
    { w: 'CLIENT',  opts: ['Person','Challenge','Story','Responsibility'], scores: { Person:{ empathy:2 }, Challenge:{ risk:1,openness:1 }, Story:{ openness:2,empathy:1 }, Responsibility:{ control:2,empathy:1 } } },
    { w: 'CHANGE',  opts: ['Exciting','Scary','Natural','Necessary'],      scores: { Exciting:{ openness:2,risk:2 }, Scary:{ risk:-2,resilience:-1 }, Natural:{ resilience:2,optimism:1 }, Necessary:{ control:1,resilience:1 } } },
    { w: 'SILENCE', opts: ['Peace','Awkward','Clarity','Emptiness'],       scores: { Peace:{ empathy:1,resilience:2 }, Awkward:{ empathy:-1,intuition:-1 }, Clarity:{ intuition:2,control:1 }, Emptiness:{ resilience:-1,optimism:-1 } } },
    { w: 'GROWTH',  opts: ['Slow','Painful','Beautiful','Inevitable'],     scores: { Slow:{ resilience:1,control:1 }, Painful:{ resilience:2,empathy:1 }, Beautiful:{ openness:2,optimism:2 }, Inevitable:{ optimism:2,control:1 } } },
    { w: 'RISK',    opts: ['Necessary','Dangerous','Exciting','Calculated'], scores: { Necessary:{ risk:2,resilience:1 }, Dangerous:{ risk:-2 }, Exciting:{ risk:2,openness:2 }, Calculated:{ control:2,intuition:-1 } } },
    { w: 'TRUST',   opts: ['Earned','Given','Fragile','Essential'],        scores: { Earned:{ control:1,resilience:1 }, Given:{ openness:2,empathy:2 }, Fragile:{ empathy:1,resilience:-1 }, Essential:{ empathy:2,optimism:1 } } },
];

const INKBLOTS = [
    {
        svg: `<svg viewBox="0 0 120 120" width="130" height="130"><ellipse cx="60" cy="60" rx="38" ry="28" fill="#8A5CF6" opacity=".65"/><ellipse cx="45" cy="44" rx="18" ry="12" fill="#8A5CF6" opacity=".5" transform="rotate(-30 45 44)"/><ellipse cx="75" cy="44" rx="18" ry="12" fill="#8A5CF6" opacity=".5" transform="rotate(30 75 44)"/><circle cx="60" cy="68" r="8" fill="#6D28D9" opacity=".6"/></svg>`,
        prompt: 'What is this shape most like to you?',
        opts: ['Two wings ready to fly','A face looking up','Roots of a tree','Two hands reaching'],
        scores: { 'Two wings ready to fly':{ openness:2,optimism:2 }, 'A face looking up':{ empathy:2,intuition:1 }, 'Roots of a tree':{ resilience:2,control:1 }, 'Two hands reaching':{ empathy:2,openness:1 } },
    },
    {
        svg: `<svg viewBox="0 0 120 120" width="130" height="130"><path d="M60 15 L80 55 L110 60 L85 85 L92 115 L60 98 L28 115 L35 85 L10 60 L40 55 Z" fill="#EC4899" opacity=".6"/><circle cx="60" cy="65" r="12" fill="#BE185D" opacity=".7"/></svg>`,
        prompt: 'Your gut says this is…',
        opts: ['A star being born','A crown','Scattered chaos','A shield'],
        scores: { 'A star being born':{ optimism:2,openness:2 }, 'A crown':{ control:2,risk:1 }, 'Scattered chaos':{ resilience:-1,openness:1 }, 'A shield':{ resilience:2,empathy:1 } },
    },
    {
        svg: `<svg viewBox="0 0 120 120" width="130" height="130"><path d="M60 10 Q90 40 90 70 Q90 100 60 110 Q30 100 30 70 Q30 40 60 10Z" fill="#F59E0B" opacity=".6"/><path d="M60 30 Q75 50 75 70 Q75 90 60 95 Q45 90 45 70 Q45 50 60 30Z" fill="#D97706" opacity=".5"/></svg>`,
        prompt: 'This shape makes you feel…',
        opts: ['Grounded and safe','A little unsettled','Curious and drawn in','Warm and protected'],
        scores: { 'Grounded and safe':{ resilience:2,control:2 }, 'A little unsettled':{ openness:1,risk:1 }, 'Curious and drawn in':{ openness:2,intuition:2 }, 'Warm and protected':{ empathy:2,optimism:1 } },
    },
];

const DILEMMAS = [
    { q: 'A new client books, but you sense they\'d do better with a colleague who specialises in their issue. You refer them out. How do you feel?', opts: ['Confident — I did the right thing','A little anxious — what if they think less of me?','Proud — that IS the work','Guilty — I should be able to help everyone'], scores: { 'Confident — I did the right thing':{ control:2,resilience:1 }, 'A little anxious — what if they think less of me?':{ empathy:1,resilience:-1 }, 'Proud — that IS the work':{ empathy:2,control:2 }, 'Guilty — I should be able to help everyone':{ empathy:2,resilience:-1 } } },
    { q: 'Someone offers to invest $20K in TalkHeals — but they want 15% equity and a seat at the table. You…', opts: ['Take it — growth needs fuel','Politely decline — my autonomy is everything','Negotiate hard for better terms','Ask mentors before deciding'], scores: { 'Take it — growth needs fuel':{ risk:2,openness:1 }, 'Politely decline — my autonomy is everything':{ control:2,risk:-1 }, 'Negotiate hard for better terms':{ risk:1,control:2 }, 'Ask mentors before deciding':{ intuition:-1,resilience:1 } } },
    { q: 'You get a glowing media feature — but they slightly misquote your cultural background. You…', opts: ['Correct them publicly, clearly','Let it go — the impact is positive','Correct them privately','Feel paralysed — not sure what\'s right'], scores: { 'Correct them publicly, clearly':{ control:2,resilience:2 }, 'Let it go — the impact is positive':{ optimism:1,risk:-1 }, 'Correct them privately':{ control:1,empathy:1 }, 'Feel paralysed — not sure what\'s right':{ resilience:-2,intuition:-1 } } },
    { q: 'A long-term client tells you they\'ve been lying about their progress. Your first reaction is…', opts: ['Relief — now we can do real work','Hurt — I thought we had trust','Clinical curiosity — why now?','Self-doubt — what did I miss?'], scores: { 'Relief — now we can do real work':{ optimism:2,empathy:2 }, 'Hurt — I thought we had trust':{ empathy:2,resilience:-1 }, 'Clinical curiosity — why now?':{ openness:2,intuition:2 }, 'Self-doubt — what did I miss?':{ empathy:1,resilience:-2 } } },
    { q: 'Your website launches and someone posts a harsh public critique of your brand. You…', opts: ['Respond thoughtfully and publicly','Ignore it — my work speaks','Feel it deeply, then let go','Screenshot it and improve from it'], scores: { 'Respond thoughtfully and publicly':{ control:2,resilience:2 }, 'Ignore it — my work speaks':{ control:2,risk:1 }, 'Feel it deeply, then let go':{ empathy:2,resilience:2 }, 'Screenshot it and improve from it':{ openness:2,optimism:2 } } },
];

const MEM_ITEMS  = ['🌱','📅','💰','👥','🤝','📱','🧘','⭐','🔑'];
const MEM_LABELS = ['Growth','Booking','Revenue','Community','Partnership','Technology','Wellbeing','Excellence','Access'];
const MEM_SCORES = { '🌱':{ openness:2,optimism:1 },'📅':{ control:2 },'💰':{ risk:1,control:1 },'👥':{ empathy:2 },'🤝':{ empathy:2,openness:1 },'📱':{ openness:1,risk:1 },'🧘':{ resilience:2,empathy:1 },'⭐':{ optimism:2,risk:1 },'🔑':{ control:2,intuition:1 } };

const STORIES = [
    { setup: 'A therapist in Brampton has built something beautiful — a full waitlist, a trusted name, a community that needs her. Then a larger clinic offers to absorb her practice. She would earn more, help more people, but lose the TalkHeals name forever. She…', opts: ['Joins — impact over ego, always','Declines — what she built IS the mission','Negotiates — partnership, not absorption','Takes time — decisions this big deserve silence'], scores: { 'Joins — impact over ego, always':{ empathy:2,risk:2 }, 'Declines — what she built IS the mission':{ control:2,resilience:2 }, 'Negotiates — partnership, not absorption':{ control:2,openness:1 }, 'Takes time — decisions this big deserve silence':{ intuition:2,resilience:1 } } },
    { setup: 'She\'s created a free online mental health resource for the South Asian community. It goes viral. A corporation wants to sponsor it for $100K, but their values aren\'t fully aligned. The community is watching. She…', opts: ['Accepts — resources outweigh this compromise','Declines — integrity cannot be priced','Accepts with strict conditions, publicly stated','Asks the community what they think first'], scores: { 'Accepts — resources outweigh this compromise':{ risk:2,empathy:1 }, 'Declines — integrity cannot be priced':{ control:2,resilience:2 }, 'Accepts with strict conditions, publicly stated':{ control:2,empathy:2 }, 'Asks the community what they think first':{ empathy:2,openness:2 } } },
];

const DESERT = [
    { q: 'You can only keep ONE thing from TalkHeals:', opts: ['The community you\'ve built','Your clinical reputation','Your income stream','Your brand identity'], scores: { 'The community you\'ve built':{ empathy:3,optimism:1 }, 'Your clinical reputation':{ control:2,resilience:2 }, 'Your income stream':{ risk:-1,resilience:1 }, 'Your brand identity':{ openness:2,control:2 } } },
    { q: 'You have 1 free hour — you always spend it:', opts: ['Learning something new','Resting fully','Connecting with someone','Creating or building something'], scores: { 'Learning something new':{ openness:3,intuition:1 }, 'Resting fully':{ resilience:2,empathy:1 }, 'Connecting with someone':{ empathy:3 }, 'Creating or building something':{ openness:2,risk:2 } } },
    { q: 'If TalkHeals could only solve ONE problem in the world:', opts: ['Mental health stigma in immigrant communities','Access to affordable therapy','Burnout in helping professions','Generational trauma in South Asian families'], scores: { 'Mental health stigma in immigrant communities':{ empathy:3,openness:1 }, 'Access to affordable therapy':{ empathy:2,optimism:2 }, 'Burnout in helping professions':{ resilience:2,empathy:2 }, 'Generational trauma in South Asian families':{ empathy:3,resilience:1 } } },
    { q: 'The one quality you refuse to lose as TalkHeals grows:', opts: ['My personal touch with every client','My cultural authenticity','My clinical rigor','My honest & fair pricing'], scores: { 'My personal touch with every client':{ empathy:3 }, 'My cultural authenticity':{ control:2,resilience:2 }, 'My clinical rigor':{ control:3 }, 'My honest & fair pricing':{ empathy:2,openness:1 } } },
];

const EMOTIONS = [
    { emoji: '😤', label: 'Frustration',  trait: 'resilience', dir: -1 },
    { emoji: '🤩', label: 'Excitement',   trait: 'openness',   dir:  1 },
    { emoji: '😰', label: 'Anxiety',      trait: 'risk',       dir: -1 },
    { emoji: '🥹', label: 'Being moved',  trait: 'empathy',    dir:  1 },
    { emoji: '🧐', label: 'Curiosity',    trait: 'intuition',  dir:  1 },
    { emoji: '😔', label: 'Self-doubt',   trait: 'resilience', dir: -1 },
    { emoji: '💪', label: 'Confidence',   trait: 'control',    dir:  1 },
    { emoji: '🌈', label: 'Hope',         trait: 'optimism',   dir:  1 },
];
const EMOTION_LABELS = ['Rarely','Sometimes','Often','Frequently','Always'];

const TIMER_CIRC = 2 * Math.PI * 20; // r=20

/* ══════════════════════════════════
   STATE
══════════════════════════════════ */
const screen     = ref('intro');
const activeGame = ref(null);
const completed  = ref([]);
const scores     = reactive(Object.fromEntries(TRAIT_KEYS.map(k => [k, 50])));
const gameData   = reactive({});
const userName   = ref('');
const userNote   = ref('');

// Timer
const timerVal = ref(0);
let   timerInterval = null;

// Per-game state
const wordIdx    = ref(0);
const wordDelta  = ref({});
const inkIdx     = ref(0);
const inkDelta   = ref({});
const dilIdx     = ref(0);
const dilDelta   = ref({});
const dilPicked  = ref(false);
const memPhase   = ref('study');
const memSelected = ref([]);
const storyIdx   = ref(0);
const storyDelta = ref({});
const desertIdx  = ref(0);
const desertDelta = ref({});
const mirrorRatings = reactive(Object.fromEntries(EMOTIONS.map(e => [e.label, 3])));

// Transition key (incremented to trigger round transitions)
const roundKey = ref(0);

/* ══════════════════════════════════
   COMPUTED
══════════════════════════════════ */
const allDone = computed(() => completed.value.length === GAMES.length);

const activeGameData = computed(() => GAMES.find(g => g.id === activeGame.value) || GAMES[0]);

const gameProgress = computed(() => {
    const g = activeGame.value;
    if (g === 'word')    return (wordIdx.value / WORD_ROUNDS.length) * 100;
    if (g === 'inkblot') return (inkIdx.value / INKBLOTS.length) * 100;
    if (g === 'dilemma') return (dilIdx.value / DILEMMAS.length) * 100;
    if (g === 'story')   return (storyIdx.value / STORIES.length) * 100;
    if (g === 'desert')  return (desertIdx.value / DESERT.length) * 100;
    return 0;
});

/* ══════════════════════════════════
   SCORE ENGINE
══════════════════════════════════ */
function applyDelta(delta) {
    Object.entries(delta || {}).forEach(([k, v]) => {
        if (scores[k] !== undefined) {
            scores[k] = Math.min(100, Math.max(0, scores[k] + v * 5));
        }
    });
}

function addDelta(target, delta) {
    Object.entries(delta || {}).forEach(([k, v]) => {
        target[k] = (target[k] || 0) + v;
    });
}

/* ══════════════════════════════════
   TIMER
══════════════════════════════════ */
function startTimer(secs, onZero) {
    clearInterval(timerInterval);
    timerVal.value = secs;
    timerInterval = setInterval(() => {
        timerVal.value--;
        if (timerVal.value <= 0) {
            clearInterval(timerInterval);
            onZero();
        }
    }, 1000);
}
function stopTimer() { clearInterval(timerInterval); }

/* ══════════════════════════════════
   NAVIGATION
══════════════════════════════════ */
function enterGame(id) {
    stopTimer();
    activeGame.value = id;
    roundKey.value = 0;

    // Reset per-game state
    if (id === 'word')    { wordIdx.value = 0; wordDelta.value = {}; }
    if (id === 'inkblot') { inkIdx.value = 0; inkDelta.value = {}; }
    if (id === 'dilemma') { dilIdx.value = 0; dilDelta.value = {}; dilPicked.value = false; }
    if (id === 'memory')  { memPhase.value = 'study'; memSelected.value = []; }
    if (id === 'story')   { storyIdx.value = 0; storyDelta.value = {}; }
    if (id === 'desert')  { desertIdx.value = 0; desertDelta.value = {}; }
    if (id === 'mirror')  { EMOTIONS.forEach(e => mirrorRatings[e.label] = 3); }

    screen.value = 'game';

    // Start timers for timed games
    if (id === 'word')    { setTimeout(() => startWordTimer(), 50); }
    if (id === 'dilemma') { setTimeout(() => startDilTimer(), 50); }
    if (id === 'memory')  { setTimeout(() => startMemTimer(), 50); }
}

function exitGame() {
    stopTimer();
    screen.value = 'hub';
}

/* ══════════════════════════════════
   GAME 1 — WORD FLASH
══════════════════════════════════ */
function startWordTimer() {
    startTimer(10, () => pickWord(null));
}
function pickWord(opt) {
    stopTimer();
    if (opt && WORD_ROUNDS[wordIdx.value].scores[opt]) {
        addDelta(wordDelta.value, WORD_ROUNDS[wordIdx.value].scores[opt]);
    }
    wordIdx.value++;
    if (wordIdx.value >= WORD_ROUNDS.length) {
        applyDelta(wordDelta.value);
        if (!completed.value.includes('word')) completed.value.push('word');
        screen.value = 'hub';
    } else {
        roundKey.value++;
        setTimeout(startWordTimer, 100);
    }
}

/* ══════════════════════════════════
   GAME 2 — INKBLOT
══════════════════════════════════ */
function pickInkblot(opt) {
    if (INKBLOTS[inkIdx.value].scores[opt]) {
        addDelta(inkDelta.value, INKBLOTS[inkIdx.value].scores[opt]);
    }
    inkIdx.value++;
    if (inkIdx.value >= INKBLOTS.length) {
        applyDelta(inkDelta.value);
        if (!completed.value.includes('inkblot')) completed.value.push('inkblot');
        screen.value = 'hub';
    } else {
        roundKey.value++;
    }
}

/* ══════════════════════════════════
   GAME 3 — DILEMMA
══════════════════════════════════ */
function startDilTimer() {
    dilPicked.value = false;
    startTimer(10, () => { if (!dilPicked.value) pickDilemma(null); });
}
function pickDilemma(opt) {
    if (dilPicked.value) return;
    dilPicked.value = true;
    stopTimer();
    if (opt && DILEMMAS[dilIdx.value].scores[opt]) {
        addDelta(dilDelta.value, DILEMMAS[dilIdx.value].scores[opt]);
    }
    dilIdx.value++;
    if (dilIdx.value >= DILEMMAS.length) {
        applyDelta(dilDelta.value);
        if (!completed.value.includes('dilemma')) completed.value.push('dilemma');
        screen.value = 'hub';
    } else {
        roundKey.value++;
        setTimeout(startDilTimer, 100);
    }
}

/* ══════════════════════════════════
   GAME 4 — MEMORY
══════════════════════════════════ */
function startMemTimer() {
    startTimer(6, () => {
        memPhase.value = 'recall';
        roundKey.value++;
    });
}
function toggleMem(emoji) {
    const sel = memSelected.value;
    if (sel.includes(emoji)) {
        memSelected.value = sel.filter(x => x !== emoji);
    } else if (sel.length < 4) {
        memSelected.value = [...sel, emoji];
    }
}
function finishMemory() {
    const delta = {};
    memSelected.value.forEach(e => {
        if (MEM_SCORES[e]) addDelta(delta, MEM_SCORES[e]);
    });
    applyDelta(delta);
    if (!completed.value.includes('memory')) completed.value.push('memory');
    screen.value = 'hub';
}

/* ══════════════════════════════════
   GAME 5 — STORY COMPASS
══════════════════════════════════ */
function pickStory(opt) {
    if (STORIES[storyIdx.value].scores[opt]) {
        addDelta(storyDelta.value, STORIES[storyIdx.value].scores[opt]);
    }
    storyIdx.value++;
    if (storyIdx.value >= STORIES.length) {
        applyDelta(storyDelta.value);
        if (!completed.value.includes('story')) completed.value.push('story');
        screen.value = 'hub';
    } else {
        roundKey.value++;
    }
}

/* ══════════════════════════════════
   GAME 6 — DESERT ISLAND
══════════════════════════════════ */
function pickDesert(opt) {
    if (DESERT[desertIdx.value].scores[opt]) {
        addDelta(desertDelta.value, DESERT[desertIdx.value].scores[opt]);
    }
    desertIdx.value++;
    if (desertIdx.value >= DESERT.length) {
        applyDelta(desertDelta.value);
        if (!completed.value.includes('desert')) completed.value.push('desert');
        screen.value = 'hub';
    } else {
        roundKey.value++;
    }
}

/* ══════════════════════════════════
   GAME 7 — EMOTION MIRROR
══════════════════════════════════ */
function submitMirror() {
    const delta = {};
    EMOTIONS.forEach(e => {
        const normalised = mirrorRatings[e.label] - 3;
        const v = normalised * e.dir * 2;
        delta[e.trait] = (delta[e.trait] || 0) + v;
    });
    applyDelta(delta);
    if (!completed.value.includes('mirror')) completed.value.push('mirror');
    screen.value = 'hub';
}

function generateProfile() {
    screen.value = 'name';
}

function submitAndFinish() {
    if (!userName.value.trim()) return;
    submitResults();
    screen.value = 'report';
}

function submitResults() {
    try {
        const token = document.cookie
            .split(';')
            .map(c => c.trim())
            .find(c => c.startsWith('XSRF-TOKEN='))
            ?.split('=')[1];

        fetch('/private/clientdiscovery/talkheals/psychlab/submit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-XSRF-TOKEN': token ? decodeURIComponent(token) : '',
            },
            body: JSON.stringify({
                name:            userName.value.trim(),
                scores:          { ...scores },
                completed_games: completed.value,
                note:            userNote.value.trim() || null,
            }),
        }).catch(() => {}); // silent — thank you screen always shows
    } catch {
        // silent
    }
}

/* ══════════════════════════════════
   CLEANUP
══════════════════════════════════ */
onUnmounted(() => stopTimer());
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

/* ── Root ── */
.lab-root {
    min-height: 100vh;
    background: #0E1A14;
    font-family: 'DM Sans', sans-serif;
    color: #F5F0E8;
    -webkit-font-smoothing: antialiased;
}
.lab-shell {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 16px 80px;
}

/* ── Screen transitions ── */
.sf-enter-active, .sf-leave-active { transition: opacity 0.3s ease; }
.sf-enter-from, .sf-leave-to       { opacity: 0; }

/* ── Game round transitions ── */
.ga-enter-active { animation: cardIn 0.35s cubic-bezier(0.22,1,0.36,1) both; }
.ga-leave-active { animation: cardOut 0.22s ease forwards; }
@keyframes cardIn  { from { opacity:0; transform:translateY(16px) } to { opacity:1; transform:translateY(0) } }
@keyframes cardOut { from { opacity:1; } to { opacity:0; transform:translateY(-8px) } }

/* ── Fade-up ── */
@keyframes fadeUp    { from { opacity:0; transform:translateY(24px) } to { opacity:1; transform:translateY(0) } }
@keyframes floatAnim { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }

.fade-up   { animation: fadeUp 0.5s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-2 { animation: fadeUp 0.5s 0.1s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-3 { animation: fadeUp 0.5s 0.2s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-4 { animation: fadeUp 0.5s 0.3s cubic-bezier(0.22,1,0.36,1) both; }
.float-anim { animation: floatAnim 3s ease-in-out infinite; }

/* ── Typography ── */
.lab-h1       { font-family: 'Cormorant Garamond', serif; font-size: 40px; font-weight: 300; color: #F5F0E8; line-height: 1.2; margin-bottom: 0; }
.lab-sub      { font-size: 13px; letter-spacing: .08em; text-transform: uppercase; color: #3D6B52; }
.lab-body     { color: #8AB09A; font-size: 15px; line-height: 1.8; }
.lab-body-dim { color: #5A7A6A; font-size: 14px; line-height: 1.8; }
.green        { color: #6BAF89; }
.game-serif   { font-family: 'Cormorant Garamond', serif; font-style: italic; }

/* ─────────────── INTRO ─────────────── */
.intro-wrap { display: flex; justify-content: center; padding-top: 60px; width: 100%; }
.intro-card {
    background: #121F18;
    border: 1px solid #1E3028;
    border-radius: 24px;
    padding: 52px 44px;
    box-shadow: 0 24px 80px rgba(0,0,0,.45);
    max-width: 520px;
    width: 100%;
    text-align: center;
}
.float-icon { font-size: 64px; display: block; margin-bottom: 16px; animation: floatAnim 3s ease-in-out infinite; }
.intro-divider { width: 60px; height: 1px; background: #1E3028; margin: 24px auto; }
.game-pills { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin: 20px 0 28px; }
.game-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 5px 14px; border-radius: 100px;
    font-size: 12px; font-weight: 600; letter-spacing: .06em;
}
.fine-print { color: #3D6B52; font-size: 12px; text-align: center; margin-top: 16px; }

/* ─────────────── BUTTONS ─────────────── */
.btn-primary {
    padding: 16px 36px; border-radius: 100px; border: none;
    background: #6BAF89;
    color: #0E1A14; font-family: 'DM Sans', sans-serif;
    font-size: 16px; font-weight: 700; cursor: pointer;
    transition: all .25s ease; letter-spacing: .01em;
    width: 100%;
}
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(107,175,137,.4); }
.btn-primary:disabled { background: #1E3028; color: #3D6B52; cursor: not-allowed; transform: none; box-shadow: none; }

.btn-ghost {
    background: none; border: 1px solid #1E3028; color: #3D6B52;
    padding: 10px 20px; border-radius: 100px;
    font-family: 'DM Sans', sans-serif; font-size: 12px;
    cursor: pointer; transition: all .2s;
}
.btn-ghost:hover { border-color: #3D6B52; color: #8AB09A; }
.btn-ghost.lg { padding: 12px 28px; font-size: 14px; }

/* ─────────────── HUB ─────────────── */
.topbar {
    width: 100%; max-width: 680px;
    display: flex; align-items: center; gap: 16px;
    padding: 20px 0 8px;
}
.logo-txt {
    font-family: 'Cormorant Garamond', serif;
    font-size: 22px; font-weight: 600; color: #F5F0E8;
}
.logo-txt .green { font-style: italic; }
.dot-row  { display: flex; gap: 6px; flex: 1; justify-content: center; }
.prog-dot { width: 8px; height: 8px; border-radius: 50%; border: 1px solid; transition: all .3s; }
.prog-count { color: #3D6B52; font-size: 12px; }

.hub-title { width: 100%; max-width: 680px; text-align: center; margin-bottom: 28px; }

.game-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(148px, 1fr));
    gap: 12px;
    width: 100%;
    max-width: 680px;
    margin-bottom: 24px;
}
.game-card {
    background: #121F18; border: 1px solid #1E3028;
    border-radius: 20px; padding: 20px 16px;
    cursor: pointer; transition: all .25s ease;
    position: relative;
}
.game-card:hover { border-color: #3D6B52; transform: translateY(-2px); box-shadow: 0 8px 32px rgba(0,0,0,.4); }
.game-card.done { opacity: .7; }
.game-icon-wrap {
    display: inline-flex; align-items: center; justify-content: center;
    padding: 10px; border-radius: 12px; font-size: 22px; margin-bottom: 10px;
}
.game-title   { color: #A8C9B7; font-size: 13px; font-weight: 600; margin-bottom: 4px; }
.game-sub-txt { color: #3D6B52; font-size: 11px; line-height: 1.4; }
.mini-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 3px 10px; border-radius: 100px;
    font-size: 10px; font-weight: 700; letter-spacing: .06em;
    margin-top: 8px;
}

.scores-panel {
    width: 100%; max-width: 680px;
    background: #121F18; border: 1px solid #1E3028;
    border-radius: 20px; padding: 20px 24px; margin-bottom: 20px;
}
.trait-row { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
.trait-icon  { font-size: 16px; width: 22px; flex-shrink: 0; }
.trait-label { font-size: 12px; color: #3D6B52; width: 90px; flex-shrink: 0; }
.trait-bar-track { flex: 1; height: 6px; background: #0A1510; border-radius: 3px; overflow: hidden; }
.trait-bar-fill  { height: 100%; border-radius: 3px; transition: width 1.2s cubic-bezier(0.22,1,0.36,1); }
.trait-val { font-family: 'Cormorant Garamond', serif; font-size: 18px; font-weight: 700; width: 36px; text-align: right; }

/* Name + note capture */
.lab-name-input {
    width: 100%;
    padding: 16px 20px;
    background: #1A2E22;
    border: 1.5px solid #3D6B52;
    border-radius: 12px;
    color: #E8F5EE;
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    outline: none;
    transition: border-color 0.2s ease;
    box-sizing: border-box;
}
.lab-name-input::placeholder { color: #4A7A5A; }
.lab-name-input:focus { border-color: #6BAF89; box-shadow: 0 0 0 3px rgba(107,175,137,0.15); }

/* Note field */
.note-wrap { width: 100%; max-width: 560px; margin-top: 28px; }
.note-label { font-family: 'DM Sans', sans-serif; font-size: 13px; color: #6BAF89; margin-bottom: 10px; font-weight: 500; }
.note-textarea {
    width: 100%;
    background: #121F18;
    border: 1.5px solid #1E3028;
    border-radius: 12px;
    color: #C8E6D4;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    line-height: 1.6;
    padding: 14px 16px;
    resize: vertical;
    outline: none;
    transition: border-color 0.2s ease;
    box-sizing: border-box;
}
.note-textarea::placeholder { color: #3D6B52; }
.note-textarea:focus { border-color: #6BAF89; box-shadow: 0 0 0 3px rgba(107,175,137,0.12); }

.cta-wrap { text-align: center; margin-top: 8px; width: 100%; max-width: 320px; }
.cta-hint { color: #2A4535; font-size: 13px; text-align: center; margin-top: 8px; }

/* ─────────────── GAME SHELL ─────────────── */
.game-shell-wrap { width: 100%; max-width: 580px; padding-top: 24px; }
.game-shell-hdr {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 20px;
}
.gpill-hdr {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 5px 14px; border-radius: 100px;
    font-size: 13px; font-weight: 600; letter-spacing: .06em; white-space: nowrap;
}
.progress-track { flex: 1; height: 3px; background: #0A1510; border-radius: 3px; overflow: hidden; }
.progress-fill  { height: 100%; border-radius: 3px; transition: width .6s cubic-bezier(0.22,1,0.36,1); }

.game-card-inner {
    background: #121F18; border: 1px solid #1E3028;
    border-radius: 24px; padding: 36px;
    box-shadow: 0 24px 80px rgba(0,0,0,.45);
}

/* Game inner helpers */
.gi { /* game inner */ }
.tc { text-align: center; }
.game-hint { color: #3D6B52; font-size: 13px; margin-bottom: 16px; font-style: italic; }

/* ── Word Flash ── */
.word-flash {
    font-family: 'Cormorant Garamond', serif;
    font-size: 60px; font-weight: 600; color: #6BAF89;
    letter-spacing: -.01em; margin-bottom: 6px;
    text-shadow: 0 0 40px rgba(107,175,137,.35);
    animation: floatAnim 2s ease-in-out infinite;
}
.word-opts-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 24px; }

/* ── Choice buttons ── */
.choice-btn {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 18px; border-radius: 14px;
    border: 1px solid #1E3028; background: #0F1E16;
    cursor: pointer; font-family: 'DM Sans', sans-serif;
    font-size: 14px; font-weight: 400; color: #8AB09A;
    text-align: left; width: 100%;
    transition: all .22s ease; line-height: 1.5;
}
.choice-btn:hover { border-color: #6BAF89; background: rgba(107,175,137,.08); color: #F5F0E8; transform: translateY(-1px); }
.choice-btn.sm    { font-size: 13.5px; }
.opts-col { display: flex; flex-direction: column; gap: 10px; }

/* ── Timer ring ── */
.timer-wrap {
    position: relative; width: 64px; height: 64px;
    margin: 0 auto 20px;
}
.timer-num {
    position: absolute; top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px; font-weight: 700; color: #F5F0E8;
}

/* ── Inkblot ── */
.inkblot-float {
    display: flex; justify-content: center; margin: 8px 0 16px;
    filter: drop-shadow(0 0 24px rgba(107,175,137,.25));
    animation: floatAnim 3s ease-in-out infinite;
}

/* ── Dilemma ── */
.dilemma-q {
    font-family: 'Cormorant Garamond', serif;
    color: #A8C9B7; font-size: 20px; line-height: 1.65;
    margin: 20px 0 22px; text-align: center;
}

/* ── Memory ── */
.mem-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 14px; max-width: 290px; margin: 0 auto;
}
.mem-study-cell { text-align: center; padding: 12px 6px; }
.mem-emoji { font-size: 36px; margin-bottom: 4px; }
.mem-lbl   { color: #2A4535; font-size: 11px; }
.mem-item {
    text-align: center; padding: 16px 8px;
    border-radius: 14px; border: 2px solid;
    background: #0A1510; cursor: pointer; transition: all .2s;
}
.mem-item:hover { border-color: #6BAF89 !important; background: rgba(107,175,137,.06); }
.mem-item.selected { background: rgba(107,175,137,.12); }

/* ── Story ── */
.story-block {
    background: #0A1510; border: 1px solid #1E3028;
    border-radius: 16px; padding: 20px 24px; margin-bottom: 22px;
    text-align: left;
}
.story-txt { color: #8AB09A; font-size: 17px; line-height: 1.8; }

/* ── Desert ── */
.desert-emoji { font-size: 48px; margin: 10px 0 16px; }
.desert-q {
    font-family: 'Cormorant Garamond', serif;
    color: #F5F0E8; font-size: 24px; line-height: 1.45;
    margin-bottom: 26px; display: block;
}

/* ── Emotion Mirror ── */
.emotion-row { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
.emotion-emoji { font-size: 28px; width: 36px; flex-shrink: 0; }
.emotion-top   { display: flex; justify-content: space-between; margin-bottom: 5px; }
.emotion-lbl   { font-size: 13px; color: #8AB09A; }
.emotion-val   { font-size: 13px; min-width: 72px; text-align: right; color: #6BAF89; }

input[type=range] {
    -webkit-appearance: none; width: 100%; height: 5px;
    border-radius: 3px; background: #1E3028;
    outline: none; cursor: pointer;
}
input[type=range]::-webkit-slider-thumb {
    -webkit-appearance: none; width: 18px; height: 18px;
    background: #6BAF89; border-radius: 50%;
    cursor: pointer; transition: transform .2s;
}
input[type=range]::-webkit-slider-thumb:hover { transform: scale(1.2); }

/* ─────────────── THANK YOU ─────────────── */
.thankyou-wrap { display: flex; justify-content: center; padding-top: 60px; width: 100%; }
.thankyou-card {
    background: #121F18; border: 1px solid #1E3028;
    border-radius: 24px; padding: 52px 44px;
    box-shadow: 0 24px 80px rgba(0,0,0,.45);
    max-width: 520px; width: 100%; text-align: center;
}
.ty-icon   { font-size: 64px; display: block; margin-bottom: 16px; animation: floatAnim 3s ease-in-out infinite; }
.ty-title  { font-family: 'Cormorant Garamond', serif; font-size: 44px; font-weight: 300; color: #F5F0E8; line-height: 1.2; margin-bottom: 0; }
.ty-title em { color: #6BAF89; font-style: italic; }
.ty-divider  { width: 60px; height: 1px; background: #1E3028; margin: 24px auto; }
.ty-body   { color: #8AB09A; margin-bottom: 12px; font-size: 15px; line-height: 1.75; }
.ty-sub    { color: #5A7A6A; margin-bottom: 24px; font-size: 14px; line-height: 1.75; }
.ty-meta {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 8px 20px; border: 1px solid rgba(107,175,137,0.2);
    border-radius: 100px; font-size: 12px; color: #4A7A5A;
    margin-bottom: 28px;
}
.ty-check  { color: #6BAF89; font-weight: 700; }
.ty-credit { color: #1E3028; font-size: 11px; text-align: center; margin-top: 16px; }

/* ─── Responsive ─── */
@media (max-width: 560px) {
    .intro-card      { padding: 36px 24px; }
    .lab-h1          { font-size: 32px; }
    .game-grid       { grid-template-columns: 1fr 1fr; }
    .game-card-inner { padding: 24px 20px; }
    .word-flash      { font-size: 48px; }
    .word-opts-grid  { grid-template-columns: 1fr; }
}
</style>
