<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Harvester · Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ── RESET ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
button, input, textarea { font-family: inherit; }

/* ── ROOT ── */
:root {
  --glass-bg:    rgba(255,255,255,0.13);
  --glass-bg2:   rgba(255,255,255,0.18);
  --glass-border: rgba(255,255,255,0.22);
  --glass-shadow: 0 8px 32px rgba(0,0,0,0.28), 0 2px 8px rgba(0,0,0,0.18);
  --blur: blur(20px);
  --blur-nav: blur(16px);
  --accent: #fff;
  --accent2: rgba(255,255,255,0.7);
  --accent3: rgba(255,255,255,0.4);
  --accent4: rgba(255,255,255,0.18);
  --red: #FF4D4D;
  --edge: 40px;
  --card-pad: 24px;
  --gap: 16px;
  --gap-sm: 12px;
  --r-card: 24px;
  --r-btn: 16px;
  --r-pill: 14px;
  --font: 'Plus Jakarta Sans', sans-serif;
  --nav-w: 72px;
}

html, body {
  width: 100%; height: 100%;
  overflow: hidden;
  font-family: var(--font);
  color: #fff;
  background: #0d0d0d;
}

/* ══════════════════════════════════
   BACKGROUND
══════════════════════════════════ */
#bg {
  position: fixed; inset: 0; z-index: 0;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  transition: background-image 0.6s ease, opacity 0.5s;
}

/* Subtle bottom gradient for readability only */
#bg::after {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(
    to top,
    rgba(0,0,0,0.22) 0%,
    transparent 30%
  );
  pointer-events: none;
}

/* Default pattern when no image */
#bg.empty {
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 40%, #0f3460 70%, #1a1a2e 100%);
}
#bg.empty::before {
  content: '';
  position: absolute; inset: 0;
  background-image:
    radial-gradient(circle at 20% 50%, rgba(255,100,100,0.08) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(100,100,255,0.08) 0%, transparent 50%),
    radial-gradient(circle at 60% 80%, rgba(100,200,255,0.06) 0%, transparent 40%);
}

/* ══════════════════════════════════
   FLOATING LEFT NAV
══════════════════════════════════ */
.left-nav {
  position: fixed;
  left: var(--edge);
  top: 50%;
  transform: translateY(-50%);
  z-index: 100;
  display: flex;
  flex-direction: column;
  gap: 20px;
  align-items: center;
}

.nav-btn {
  width: var(--nav-w);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 5px;
  padding: 14px 10px;
  border-radius: var(--r-btn);
  background: var(--glass-bg);
  border: 1px solid var(--glass-border);
  backdrop-filter: var(--blur-nav);
  -webkit-backdrop-filter: var(--blur-nav);
  box-shadow: var(--glass-shadow);
  cursor: pointer;
  transition: background 0.22s, border-color 0.22s, box-shadow 0.22s, transform 0.18s;
  color: rgba(255,255,255,0.75);
  position: relative;
}
.nav-btn:hover {
  background: var(--glass-bg2);
  border-color: rgba(255,255,255,0.38);
  box-shadow: 0 8px 32px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.12), 0 0 18px rgba(255,255,255,0.08);
  color: #fff;
  transform: scale(1.06);
}
.nav-btn.active {
  background: rgba(255,255,255,0.22);
  border-color: rgba(255,255,255,0.45);
  color: #fff;
}
.nav-btn svg {
  width: 20px; height: 20px;
  fill: none; stroke: currentColor;
  stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
  flex-shrink: 0;
}
.nav-label {
  font-size: 9.5px;
  font-weight: 600;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  opacity: 0.7;
  line-height: 1;
}
.nav-btn.active .nav-label { opacity: 1; }

/* ══════════════════════════════════
   MAIN CONTENT CARD
══════════════════════════════════ */
.main-card {
  position: fixed;
  top: 50%;
  /* Slightly right of center */
  left: calc(var(--nav-w) + var(--edge) + 40px);
  right: var(--edge);
  transform: translateY(-50%);
  max-width: 560px;
  /* Push to the right of center */
  margin-left: auto;
  z-index: 50;

  background: rgba(255,255,255,0.13);
  border: 1px solid var(--glass-border);
  backdrop-filter: var(--blur);
  -webkit-backdrop-filter: var(--blur);
  border-radius: var(--r-card);
  box-shadow: var(--glass-shadow);
  padding: var(--card-pad);
  display: flex;
  flex-direction: column;
  gap: var(--gap);
  max-height: calc(100vh - 80px);
  overflow-y: auto;
  scrollbar-width: none;
}
.main-card::-webkit-scrollbar { display: none; }

