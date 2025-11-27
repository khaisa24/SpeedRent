

<?php $__env->startSection('title', 'Manajemen Kendaraan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <!-- Alert Messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Daftar Kendaraan (CARD DI ATAS) -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="orange-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title mb-0">
                        <i class="fas fa-car-side me-2"></i>Daftar Kendaraan
                    </h3>
                    <span class="badge bg-orange px-3 py-2">
                        Total: <?php echo e($kendaraans->count()); ?> Kendaraan
                    </span>
                </div>
                
                <?php if($kendaraans->count() > 0): ?>
                    <div class="kendaraan-grid">
                        <?php $__currentLoopData = $kendaraans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kendaraan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="kendaraan-item">
                            <div class="kendaraan-card">
                                <div class="kendaraan-image">
                                    <img src="<?php echo e($kendaraan->foto ? asset('storage/' . $kendaraan->foto) : 'https://via.placeholder.com/300x200/1a1a1a/FF6B35?text=No+Image'); ?>" 
                                         alt="<?php echo e($kendaraan->nama_kendaraan); ?>"
                                         onerror="this.src='https://via.placeholder.com/300x200/1a1a1a/FF6B35?text=No+Image'">
                                    <div class="kendaraan-status">
                                        <?php echo $kendaraan->status_badge; ?>

                                    </div>
                                    <div class="kendaraan-category">
                                        <span class="badge bg-dark"><?php echo e($kendaraan->kategori->nama_kategori ?? 'No Category'); ?></span>
                                    </div>
                                </div>
                                <div class="kendaraan-info">
                                    <h5 class="kendaraan-title"><?php echo e($kendaraan->nama_kendaraan); ?></h5>
                                    <div class="kendaraan-details">
                                        <div class="kendaraan-brand">
                                            <i class="fas fa-tag me-1"></i><?php echo e($kendaraan->merek); ?>

                                        </div>
                                        <div class="kendaraan-type">
                                            <i class="fas fa-list me-1"></i><?php echo e($kendaraan->kategori->jenis ?? 'N/A'); ?>

                                        </div>
                                        <div class="kendaraan-specs">
                                            <span class="spec-item">
                                                <i class="fas fa-palette me-1"></i><?php echo e($kendaraan->warna); ?>

                                            </span>
                                            <span class="spec-item">
                                                <i class="fas fa-id-card me-1"></i><?php echo e($kendaraan->plat_nomor); ?>

                                            </span>
                                            <span class="spec-item">
                                                <i class="fas fa-users me-1"></i><?php echo e($kendaraan->kapasitas); ?> Org
                                            </span>
                                            <span class="spec-item">
                                                <i class="fas fa-gas-pump me-1"></i><?php echo e($kendaraan->bahan_bakar); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <p class="kendaraan-description"><?php echo e(Str::limit($kendaraan->deskripsi, 120)); ?></p>
                                    <div class="kendaraan-actions">
                                        <button class="btn btn-sm btn-orange-outline edit-btn" 
                                                data-id="<?php echo e($kendaraan->id_kendaraan); ?>"
                                                data-nama="<?php echo e($kendaraan->nama_kendaraan); ?>"
                                                data-merek="<?php echo e($kendaraan->merek); ?>"
                                                data-kategori="<?php echo e($kendaraan->id_kategori); ?>"
                                                data-deskripsi="<?php echo e($kendaraan->deskripsi); ?>"
                                                data-warna="<?php echo e($kendaraan->warna); ?>"
                                                data-plat_nomor="<?php echo e($kendaraan->plat_nomor); ?>"
                                                data-kapasitas="<?php echo e($kendaraan->kapasitas); ?>"
                                                data-bahan_bakar="<?php echo e($kendaraan->bahan_bakar); ?>"
                                                data-status="<?php echo e($kendaraan->status); ?>"
                                                data-foto="<?php echo e($kendaraan->foto); ?>">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                        <form action="<?php echo e(route('admin.kendaraan.destroy', $kendaraan->id_kendaraan)); ?>" 
                                              method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-car"></i>
                        <h4>Belum ada kendaraan</h4>
                        <p>Mulai dengan menambahkan kendaraan pertama Anda.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Form Tambah Kendaraan (FORM DI BAWAH) -->
    <div class="row">
        <div class="col-12">
            <div class="orange-card p-4">
                <h3 class="section-title">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Kendaraan Baru
                </h3>
                <form action="<?php echo e(route('admin.kendaraan.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_kendaraan" class="form-label">Nama Kendaraan</label>
                            <input type="text" class="form-control" id="nama_kendaraan" name="nama_kendaraan" 
                                   placeholder="Contoh: Toyota Avanza" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="merek" class="form-label">Merek</label>
                            <input type="text" class="form-control" id="merek" name="merek" 
                                   placeholder="Contoh: Toyota" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_kategori" class="form-label">Kategori & Jenis</label>
                            <select class="form-control dark-select" id="id_kategori" name="id_kategori" required>
                                <option value="" disabled selected>Pilih Kategori & Jenis</option>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->id_kategori); ?>">
                                        <?php echo e($kategori->nama_kategori); ?> - <?php echo e($kategori->jenis); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-muted">Pilih kategori (Mobil/Motor) dan jenis kendaraan</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control bg-success text-white" value="Tersedia" readonly>
                            <input type="hidden" name="status" value="Tersedia">
                            <small class="text-muted">Status otomatis "Tersedia" untuk kendaraan baru</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="warna" class="form-label">Warna Kendaraan</label>
                            <input type="text" class="form-control" id="warna" name="warna" 
                                   placeholder="Contoh: Putih, Hitam, Silver" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="plat_nomor" class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" 
                                   placeholder="Contoh: B 1234 ABC" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas (Jumlah Penumpang)</label>
                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" 
                                   min="1" max="20" placeholder="Contoh: 4" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bahan_bakar" class="form-label">Bahan Bakar</label>
                            <select class="form-control dark-select" id="bahan_bakar" name="bahan_bakar" required>
                                <option value="" disabled selected>Pilih Bahan Bakar</option>
                                <option value="Bensin">Bensin</option>
                                <option value="Solar">Solar</option>
                                <option value="Listrik">Listrik</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" 
                                  placeholder="Deskripsi kendaraan..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Kendaraan</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                        <div class="mt-2">
                            <img id="fotoPreview" class="preview-image" src="#" alt="Preview Foto">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-orange-outline me-2">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-orange-primary">
                            <i class="fas fa-save me-1"></i>Simpan Kendaraan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Kendaraan -->
