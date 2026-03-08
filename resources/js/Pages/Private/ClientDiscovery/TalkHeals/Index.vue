<template>
    <div class="talkheals-root">
        <Head>
            <title>TalkHeals · Client Discovery Portal</title>
            <link
                href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap"
                rel="stylesheet"
            />
        </Head>

        <!-- Ambient background orbs -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <!-- Dot grid overlay -->
        <div class="dot-grid"></div>

        <div class="portal-shell">
            <!-- Header -->
            <header class="portal-header fade-up">
                <div class="portal-badge">
                    <span class="badge-dot"></span>
                    Private Client Portal
                </div>
                <div class="portal-logo">
                    Talk<span>Heals</span>
                </div>
                <p class="portal-tagline">Powered by Nuclear Edge</p>
            </header>

            <!-- Hero copy -->
            <div class="hero-copy fade-up-2">
                <h1 class="hero-title">
                    Where would you<br />
                    <em>like to begin?</em>
                </h1>
                <p class="hero-sub">
                    Choose your path below. Each space is designed specifically for your practice.
                </p>
            </div>

            <!-- Two cards -->
            <div class="cards-grid fade-up-3">

                <!-- Discovery Card -->
                <Link href="/private/clientdiscovery/talkheals/discovery" class="portal-card card-discovery">
                    <div class="card-glow glow-green"></div>

                    <div class="card-icon-wrap icon-green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/>
                        </svg>
                    </div>

                    <div class="card-label label-green">Deep Dive</div>

                    <h2 class="card-title">Discovery</h2>
                    <p class="card-desc">
                        A rich, 28-question psychological exploration of who you are, who you serve,
                        and what TalkHeals is truly meant to become. Generates a full AI-powered
                        strategic report at the end.
                    </p>

                    <div class="card-meta">
                        <span class="meta-pill">🌿 6 Sections</span>
                        <span class="meta-pill">📋 28 Questions</span>
                        <span class="meta-pill">⏱ ~10 Min</span>
                        <span class="meta-pill">🔒 Confidential</span>
                    </div>

                    <div class="card-cta">
                        <span>Begin Discovery</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>

                    <div class="card-corner-accent accent-green"></div>
                </Link>

                <!-- Psychlab Card -->
                <Link href="/private/clientdiscovery/talkheals/psychlab" class="portal-card card-psychlab">
                    <div class="card-glow glow-terra"></div>

                    <div class="card-icon-wrap icon-terra">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/>
                        </svg>
                    </div>

                    <div class="card-label label-terra">In Progress</div>

                    <h2 class="card-title">Psychlab</h2>
                    <p class="card-desc">
                        An interactive workspace for clinical tools, session templates, and
                        psychometric instruments. Built for your practice's daily operational rhythm
                        and clinical excellence.
                    </p>

                    <div class="card-meta">
                        <span class="meta-pill">🧠 Clinical Tools</span>
                        <span class="meta-pill">📊 Templates</span>
                        <span class="meta-pill">🔬 Instruments</span>
                        <span class="meta-pill">⚡ Live</span>
                    </div>

                    <div class="card-cta">
                        <span>Open Psychlab</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>

                    <div class="card-corner-accent accent-terra"></div>
                </Link>

            </div>

            <!-- Footer note -->
            <footer class="portal-footer fade-up-4">
                <p>Designed exclusively for Namrata Mam · TalkHeals Psychotherapy · Brampton, Ontario</p>
                <p class="footer-year">© {{ currentYear }} Nuclear Edge · All Rights Reserved · Strictly Private</p>
            </footer>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

const currentYear = new Date().getFullYear();
</script>

<style scoped>
/* ── Google Fonts ── */
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

/* ── Root ── */
.talkheals-root {
    min-height: 100vh;
    background: #0A1510;
    font-family: 'DM Sans', sans-serif;
    color: #F5F0E8;
    position: relative;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
}

/* ── Ambient orbs ── */
.orb {
    position: fixed;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
    z-index: 0;
}
.orb-1 {
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(107,175,137,0.12) 0%, transparent 70%);
    top: -200px;
    left: -150px;
    animation: driftA 18s ease-in-out infinite alternate;
}
.orb-2 {
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(196,147,122,0.10) 0%, transparent 70%);
    bottom: -150px;
    right: -100px;
    animation: driftB 22s ease-in-out infinite alternate;
}
.orb-3 {
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(139,157,195,0.07) 0%, transparent 70%);
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    animation: driftC 14s ease-in-out infinite alternate;
}

/* ── Dot grid ── */
.dot-grid {
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image: radial-gradient(circle, rgba(107,175,137,0.08) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
}

/* ── Shell ── */
.portal-shell {
    position: relative;
    z-index: 1;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 48px 24px 40px;
}

/* ── Header ── */
.portal-header {
    text-align: center;
    margin-bottom: 52px;
}
.portal-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    border: 1px solid rgba(107,175,137,0.3);
    border-radius: 100px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #6BAF89;
    margin-bottom: 20px;
}
.badge-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #6BAF89;
    animation: pulse-dot 2s ease-in-out infinite;
}
.portal-logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(40px, 6vw, 64px);
    font-weight: 300;
    color: #F5F0E8;
    letter-spacing: -0.01em;
    line-height: 1;
    margin-bottom: 10px;
}
.portal-logo span {
    color: #6BAF89;
    font-style: italic;
}
.portal-tagline {
    font-size: 12px;
    color: #2A4535;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

/* ── Hero copy ── */
.hero-copy {
    text-align: center;
    max-width: 560px;
    margin-bottom: 56px;
}
.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(32px, 4.5vw, 52px);
    font-weight: 400;
    line-height: 1.2;
    color: #F5F0E8;
    margin-bottom: 14px;
}
.hero-title em {
    color: #6BAF89;
    font-style: italic;
}
.hero-sub {
    font-size: 15px;
    line-height: 1.7;
    color: #5A7A6A;
}

