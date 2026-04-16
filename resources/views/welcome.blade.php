<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Claude — Modal & Toast</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    min-height: 100vh;
    background: #0d0d0d;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
    padding: 40px 16px;
    color: #fff;
  }

  /* ── Layout ─────────────────────────────────────── */
  .demo {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 36px;
    width: 100%;
  }

  .section-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.28);
    margin-bottom: 14px;
    text-align: center;
  }

  .btn-row {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    justify-content: center;
  }

  .divider {
    width: 1px;
    height: 28px;
    background: rgba(255,255,255,0.07);
  }

  /* ── Buttons ─────────────────────────────────────── */
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    letter-spacing: -0.01em;
    cursor: pointer;
    border: none;
    transition: opacity 0.15s;
    font-family: inherit;
    line-height: 1;
  }
  .btn:hover { opacity: 0.78; }
  .btn:active { opacity: 0.6; }

  .btn-secondary {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.8);
    border: 1px solid rgba(255,255,255,0.1);
  }
  .btn-primary {
    background: #fff;
    color: #0d0d0d;
    border: 1px solid transparent;
  }
  .btn-destructive {
    background: #ef4444;
    color: #fff;
    border: 1px solid transparent;
  }
  .btn-ghost {
    background: transparent;
    color: rgba(255,255,255,0.55);
    border: 1px solid transparent;
  }
  .btn svg { flex-shrink: 0; }

  /* ── Overlay ─────────────────────────────────────── */
  .overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9000;
    padding: 16px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease;
  }
  .overlay.open {
    opacity: 1;
    pointer-events: auto;
  }

  /* ── Modal ───────────────────────────────────────── */
  .modal {
    background: #1e1f20;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    box-shadow: 0 24px 64px rgba(0,0,0,0.6), 0 4px 16px rgba(0,0,0,0.3);
    width: 100%;
    max-width: 480px;
    overflow: hidden;
    transform: translateY(16px) scale(0.97);
    transition: transform 0.25s cubic-bezier(0.34,1.3,0.64,1);
  }
  .overlay.open .modal {
    transform: translateY(0) scale(1);
  }

  .modal-header {
    padding: 20px 20px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
  }
  .modal-header.destructive {
    border-bottom-color: rgba(239,68,68,0.15);
  }

  .modal-title {
    font-size: 15px;
    font-weight: 600;
    color: rgba(255,255,255,0.92);
    letter-spacing: -0.015em;
    line-height: 1.3;
  }
  .modal-desc {
    margin-top: 4px;
    font-size: 13px;
    color: rgba(255,255,255,0.45);
    line-height: 1.5;
  }

  .modal-close {
    background: none;
    border: none;
    color: rgba(255,255,255,0.32);
    cursor: pointer;
    padding: 3px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: color 0.15s, background 0.15s;
    margin-top: 1px;
  }
  .modal-close:hover {
    color: rgba(255,255,255,0.7);
    background: rgba(255,255,255,0.07);
  }

  .modal-body {
    padding: 16px 20px;
    font-size: 13.5px;
    color: rgba(255,255,255,0.65);
    line-height: 1.6;
  }

  .modal-footer {
    padding: 10px 20px 18px;
    display: flex;
    justify-content: flex-end;
    gap: 8px;
  }

  /* ── Text input ──────────────────────────────────── */
  .modal-input {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 8px;
    padding: 9px 12px;
    font-size: 13.5px;
    color: rgba(255,255,255,0.88);
    outline: none;
    font-family: inherit;
    caret-color: #10a37f;
    letter-spacing: -0.01em;
    transition: border-color 0.15s;
  }
  .modal-input:focus {
    border-color: rgba(255,255,255,0.26);
  }

  /* Share row */
  .share-row {
    display: flex;
    gap: 8px;
    align-items: center;
  }
  .share-link {
    flex: 1;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 9px 12px;
    font-size: 12.5px;
    color: rgba(255,255,255,0.38);
    font-family: ui-monospace, monospace;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  /* ── Toast container ─────────────────────────────── */
  #toast-container {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column-reverse;
    gap: 8px;
    z-index: 9999;
    pointer-events: none;
    align-items: center;
  }

  /* ── Toast item ──────────────────────────────────── */
  .toast {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 12px 14px;
    background: rgba(32,33,35,0.96);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.35), 0 1px 4px rgba(0,0,0,0.2);
    max-width: 360px;
    min-width: 220px;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    pointer-events: auto;
    cursor: pointer;
    user-select: none;
    opacity: 0;
    transform: translateY(8px) scale(0.97);
    transition: opacity 0.28s cubic-bezier(0.34,1.56,0.64,1),
                transform 0.28s cubic-bezier(0.34,1.56,0.64,1);
  }
  .toast.show {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
  .toast.hide {
    opacity: 0;
    transform: translateY(6px) scale(0.97);
    transition: opacity 0.22s ease, transform 0.22s ease;
  }

  .toast-icon { flex-shrink: 0; margin-top: 1px; display: flex; }
  .toast-msg {
    flex: 1;
    font-size: 13.5px;
    line-height: 1.45;
    color: rgba(255,255,255,0.88);
    letter-spacing: -0.01em;
  }
  .toast-x { flex-shrink: 0; margin-top: 1px; display: flex; color: rgba(255,255,255,0.28); }

  /* type colors */
  .toast[data-type="success"] { border-color: rgba(16,163,127,0.2); }
  .toast[data-type="success"] .toast-icon { color: #10a37f; }
  .toast[data-type="info"] .toast-icon { color: rgba(255,255,255,0.45); }
  .toast[data-type="warning"] { border-color: rgba(245,158,11,0.2); }
  .toast[data-type="warning"] .toast-icon { color: #f59e0b; }
  .toast[data-type="error"] { border-color: rgba(239,68,68,0.2); }
  .toast[data-type="error"] .toast-icon { color: #ef4444; }
</style>
</head>
<body>

<div class="demo">

  <!-- Modals -->
  <div>
    <div class="section-label">Modals</div>
    <div class="btn-row">
      <button class="btn btn-secondary" onclick="openModal('delete')">
        <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M2 4h12M5 4V3a1 1 0 011-1h4a1 1 0 011 1v1M6 7v5M10 7v5M3 4l1 9a1 1 0 001 1h6a1 1 0 001-1l1-9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Delete
      </button>
      <button class="btn btn-secondary" onclick="openModal('rename')">
        <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M11 2l3 3-8 8H3v-3l8-8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Rename
      </button>
      <button class="btn btn-secondary" onclick="openModal('share')">
        <svg width="15" height="15" viewBox="0 0 16 16" fill="none"><path d="M10 2l4 4-4 4M14 6H6a4 4 0 000 8h1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Share
      </button>
    </div>
  </div>

  <div class="divider"></div>

  <!-- Toasts -->
  <div>
    <div class="section-label">Toasts</div>
    <div class="btn-row">
      <button class="btn btn-secondary" onclick="showToast('Starting a new conversation', 'default')">Default</button>
      <button class="btn btn-secondary" onclick="showToast('Changes saved successfully', 'success')">Success</button>
      <button class="btn btn-secondary" onclick="showToast('Your session will expire soon', 'info')">Info</button>
      <button class="btn btn-secondary" onclick="showToast('You\'re approaching your usage limit', 'warning')">Warning</button>
      <button class="btn btn-secondary" onclick="showToast('Something went wrong. Please try again', 'error')">Error</button>
    </div>
  </div>

</div>

<!-- ── DELETE MODAL ────────────────────────────────────── -->
<div class="overlay" id="modal-delete" onclick="overlayClick(event, 'delete')">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="delete-title">
    <div class="modal-header destructive">
      <div>
        <div class="modal-title" id="delete-title">Delete conversation?</div>
        <div class="modal-desc">This will permanently remove this conversation from your history.</div>
      </div>
      <button class="modal-close" onclick="closeModal('delete')" aria-label="Close">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
      </button>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeModal('delete')">Cancel</button>
      <button class="btn btn-destructive" onclick="closeModal('delete'); showToast('Conversation deleted', 'success')">
        <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M2 4h12M5 4V3a1 1 0 011-1h4a1 1 0 011 1v1M6 7v5M10 7v5M3 4l1 9a1 1 0 001 1h6a1 1 0 001-1l1-9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Delete
      </button>
    </div>
  </div>
</div>

<!-- ── RENAME MODAL ────────────────────────────────────── -->
<div class="overlay" id="modal-rename" onclick="overlayClick(event, 'rename')">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="rename-title">
    <div class="modal-header">
      <div>
        <div class="modal-title" id="rename-title">Rename conversation</div>
      </div>
      <button class="modal-close" onclick="closeModal('rename')" aria-label="Close">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <input class="modal-input" id="rename-input" type="text" value="My awesome project" />
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeModal('rename')">Cancel</button>
      <button class="btn btn-primary" onclick="closeModal('rename'); showToast('Conversation renamed', 'success')">Save</button>
    </div>
  </div>
</div>

<!-- ── SHARE MODAL ─────────────────────────────────────── -->
<div class="overlay" id="modal-share" onclick="overlayClick(event, 'share')">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="share-title">
    <div class="modal-header">
      <div>
        <div class="modal-title" id="share-title">Share conversation</div>
        <div class="modal-desc">Anyone with the link can view this conversation.</div>
      </div>
      <button class="modal-close" onclick="closeModal('share')" aria-label="Close">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
      </button>
    </div>
    <div class="modal-body">
      <div class="share-row">
        <div class="share-link">https://claude.ai/share/a8f3c2d1e9b...</div>
        <button class="btn btn-secondary" onclick="closeModal('share'); showToast('Link copied to clipboard', 'success')">Copy</button>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeModal('share')">Done</button>
    </div>
  </div>
</div>

<!-- ── Toast container ──────────────────────────────────── -->
<div id="toast-container"></div>

<script>
  // ── Modal ──────────────────────────────────────────────
  function openModal(id) {
    const el = document.getElementById('modal-' + id);
    el.classList.add('open');
    if (id === 'rename') {
      setTimeout(() => document.getElementById('rename-input').focus(), 50);
    }
    document.addEventListener('keydown', escHandler);
    el._escHandler = escHandler;
    function escHandler(e) {
      if (e.key === 'Escape') closeModal(id);
    }
  }

  function closeModal(id) {
    const el = document.getElementById('modal-' + id);
    el.classList.remove('open');
    document.removeEventListener('keydown', el._escHandler);
  }

  function overlayClick(e, id) {
    if (e.target === e.currentTarget) closeModal(id);
  }

  // ── Toast ──────────────────────────────────────────────
  const icons = {
    success: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8l3.5 3.5L13 4.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
    info:    `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/><path d="M8 7v4M8 5.5v.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`,
    warning: `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 2.5L14 13H2L8 2.5z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M8 6v3.5M8 11v.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`,
    error:   `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.5"/><path d="M5.5 5.5l5 5M10.5 5.5l-5 5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`,
    default: '',
  };
  const closeIcon = `<svg width="13" height="13" viewBox="0 0 14 14" fill="none"><path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>`;

  function showToast(message, type = 'default') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.setAttribute('data-type', type);
    toast.innerHTML = `
      ${icons[type] ? `<span class="toast-icon">${icons[type]}</span>` : ''}
      <span class="toast-msg">${message}</span>
      <span class="toast-x">${closeIcon}</span>
    `;

    container.prepend(toast);
    requestAnimationFrame(() => requestAnimationFrame(() => toast.classList.add('show')));

    const dismiss = () => {
      toast.classList.add('hide');
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 250);
    };

    toast.addEventListener('click', dismiss);
    setTimeout(dismiss, 4000);
  }
</script>
</body>
</html>