/* ── Card header ── */
.card-header { display: flex; flex-direction: column; gap: 5px; }
.card-title {
  font-size: 1.5rem;
  font-weight: 700;
  letter-spacing: -0.01em;
  color: #fff;
  text-shadow: 0 1px 12px rgba(0,0,0,0.3);
  line-height: 1.2;
}
.card-sub {
  font-size: 0.85rem;
  color: rgba(255,255,255,0.58);
  font-weight: 400;
}

/* ── Section label ── */
.section-label {
  font-size: 0.7rem;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.42);
  display: flex;
  align-items: center;
  gap: 8px;
}
.section-label::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(255,255,255,0.1);
  border-radius: 1px;
}

/* ── Note pills ── */
.notes-list { display: flex; flex-direction: column; gap: var(--gap-sm); }

.note-pill {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 13px 16px;
  background: rgba(255,255,255,0.09);
  border: 1px solid rgba(255,255,255,0.13);
  border-radius: var(--r-pill);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  transition: background 0.2s, border-color 0.2s, transform 0.18s;
  cursor: default;
  position: relative;
  group: note;
}
.note-pill:hover {
  background: rgba(255,255,255,0.15);
  border-color: rgba(255,255,255,0.22);
  transform: translateX(3px);
}
.note-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: rgba(255,255,255,0.5);
  flex-shrink: 0;
}
.note-text {
  flex: 1;
  font-size: 0.88rem;
  color: rgba(255,255,255,0.88);
  line-height: 1.4;
}
.note-del {
  width: 22px; height: 22px;
  border-radius: 7px;
  background: rgba(255,80,80,0.0);
  border: none; cursor: pointer;
  color: rgba(255,255,255,0.25);
  font-size: 14px; line-height: 1;
  display: flex; align-items: center; justify-content: center;
  transition: all 0.18s;
  flex-shrink: 0;
  opacity: 0;
}
.note-pill:hover .note-del { opacity: 1; }
.note-del:hover { background: rgba(255,60,60,0.2); color: #FF6060; }

/* Add note row */
.add-note-row {
  display: flex;
  gap: 10px;
  align-items: center;
}
.add-note-input {
  flex: 1;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.14);
  border-radius: var(--r-pill);
  padding: 11px 16px;
  color: #fff;
  font-size: 0.85rem;
  outline: none;
  transition: background 0.2s, border-color 0.2s;
}
.add-note-input::placeholder { color: rgba(255,255,255,0.3); }
.add-note-input:focus {
  background: rgba(255,255,255,0.13);
  border-color: rgba(255,255,255,0.28);
}
.add-note-btn {
  padding: 11px 18px;
  border-radius: var(--r-pill);
  background: rgba(255,255,255,0.18);
  border: 1px solid rgba(255,255,255,0.28);
  color: #fff;
  font-size: 0.82rem;
  font-weight: 600;
  cursor: pointer;
  white-space: nowrap;
  transition: background 0.2s, border-color 0.2s, transform 0.15s, box-shadow 0.2s;
  letter-spacing: 0.01em;
}
.add-note-btn:hover {
  background: rgba(255,255,255,0.26);
  border-color: rgba(255,255,255,0.42);
  box-shadow: 0 0 16px rgba(255,255,255,0.1);
  transform: scale(1.03);
}
.add-note-btn:active { transform: scale(0.97); }

/* ── Divider ── */
.divider {
  height: 1px;
  background: rgba(255,255,255,0.1);
  border-radius: 1px;
}

/* ── Quick thought ── */
.thought-area {
  width: 100%;
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: var(--r-pill);
  padding: 13px 16px;
  color: #fff;
  font-size: 0.88rem;
  line-height: 1.65;
  resize: none;
  outline: none;
  min-height: 80px;
  transition: background 0.2s, border-color 0.2s;
}
.thought-area::placeholder { color: rgba(255,255,255,0.28); font-style: italic; }
.thought-area:focus {
  background: rgba(255,255,255,0.11);
  border-color: rgba(255,255,255,0.25);
}
.thought-footer {
  display: flex; align-items: center; justify-content: space-between;
  margin-top: -4px;
}
.thought-chars { font-size: 0.68rem; color: rgba(255,255,255,0.25); }
.thought-save {
  padding: 7px 18px;
  border-radius: 20px;
  background: rgba(255,255,255,0.13);
  border: 1px solid rgba(255,255,255,0.22);
  color: rgba(255,255,255,0.85);
  font-size: 0.76rem; font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, border-color 0.2s, box-shadow 0.2s, transform 0.15s;
}
.thought-save:hover {
  background: rgba(255,255,255,0.22);
  border-color: rgba(255,255,255,0.38);
  box-shadow: 0 0 14px rgba(255,255,255,0.08);
  transform: scale(1.04);
}

