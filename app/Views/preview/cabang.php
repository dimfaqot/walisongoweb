<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php
    $utils = \App\Models\Utils::class;
    $utils = new $utils;
    $cols = [];
    foreach ($data['props'] as $i) {
        $cols[] = $i['col'];
    }
    ?>
    <div class="container mb-3">
        <div class="title"><?= $data['utils']['judul']; ?></div>
        <div class="card my-1">
            <div class="card-body">
                <div class="row mt-2" style="background-color:<?= tema('light'); ?>">
                    <div class="col-6 col-md-2">
                        <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                            <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="jenis">Tahun</label>
                            <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="tahun">
                                <option selected>Semua</option>
                                <?php foreach ($utils->tahun() as $i) : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>">Cari</span>
                    <input data-query="<?= $data['query']; ?>" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>; background-color:<?= tema('light'); ?>;" type=" text" value="" class="form-control caripreview" placeholder="..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

                </div>
            </div>
        </div>
        <div class="bodypreview<?= $data['query']; ?>">

        </div>
    </div>


    <!-- modal -->
    <div class="modal fade" id="addcabang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addpreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="font-size:<?= tema('font_size'); ?>;">
                <div class="modal-body">
                    <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                        <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>">Cari</span>
                        <input data-menu="<?= $data['utils']['menu']; ?>" data-query="<?= $data['query']; ?>" data-cols="<?= implode(",", $cols); ?>" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>; background-color:<?= tema('light'); ?>;" type=" text" value="" class="form-control selectpreview" placeholder="..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" autofocus>
                        <button style="border:1px solid <?= color('danger mid_light'); ?>; color:<?= color('danger mid_dark'); ?>" class="btn" type="button" class="btn-close" data-bs-dismiss="modal"><i class="fa fa-remove"></i></button>
                    </div>
                    <div class="list-group bodyselectpreview" style="font-size:<?= tema('font_size'); ?>;position:absolute;z-index:10;left:95px;top:34px;width:230px; display:none;">

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>