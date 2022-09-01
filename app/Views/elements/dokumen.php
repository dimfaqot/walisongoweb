<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php

    // dd($data);
    ?>
    <div class="container mb-3">
        <div class="title"><?= $data['utils']['judul']; ?></div>
        <div class="card p-1" style="border-radius: 0px 0px 10px 10px;">
            <div class="card-body">
                <div class="input-group input-group-sm mb-1" style="width:250px;">
                    <span class="input-group-text" style="font-size:<?= tema('font_size'); ?>" id="basic-addon1">Cari</span>
                    <input style="font-size:<?= tema('font_size'); ?>" data-menu="<?= $data['utils']['menu']; ?>" data-tabel="<?= $data['utils']['tabel']; ?>" data-order="dokumen" type="text" class="form-control select" placeholder="..." aria-label="Username" aria-describedby="basic-addon1" autofocus>
                </div>
                <div class="row g-2 bodydokumen">
                    <div class="mt-3 text-center" style="font-weight:bold;color:<?= tema('mid_dark'); ?>;font-size:<?= tema('font_size'); ?>;padding:5px 10px 5px 10px; border:1px solid <?= tema('mid_dark'); ?>; border-radius:10px; background-color:<?= tema('secondary'); ?>"><?= $data['utils']['judul']; ?></div>

                </div>
            </div>
        </div>
    </div>

    <!-- modal zoom -->
    <div style="z-index:9999;" class="modal fade" id="zoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header px-3 py-2 d-flex" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>; background-color:<?= tema('secondary'); ?>">

                    <div class="p-1"> <i class="fa fa-square" style="font-size:small; color:<?= tema('mid_dark'); ?>"></i></div>
                    <div class="p-1">
                        <p class="modal-title" id="submitLabel">Dokumen</p>
                    </div>
                    <div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>

                </div>
                <div class="modal-body text-center">
                    <img class="bodyzoom img-fluid" src="" alt="Dokumen">
                </div>
                <div class="d-grid gap-1 d-flex justify-content-center p-2" style="border-top:1px solid <?= tema('mid_light'); ?>; background-color:<?= tema('light'); ?>">
                    <a class="btn download" href="" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:<?= tema('secondary'); ?>; color:<?= tema('dark'); ?>" download>
                        <i class="fa fa-cloud-download"></i> Download
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>