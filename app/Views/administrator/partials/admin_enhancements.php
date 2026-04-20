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

<!-- ===== BXSEA Admin Guide System ===== -->
<style>
  /* Guide Banner */
  .bxsea-guide-wrap { margin-bottom: 1.5rem; }

  .bxsea-guide-card {
    position: relative;
    border: 1px solid #dce8f5;
    border-left: 4px solid #3699ff;
    border-radius: 0.9rem;
    background: linear-gradient(135deg, #f0f8ff 0%, #fafcff 100%);
    box-shadow: 0 2px 14px rgba(54,153,255,0.08);
    padding: 1.05rem 1.3rem;
    transition: box-shadow 0.18s;
  }
  .bxsea-guide-card:hover { box-shadow: 0 4px 22px rgba(54,153,255,0.13); }

  .bxsea-guide-head {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  .bxsea-guide-icon { font-size: 1.5rem; line-height: 1; flex-shrink: 0; }
  .bxsea-guide-heading-group { flex: 1; min-width: 0; }
  .bxsea-guide-kicker {
    font-size: 0.67rem;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: #3699ff;
    margin-bottom: 0.1rem;
  }
  .bxsea-guide-title {
    font-size: 0.975rem;
    font-weight: 700;
    color: #181c32;
    margin: 0;
    line-height: 1.3;
  }
  .bxsea-guide-actions { display: flex; align-items: center; gap: 0.3rem; flex-shrink: 0; }
  .bxsea-guide-btn {
    background: none;
    border: 1px solid transparent;
    border-radius: 0.45rem;
    cursor: pointer;
    padding: 0.25rem 0.55rem;
    font-size: 0.75rem;
    font-weight: 600;
    line-height: 1.4;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
    white-space: nowrap;
  }
  .bxsea-guide-btn-toggle { color: #5e6278; }
  .bxsea-guide-btn-toggle:hover { background: #e4f1ff; border-color: #c5dcf5; color: #3699ff; }
  .bxsea-guide-btn-dismiss { color: #a1a5b7; }
  .bxsea-guide-btn-dismiss:hover { background: #fff3f6; border-color: #fcc; color: #f64e60; }

  .bxsea-guide-body {
    margin-top: 0.8rem;
    padding-top: 0.8rem;
    border-top: 1px solid #dce8f5;
  }
  .bxsea-guide-desc {
    color: #3f4254;
    font-size: 0.9rem;
    line-height: 1.72;
    margin: 0 0 0.95rem;
  }
  .bxsea-guide-row {
    display: flex;
    flex-wrap: wrap;
    gap: 1.1rem;
    align-items: flex-start;
  }
  .bxsea-guide-col { flex: 1; min-width: 240px; }
  .bxsea-guide-section-lbl {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #a1a5b7;
    margin-bottom: 0.45rem;
  }
  .bxsea-guide-chips { display: flex; flex-wrap: wrap; gap: 0.35rem; }
  .bxsea-guide-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.22rem;
    padding: 0.25rem 0.6rem;
    border-radius: 999px;
    background: #e2f0ff;
    color: #1564bf;
    font-size: 0.775rem;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid #c3def8;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
  }
  .bxsea-guide-chip:hover { background: #cce4ff; border-color: #3699ff; color: #0b5ed7; text-decoration: none; }
  .bxsea-guide-no-fe { color: #b5b5c3; font-size: 0.82rem; font-style: italic; }
  .bxsea-guide-tips-ul { margin: 0; padding: 0; list-style: none; }
  .bxsea-guide-tips-ul li {
    position: relative;
    padding-left: 1.4rem;
    color: #3f4254;
    font-size: 0.84rem;
    line-height: 1.72;
    margin-bottom: 0.18rem;
  }
  .bxsea-guide-tips-ul li::before {
    content: '\1F4A1';
    position: absolute;
    left: 0;
    font-size: 0.74rem;
    top: 0.15rem;
  }

  /* Floating Action Button */
  .bxsea-guide-fab {
    position: fixed;
    bottom: 1.8rem;
    right: 1.8rem;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #3699ff;
    color: #fff;
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 22px rgba(54,153,255,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    font-weight: 800;
    z-index: 9990;
    transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.2s ease;
    opacity: 1;
    padding: 0;
  }
  .bxsea-guide-fab:hover { transform: scale(1.12); box-shadow: 0 10px 30px rgba(54,153,255,0.55); color: #fff; }
  .bxsea-guide-fab.is-hidden { opacity: 0; pointer-events: none; transform: scale(0.65); }
  .bxsea-guide-fab-tip {
    position: absolute;
    right: 58px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(24,28,50,0.82);
    color: #fff;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.28rem 0.6rem;
    border-radius: 0.4rem;
    white-space: nowrap;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.18s;
  }
  .bxsea-guide-fab:hover .bxsea-guide-fab-tip { opacity: 1; }

  @media (max-width: 767px) {
    .bxsea-guide-fab { bottom: 1rem; right: 1rem; width: 44px; height: 44px; font-size: 1.15rem; }
    .bxsea-guide-row { flex-direction: column; gap: 0.75rem; }
    .bxsea-guide-col { min-width: 0; }
    .bxsea-guide-actions .bxsea-guide-btn { font-size: 0.7rem; padding: 0.2rem 0.4rem; }
  }
</style>

<script>
(function () {
  var BXSEA_BASE = '<?= rtrim(base_url(), '/') ?>';

  var GUIDE = {
    'dashboard': {
      icon: '&#127968;',
      title: 'Dashboard Utama',
      desc: 'Halaman ringkasan seluruh aktivitas website BXSea. Gunakan halaman ini sebagai titik awal untuk memantau kondisi website dan mengakses menu pengelolaan konten di sidebar kiri.',
      frontend: [],
      tips: [
        'Gunakan menu di sidebar kiri untuk berpindah ke halaman pengelolaan konten.',
        'Perubahan konten yang disimpan di admin akan langsung terlihat di website utama.',
        'Jika ragu, selalu buka halaman frontend (tombol chip biru) untuk melihat hasil perubahan Anda.'
      ]
    },
    'about': {
      icon: '&#128203;',
      title: 'Tentang BXSea (About)',
      desc: 'Kelola konten halaman "Tentang Kami" — profil perusahaan, visi &amp; misi, dan galeri foto yang ditampilkan kepada pengunjung website.',
      frontend: [
        { label: 'ID: Tentang Kami', url: '/id/tentang-kami' },
        { label: 'EN: About Us', url: '/en/tentang-kami' }
      ],
      tips: [
        'Perubahan di menu ini langsung mempengaruhi halaman "Tentang BXSea".',
        'Gunakan ukuran gambar yang konsisten agar tampilan tetap rapi.',
        'Klik tombol chip biru di atas untuk melihat halaman frontend yang terpengaruh.'
      ]
    },
    'user': {
      icon: '&#128100;',
      title: 'Manajemen User Admin',
      desc: 'Kelola akun pengguna yang dapat login ke dashboard administrator ini. Hanya Super Admin (Role 1) yang dapat mengakses dan menambah user baru.',
      frontend: [],
      tips: [
        'Role 1 = Super Admin (akses penuh ke semua menu), Role 2 = Admin biasa.',
        'Jangan bagikan password akun admin kepada pihak yang tidak berwenang.',
        'Jika ada staf yang resign, segera nonaktifkan atau hapus akunnya untuk keamanan.'
      ]
    },
    'master/legal': {
      icon: '&#9878;',
      title: 'Legal &amp; Dokumen Hukum',
      desc: 'Kelola konten halaman Syarat &amp; Ketentuan dan Kebijakan Privasi yang wajib ditampilkan kepada pengunjung website.',
      frontend: [
        { label: 'ID: Syarat &amp; Ketentuan', url: '/id/syarat-ketentuan' },
        { label: 'ID: Kebijakan Privasi', url: '/id/privasi' },
        { label: 'EN: Terms of Service', url: '/en/syarat-ketentuan' },
        { label: 'EN: Privacy Policy', url: '/en/privasi' }
      ],
      tips: [
        'Perbarui dokumen legal setiap kali ada perubahan kebijakan perusahaan.',
        'Gunakan editor teks (heading &amp; paragraf) agar format halaman tetap rapi.',
        'Sertakan tanggal terakhir diperbarui di dalam teks dokumen.'
      ]
    },
    'master/socialmedia': {
      icon: '&#128242;',
      title: 'Tautan Media Sosial',
      desc: 'Update link akun media sosial BXSea (Instagram, TikTok, YouTube, dll). Link ini tampil di footer SEMUA halaman website dan pada tombol share/sosial.',
      frontend: [
        { label: 'ID: Home (footer)', url: '/id/' },
        { label: 'EN: Home (footer)', url: '/en/' }
      ],
      tips: [
        'Pastikan URL yang dimasukkan adalah link profil yang benar dan bisa diakses publik.',
        'Perubahan langsung terlihat di footer semua halaman website.',
        'Cek kembali URL setelah disimpan dengan membuka halaman website di tab baru.'
      ]
    },
    'master/designasset': {
      icon: '&#127912;',
      title: 'Design Assets (Gambar Sistem)',
      desc: 'Kelola gambar-gambar sistem: ikon, ilustrasi dekoratif, gambar default, dan background yang digunakan di berbagai bagian halaman frontend. Ganti gambar-gambar ini untuk mengubah tampilan visual website.',
      frontend: [
        { label: 'ID: Home (cek visual)', url: '/id/' },
        { label: 'EN: Home (check visuals)', url: '/en/' }
      ],
      tips: [
        'Hati-hati! Mengganti design asset mempengaruhi tampilan di BANYAK halaman sekaligus.',
        'Gunakan gambar PNG transparan untuk ikon dan elemen dekoratif.',
        'Ukuran gambar pengganti sebaiknya sama dengan gambar asli yang digantikan.',
        'Simpan backup gambar lama sebelum menggantinya dengan yang baru.'
      ]
    },
    'master/setup': {
      icon: '&#9881;',
      title: 'Setup Landing Page',
      desc: 'Konfigurasi pengaturan global untuk semua halaman landing: aktifkan/nonaktifkan section, atur tampilan umum, dan kelola konfigurasi teknis website.',
      frontend: [
        { label: 'ID: Home (cek hasil)', url: '/id/' },
        { label: 'EN: Home (check result)', url: '/en/' }
      ],
      tips: [
        'Menu ini berisi pengaturan teknis — ubah hanya jika Anda yakin dengan dampaknya.',
        'Menonaktifkan sebuah section akan menyembunyikannya dari halaman frontend.',
        'Konsultasikan dengan developer jika tidak yakin dengan efek perubahan tertentu.'
      ]
    },
    'home': {
      icon: '&#127968;',
      title: 'Ringkasan Menu Home',
      desc: 'Halaman ini menampilkan ringkasan semua sub-menu yang mengelola konten <strong>Halaman Utama (Home)</strong> website BXSea. Klik salah satu kartu untuk langsung ke pengelolaan konten tersebut.',
      frontend: [
        { label: 'ID: Home', url: '/id/' },
        { label: 'EN: Home', url: '/en/' }
      ],
      tips: [
        'Home adalah halaman pertama yang dilihat pengunjung — pastikan konten selalu terbarui.',
        'Gunakan sub-menu di sidebar kiri untuk mengelola masing-masing bagian Home secara terpisah.',
        'Setelah mengubah konten, buka halaman Home website untuk memverifikasi perubahannya.'
      ]
    },
    'home/announcement': {
      icon: '&#128226;',
      title: 'Pengumuman Berjalan (Marquee Ticker)',
      desc: 'Teks berjalan (ticker) yang muncul di bagian paling ATAS halaman Home. Gunakan ini untuk pengumuman penting, promo kilat, atau informasi mendadak yang perlu dilihat semua pengunjung segera.',
      frontend: [
        { label: 'ID: Home (ticker paling atas)', url: '/id/' },
        { label: 'EN: Home (top ticker)', url: '/en/' }
      ],
      tips: [
        'Tulis teks yang singkat dan padat — maksimal 1-2 kalimat per pengumuman.',
        'Bisa tambahkan beberapa pengumuman sekaligus — semuanya tampil bergantian dalam satu baris.',
        'Jika tidak ada data aktif, section ticker ini disembunyikan otomatis dari website.',
        'Contoh penggunaan: "Promo Lebaran! Diskon 20% untuk tiket reguler 10–30 April."'
      ]
    },
    'home/banner': {
      icon: '&#128444;',
      title: 'Banner Utama (Hero Slider)',
      desc: 'Gambar slideshow utama yang menjadi latar belakang halaman Home saat pertama kali dibuka. Ini adalah visual PERTAMA yang dilihat pengunjung ketika membuka website.',
      frontend: [
        { label: 'ID: Home (slider utama)', url: '/id/' },
        { label: 'EN: Home (main slider)', url: '/en/' }
      ],
      tips: [
        'Gunakan gambar beresolusi tinggi (minimal 1920x800 px) agar terlihat tajam di layar besar.',
        'Idealnya 3-5 slide saja agar pengunjung tidak menunggu terlalu lama.',
        'Optimalkan ukuran file gambar (di bawah 500 KB) menggunakan tools seperti tinypng.com.',
        'Pilih foto yang menampilkan suasana BXSea yang paling menarik dan berwarna.'
      ]
    },
    'home/fiturslide': {
      icon: '&#127904;',
      title: 'Fitur Slide (Zona Carousel)',
      desc: 'Kartu fitur zona/area BXSea yang tampil di carousel utama halaman Home (bagian "Oceanarium Tours"). Setiap slide menampilkan foto zona beserta judul dan deskripsi singkat.',
      frontend: [
        { label: 'ID: Home (carousel zona)', url: '/id/' },
        { label: 'EN: Home (zone carousel)', url: '/en/' }
      ],
      tips: [
        'Maksimal 4 slide yang ditampilkan di Home — urutan paling atas yang muncul pertama.',
        'Gunakan foto zona yang menarik dan representatif untuk memikat pengunjung.',
        'Judul sebaiknya singkat (3-5 kata) dan deskripsi maksimal 1 kalimat pendek.'
      ]
    },
    'home/description': {
      icon: '&#9999;',
      title: 'Teks Deskripsi Section Home',
      desc: 'Kelola teks judul dan deskripsi untuk berbagai section di halaman Home: Experience, Partner, Testimoni, Berita, dan Tiket. Tiap baris data mengontrol teks di section yang berbeda.',
      frontend: [
        { label: 'ID: Home (berbagai section)', url: '/id/' },
        { label: 'EN: Home (various sections)', url: '/en/' }
      ],
      tips: [
        'Setiap data description memiliki kode/nama section — JANGAN ubah kodenya, hanya ubah isinya.',
        'Teks ini biasanya berupa 1 judul (Title) dan 1 paragraf deskripsi (Description).',
        'Gunakan bahasa yang hangat dan mengundang untuk setiap section.'
      ]
    },
    'home/testimoni': {
      icon: '&#11088;',
      title: 'Review &amp; Testimoni Pengunjung',
      desc: 'Kelola ulasan dari pengunjung nyata BXSea yang tampil di section "Cerita dari Pengunjung Kami" di halaman Home.',
      frontend: [
        { label: 'ID: Home (section review)', url: '/id/' },
        { label: 'EN: Home (review section)', url: '/en/' }
      ],
      tips: [
        'Gunakan review yang positif, autentik, dan mencerminkan pengalaman nyata pengunjung.',
        'Tambahkan foto pengunjung agar review terlihat lebih kredibel dan personal.',
        'Maksimal 6 review yang ditampilkan (digabung dengan influencer review).'
      ]
    },
    'home/influencer': {
      icon: '&#127775;',
      title: 'Review Influencer',
      desc: 'Kelola review/ulasan dari influencer dan content creator yang pernah berkunjung ke BXSea. Review ini tampil bergabung dengan testimoni pengunjung biasa di slider Home.',
      frontend: [
        { label: 'ID: Home (section review)', url: '/id/' },
        { label: 'EN: Home (review section)', url: '/en/' }
      ],
      tips: [
        'Tambahkan nama asli atau nama akun sosial media influencer agar pengunjung dapat mengenali.',
        'Foto profil yang jelas meningkatkan kepercayaan dan keaslian review.',
        'Review dari influencer ternama bisa jadi daya tarik lebih bagi pengunjung baru.'
      ]
    },
    'home/partner': {
      icon: '&#129309;',
      title: 'Logo Partner / Mitra BXSea',
      desc: 'Gambar logo partner dan mitra resmi BXSea yang tampil di section "Mitra BXSea" halaman Home.',
      frontend: [
        { label: 'ID: Home (section partner)', url: '/id/' },
        { label: 'EN: Home (partner section)', url: '/en/' }
      ],
      tips: [
        'Gunakan logo dalam format PNG dengan latar transparan untuk tampilan terbaik.',
        'Ukuran logo sebaiknya seragam (misalnya 200x80 px) agar terlihat rapi dan konsisten.',
        'Minta file logo resmi (PNG transparan atau vektor) dari masing-masing partner.'
      ]
    },
    'home/sosmedcontent': {
      icon: '&#128248;',
      title: 'Konten Media Sosial',
      desc: 'Kelola konten atau link dari postingan media sosial BXSea yang ditampilkan sebagai feed atau galeri di halaman tertentu.',
      frontend: [
        { label: 'ID: Home (feed sosmed)', url: '/id/' }
      ],
      tips: [
        'Update secara berkala dengan konten terbaru untuk menjaga halaman tetap segar.',
        'Pastikan link postingan yang dimasukkan masih aktif dan dapat diakses publik.'
      ]
    },
    'ticketing/description': {
      icon: '&#127915;',
      title: 'Teks Deskripsi Halaman Tiket',
      desc: 'Kelola teks judul dan deskripsi yang muncul di bagian ATAS halaman pembelian tiket — penjelasan singkat sebelum daftar harga tiket ditampilkan.',
      frontend: [
        { label: 'ID: Harga Tiket', url: '/id/tiket/harga' },
        { label: 'EN: Harga Tiket', url: '/en/tiket/harga' }
      ],
      tips: [
        'Gunakan deskripsi yang informatif namun singkat untuk memandu pengunjung.',
        'Sebutkan jenis tiket yang tersedia (Reguler, Group, dll) di teks deskripsi.',
        'Pastikan info harga di deskripsi selalu sinkron dengan data tiket aktual.'
      ]
    },
    'category/ticketcategory': {
      icon: '&#128193;',
      title: 'Kategori Tiket',
      desc: 'Kelola kategori pengelompokan tiket BXSea (contoh: Reguler, Group). Kategori ini tampil sebagai TAB di halaman pembelian tiket sehingga pengunjung dapat memfilter jenis tiket.',
      frontend: [
        { label: 'ID: Harga Tiket (tab kategori)', url: '/id/tiket/harga' },
        { label: 'EN: Harga Tiket (tab)', url: '/en/tiket/harga' }
      ],
      tips: [
        'Nama kategori harus singkat karena tampil sebagai tombol tab (idealnya 1-2 kata).',
        'Jangan hapus kategori yang sudah memiliki tiket terkait — tiket tersebut tidak akan muncul.'
      ]
    },
    'ticketing/masterticket': {
      icon: '&#128179;',
      title: 'Data Tiket (Harga &amp; Detail)',
      desc: 'Kelola SEMUA tiket yang dijual BXSea: judul tiket, harga, gambar, deskripsi, dan link pembelian. <strong>Ini adalah menu utama untuk mengupdate harga tiket.</strong>',
      frontend: [
        { label: 'ID: Harga Tiket', url: '/id/tiket/harga' },
        { label: 'EN: Harga Tiket', url: '/en/tiket/harga' },
        { label: 'ID: Home (section tiket)', url: '/id/' }
      ],
      tips: [
        'Jika ada kenaikan harga tiket, update di sini dan perubahan langsung terlihat di website.',
        'Isi kolom "Link Pembelian" dengan URL dari platform ticketing (Traveloka, Tiket.com, dll).',
        'Jika tiket belum bisa dibeli online, kosongkan kolom link — otomatis tampil "Segera Hadir".',
        'Tiket kategori Reguler (ID 1) dan Group (ID 2) juga tampil di section tiket halaman Home.'
      ]
    },
    'ticketing/experience': {
      icon: '&#129347;',
      title: 'Add-Ons &amp; Experience Tambahan',
      desc: 'Kelola paket pengalaman tambahan (add-ons) yang dijual terpisah dari tiket utama: Boat Tour, Foto Bawah Air, Sesi Edukasi, dan lainnya.',
      frontend: [
        { label: 'ID: Pengalaman Premium', url: '/id/tiket/pengalaman-premium' },
        { label: 'EN: Pengalaman Premium', url: '/en/tiket/pengalaman-premium' },
        { label: 'ID: Home (additional experience)', url: '/id/' }
      ],
      tips: [
        'Gunakan foto yang menarik untuk setiap experience agar pengunjung tertarik membeli.',
        'Deskripsi singkat yang tampil di kartu Home maksimal sekitar 100 karakter.',
        'Isi harga dengan lengkap — pengunjung biasanya membandingkan harga sebelum memutuskan.'
      ]
    },
    'ticketing/promotion': {
      icon: '&#127881;',
      title: 'Promosi &amp; Event',
      desc: 'Kelola data promosi, event, dan acara yang sedang atau akan berlangsung di BXSea. Tampil di halaman Event &amp; Promosi dan juga di section Event di halaman Home.',
      frontend: [
        { label: 'ID: Event &amp; Promosi', url: '/id/tiket/promosi' },
        { label: 'EN: Event &amp; Promosi', url: '/en/tiket/promosi' },
        { label: 'ID: Home (section event)', url: '/id/' }
      ],
      tips: [
        'Gunakan gambar promosi berukuran landscape (rasio 16:9) untuk tampilan terbaik.',
        'Tambahkan tanggal mulai dan berakhirnya promo agar pengunjung tahu kapan berlaku.',
        '4 promosi/event terbaru yang tampil otomatis di section Event halaman Home.'
      ]
    },
    'ticketing/moment': {
      icon: '&#128157;',
      title: 'Momen Istimewa',
      desc: 'Kelola paket khusus untuk momen istimewa: ulang tahun, anniversary, lamaran, pernikahan, dll yang dapat dipesan pengunjung.',
      frontend: [
        { label: 'ID: Momen Istimewa', url: '/id/tiket/momen-istimewa' },
        { label: 'EN: Momen Istimewa', url: '/en/tiket/momen-istimewa' }
      ],
      tips: [
        'Gunakan foto yang emosional dan berkesan untuk menarik pasangan atau keluarga.',
        'Sertakan detail apa saja yang termasuk dalam paket (dekorasi, kue, foto, dll).',
        'Pastikan harga dan ketersediaan selalu terbarui sebelum promo disebarkan ke media sosial.'
      ]
    },
    'ticketing/schoolprogram': {
      icon: '&#127979;',
      title: 'Program Kunjungan Sekolah',
      desc: 'Kelola informasi program kunjungan sekolah (field trip): deskripsi program, keunggulan, materi edukasi yang ditawarkan, dan kontak pemesanan.',
      frontend: [
        { label: 'ID: Program Kunjungan Sekolah', url: '/id/tiket/program-kunjungan-sekolah' },
        { label: 'EN: Program Kunjungan Sekolah', url: '/en/tiket/program-kunjungan-sekolah' }
      ],
      tips: [
        'Tampilkan poin keunggulan program yang menarik untuk pihak sekolah (kurikulum, sertifikat, dll).',
        'Sertakan kontak person yang bisa dihubungi sekolah untuk pemesanan grup.',
        'Gunakan bahasa yang profesional karena target audiensnya adalah guru dan kepala sekolah.'
      ]
    },
    'ticketing/schoolvisit': {
      icon: '&#128218;',
      title: 'Paket Kunjungan Sekolah',
      desc: 'Kelola detail paket harga kunjungan sekolah (Basic, Premium, Special) termasuk foto, harga, fitur masing-masing paket, dan kutipan dari guru/pembimbing.',
      frontend: [
        { label: 'ID: Program Kunjungan Sekolah (paket)', url: '/id/tiket/program-kunjungan-sekolah' },
        { label: 'EN: Program Kunjungan Sekolah (paket)', url: '/en/tiket/program-kunjungan-sekolah' }
      ],
      tips: [
        'Bedakan dengan jelas perbedaan antara paket Basic, Premium, dan Special.',
        'Tambahkan kutipan/testimoni dari guru yang pernah membawa rombongan untuk meningkatkan kepercayaan.',
        'Update harga paket segera jika ada penyesuaian dari tim operasional.'
      ]
    },
    'explore/description': {
      icon: '&#128506;',
      title: 'Teks Deskripsi Halaman Jelajahi',
      desc: 'Kelola teks judul dan deskripsi untuk halaman utama "Jelajahi" / Journey yang menampilkan semua zona wisata di BXSea.',
      frontend: [
        { label: 'ID: Journey Utama', url: '/id/journey/journey-utama' },
        { label: 'EN: Journey Utama', url: '/en/journey/journey-utama' }
      ],
      tips: [
        'Teks deskripsi ini tampil sebagai pengantar sebelum daftar zona ditampilkan.',
        'Gunakan kalimat yang mengundang rasa ingin tahu dan antusiasme pengunjung.'
      ]
    },
    'explore/journey': {
      icon: '&#128032;',
      title: 'Data Zona Journey',
      desc: 'Kelola zona/area wisata yang dapat dieksplorasi pengunjung di BXSea. Setiap zona memiliki nama, foto utama, dan deskripsi lengkap tentang biota laut yang ada di dalamnya.',
      frontend: [
        { label: 'ID: Journey Utama (kartu zona)', url: '/id/journey/journey-utama' },
        { label: 'EN: Journey Utama (zone cards)', url: '/en/journey/journey-utama' }
      ],
      tips: [
        'Gunakan foto yang menampilkan biota laut paling ikonik dari setiap zona.',
        'Deskripsi zona sebaiknya edukatif dan informatif tentang spesies yang ada di zona tersebut.',
        'Urutan tampil di website mengikuti urutan data — atur urutan yang sesuai alur kunjungan.'
      ]
    },
    'explore/show': {
      icon: '&#127917;',
      title: 'Data Pertunjukan (Show)',
      desc: 'Kelola data pertunjukan yang ada di BXSea: Regular Show dan Sea-Pecial Show. Setiap show memiliki nama, foto, poster, tipe, dan info jadwal.',
      frontend: [
        { label: 'ID: Pertunjukan', url: '/id/journey/pertunjukan' },
        { label: 'EN: Pertunjukan', url: '/en/journey/pertunjukan' },
        { label: 'ID: Home (section show)', url: '/id/' }
      ],
      tips: [
        'Tipe show: "regular" untuk Regular Shows, "seapecial" untuk Sea-Pecial Shows.',
        'Poster/gambar show tampil di halaman Home — gunakan gambar yang eye-catching dan berwarna.',
        'Maksimal 4 show regular dan 4 sea-pecial show yang ditampilkan di slider Home.'
      ]
    },
    'visit/description': {
      icon: '&#128221;',
      title: 'Teks Deskripsi Info Kunjungan',
      desc: 'Kelola teks judul dan deskripsi untuk berbagai section di halaman-halaman Info Kunjungan (Informasi Pengunjung, Jadwal, Denah, dan lainnya).',
      frontend: [
        { label: 'ID: Informasi Pengunjung', url: '/id/kunjungan/informasi-pengunjung' },
        { label: 'EN: Informasi Pengunjung', url: '/en/kunjungan/informasi-pengunjung' }
      ],
      tips: [
        'Setiap data memiliki kode section yang menentukan di halaman mana teks tersebut tampil.',
        'JANGAN ubah kode section — hanya ubah teks Title dan Description-nya saja.'
      ]
    },
    'visit/visitorinfo': {
      icon: '&#8505;',
      title: 'Informasi Pengunjung',
      desc: 'Kelola informasi penting bagi pengunjung: peraturan yang harus dipatuhi, tips berkunjung, daftar fasilitas yang tersedia, dan larangan di dalam area BXSea.',
      frontend: [
        { label: 'ID: Informasi Pengunjung', url: '/id/kunjungan/informasi-pengunjung' },
        { label: 'EN: Informasi Pengunjung', url: '/en/kunjungan/informasi-pengunjung' }
      ],
      tips: [
        'Tulis informasi yang benar-benar dibutuhkan pengunjung sebelum mereka datang.',
        'Sertakan aturan berpakaian, larangan membawa hewan, dan prosedur keselamatan.',
        'Update segera jika ada perubahan aturan atau fasilitas baru di BXSea.'
      ]
    },
    'visit/schedule': {
      icon: '&#128197;',
      title: 'Jadwal Aquarium (Jam Operasional)',
      desc: 'Kelola jadwal operasional BXSea: jam buka-tutup setiap hari, hari libur khusus, dan jadwal pertunjukan (show schedule).',
      frontend: [
        { label: 'ID: Jadwal Aquarium', url: '/id/kunjungan/jadwal-aquarium' },
        { label: 'EN: Jadwal Aquarium', url: '/en/kunjungan/jadwal-aquarium' }
      ],
      tips: [
        'Segera update jadwal jika ada perubahan jam operasional atau hari libur mendadak.',
        'Pengunjung sering mengecek jadwal show sebelum datang — pastikan selalu akurat.',
        'Tambahkan keterangan khusus untuk hari libur nasional atau event spesial.'
      ]
    },
    'visit/map': {
      icon: '&#128506;',
      title: 'Denah Lokasi (Map)',
      desc: 'Kelola gambar denah/peta area BXSea yang membantu pengunjung navigasi di dalam kawasan. Gambar ini tampil di halaman Denah Oceanarium.',
      frontend: [
        { label: 'ID: Denah Oceanarium', url: '/id/kunjungan/denah' },
        { label: 'EN: Denah Oceanarium', url: '/en/kunjungan/denah' }
      ],
      tips: [
        'Upload gambar denah dengan resolusi tinggi agar detail setiap zona terlihat jelas.',
        'Pastikan denah mencerminkan layout terkini jika ada renovasi atau penambahan zona.',
        'Format yang direkomendasikan: PNG atau JPG, ukuran file maksimal 2 MB.'
      ]
    },
    'visit/guide': {
      icon: '&#128214;',
      title: 'Panduan Aksesibilitas &amp; Kunjungan',
      desc: 'Kelola panduan dan tips yang membantu pengunjung mempersiapkan kunjungan: cara menuju lokasi, tempat parkir, barang yang perlu dibawa, dan tips aksesibilitas.',
      frontend: [
        { label: 'ID: Panduan Aksesibilitas', url: '/id/kunjungan/panduan-aksesibilitas' },
        { label: 'EN: Panduan Aksesibilitas', url: '/en/kunjungan/panduan-aksesibilitas' }
      ],
      tips: [
        'Tulis panduan yang praktis dan mudah dipahami oleh semua kalangan usia.',
        'Sertakan tips terbaik waktu berkunjung (misal: datang pagi hari di hari kerja).',
        'Sertakan informasi aksesibilitas untuk pengunjung berkebutuhan khusus.'
      ]
    },
    'visit/tenant': {
      icon: '&#127978;',
      title: 'Tenant (Gerai di BXSea)',
      desc: 'Kelola data tenant/gerai yang beroperasi di dalam area BXSea: restoran, kafe, toko souvenir, dll. Data ini tampil di slider Tenant Home dan di halaman Tenant.',
      frontend: [
        { label: 'ID: Tenant', url: '/id/kunjungan/tenant' },
        { label: 'EN: Tenant', url: '/en/kunjungan/tenant' },
        { label: 'ID: Home (section tenant)', url: '/id/' }
      ],
      tips: [
        'Foto thumbnail digunakan di slider halaman Home — gunakan foto yang menarik dan terang.',
        'Deskripsi tenant sebaiknya mencakup jenis produk atau menu yang dijual.',
        'Update segera jika ada tenant baru masuk atau tenant lama keluar dari BXSea.'
      ]
    },
    'visit/merchandise': {
      icon: '&#128717;',
      title: 'Merchandise BXSea',
      desc: 'Kelola katalog produk merchandise resmi BXSea: kaos, topi, tas, boneka, dan lainnya. Setiap produk memiliki foto, nama, deskripsi, dan kategori.',
      frontend: [
        { label: 'ID: Merchandise', url: '/id/kunjungan/merchandise' },
        { label: 'EN: Merchandise', url: '/en/kunjungan/merchandise' }
      ],
      tips: [
        'Gunakan foto produk yang jelas dengan latar belakang bersih untuk tampilan profesional.',
        'Sertakan deskripsi material atau spesifikasi produk jika ada (misal: cotton 100%).',
        'Kelompokkan produk ke kategori yang tepat agar mudah dicari pengunjung.'
      ]
    },
    'category/merchandisecategory': {
      icon: '&#128193;',
      title: 'Kategori Merchandise',
      desc: 'Kelola kategori produk merchandise (contoh: Pakaian, Aksesoris, Tas) yang digunakan untuk mengelompokkan produk di halaman Merchandise.',
      frontend: [
        { label: 'ID: Merchandise (filter kategori)', url: '/id/kunjungan/merchandise' },
        { label: 'EN: Merchandise (filter)', url: '/en/kunjungan/merchandise' }
      ],
      tips: [
        'Kategori tampil sebagai tombol filter di halaman Merchandise.',
        'Gunakan nama kategori yang singkat dan mudah dipahami pengunjung.',
        'JANGAN hapus kategori yang masih digunakan oleh produk merchandise aktif.'
      ]
    },
    'visit/faq': {
      icon: '&#10067;',
      title: 'FAQ (Pertanyaan Umum)',
      desc: 'Kelola daftar pertanyaan yang sering diajukan pengunjung beserta jawaban lengkapnya. Halaman FAQ membantu mengurangi pertanyaan repetitif ke tim Customer Service.',
      frontend: [
        { label: 'ID: FAQ', url: '/id/kunjungan/faq' },
        { label: 'EN: FAQ', url: '/en/kunjungan/faq' }
      ],
      tips: [
        'Kelompokkan pertanyaan berdasarkan topik (tiket, jadwal, fasilitas, dll).',
        'Jawaban harus akurat, jelas, dan selalu diperbarui sesuai kondisi operasional terkini.',
        'Review FAQ secara berkala dan tambahkan pertanyaan baru yang sering masuk ke CS.'
      ]
    },
    'visit/contact': {
      icon: '&#128236;',
      title: 'Pesan Masuk (Hubungi Kami)',
      desc: '<strong>INI ADALAH INBOX.</strong> Lihat dan kelola pesan yang masuk dari form "Hubungi Kami" di website — dari pengunjung, calon mitra, dan pihak lainnya.',
      frontend: [
        { label: 'ID: Hubungi Kami (form)', url: '/id/kunjungan/hubungi-kami' },
        { label: 'EN: Hubungi Kami (form)', url: '/en/kunjungan/hubungi-kami' }
      ],
      tips: [
        'Cek inbox ini secara RUTIN — pesan dari pengunjung perlu ditindaklanjuti segera.',
        'Pesan yang masuk TIDAK otomatis diteruskan ke email — harus dicek langsung di sini.',
        'Tandai atau hapus pesan yang sudah ditindaklanjuti agar inbox tetap bersih dan tertata.'
      ]
    },
    'partnership': {
      icon: '&#129309;',
      title: 'Kemitraan &amp; Partnership',
      desc: 'Kelola konten halaman Kemitraan yang ditujukan untuk calon mitra bisnis BXSea: informasi jenis kemitraan, keuntungan bergabung, dan cara mendaftar.',
      frontend: [
        { label: 'ID: Kemitraan', url: '/id/kunjungan/partnership' },
        { label: 'EN: Partnership', url: '/en/kunjungan/partnership' }
      ],
      tips: [
        'Tampilkan benefit kemitraan yang jelas dan menarik untuk calon mitra.',
        'Sertakan contact person atau cara pendaftaran yang mudah dan jelas.'
      ]
    },
    'master/article': {
      icon: '&#128240;',
      title: 'Artikel &amp; Berita',
      desc: 'Kelola semua artikel, berita terbaru, dan cerita konservasi yang dipublikasikan di halaman Berita BXSea. Artikel terbaru juga tampil otomatis di section Berita halaman Home.',
      frontend: [
        { label: 'ID: Berita', url: '/id/berita' },
        { label: 'EN: Berita', url: '/en/berita' },
        { label: 'ID: Home (section berita)', url: '/id/' }
      ],
      tips: [
        'Tulis judul yang menarik dan deskriptif — judul adalah hal pertama yang dilihat pengunjung.',
        'Gunakan gambar artikel yang relevan dengan ukuran minimal 800x450 px.',
        'Kategorikan artikel dengan benar agar mudah ditemukan pengunjung.',
        'Artikel yang paling atas/terbaru tampil otomatis di section Berita halaman Home.'
      ]
    },
    'whatsnew': {
      icon: '&#128240;',
      title: 'Artikel &amp; Berita',
      desc: 'Kelola semua artikel, berita terbaru, dan cerita konservasi yang dipublikasikan di halaman Berita BXSea. Artikel terbaru juga tampil otomatis di section Berita halaman Home.',
      frontend: [
        { label: 'ID: Berita', url: '/id/berita' },
        { label: 'EN: Berita', url: '/en/berita' },
        { label: 'ID: Home (section berita)', url: '/id/' }
      ],
      tips: [
        'Tulis judul yang menarik dan deskriptif.',
        'Gunakan gambar artikel yang relevan.',
        'Artikel terbaru tampil otomatis di section Berita halaman Home.'
      ]
    },
    'category/articlecategory': {
      icon: '&#128193;',
      title: 'Kategori Artikel',
      desc: 'Kelola kategori artikel/berita untuk mengelompokkan konten (contoh: Konservasi, Event, Tips Berkunjung, dll).',
      frontend: [
        { label: 'ID: Berita (filter kategori)', url: '/id/berita' },
        { label: 'EN: Berita (filter)', url: '/en/berita' }
      ],
      tips: [
        'Nama kategori sebaiknya singkat (1-3 kata) dan mudah dipahami.',
        'JANGAN hapus kategori yang masih memiliki artikel aktif.'
      ]
    },
    'subscribed': {
      icon: '&#128231;',
      title: 'Email Subscriber',
      desc: 'Lihat daftar email pengunjung yang mendaftar untuk menerima newsletter dan update terbaru dari BXSea melalui form subscribe di website.',
      frontend: [
        { label: 'ID: Home (form subscribe footer)', url: '/id/' }
      ],
      tips: [
        'Data ini berguna untuk kampanye email marketing — export jika diperlukan.',
        'Jangan menghapus data subscriber kecuali ada permintaan langsung dari pengunjung.',
        'Data email bersifat sensitif — jaga kerahasiaannya sesuai Kebijakan Privasi BXSea.'
      ]
    },
    'media': {
      icon: '&#128444;',
      title: 'Media Manager (Perpustakaan Gambar)',
      desc: 'Kelola semua file gambar yang sudah diunggah ke server BXSea. Gunakan ini untuk <strong>upload gambar baru</strong> sebelum memasukkannya ke konten, atau untuk mengambil URL gambar yang sudah ada.',
      frontend: [],
      tips: [
        'Upload gambar di sini terlebih dahulu, lalu gunakan URL-nya di form konten lainnya.',
        'Hapus gambar lama yang sudah tidak digunakan untuk menjaga kapasitas server.',
        'Format yang didukung: JPG, PNG, WebP, GIF. Ukuran maksimal 5 MB per file.',
        'Beri nama file yang deskriptif (bukan "IMG_1234.jpg") agar mudah ditemukan kembali.'
      ]
    },
    'settings': {
      icon: '&#9881;',
      title: 'Pengaturan Global Website',
      desc: 'Konfigurasi pengaturan teknis dan global website BXSea: nama situs, logo, favicon, meta SEO, dan konfigurasi sistem lainnya.',
      frontend: [
        { label: 'ID: Home (cek hasil)', url: '/id/' },
        { label: 'EN: Home (check result)', url: '/en/' }
      ],
      tips: [
        'Perubahan di Global Settings mempengaruhi SELURUH halaman website.',
        'Hati-hati saat mengubah setting teknis — konsultasikan dengan developer jika tidak yakin.',
        'Update meta deskripsi dan keywords untuk membantu meningkatkan SEO website.'
      ]
    },
    'profile': {
      icon: '&#128100;',
      title: 'Profil Akun Admin',
      desc: 'Kelola data profil akun administrator Anda sendiri: nama lengkap, email, dan kata sandi login.',
      frontend: [],
      tips: [
        'Gunakan password yang kuat: minimal 8 karakter, kombinasi huruf, angka, dan simbol.',
        'Ganti password secara berkala (minimal setiap 3 bulan) untuk keamanan akun.',
        'JANGAN menggunakan password yang sama dengan akun media sosial atau email Anda.'
      ]
    }
  };

  function getGuideKey() {
    var parts = window.location.pathname.replace(/\/+$/, '').split('/').filter(Boolean);
    var adminIdx = -1;
    for (var i = 0; i < parts.length; i++) {
      if (parts[i] === 'adminsite') { adminIdx = i; break; }
    }
    if (adminIdx < 0) return null;
    var seg2 = parts[adminIdx + 1] || '';
    var seg3 = parts[adminIdx + 2] || '';
    var compositeKey = (seg2 && seg3) ? (seg2 + '/' + seg3) : '';
    if (compositeKey && GUIDE[compositeKey]) return compositeKey;
    if (seg2 && GUIDE[seg2]) return seg2;
    return null;
  }

  function buildChipsHTML(frontendPages) {
    if (!frontendPages || frontendPages.length === 0) {
      return '<span class="bxsea-guide-no-fe">Tidak mempengaruhi halaman frontend secara langsung.</span>';
    }
    return frontendPages.map(function (p) {
      return '<a href="' + BXSEA_BASE + p.url + '" target="_blank" rel="noopener noreferrer" class="bxsea-guide-chip">&#128279; ' + p.label + '</a>';
    }).join('');
  }

  function buildTipsHTML(tips) {
    if (!tips || tips.length === 0) return '';
    return tips.map(function (t) { return '<li>' + t + '</li>'; }).join('');
  }

  function buildBannerHTML(guide) {
    var feCol = '<div class="bxsea-guide-col">'
      + '<div class="bxsea-guide-section-lbl">&#128279; Tampil di halaman frontend</div>'
      + '<div class="bxsea-guide-chips">' + buildChipsHTML(guide.frontend) + '</div>'
      + '</div>';
    var tipsCol = (guide.tips && guide.tips.length)
      ? '<div class="bxsea-guide-col">'
        + '<div class="bxsea-guide-section-lbl">&#128161; Tips &amp; Catatan</div>'
        + '<ul class="bxsea-guide-tips-ul">' + buildTipsHTML(guide.tips) + '</ul>'
        + '</div>'
      : '';
    return '<div class="bxsea-guide-card">'
      + '<div class="bxsea-guide-head">'
        + '<span class="bxsea-guide-icon">' + guide.icon + '</span>'
        + '<div class="bxsea-guide-heading-group">'
          + '<div class="bxsea-guide-kicker">&#128214; Panduan Halaman</div>'
          + '<div class="bxsea-guide-title">' + guide.title + '</div>'
        + '</div>'
        + '<div class="bxsea-guide-actions">'
          + '<button class="bxsea-guide-btn bxsea-guide-btn-toggle js-bxguide-toggle" type="button">&#9660; Sembunyikan</button>'
          + '<button class="bxsea-guide-btn bxsea-guide-btn-dismiss js-bxguide-dismiss" type="button" title="Tutup panduan ini">&#10005;</button>'
        + '</div>'
      + '</div>'
      + '<div class="bxsea-guide-body js-bxguide-body">'
        + '<p class="bxsea-guide-desc">' + guide.desc + '</p>'
        + '<div class="bxsea-guide-row">' + feCol + tipsCol + '</div>'
      + '</div>'
    + '</div>';
  }

  document.addEventListener('DOMContentLoaded', function () {
    var guideKey = getGuideKey();
    if (!guideKey) return;
    var guide = GUIDE[guideKey];
    var storageKey = 'bxsea_guide_v1_' + guideKey.replace('/', '_');
    var isDismissed = localStorage.getItem(storageKey) === 'dismissed';
    var isCollapsed = localStorage.getItem(storageKey + '_col') === '1';

    var container = document.querySelector('#kt_content .d-flex.flex-column-fluid .container')
      || document.querySelector('#kt_content .d-flex.flex-column-fluid .container-fluid');
    if (!container) return;

    /* --- Banner --- */
    var wrap = document.createElement('div');
    wrap.className = 'bxsea-guide-wrap';
    wrap.style.display = isDismissed ? 'none' : '';
    wrap.innerHTML = buildBannerHTML(guide);
    container.insertBefore(wrap, container.firstChild);

    if (isCollapsed) {
      var body = wrap.querySelector('.js-bxguide-body');
      var toggleBtn = wrap.querySelector('.js-bxguide-toggle');
      if (body) body.style.display = 'none';
      if (toggleBtn) toggleBtn.innerHTML = '&#9654; Tampilkan panduan';
    }

    /* --- FAB --- */
    var fab = document.createElement('button');
    fab.type = 'button';
    fab.className = 'bxsea-guide-fab' + (isDismissed ? '' : ' is-hidden');
    fab.setAttribute('aria-label', 'Tampilkan panduan halaman');
    fab.innerHTML = '?<span class="bxsea-guide-fab-tip">Panduan Halaman</span>';
    document.body.appendChild(fab);

    /* --- Events: toggle collapse --- */
    var toggleBtn2 = wrap.querySelector('.js-bxguide-toggle');
    if (toggleBtn2) {
      toggleBtn2.addEventListener('click', function (e) {
        e.stopPropagation();
        var body2 = wrap.querySelector('.js-bxguide-body');
        if (body2.style.display === 'none') {
          body2.style.display = '';
          toggleBtn2.innerHTML = '&#9660; Sembunyikan';
          localStorage.removeItem(storageKey + '_col');
        } else {
          body2.style.display = 'none';
          toggleBtn2.innerHTML = '&#9654; Tampilkan panduan';
          localStorage.setItem(storageKey + '_col', '1');
        }
      });
    }

    /* --- Events: dismiss --- */
    var dismissBtn = wrap.querySelector('.js-bxguide-dismiss');
    if (dismissBtn) {
      dismissBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        wrap.style.display = 'none';
        fab.classList.remove('is-hidden');
        localStorage.setItem(storageKey, 'dismissed');
      });
    }

    /* --- Events: FAB restore --- */
    fab.addEventListener('click', function () {
      wrap.style.display = '';
      var body3 = wrap.querySelector('.js-bxguide-body');
      var toggleBtn3 = wrap.querySelector('.js-bxguide-toggle');
      if (body3) body3.style.display = '';
      if (toggleBtn3) toggleBtn3.innerHTML = '&#9660; Sembunyikan';
      localStorage.removeItem(storageKey);
      localStorage.removeItem(storageKey + '_col');
      fab.classList.add('is-hidden');
      wrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
  });
}());
</script>