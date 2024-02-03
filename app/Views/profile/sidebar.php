<div class="col-3 d-none d-md-block border-end">
    <div class="card-body">
        <h4 class="subheader">Profile</h4>
        <div class="list-group list-group-transparent">
            <a href="<?= base_url('/profile') ?>" class="list-group-item list-group-item-action d-flex align-items-center active">Kelola Profile</a>
        </div>
        <h4 class="subheader mt-4">Email & Password</h4>
        <div class="list-group list-group-transparent">
            <a href="<?= base_url('/ubah-email') ?>" class="list-group-item list-group-item-action">Ubah Email</a>
            <a href="<?= base_url('/ubah-password') ?>" class="list-group-item list-group-item-action">Ubah Password</a>
        </div>
        <h4 class="subheader mt-4">Keluar</h4>
        <div class="list-group list-group-transparent">
            <a href="<?= base_url('/logout') ?>" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#logout-modal">Logout</a>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="logout-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-title">Anda yakin ingin Logout?</div>
                <div>Silahkan kembali lagi kapanpun yang Anda inginkan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Ya, logout</a>
            </div>
        </div>
    </div>
</div>