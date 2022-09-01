<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php
    $utils = \App\Models\Utils::class;
    $utils = new $utils;
    $cols = [];
    foreach ($data['props'] as $i) {
        $cols[] = $i['col'];
    }
    // dd($data);
    ?>
    <div class="container mb-3">
        <div class="title"><?= $data['utils']['judul']; ?></div>
        <?php if (count($data['ops']) > 0) : ?>
            <?php if ($data['query'] == 'prevcetak') : ?>
                <div class="card my-1">
                    <div class="card-body">
                        <div class="title" style="background-color:<?= tema('secondary'); ?>; color:<?= tema('dark'); ?>">Kategori</div>
                        <div class="row mt-2" style="background-color:<?= tema('light'); ?>">
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="jenis">Jenis</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="jenis">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->kategoriuser() as $i) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="sub">Sub</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="sub">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->sub() as $i) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="status">Status</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="ket">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->ketuser() as $i) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="kelurahan">Kelurahan</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="kelurahan">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->kelurahan() as $i) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="kecamatan">Kecamatan</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="kecamatan">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->kecamatan() as $i) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="kabupaten">Kabupaten</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="kabupaten">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->kabupaten() as $i) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="provinsi">Provinsi</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="provinsi">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->provinsi() as $i) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <label style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="jenis">Ultah</label>
                                    <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select changepreview" data-query="<?= $data['query']; ?>" id="ultah">
                                        <option selected>Semua</option>
                                        <?php foreach ($utils->bulan() as $i) : ?>
                                            <option value="<?= $i['bulan']; ?>"><?= $i['bulan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>">Nama Gelar</span>
                                    <div class="form-check form-switch pt-2 ms-1" style="font-size:<?= tema('font_size'); ?>">
                                        <input data-type="check" data-menu="<?= $data['utils']['menu']; ?>" class="form-check-input changepreview" value="namagelar" data-query="<?= $data['query']; ?>" name="changepreview" type="checkbox" style="font-size:<?= tema('font_size'); ?>" role="switch" id="namagelar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card my-1">
                <div class="card-body">
                    <div class="title" style="background-color:<?= tema('secondary'); ?>; color:<?= tema('dark'); ?>">Pilihan</div>
                    <div class="row mt-2" style="background-color:<?= tema('light'); ?>">
                        <?php foreach ($data['ops'] as $i) : ?>
                            <div class="col-6 col-md-2">
                                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:70px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>"><?= $i['label']; ?></span>
                                    <div class="form-check form-switch pt-2 ms-1" style="font-size:<?= tema('font_size'); ?>">
                                        <input data-type="check" data-menu="<?= $data['utils']['menu']; ?>" name="changepreview" class="form-check-input changepreview" data-query="<?= $data['query']; ?>" type="checkbox" style="font-size:<?= tema('font_size'); ?>" role="switch" id="<?= $i['col']; ?>" value="<?= $i['col']; ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="card my-1">
            <div class="card-body">
                <div class="title" style="background-color:<?= tema('secondary'); ?>; color:<?= tema('dark'); ?>"><?= $data['query'] == 'prevcetak' ? 'Cari/Tambah Data' : 'Cari'; ?></div>
                <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
                    <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>">Cari</span>
                    <input data-query="<?= $data['query']; ?>" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>; background-color:<?= tema('light'); ?>;" type=" text" value="" class="form-control caripreview" placeholder="..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <?php if ($data['query'] == 'prevcetak') : ?>
                        <button style="border:1px solid <?= tema('mid_light'); ?>; color:<?= tema('mid_dark'); ?>" class="btn" type="button" data-bs-toggle="modal" data-bs-target="#addpreview"><i class="fa fa-plus-square"></i></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="bodypreview<?= $data['query']; ?>"></div>
    </div>


    <!-- modal -->
    <div class="modal fade" id="addpreview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addpreviewLabel" aria-hidden="true">
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