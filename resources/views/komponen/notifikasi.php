<div class="modal fade" id="modalKeluar" tabindex="-1" aria-labelledby="modalKeluarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            
            <div class="modal-body p-4 text-center">
                
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" 
                     style="width: 60px; height: 60px; border-radius: 50%; background-color: #fee2e2; color: #dc2626; font-size: 26px;">
                    <i class="bi bi-box-arrow-right"></i>
                </div>
                
                <h5 class="fw-bold mb-2" id="modalKeluarLabel" style="color: #111827;">Konfirmasi Keluar</h5>
                <p class="text-muted small mb-4">Apakah anda yakin ingin mengakhiri sesi dan keluar dari sistem aplikasi?</p>
                
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-3" data-bs-dismiss="modal" style="border-radius: 10px; font-weight: 500;">
                        Batal
                    </button>
                    <a href="<?= $base ?>resources/views/auth/logout.php" class="btn btn-danger px-3" style="border-radius: 10px; font-weight: 500;">
                        Ya, Keluar
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            
            <div class="modal-body p-4 text-center">
                
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" 
                     style="width: 60px; height: 60px; border-radius: 50%; background-color: #fee2e2; color: #dc2626; font-size: 26px;">
                    <i class="bi bi-trash"></i>
                </div>
                
                <h5 class="fw-bold mb-2" id="modalHapusLabel" style="color: #111827;">Hapus Data Pegawai</h5>
                <p class="text-muted small mb-1">Apakah anda yakin ingin menghapus data pegawai ini?</p>
                <p class="fw-semibold text-danger small mb-4" id="namaPegawaiHapus"></p>
                
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-3" data-bs-dismiss="modal" style="border-radius: 10px; font-weight: 500;">
                        Batal
                    </button>
                    <a href="#" id="tombolKonfirmasiHapus" class="btn btn-danger px-3" style="border-radius: 10px; font-weight: 500;">
                        Ya, Hapus
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
