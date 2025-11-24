

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
                    <div class="row g-4">
                        <?php $__currentLoopData = $kendaraans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kendaraan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="kendaraan-card">
                                <div class="kendaraan-image">
                                    <img src="<?php echo e($kendaraan->foto ? asset('storage/' . $kendaraan->foto) : 'https://via.placeholder.com/300x200/1a1a1a/FF6B35?text=No+Image'); ?>" 
                                         alt="<?php echo e($kendaraan->nama_kendaraan); ?>">
                                    <div class="kendaraan-status">
                                        <?php echo $kendaraan->status_badge; ?>

                                    </div>
                                    <div class="kendaraan-category">
                                        <span class="badge bg-dark"><?php echo e($kendaraan->kategori->nama_kategori); ?></span>
                                    </div>
                                </div>
                                <div class="kendaraan-info">
                                    <h5 class="kendaraan-title"><?php echo e($kendaraan->nama_kendaraan); ?></h5>
                                    <div class="kendaraan-brand">
                                        <i class="fas fa-tag me-1"></i><?php echo e($kendaraan->merek); ?>

                                    </div>
                                    <p class="kendaraan-description"><?php echo e($kendaraan->deskripsi); ?></p>
                                    <div class="kendaraan-actions">
                                        <button class="btn btn-sm btn-orange-outline edit-btn" 
                                                data-id="<?php echo e($kendaraan->id_kendaraan); ?>"
                                                data-nama="<?php echo e($kendaraan->nama_kendaraan); ?>"
                                                data-merek="<?php echo e($kendaraan->merek); ?>"
                                                data-kategori="<?php echo e($kendaraan->id_kategori); ?>"
                                                data-deskripsi="<?php echo e($kendaraan->deskripsi); ?>"
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
                            <label for="id_kategori" class="form-label">Kategori</label>
                            <select class="form-control" id="id_kategori" name="id_kategori" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->id_kategori); ?>"><?php echo e($kategori->nama_kategori); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Disewa">Disewa</option>
                                <option value="Maintenance">Maintenance</option>
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
                            <label for="edit_id_kategori" class="form-label">Kategori</label>
                            <select class="form-control" id="edit_id_kategori" name="id_kategori" required>
                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->id_kategori); ?>"><?php echo e($kategori->nama_kategori); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-control" id="edit_status" name="status" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Disewa">Disewa</option>
                                <option value="Maintenance">Maintenance</option>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<style>
    /* Kendaraan Card Styles */
    .kendaraan-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        background: rgba(26, 26, 26, 0.8);
        border: 1px solid rgba(255, 107, 53, 0.2);
    }
    
    .kendaraan-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(255, 107, 53, 0.2);
        border-color: var(--orange);
    }
    
    .kendaraan-image {
        height: 200px;
        background: linear-gradient(135deg, var(--dark) 0%, var(--black) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    
    .kendaraan-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .kendaraan-card:hover .kendaraan-image img {
        transform: scale(1.1);
    }
    
    .kendaraan-status {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
    }
    
    .kendaraan-category {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 2;
    }
    
    .kendaraan-info {
        padding: 1.5rem;
    }
    
    .kendaraan-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--white);
        margin-bottom: 0.5rem;
    }
    
    .kendaraan-brand {
        color: var(--orange);
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .kendaraan-description {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .kendaraan-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: space-between;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: rgba(255, 255, 255, 0.6);
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: rgba(255, 255, 255, 0.3);
    }
    
    .section-title {
        color: var(--white);
        font-weight: 700;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(255, 107, 53, 0.3);
    }
    
    .preview-image {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        margin-top: 10px;
        display: none;
    }
    
    .badge.bg-orange {
        background: linear-gradient(135deg, var(--orange) 0%, var(--orange-light) 100%) !important;
    }
</style>

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
                const status = this.getAttribute('data-status');
                const foto = this.getAttribute('data-foto');

                // Isi form edit
                document.getElementById('edit_nama_kendaraan').value = nama;
                document.getElementById('edit_merek').value = merek;
                document.getElementById('edit_id_kategori').value = kategori;
                document.getElementById('edit_deskripsi').value = deskripsi;
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
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\SpeedRent\resources\views/admin/kendaraan.blade.php ENDPATH**/ ?>