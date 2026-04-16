  <!-- SIDEBAR -->
  <nav class="sidebar">
    <div class="logo">
      <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
    </div>

    <div class="nav-group">
      <div class="nav-icon active">
        <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      </div>
      <div class="nav-icon">
        <svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
        <span class="dot"></span>
      </div>
      <div class="nav-icon">
        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/></svg>
      </div>
      <div class="nav-icon">
        <svg viewBox="0 0 24 24"><path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"/></svg>
      </div>
    </div>

    <div class="spacer"></div>

    <div class="social-row">
      <div class="social-btn">
        <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"/></svg>
      </div>
      <div class="social-btn">
        <svg viewBox="0 0 24 24"><path d="M21.543 7.104c.015.211.015.423.015.636 0 6.507-4.954 14.01-14.01 14.01v-.003A13.94 13.94 0 0 1 2 19.539a9.88 9.88 0 0 0 7.287-2.041 4.93 4.93 0 0 1-4.6-3.42 4.916 4.916 0 0 0 2.223-.084A4.926 4.926 0 0 1 2.96 9.167v-.062a4.887 4.887 0 0 0 2.235.616A4.928 4.928 0 0 1 3.67 3.148a13.98 13.98 0 0 0 10.15 5.144 4.929 4.929 0 0 1 8.39-4.49 9.868 9.868 0 0 0 3.128-1.196 4.941 4.941 0 0 1-2.166 2.724A9.828 9.828 0 0 0 26 4.287a10.019 10.019 0 0 1-2.457 2.817z"/></svg>
      </div>
    </div>

    <div class="lang-group">
      <div class="lang-btn active">EN</div>
      <div class="lang-btn">RU</div>
      <div class="lang-btn">JP</div>
    </div>

    <div class="profile-area" onclick="openModal('user_option')">
      <div class="avatar" >
        <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
      </div>
      <div class="profile-label">Profile</div>
    </div>
  </nav>

  <x-modal modal_id="user_option"
             modal_title="Enter Email"
             modal_description="Please Enter Email To Get You Registered"
             modal_button_label="Register"
             modal_form_action="{{ route('register') }}"
             modal_form_method="POST"
             >
      <input class="modal-input" id="user-input" type="text" placeholder="Enter Email to Login" />
             
    </x-modal>