/* ══════════════════════════════════
   STREAK WIDGET — floating bottom-right of card
══════════════════════════════════ */
.streak-widget {
  position: fixed;
  z-index: 60;
  /* Will be positioned by JS, defaults below */
  bottom: var(--edge);
  right: var(--edge);
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.24);
  backdrop-filter: var(--blur);
  -webkit-backdrop-filter: var(--blur);
  border-radius: 20px;
  box-shadow: var(--glass-shadow);
  padding: 18px 22px;
  display: flex;
  align-items: center;
  gap: 14px;
  min-width: 220px;
  animation: floatUp 0.5s 0.4s ease both;
}

.streak-flame {
  font-size: 1.8rem;
  line-height: 1;
  filter: drop-shadow(0 0 8px rgba(255,140,0,0.6));
}
.streak-info { flex: 1; }
.streak-count {
  font-size: 1.25rem;
  font-weight: 700;
  color: #fff;
  line-height: 1.1;
  letter-spacing: -0.01em;
}
.streak-sub {
  font-size: 0.72rem;
  color: rgba(255,255,255,0.5);
  margin-top: 2px;
}
.checkin-btn {
  padding: 9px 16px;
  border-radius: 12px;
  background: rgba(255,100,50,0.22);
  border: 1px solid rgba(255,120,60,0.35);
  color: #FFB07A;
  font-size: 0.78rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, border-color 0.2s, box-shadow 0.2s, transform 0.15s;
  white-space: nowrap;
  letter-spacing: 0.02em;
}
.checkin-btn:hover {
  background: rgba(255,100,50,0.35);
  border-color: rgba(255,140,80,0.55);
  box-shadow: 0 0 18px rgba(255,100,50,0.25);
  transform: scale(1.05);
}
.checkin-btn:active { transform: scale(0.96); }
.checkin-btn.done {
  background: rgba(60,180,100,0.2);
  border-color: rgba(80,200,120,0.35);
  color: #7AE0A0;
}

/* Streak dots row */
.streak-dots-row {
  display: flex; gap: 5px; margin-top: 8px; flex-wrap: wrap;
}
.s-dot {
  width: 10px; height: 10px; border-radius: 3px;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.15);
  transition: all 0.3s;
}
.s-dot.done {
  background: #FF6B35;
  border-color: #FF6B35;
  box-shadow: 0 0 6px rgba(255,107,53,0.5);
}
.s-dot.today {
  background: transparent;
  border: 2px solid #FF6B35;
  animation: blink 2s ease-in-out infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

/* ══════════════════════════════════
   IMAGE UPLOAD OVERLAY (bottom center)
══════════════════════════════════ */
.img-dock {
  position: fixed;
  bottom: var(--edge);
  left: 50%;
  transform: translateX(-50%);
  z-index: 200;
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(0,0,0,0.35);
  border: 1px solid rgba(255,255,255,0.15);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border-radius: 40px;
  padding: 8px 12px 8px 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.3);
  transition: opacity 0.3s;
}
.img-dock:hover { opacity: 1 !important; }

.dock-hint { font-size: 0.72rem; color: rgba(255,255,255,0.4); white-space: nowrap; }

.url-inp {
  background: transparent;
  border: none;
  color: rgba(255,255,255,0.8);
  font-size: 0.78rem;
  outline: none;
  width: 200px;
}
.url-inp::placeholder { color: rgba(255,255,255,0.28); }

.dock-sep { width: 1px; height: 16px; background: rgba(255,255,255,0.15); }