<div class="modal fade" id="editKendaraanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content orange-card">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kendaraan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editKendaraanForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nama_kendaraan" class="form-label">Nama Kendaraan</label>
                            <input type="text" class="form-control" id="edit_nama_kendaraan" name="nama_kendaraan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_merek" class="form-label">Merek</label>
                            <input type="text" class="form-control" id="edit_merek" name="merek" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_id_kategori" class="form-label">Kategori & Jenis</label>
                            <select class="form-control dark-select" id="edit_id_kategori" name="id_kategori" required>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->id_kategori); ?>">
                                        <?php echo e($kategori->nama_kategori); ?> - <?php echo e($kategori->jenis); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-control dark-select" id="edit_status" name="status" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Disewa">Disewa</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_warna" class="form-label">Warna Kendaraan</label>
                            <input type="text" class="form-control" id="edit_warna" name="warna" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_plat_nomor" class="form-label">Plat Nomor</label>
                            <input type="text" class="form-control" id="edit_plat_nomor" name="plat_nomor" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_kapasitas" class="form-label">Kapasitas (Jumlah Penumpang)</label>
                            <input type="number" class="form-control" id="edit_kapasitas" name="kapasitas" 
                                   min="1" max="20" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_bahan_bakar" class="form-label">Bahan Bakar</label>
                            <select class="form-control dark-select" id="edit_bahan_bakar" name="bahan_bakar" required>
                                <option value="Bensin">Bensin</option>
                                <option value="Solar">Solar</option>
                                <option value="Listrik">Listrik</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_foto" class="form-label">Foto Kendaraan (Opsional)</label>
                        <input type="file" class="form-control" id="edit_foto" name="foto" accept="image/*">
                        <div class="mt-2">
                            <img id="editFotoPreview" class="preview-image" src="#" alt="Preview Foto">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange-outline" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-orange-primary">Update Kendaraan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview image untuk form tambah
        const fotoInput = document.getElementById('foto');
        const fotoPreview = document.getElementById('fotoPreview');
        
        fotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    fotoPreview.src = e.target.result;
                    fotoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Edit functionality
        const editButtons = document.querySelectorAll('.edit-btn');
        const editModal = new bootstrap.Modal(document.getElementById('editKendaraanModal'));
        const editForm = document.getElementById('editKendaraanForm');
        
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const merek = this.getAttribute('data-merek');
                const kategori = this.getAttribute('data-kategori');
                const deskripsi = this.getAttribute('data-deskripsi');
                const warna = this.getAttribute('data-warna');
                const plat_nomor = this.getAttribute('data-plat_nomor');
                const kapasitas = this.getAttribute('data-kapasitas');
                const bahan_bakar = this.getAttribute('data-bahan_bakar');
                const status = this.getAttribute('data-status');
                const foto = this.getAttribute('data-foto');

                // Isi form edit
                document.getElementById('edit_nama_kendaraan').value = nama;
                document.getElementById('edit_merek').value = merek;
                document.getElementById('edit_id_kategori').value = kategori;
                document.getElementById('edit_deskripsi').value = deskripsi;
                document.getElementById('edit_warna').value = warna;
                document.getElementById('edit_plat_nomor').value = plat_nomor;
                document.getElementById('edit_kapasitas').value = kapasitas;
                document.getElementById('edit_bahan_bakar').value = bahan_bakar;
                document.getElementById('edit_status').value = status;
                
                // Set action form
                editForm.action = `/admin/kendaraan/${id}`;

                // Tampilkan preview foto lama
                if (foto) {
                    const editFotoPreview = document.getElementById('editFotoPreview');
                    editFotoPreview.src = `/storage/${foto}`;
                    editFotoPreview.style.display = 'block';
                }

                editModal.show();
            });
        });

        // Preview image untuk form edit
        const editFotoInput = document.getElementById('edit_foto');
        const editFotoPreview = document.getElementById('editFotoPreview');
        
        editFotoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editFotoPreview.src = e.target.result;
                    editFotoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Force refresh select elements untuk memastikan style diterapkan
        const selectElements = document.querySelectorAll('.dark-select');
        selectElements.forEach(select => {
            select.style.backgroundColor = '#2d3748';
            select.style.color = 'white';
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/kendaraan.blade.php ENDPATH**/ ?>