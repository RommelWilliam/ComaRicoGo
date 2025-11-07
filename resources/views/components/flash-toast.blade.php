@props(['success' => session('success'), 'error' => session('error')])

<style>
  .toast {
    position: fixed; right: 16px; top: 16px; z-index: 9999;
    min-width: 260px; padding: 12px 14px; border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,.15); color: #0b3b2e; background: #d1fae5;
    display: none; align-items: center; gap: 8px; font-weight: 600;
  }
  .toast.error { background: #fee2e2; color: #7f1d1d; }
  .toast .close { margin-left: auto; cursor: pointer; font-weight: 700; opacity:.6 }
  .toast .close:hover { opacity: 1 }
</style>

<div id="toast" class="toast" role="status" aria-live="polite">
  <span id="toast-text">Acción realizada.</span>
  <span class="close" onclick="hideToast()">×</span>
</div>

<script>
  function showToast(msg, isError=false) {
    const t = document.getElementById('toast');
    const txt = document.getElementById('toast-text');
    if (!t || !txt) return;
    txt.textContent = msg || 'Listo';
    t.classList.toggle('error', !!isError);
    t.style.display = 'flex';
    clearTimeout(window._toastTimer);
    window._toastTimer = setTimeout(() => hideToast(), 4000);
  }
  function hideToast() {
    const t = document.getElementById('toast');
    if (t) t.style.display = 'none';
  }
  @if ($success)
    document.addEventListener('DOMContentLoaded', () => showToast(@json($success), false));
  @endif
  @if ($error)
    document.addEventListener('DOMContentLoaded', () => showToast(@json($error), true));
  @endif
</script>
