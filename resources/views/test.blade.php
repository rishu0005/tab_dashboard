@extends('layouts.app')
@section('content')
<div class="app">

<x-sidebar />

  <!-- MAIN CONTENT -->
  <div class="main">
    <div class="topnav">
      <a class="active">Home</a>
      <a>Work</a>
      <a>Aesthestic</a>
    </div>

    <div class="hero">
      <div class="hero-bg"></div>
      <div class="hero-noise"></div>
      <div class="kanji-bg">領域展開</div>

      

      <!-- SCORE BADGE -->
      <div class="score-badge">
          <div class="score-label mb-3  text-grey">Streak</div>
        <div class="score-num mb-3 "> <i class="fa-solid fa-fire"></i> 9</div>
        <div class="score-stars">
          <span class="star"> <i class="fa-solid fa-fire"></i> </span>
          <span class="star"> <i class="fa-solid fa-fire"></i> </span>
          <span class="star"> <i class="fa-solid fa-fire"></i> </span>
          <span class="star"><i class="fa-solid fa-fire"></i></span>
          <span class="star"><i class="fa-solid fa-fire"></i></span>
        </div>
      </div>

      <!-- LEFT CONTROLS -->
      {{-- <div class="hero-left">
        <div class="merch-card">
          <div class="merch-card-label">Merch</div>
          <div class="merch-icon-row">
            <svg viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14l-5-5 1.41-1.41L12 14.17l7.59-7.59L21 8l-9 9z"/></svg>
          </div>
          <button class="red-btn">
            <svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
          </button>
        </div> --}}
        {{-- <button class="red-btn red-btn-float">
          <svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
        </button> --}}
      {{-- </div> --}}

      <!-- SERIES TITLE -->
      <div class="title-block">
        <div class="series-tag font-11">Currently Airing</div>
        <div class="series-title">Jujutsu<br>Kaisen</div>
        <!-- GENRE TAGS -->
        <div class="genre-tags">
          <div class="genre-tag accent">Shonen</div>
          <div class="genre-tag">Action</div>
          <div class="genre-tag">Supernatural</div>
        </div>
        <div class="series-sub">Season 2 &nbsp;·&nbsp; Shibuya Arc</div>
      </div>

      <!-- PRODUCTIVITY PANEL -->
{{-- <div class="productivity-panel">

  <!-- NOTES -->
  <div class="widget notes-widget">
    <div class="widget-title">Quick Notes</div>
    <textarea placeholder="Write something..."></textarea>
  </div>

  <!-- HABITS -->
  <div class="widget habits-widget">
    <div class="widget-title">Habits</div>

    <div class="habit">
      <input type="checkbox" id="h1">
      <label for="h1">Code 2 hours</label>
    </div>

    <div class="habit">
      <input type="checkbox" id="h2">
      <label for="h2">Workout</label>
    </div>

    <div class="habit">
      <input type="checkbox" id="h3">
      <label for="h3">Read</label>
    </div>
  </div>

  <!-- THOUGHTS -->
  <div class="widget thoughts-widget">
    <div class="widget-title">Thoughts</div>
    <textarea placeholder="What's on your mind..."></textarea>
  </div>

</div> --}}

      <!-- RIGHT PANEL -->
      <div class="hero-right">
        <div class="ep-info">
          <div class="ep-label text-grey">Today</div>
          <div class="ep-day">{{ now()->format('d') }}</div>
          <div class="ep-month">{{ now()->shortMonthName }}</div>
        </div>

        <div class="right-bottom">
          <button class="continue-btn">Continue</button>
          <div class="preview-card">
            <div class="preview-scene"></div>
            <!-- Preview scene figures -->
            <svg style="position:absolute;bottom:0;left:0;width:100%;height:65px;" viewBox="0 0 148 65" preserveAspectRatio="xMidYMax meet">
              <ellipse cx="38" cy="65" rx="22" ry="42" fill="#3a4a6a" opacity="0.8"/>
              <ellipse cx="74" cy="65" rx="24" ry="48" fill="#2a3a5a" opacity="0.9"/>
              <ellipse cx="110" cy="65" rx="20" ry="40" fill="#3a4a6a" opacity="0.8"/>
              <circle cx="38" cy="18" r="10" fill="#5a6a8a"/>
              <circle cx="74" cy="12" r="12" fill="#4a5a7a"/>
              <circle cx="110" cy="20" r="10" fill="#5a6a8a"/>
            </svg>
            <div class="play-circle">
              <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- BOTTOM BAR -->
    <div class="bottom-bar">
      <div class="now-label">Now Playing</div>
      <div class="progress-track" id="track">
        <div class="progress-fill" id="fill"></div>
      </div>
      <div class="show-info">Ep 14 — <span>Shibuya Incident</span></div>
      <button class="play-sm" id="playBtn">
        <svg viewBox="0 0 24 24" id="playIcon"><path d="M8 5v14l11-7z"/></svg>
      </button>
    </div>
  </div>
</div>

@endsection

@section('script')

<script>
  let playing = false;
  let progress = 38;
  let interval;

  const fill = document.getElementById('fill');
  const playIcon = document.getElementById('playIcon');
  const track = document.getElementById('track');
  const playBtn = document.getElementById('playBtn');

  playBtn.addEventListener('click', () => {
    playing = !playing;
    if (playing) {
      playIcon.innerHTML = '<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>';
      interval = setInterval(() => {
        progress = Math.min(100, progress + 0.15);
        fill.style.width = progress + '%';
        if (progress >= 100) { clearInterval(interval); playing = false; playIcon.innerHTML = '<path d="M8 5v14l11-7z"/>'; progress = 0; }
      }, 100);
    } else {
      playIcon.innerHTML = '<path d="M8 5v14l11-7z"/>';
      clearInterval(interval);
    }
  });

  track.addEventListener('click', (e) => {
    const rect = track.getBoundingClientRect();
    progress = ((e.clientX - rect.left) / rect.width) * 100;
    fill.style.width = progress + '%';
  });

  document.querySelectorAll('.topnav a').forEach(a => {
    a.addEventListener('click', () => {
      document.querySelectorAll('.topnav a').forEach(x => x.classList.remove('active'));
      a.classList.add('active');
    });
  });

  document.querySelectorAll('.nav-icon').forEach(n => {
    n.addEventListener('click', () => {
      document.querySelectorAll('.nav-icon').forEach(x => x.classList.remove('active'));
      n.classList.add('active');
    });
  });

  document.querySelectorAll('.lang-btn').forEach(b => {
    b.addEventListener('click', () => {
      document.querySelectorAll('.lang-btn').forEach(x => x.classList.remove('active'));
      b.classList.add('active');
    });
  });
</script>
@endsection
