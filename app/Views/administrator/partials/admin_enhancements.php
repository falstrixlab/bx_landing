<style>
  .bxsea-admin-table-host .dataTables_wrapper .dataTables_filter input {
    min-width: 260px;
    border-radius: 0.65rem;
  }

  .bxsea-admin-table-host .dataTables_wrapper .dataTables_length select {
    min-width: 90px;
    border-radius: 0.65rem;
  }

  .bxsea-admin-table-host .pagination .page-link {
    border-radius: 0.65rem;
    margin: 0 0.15rem;
  }

  .bxsea-quill-shell {
    border: 1px solid #e4e6ef;
    border-radius: 0.75rem;
    background: #fff;
    overflow: hidden;
  }

  .bxsea-quill-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #eef0f8;
    background: #f8fafc;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .bxsea-quill-meta-copy {
    color: #7e8299;
    font-size: 0.875rem;
  }

  .bxsea-quill-editor .ql-toolbar.ql-snow {
    border: 0;
    border-bottom: 1px solid #eef0f8;
  }

  .bxsea-quill-editor .ql-container.ql-snow {
    border: 0;
    font-size: 0.95rem;
  }

  .bxsea-quill-editor .ql-editor {
    min-height: 220px;
  }

  .bxsea-upload-preview {
    margin-top: 0.85rem;
    display: none;
    align-items: center;
    gap: 1rem;
    padding: 0.9rem 1rem;
    background: #f8fafc;
    border: 1px dashed #cdd6e3;
    border-radius: 0.75rem;
  }

  .bxsea-upload-preview.is-visible {
    display: flex;
  }

  .bxsea-upload-preview-thumb {
    width: 88px;
    height: 88px;
    object-fit: cover;
    border-radius: 0.75rem;
    background: #fff;
    border: 1px solid #dfe4ea;
  }

  .bxsea-upload-preview-body {
    min-width: 0;
  }

  .bxsea-upload-preview-title {
    font-weight: 600;
    color: #181c32;
    word-break: break-word;
  }

  .bxsea-upload-preview-meta {
    color: #7e8299;
    font-size: 0.85rem;
  }

  .bxsea-admin-note {
    margin-top: 0.5rem;
    color: #7e8299;
    font-size: 0.85rem;
  }

  .bxsea-overview-page {
    padding-bottom: 2rem;
  }

  .bxsea-overview-hero {
    border: 0;
    background: linear-gradient(135deg, #e9f4ff 0%, #ffffff 52%, #eef9f4 100%);
    box-shadow: 0 18px 48px rgba(24, 28, 50, 0.08);
  }

  .bxsea-overview-kicker {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.35rem 0.75rem;
    border-radius: 999px;
    background: rgba(54, 153, 255, 0.12);
    color: #0b5ed7;
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }

  .bxsea-overview-title {
    margin: 1rem 0 0.6rem;
    color: #181c32;
    font-size: 2rem;
    font-weight: 700;
  }

  .bxsea-overview-copy {
    max-width: 60rem;
    margin: 0;
    color: #5e6278;
    font-size: 1rem;
    line-height: 1.7;
  }

  .bxsea-overview-card {
    display: block;
    border: 1px solid #edf2f7;
    border-radius: 1rem;
    color: inherit;
    text-decoration: none;
    transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
    box-shadow: 0 10px 26px rgba(24, 28, 50, 0.05);
  }

  .bxsea-overview-card:hover {
    transform: translateY(-4px);
    border-color: #8bc4ff;
    box-shadow: 0 18px 38px rgba(24, 28, 50, 0.12);
    color: inherit;
    text-decoration: none;
  }

  .bxsea-overview-card .card-body {
    padding: 1.35rem;
  }

  .bxsea-overview-card h4 {
    margin: 0.7rem 0 0.6rem;
    color: #181c32;
    font-size: 1.1rem;
    font-weight: 700;
  }

  .bxsea-overview-card p {
    margin: 0;
    color: #7e8299;
    line-height: 1.65;
    min-height: 4.9rem;
  }

  .bxsea-overview-meta {
    display: inline-flex;
    align-items: center;
    padding: 0.3rem 0.65rem;
    border-radius: 999px;
    background: #f3f6f9;
    color: #3f4254;
    font-size: 0.8rem;
    font-weight: 600;
  }

  .bxsea-overview-link {
    display: inline-flex;
    margin-top: 1rem;
    color: #0b5ed7;
    font-weight: 700;
  }

  .bxsea-overview-card--related {
    background: #fbfcfe;
  }

  @media (max-width: 991.98px) {
    .bxsea-overview-title {
      font-size: 1.55rem;
    }

    .bxsea-overview-card p {
      min-height: 0;
    }
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const csrfName = '<?= csrf_token() ?>';
  let csrfHash = '<?= csrf_hash() ?>';
  const uploadUrl = '<?= base_url('adminsite/media/upload') ?>';
  const mediaLibraryUrl = '<?= base_url('adminsite/media') ?>';

  function syncCsrfInputs() {
    document.querySelectorAll('form[method="POST"], form[method="post"]').forEach(function(form) {
      let input = form.querySelector('input[name="' + csrfName + '"]');
      if (!input) {
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = csrfName;
        form.appendChild(input);
      }
      input.value = csrfHash;
    });
  }

  function formatBytes(bytes) {
    if (!bytes) {
      return '0 KB';
    }

    const sizes = ['B', 'KB', 'MB', 'GB'];
    const index = Math.min(Math.floor(Math.log(bytes) / Math.log(1024)), sizes.length - 1);
    const value = bytes / Math.pow(1024, index);

    return value.toFixed(index === 0 ? 0 : 1) + ' ' + sizes[index];
  }

  function looksLikeImageInput(input) {
    const accept = (input.getAttribute('accept') || '').toLowerCase();
    const name = (input.getAttribute('name') || '').toLowerCase();

    return accept.indexOf('image') !== -1 || /(pict|image|logo|favicon|thumbnail|poster|file)/.test(name);
  }

  function ensureUploadPreview(input) {
    if (!looksLikeImageInput(input)) {
      return;
    }

    let preview = input.parentNode.querySelector('.bxsea-upload-preview');
    if (!preview) {
      preview = document.createElement('div');
      preview.className = 'bxsea-upload-preview';
      preview.innerHTML = ''
        + '<img class="bxsea-upload-preview-thumb" alt="Preview upload">'
        + '<div class="bxsea-upload-preview-body">'
        + '<div class="bxsea-upload-preview-title"></div>'
        + '<div class="bxsea-upload-preview-meta"></div>'
        + '</div>';
      input.insertAdjacentElement('afterend', preview);
    }

    const thumb = preview.querySelector('.bxsea-upload-preview-thumb');
    const title = preview.querySelector('.bxsea-upload-preview-title');
    const meta = preview.querySelector('.bxsea-upload-preview-meta');
    const maxSizeKb = parseInt(input.dataset.maxSize || '5120', 10);

    input.addEventListener('change', function() {
      const file = input.files && input.files[0] ? input.files[0] : null;
      if (!file) {
        preview.classList.remove('is-visible');
        thumb.removeAttribute('src');
        title.textContent = '';
        meta.textContent = '';
        return;
      }

      if (looksLikeImageInput(input) && file.type && file.type.indexOf('image/') !== 0) {
        input.value = '';
        preview.classList.remove('is-visible');
        Swal.fire('Format tidak didukung', 'Hanya file gambar yang diizinkan untuk field ini.', 'error');
        return;
      }

      if (file.size > (maxSizeKb * 1024)) {
        input.value = '';
        preview.classList.remove('is-visible');
        Swal.fire('File terlalu besar', 'Ukuran maksimal file adalah ' + formatBytes(maxSizeKb * 1024) + '.', 'error');
        return;
      }

      title.textContent = file.name;
      meta.textContent = (file.type || 'image') + ' • ' + formatBytes(file.size);
      preview.classList.add('is-visible');

      if (file.type && file.type.indexOf('image/') === 0) {
        const reader = new FileReader();
        reader.onload = function(event) {
          thumb.src = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  }

  function enhanceTable(table) {
    if (!table || table.dataset.adminTableReady === '1') {
      return;
    }

    if (!table.parentElement.classList.contains('table-responsive')) {
      const wrapper = document.createElement('div');
      wrapper.className = 'table-responsive bxsea-admin-table-host';
      table.parentNode.insertBefore(wrapper, table);
      wrapper.appendChild(table);
    } else {
      table.parentElement.classList.add('bxsea-admin-table-host');
    }

    if (!window.jQuery || !jQuery.fn || !jQuery.fn.DataTable) {
      table.dataset.adminTableReady = '1';
      return;
    }

    const $table = jQuery(table);
    let instance;

    if (jQuery.fn.DataTable.isDataTable(table)) {
      instance = $table.DataTable();
    } else {
      instance = $table.DataTable({
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Semua']],
        order: [],
        autoWidth: false,
        responsive: false,
        language: {
          search: 'Cari:',
          searchPlaceholder: 'Cari judul, deskripsi, status...',
          lengthMenu: 'Tampilkan _MENU_ data',
          info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
          infoEmpty: 'Belum ada data',
          zeroRecords: 'Data tidak ditemukan',
          paginate: {
            previous: 'Sebelumnya',
            next: 'Berikutnya'
          }
        },
        dom: "<'row align-items-center mb-5'<'col-md-6 d-flex align-items-center'l><'col-md-6 d-flex justify-content-md-end'f>>rt<'row align-items-center mt-4'<'col-md-6'i><'col-md-6 d-flex justify-content-md-end'p>>"
      });
    }

    const container = table.closest('.bxsea-admin-table-host') || table.parentElement;
    const filterInput = container.querySelector('.dataTables_filter input');
    const lengthSelect = container.querySelector('.dataTables_length select');

    if (filterInput) {
      filterInput.classList.add('form-control');
      filterInput.placeholder = 'Cari data administrator...';
    }

    if (lengthSelect) {
      lengthSelect.classList.add('form-control');
    }

    table.dataset.adminTableReady = '1';
  }

  function syncEditorValue(textarea, quill) {
    textarea.value = quill.root.innerHTML;
  }

  function uploadEditorImage(file) {
    const formData = new FormData();
    formData.append('file', file);
    formData.append(csrfName, csrfHash);

    return fetch(uploadUrl, {
      method: 'POST',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: formData
    }).then(function(response) {
      return response.json();
    }).then(function(result) {
      if (!result.success) {
        throw new Error(result.message || 'Upload gagal.');
      }

      if (result.csrfHash) {
        csrfHash = result.csrfHash;
        syncCsrfInputs();
      }

      return result.url;
    });
  }

  function initQuillEditor(textarea) {
    if (textarea.dataset.quillReady === '1') {
      return;
    }

    const shell = document.createElement('div');
    shell.className = 'bxsea-quill-shell';

    const meta = document.createElement('div');
    meta.className = 'bxsea-quill-meta';
    meta.innerHTML = ''
      + '<div class="bxsea-quill-meta-copy">Editor visual aktif. Konten akan tersimpan aman sesuai format editor situs.</div>'
      + '<div class="d-flex align-items-center" style="gap:.5rem;">'
      + '<a href="' + mediaLibraryUrl + '" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-light-primary">Open Media Library</a>'
      + '</div>';

    const container = document.createElement('div');
    container.className = 'bxsea-quill-editor';
    container.style.minHeight = textarea.dataset.editorHeight || '220px';

    shell.appendChild(meta);
    shell.appendChild(container);
    textarea.parentNode.insertBefore(shell, textarea);
    textarea.style.display = 'none';

    const quill = new Quill(container, {
      theme: 'snow',
      modules: {
        toolbar: {
          container: [
            [{ header: [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ align: [] }],
            ['link', 'image', 'blockquote'],
            ['clean']
          ],
          handlers: {
            image: function() {
              const input = document.createElement('input');
              input.type = 'file';
              input.accept = 'image/png,image/jpeg,image/webp,image/gif';
              input.click();
              input.addEventListener('change', function() {
                if (!input.files || !input.files[0]) {
                  return;
                }

                uploadEditorImage(input.files[0]).then(function(url) {
                  const range = quill.getSelection(true) || { index: quill.getLength(), length: 0 };
                  quill.insertEmbed(range.index, 'image', url, 'user');
                  quill.setSelection(range.index + 1, 0, 'silent');
                  syncEditorValue(textarea, quill);
                }).catch(function(error) {
                  Swal.fire('Upload gagal', error.message, 'error');
                });
              });
            }
          }
        }
      }
    });

    if (textarea.value) {
      quill.root.innerHTML = textarea.value;
    }

    quill.on('text-change', function() {
      syncEditorValue(textarea, quill);
    });

    const form = textarea.closest('form');
    if (form) {
      form.addEventListener('submit', function() {
        syncEditorValue(textarea, quill);
      });
    }

    textarea.dataset.quillReady = '1';
  }

  syncCsrfInputs();

  document.querySelectorAll('a.btn-delete-confirm').forEach(function(el) {
    el.addEventListener('click', function(e) {
      e.preventDefault();
      var href = el.getAttribute('href');
      Swal.fire({
        title: 'Hapus Data?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33'
      }).then(function(result) {
        if (result.isConfirmed) {
          window.location.href = href;
        }
      });
    });
  });

  document.querySelectorAll('table#kt_datatable, table.js-admin-datatable').forEach(enhanceTable);

  document.querySelectorAll('input[type="file"]').forEach(ensureUploadPreview);

  document.querySelectorAll('textarea').forEach(function(textarea) {
    if (textarea.dataset.editor === 'plain' || textarea.classList.contains('js-no-editor')) {
      return;
    }

    const rows = parseInt(textarea.getAttribute('rows') || '0', 10);
    const isMarkedEditor = textarea.classList.contains('js-quill-editor') || textarea.dataset.editor === 'quill' || (textarea.id || '').indexOf('kt-ckeditor-') === 0;

    if (isMarkedEditor || rows >= 4) {
      initQuillEditor(textarea);
    }
  });
});
</script>