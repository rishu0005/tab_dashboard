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

      <!-- SERIES TITLE -->
      <div class="title-block">
        <div class="series-tag font-11">Word Of The Day</div>
        <div class="series-title">{{ $word ?? '-' }} </div>
        <!-- GENRE TAGS -->
        <div class="genre-tags">
          <div class="genre-tag accent">{{ $part_of_speech ?? 'Not Found' }}</div>
        </div>
        <div class="series-sub">Definition  : &nbsp;·&nbsp; {{ $definition ?? 'Not Found' }}</div>
        <div class="series-sub">Example : &nbsp;·&nbsp; {{ $example ?? 'Not Found' }}</div>
      </div>

      <!-- RIGHT PANEL -->
      <div class="hero-right">
        <div class="ep-info">
          <div class="ep-label text-grey">Today</div>
          <div class="ep-day">{{ now()->format('d') }}</div>
          <div class="ep-month">{{ now()->shortMonthName }}</div>
        </div>

        <div class="right-bottom">
          <form action="" id="upload_bg-wallpaper_form" method="post">
            <input type="file" name="bg-wallpaper" class="d-none" id="upload_image">
            <label for="upload_image" class="continue-btn">Upload Image</label>
          </form>
        </div>
      </div>
    </div>
    <button onclick="openModal('user_option')">
      i am button
    </button>

    <x-modal modal_id="user_option"
             modal_title="Enter Email"
             modal_description="Please Enter Email To Get You Registered"
             modal_button_label="Register"
             modal_form_action="{{ route('register') }}"
             modal_form_method="POST"
             >
      <input class="modal-input" id="user-input" type="text" placeholder="Enter Email to get you registered" />
             
    </x-modal>

    <div class="clock-widget">
      <div class="clock-time" id="clockTime">{{ $time->format('h:i') }}  
          <span class="clock-period" id="clockP">{{ $time->format('A')}}</span></div>
      <div class="clock-date" id="clockDate">{{ $time->format('l, F j, Y') }}</div>
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
