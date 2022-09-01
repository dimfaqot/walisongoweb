<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php
    // dd($data);


    ?>
    <div class="modal fade" id="submit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header px-3 py-2 d-flex" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>; background-color:<?= tema('secondary'); ?>">

                    <div class="p-1"> <i class="fa fa-square" style="font-size:small; color:<?= tema('mid_dark'); ?>"></i></div>
                    <div class="p-1">
                        <p class="modal-title" id="submitLabel">Tambah Data <?= $data['utils']['menu']; ?></p>
                    </div>
                    <div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php foreach ($data['inputs'] as $i) : ?>
                            <?= $i; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="d-grid gap-1 d-flex justify-content-center p-2" style="border-top:1px solid <?= tema('mid_light'); ?>; background-color:<?= tema('light'); ?>">
                    <button data-order="submit" data-idmenu="<?= $data['utils']['idmenu']; ?>" data-tabel="<?= $data['utils']['tabel']; ?>" data-labels="<?= $data['labels']; ?>" type="button" class="btn save" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:<?= tema('secondary'); ?>; color:<?= tema('dark'); ?>">
                        <i class="fa fa-folder-o"></i> Save
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>