/* ── Cards grid ── */
.cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    width: 100%;
    max-width: 900px;
}

/* ── Portal card base ── */
.portal-card {
    position: relative;
    background: #121F18;
    border: 1px solid #1A2E22;
    border-radius: 24px;
    padding: 40px 36px 36px;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    gap: 0;
    overflow: hidden;
    transition: transform 0.35s cubic-bezier(0.22,1,0.36,1),
                border-color 0.35s ease,
                box-shadow 0.35s ease;
}
.portal-card:hover {
    transform: translateY(-6px);
}

/* ── Glow ── */
.card-glow {
    position: absolute;
    inset: 0;
    opacity: 0;
    border-radius: 24px;
    transition: opacity 0.4s ease;
    pointer-events: none;
}
.portal-card:hover .card-glow {
    opacity: 1;
}
.glow-green {
    background: radial-gradient(ellipse at 30% 20%, rgba(107,175,137,0.12) 0%, transparent 65%);
}
.glow-terra {
    background: radial-gradient(ellipse at 30% 20%, rgba(196,147,122,0.12) 0%, transparent 65%);
}

.card-discovery:hover {
    border-color: rgba(107,175,137,0.4);
    box-shadow: 0 24px 60px rgba(107,175,137,0.12), 0 0 0 1px rgba(107,175,137,0.15);
}
.card-psychlab:hover {
    border-color: rgba(196,147,122,0.4);
    box-shadow: 0 24px 60px rgba(196,147,122,0.12), 0 0 0 1px rgba(196,147,122,0.15);
}

/* ── Icon ── */
.card-icon-wrap {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    flex-shrink: 0;
}
.card-icon-wrap svg {
    width: 26px;
    height: 26px;
}
.icon-green {
    background: rgba(107,175,137,0.12);
    color: #6BAF89;
    border: 1px solid rgba(107,175,137,0.2);
}
.icon-terra {
    background: rgba(196,147,122,0.12);
    color: #C4937A;
    border: 1px solid rgba(196,147,122,0.2);
}

/* ── Label ── */
.card-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    margin-bottom: 8px;
}
.label-green { color: #6BAF89; }
.label-terra  { color: #C4937A; }

/* ── Title ── */
.card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 36px;
    font-weight: 600;
    color: #F5F0E8;
    margin-bottom: 14px;
    line-height: 1.1;
}

/* ── Description ── */
.card-desc {
    font-size: 14px;
    line-height: 1.75;
    color: #6A8A76;
    margin-bottom: 24px;
    flex: 1;
}

/* ── Meta pills ── */
.card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 28px;
}
.meta-pill {
    padding: 5px 11px;
    border-radius: 100px;
    border: 1px solid #1E3028;
    background: #0A1510;
    font-size: 11px;
    color: #4A7A5A;
}

/* ── CTA ── */
.card-cta {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 600;
    transition: gap 0.25s ease;
}
.card-cta svg {
    width: 18px;
    height: 18px;
    transition: transform 0.25s ease;
}
.portal-card:hover .card-cta {
    gap: 14px;
}
.portal-card:hover .card-cta svg {
    transform: translateX(4px);
}
.card-discovery .card-cta { color: #6BAF89; }
.card-psychlab  .card-cta { color: #C4937A; }

/* ── Corner accent ── */
.card-corner-accent {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 120px;
    height: 120px;
    border-radius: 24px 0 24px 0;
    opacity: 0.06;
    transition: opacity 0.3s ease;
}
.portal-card:hover .card-corner-accent {
    opacity: 0.12;
}
.accent-green { background: radial-gradient(circle at bottom right, #6BAF89, transparent 70%); }
.accent-terra  { background: radial-gradient(circle at bottom right, #C4937A, transparent 70%); }

/* ── Footer ── */
.portal-footer {
    margin-top: 56px;
    text-align: center;
    color: #2A4535;
    font-size: 12px;
    line-height: 1.8;
}
.footer-year {
    color: #1E3028;
    font-size: 11px;
}

/* ── Animations ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes driftA {
    from { transform: translate(0,0) scale(1); }
    to   { transform: translate(60px, 40px) scale(1.1); }
}
@keyframes driftB {
    from { transform: translate(0,0) scale(1); }
    to   { transform: translate(-50px, -40px) scale(1.08); }
}
@keyframes driftC {
    from { transform: translate(-50%,-50%) scale(1); }
    to   { transform: translate(-50%,-50%) scale(1.15); }
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(0.7); }
}

.fade-up   { animation: fadeUp 0.6s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-2 { animation: fadeUp 0.6s 0.1s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-3 { animation: fadeUp 0.6s 0.2s cubic-bezier(0.22,1,0.36,1) both; }
.fade-up-4 { animation: fadeUp 0.6s 0.35s cubic-bezier(0.22,1,0.36,1) both; }

/* ── Responsive ── */
@media (max-width: 700px) {
    .cards-grid {
        grid-template-columns: 1fr;
        max-width: 480px;
    }
    .portal-card {
        padding: 32px 28px;
    }
    .card-title {
        font-size: 30px;
    }
}
@media (max-width: 400px) {
    .portal-shell { padding: 36px 16px 32px; }
    .portal-card { padding: 28px 20px; }
}
</style>