.dock-btn {
  padding: 6px 14px;
  border-radius: 20px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.18);
  color: rgba(255,255,255,0.8);
  font-size: 0.73rem; font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
  white-space: nowrap;
}
.dock-btn:hover { background: rgba(255,255,255,0.22); color: #fff; }

.upload-label {
  display: flex; align-items: center; gap: 6px;
  padding: 6px 14px;
  border-radius: 20px;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.18);
  color: rgba(255,255,255,0.8);
  font-size: 0.73rem; font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
  white-space: nowrap;
}
.upload-label:hover { background: rgba(255,255,255,0.22); color: #fff; }
.upload-label input { display: none; }
.upload-label svg { width: 12px; height: 12px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; }

/* ══════════════════════════════════
   CLOCK WIDGET (top-left floating)
══════════════════════════════════ */
.clock-widget {
  position: fixed;
  top: var(--edge);
  left: calc(var(--nav-w) + var(--edge) + 56px);
  z-index: 60;
  animation: floatUp 0.4s 0.1s ease both;
}
.clock-time {
  font-size: clamp(2.8rem, 5vw, 4.5rem);
  font-weight: 700;
  letter-spacing: -0.03em;
  color: #fff;
  text-shadow: 0 2px 32px rgba(0,0,0,0.5), 0 0 60px rgba(0,0,0,0.2);
  line-height: 1;
}
.clock-period { font-size: 1rem; font-weight: 400; color: rgba(255,255,255,0.55); margin-left: 6px; vertical-align: super; }
.clock-date {
  font-size: 0.8rem;
  color: rgba(255,255,255,0.45);
  margin-top: 4px;
  text-shadow: 0 1px 8px rgba(0,0,0,0.5);
  letter-spacing: 0.02em;
}

/* ══════════════════════════════════
   TOASTS
══════════════════════════════════ */
.toast-wrap {
  position: fixed; top: var(--edge); right: var(--edge);
  z-index: 9999; display: flex; flex-direction: column; gap: 8px;
  pointer-events: none; align-items: flex-end;
}
.toast {
  background: rgba(15,15,15,0.88);
  border: 1px solid rgba(255,255,255,0.12);
  backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
  border-radius: 14px; padding: 11px 18px;
  font-size: 0.81rem; color: rgba(255,255,255,0.9);
  display: flex; align-items: center; gap: 9px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.45);
  animation: tIn 0.38s cubic-bezier(.34,1.56,.64,1) both;
  pointer-events: auto;
  border-left: 3px solid rgba(255,255,255,0.3);
}
.toast.success { border-left-color: #4ADE80; }
.toast.warning { border-left-color: #FBBF24; }
.toast.info    { border-left-color: #60A5FA; }
.toast.out { animation: tOut 0.28s ease both; }

/* ══════════════════════════════════
   ANIMATIONS
══════════════════════════════════ */
@keyframes floatUp  { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
@keyframes tIn  { from{opacity:0;transform:translateX(16px) scale(0.92)} to{opacity:1;transform:translateX(0) scale(1)} }
@keyframes tOut { from{opacity:1;transform:translateX(0)} to{opacity:0;transform:translateX(16px)} }
@keyframes cardIn { from{opacity:0;transform:translateY(24px) scale(0.97)} to{opacity:1;transform:translateY(0) scale(1)} }
@keyframes navIn  { from{opacity:0;transform:translateX(-20px)} to{opacity:1;transform:translateX(0)} }
@keyframes popDot { 0%{transform:scale(1)} 40%{transform:scale(1.4)} 100%{transform:scale(1)} }

.main-card  { animation: cardIn 0.5s 0.15s cubic-bezier(.34,1.2,.64,1) both; }
.left-nav   { animation: navIn  0.4s 0.05s ease both; }
.clock-widget { animation: floatUp 0.4s 0.08s ease both; }

/* ══════════════════════════════════
   RESPONSIVE
══════════════════════════════════ */
@media (max-width: 680px) {
  .left-nav {
    top: auto; bottom: var(--edge);
    left: 50%; transform: translateX(-50%);
    flex-direction: row;
    gap: 10px;
  }
  .nav-btn { width: 52px; padding: 10px 8px; }
  .nav-label { display: none; }
  .main-card {
    left: var(--edge); right: var(--edge);
    top: calc(var(--edge) + 4rem);
    transform: none;
    max-width: 100%;
    margin: 0;
    max-height: calc(100vh - 10rem);
  }
  .clock-widget { left: var(--edge); }
  .streak-widget { bottom: calc(var(--edge) + 80px); right: var(--edge); min-width: 0; }
  .img-dock { bottom: calc(var(--edge) + 4.5rem); }
}
</style>
</head>
<body>

<!-- BG -->
<div id="bg" class="empty"></div>

<!-- CLOCK -->
<div class="clock-widget">
  <div class="clock-time" id="clockTime">12:00<span class="clock-period" id="clockP">AM</span></div>
  <div class="clock-date" id="clockDate">—</div>
</div>

<!-- LEFT NAV -->
<nav class="left-nav">
  <button class="nav-btn active" onclick="setActive(this)" title="Home">
    <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
    <span class="nav-label">Home</span>
  </button>
  <button class="nav-btn" onclick="setActive(this)" title="Favorites">
    <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
    <span class="nav-label">Favs</span>
  </button>
  <button class="nav-btn" onclick="setActive(this); openNotes()" title="Notes">
    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    <span class="nav-label">Notes</span>
  </button>
  <button class="nav-btn" onclick="setActive(this)" title="Streaks">
    <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
    <span class="nav-label">Streak</span>
  </button>
  <button class="nav-btn" onclick="setActive(this)" title="Settings">
    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
    <span class="nav-label">Settings</span>
  </button>
</nav>

<!-- MAIN CARD -->
<main class="main-card" id="mainCard">

  <!-- Header -->
  <div class="card-header">
    <div class="card-title">Hey Harvester 👋</div>
    <div class="card-sub">What's on your mind today?</div>
  </div>

  <!-- Quick Notes -->
  <div class="section-label">Quick Notes</div>
  <div class="notes-list" id="notesList"></div>
  <div class="add-note-row">
    <input class="add-note-input" id="noteInput" placeholder="+ Add a new note..." onkeydown="if(event.key==='Enter')addNote()">
    <button class="add-note-btn" onclick="addNote()">+ Add</button>
  </div>

  <div class="divider"></div>

  <!-- Today's Thought -->
  <div class="section-label">Today's Thought</div>
  <textarea class="thought-area" id="thoughtArea" placeholder="Write something... a feeling, an idea, anything." oninput="updateChars()" rows="3"></textarea>
  <div class="thought-footer">
    <span class="thought-chars" id="charCnt">0 characters</span>
    <button class="thought-save" onclick="saveThought()">Save ✦</button>
  </div>

</main>

<!-- STREAK WIDGET -->
<div class="streak-widget" id="streakWidget">
  <div class="streak-flame">🔥</div>
  <div class="streak-info">
    <div class="streak-count"><span id="streakNum">12</span> day streak</div>
    <div class="streak-sub">Keep it going!</div>
    <div class="streak-dots-row" id="streakDots"></div>
  </div>
  <button class="checkin-btn" id="checkinBtn" onclick="checkIn()">Check-in</button>
</div>

<!-- IMAGE DOCK -->
<div class="img-dock" id="imgDock">
  <span class="dock-hint">🖼</span>
  <input class="url-inp" id="urlInp" placeholder="Paste image URL..." onkeydown="if(event.key==='Enter')loadUrl()">
  <div class="dock-sep"></div>
  <button class="dock-btn" onclick="loadUrl()">Set</button>
  <div class="dock-sep"></div>
  <label class="upload-label">
    <svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
    Upload
    <input type="file" accept="image/*" onchange="loadFile(event)">
  </label>
</div>

<!-- TOASTS -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
/* ════════════════════════════
   DATA
════════════════════════════ */
let notes = [
  "Remember to stay hydrated 💧",
  "Plan the weekend adventure 🗺",
];
let streakCount = 12;
let checkedIn = false;

/* ════════════════════════════
   CLOCK
════════════════════════════ */
function tick() {
  const n = new Date();
  let h = n.getHours(), m = n.getMinutes(), s = n.getSeconds();
  const p = h >= 12 ? 'PM' : 'AM';
  h = h % 12 || 12;
  document.getElementById('clockTime').childNodes[0].textContent =
    `${h}:${String(m).padStart(2,'0')}`;
  document.getElementById('clockP').textContent = p;
}
document.getElementById('clockDate').textContent =
  new Date().toLocaleDateString('en-US',{weekday:'long',month:'long',day:'numeric',year:'numeric'});
tick(); setInterval(tick, 1000);

/* ════════════════════════════
   NAV
════════════════════════════ */
function setActive(el) {
  document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
}

/* ════════════════════════════
   NOTES
════════════════════════════ */
function renderNotes() {
  const list = document.getElementById('notesList');
  list.innerHTML = '';
  if (!notes.length) {
    const p = document.createElement('p');
    p.style.cssText = 'font-size:0.82rem;color:rgba(255,255,255,0.28);font-style:italic;padding:4px 0;';
    p.textContent = 'No notes yet — add your first one above.';
    list.appendChild(p); return;
  }
  notes.forEach((n, i) => {
    const pill = document.createElement('div');
    pill.className = 'note-pill';
    pill.style.animationDelay = (i * 0.05) + 's';

    const dot = document.createElement('div'); dot.className = 'note-dot';
    const txt = document.createElement('div'); txt.className = 'note-text'; txt.textContent = n;
    const del = document.createElement('button'); del.className = 'note-del'; del.textContent = '×';
    del.onclick = e => {
      e.stopPropagation();
      pill.style.transition = 'opacity 0.2s, transform 0.2s';
      pill.style.opacity = '0'; pill.style.transform = 'translateX(-10px)';
      setTimeout(() => { notes.splice(i,1); renderNotes(); }, 200);
      toast('Note removed.', 'warning');
    };

    pill.appendChild(dot); pill.appendChild(txt); pill.appendChild(del);
    list.appendChild(pill);
  });
}

function addNote() {
  const inp = document.getElementById('noteInput');
  const v = inp.value.trim(); if (!v) return;
  notes.unshift(v);
  inp.value = '';
  renderNotes();
  toast('Note added! ✦', 'success');
}

function openNotes() { /* nav shortcut — card is always visible */ }

renderNotes();

/* ════════════════════════════
   THOUGHT
════════════════════════════ */
function updateChars() {
  const v = document.getElementById('thoughtArea').value;
  document.getElementById('charCnt').textContent = v.length + ' character' + (v.length !== 1 ? 's' : '');
}
function saveThought() {
  const v = document.getElementById('thoughtArea').value.trim();
  if (!v) { toast('Nothing written yet...', 'warning'); return; }
  toast('Thought saved. You\'re doing great ✨', 'success');
}

/* ════════════════════════════
   STREAK
════════════════════════════ */
function renderStreak() {
  document.getElementById('streakNum').textContent = streakCount;
  const wrap = document.getElementById('streakDots');
  wrap.innerHTML = '';
  const total = Math.min(streakCount + 2, 14);
  for (let i = 0; i < total; i++) {
    const d = document.createElement('div');
    d.className = 's-dot' + (i < streakCount - 1 ? ' done' : i === streakCount - 1 ? ' today' : '');
    wrap.appendChild(d);
  }
}
function checkIn() {
  if (checkedIn) { toast('Already checked in today! 🔥', 'info'); return; }
  checkedIn = true;
  streakCount++;
  renderStreak();
  const btn = document.getElementById('checkinBtn');
  btn.textContent = '✓ Done!';
  btn.classList.add('done');
  toast(`${streakCount} day streak! You\'re on fire 🔥`, 'success');
}
renderStreak();

/* ════════════════════════════
   IMAGE
════════════════════════════ */
function setImage(src) {
  const bg = document.getElementById('bg');
  bg.style.transition = 'opacity 0.4s ease';
  bg.style.opacity = '0';
  setTimeout(() => {
    bg.className = '';
    bg.style.backgroundImage = `url('${src}')`;
    bg.style.backgroundSize = 'cover';
    bg.style.backgroundPosition = 'center';
    bg.style.opacity = '1';
  }, 350);
  toast('Background set! Looking amazing. ✦', 'success');
}
function loadFile(e) {
  const f = e.target.files[0]; if (!f) return;
  const r = new FileReader();
  r.onload = ev => setImage(ev.target.result);
  r.readAsDataURL(f);
}
function loadUrl() {
  const v = document.getElementById('urlInp').value.trim();
  if (!v) { toast('Paste an image URL first.', 'warning'); return; }
  setImage(v);
  document.getElementById('urlInp').value = '';
}

/* ════════════════════════════
   TOAST
════════════════════════════ */
function toast(msg, type='info') {
  const icons = { success:'✦', warning:'◈', info:'◉' };
  const wrap = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.className = 'toast ' + type;
  t.innerHTML = `<span style="font-size:11px">${icons[type]||'◉'}</span>${msg}`;
  wrap.appendChild(t);
  setTimeout(() => {
    t.classList.add('out');
    setTimeout(() => t.remove(), 300);
  }, 3000);
}

/* ════════════════════════════
   WELCOME
════════════════════════════ */
setTimeout(() => toast('Welcome back, Harvester 👋', 'info'), 500);
</script>
</body>
</html>