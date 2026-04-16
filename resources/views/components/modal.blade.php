@props([
    'modal_id',
    'modal_title',
    'modal_description',
    'modal_button_label',
    'modal_form_action',
    'modal_form_method',
    'toast_message' => null,
    'toast_status' => null



])


<div class="overlay" id="modal-{{ $modal_id }}" onclick="overlayClick(event, '{{ $modal_id}}')">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="{{ $modal_id}}-title">
    <form action="{{ $modal_form_action }}" method="{{ $modal_form_method }}" id="form_{{ $modal_id }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <div>
            <div class="modal-title" id="{{ $modal_id}}-title">{{ $modal_title }}</div>
            <div class="modal-desc">{{ $modal_description }}</div>
          </div>
          <button type="button" class="modal-close"  onclick="closeModal('{{ $modal_id }}')" aria-label="Close">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 2l10 10M12 2L2 12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
          </button>
        </div>
        <div class="modal-body">
         {{ $slot}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModal('{{ $modal_id }}')">Close</button>
          <button type="submit" class="btn btn-primary" onclick="closeModal('{{ $modal_id }}'); showToast('{{ $toast_message }}', '{{ $toast_status }}')">{{ $modal_button_label }}</button>
        </div>
    </form>
  </div>
</div>
