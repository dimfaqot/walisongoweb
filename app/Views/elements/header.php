<!-- format berasal dari functions tema. Data di dalamnya berisi tema yang diset di tabel tema -->
<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php
    $utils = \App\Models\Utils::class;
    $utils = new $utils;

    // dd($data);

    ?>
    <div style="background-color:<?= tema('main'); ?>; color:<?= tema('light'); ?>; border-radius: 0px 0px 130px 130px; height:280px; margin-bottom:-80px;">
        <div class="text-center pt-3">

            <!-- logout -->
            <div class="d-flex justify-content-center">
                <div style="font-size:x-large;" data-bs-toggle="modal" data-bs-target="#menusettings">
                    <a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#menusetting" style="color:<?= tema('mid_light'); ?>">
                        <i class="fa fa-navicon"></i>
                    </a>
                </div>
                <form action="<?= base_url('login/logout'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <button style="width: 200px; background-color:<?= tema('light'); ?>; color:<?= tema('dark'); ?>;" class="btn font-weight-bold mb-3">Logout</button>
                </form>

            </div>

            <hr style="width: 200px; margin:auto;">

            <!-- nav -->
            <div class="mb-2 mt-2" style="color: <?= tema('mid_light'); ?>;">

                <!-- Navigation -->

                <div class="btn-group">
                    <a type="button" href="<?= base_url('dashboard'); ?>" style="background-color: <?= tema('mid_light'); ?>; color: <?= tema('dark'); ?>;" class="btn btn-sm btnHome"><i class="fa fa-home"></i> Home</a>
                    <button type="button" style="background-color: <?= tema('mid_light'); ?>; color: <?= tema('dark'); ?>;" class="btn btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" style="background-color: <?= tema('light'); ?>; color: <?= tema('dark'); ?>; font-size:<?= tema('font_size'); ?>;">
                        <?php foreach (menus() as $i) : ?>
                            <li><a class="dropdown-item" style="color:<?= tema('dark'); ?>;" href="<?= base_url() . '/' . strtolower(str_replace(' ', '', $i['menu'])); ?>"><i class="<?= $i['icon']; ?>"></i> <?= $i['menu']; ?></a></li>
                            <hr style="width: 200px; margin:auto;">
                        <?php endforeach; ?>
                    </ul>
                </div>


                <!-- Title -->
                <i class="<?= menu($data['utils']['menu'])['icon']; ?>"></i> <?= menu($data['utils']['menu'])['menu']; ?>
            </div>

            <!-- identitas -->
            <h4 style="color: <?= tema('light'); ?>;"><?= session('nama'); ?></h4>
            <h6 class="roleuser" style="color: <?= tema('light'); ?>;"><?= role('text', session('role_id')); ?></h6>
        </div>
        <hr style="width: 200px; margin:auto;">
    </div>


    <!-- modal menu setting-->
    <div class="modal fade" id="menusetting" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header px-3 py-2 d-flex" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>; background-color:<?= tema('secondary'); ?>">

                    <div class="p-1"> <i class="fa fa-square" style="font-size:small; color:<?= tema('mid_dark'); ?>"></i></div>
                    <div class="p-1">
                        <p class="modal-title" id="submitLabel">Settings</p>
                    </div>
                    <div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>

                </div>
                <div class="modal-body">
                    <div class="title">Ganti Password</div>
                    <div class="card mb-3" style="border-radius:0px 0px 10px 10px;">
                        <div class="card-body">
                            <div class="row">
                                <form action="<?= base_url('dashboard'); ?>/gantipassword" method="post">
                                    <input type="hidden" name="menu" value="<?= strtolower(str_replace(" ", "", $data['utils']['menu'])); ?>">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-sm mb-1" style="font-size:<?= tema('font_size'); ?>;">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:120px;font-size:<?= tema('font_size'); ?>;background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>">Password Sekarang</span>
                                            <input style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>" name="passwordsekarang" type="password" value="" class="form-control" placeholder="Password sekarang" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-sm mb-1" style="font-size:<?= tema('font_size'); ?>;">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:120px;font-size:<?= tema('font_size'); ?>;background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>">Password Baru</span>
                                            <input style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>" name="passwordbaru" type="password" value="" class="form-control" placeholder="Password Baru" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-sm mb-1" style="font-size:<?= tema('font_size'); ?>;">
                                            <span class="input-group-text" id="inputGroup-sizing-sm" style="width:120px;font-size:<?= tema('font_size'); ?>;background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>">Konfirmasi</span>
                                            <input style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>" name="konfirmasi" type="password" value="" class="form-control" placeholder="Konfirmasi Password Baru" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:<?= tema('secondary'); ?>; color:<?= tema('dark'); ?>">
                                            <i class="fa fa-folder"></i> Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="title">Ganti Ukuran Font</div>
                    <div class="card mb-3" style="border-radius:0px 0px 10px 10px;">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($utils->fontsize() as $i) : ?>
                                    <div class="col-md-6" style="border-bottom:1px solid <?= tema('secondary'); ?>">
                                        <div class="form-check form-switch" style="font-size:<?= tema('font_size'); ?>">
                                            <input style="font-size:<?= tema('font_size'); ?>" data-val="<?= $i['val']; ?>" name="fontsize" class="form-check-input fontsize" type="radio" role="switch" id="flexSwitchCheckChecked" <?= ($i['val'] == tema('font_size') ? 'checked' : ''); ?>>
                                            <label style="font-size:<?= tema('font_size'); ?>" class="form-check-label" for="flexSwitchCheckChecked"><?= $i['label']; ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="title">Ganti Warna</div>
                    <div class="card mb-3" style="border-radius:0px 0px 10px 10px;">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach (color() as $i) : ?>
                                    <div class="col-md-6 mb-2 pb-2" style="border-bottom:1px solid <?= tema('secondary'); ?>">
                                        <button type="button" class="btn colortema" data-id="<?= $i['id']; ?>" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; width:100px;background-color:<?= $i['main']; ?>;color:<?= $i['light']; ?>; border-color:<?= $i['secondary']; ?>">
                                            <?= firstWordUpCase($i['color']); ?>
                                        </button>
                                        <span style="font-size:<?= tema('font_size'); ?>; color:<?= $i['main']; ?>"><?= ($i['id'] == tema('color_id') ? 'Active <i class="fa fa-check-circle"></i>' : ''); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>