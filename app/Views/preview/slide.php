<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php
    // dd($data);

    ?>
    <div class="container mb-3">
        <div class="title"><?= $data['utils']['judul']; ?></div>
        <div id="carouselExampleCaptions" class="carousel slide py-2" style="background-color:<?= tema('mid_dark'); ?>; border-radius:0px 0px 10px 10px;" data-bs-ride="false">
            <div class="carousel-inner" role="listbox">

                <?php
                $pembagian = 3;
                $jml = ceil(count($data['data']) / $pembagian);
                // >=0 <$pembagian >=$pembagian <20 >=20 <30
                // <3 <13
                ?>
                <?php for ($j = 0; $j < $jml; $j++) : ?>
                    <?php
                    $min = ($j > 0 ? $j * $pembagian : 0);
                    $max = ($j > 0 ? ($j + 1) * $pembagian : $pembagian);
                    $md = $min + 2;
                    ?>
                    <div class="carousel-item <?= ($j == 0 ? 'active' : ''); ?> py-2 <?= $min; ?> <?= $max; ?>" style="background-color:transparent;">
                        <div class="row justify-content-center">
                            <?php foreach ($data['data'] as $k => $i) : ?>
                                <?php if ($k >= $min && $k < $max) : ?>
                                    <div class="col-3 col-md-2 col-lg-1 <?= $k; ?>" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#slide<?= str_replace(" ", "", $data['utils']['judul']); ?><?= $i['id']; ?>">
                                        <div style="background-position: center; background-size: contain;width:80px; height:80px;background-image:url(images/<?= folder('profile'); ?>/<?= $i[$data['utils']['colshow'][1]]; ?>) ;">
                                        </div>
                                        <div>
                                            <p style="font-size:x-small"><?= ($data['utils']['colshow'][0] == 'nama' ? singkatnama($i[$data['utils']['colshow'][0]]) : $i[$data['utils']['colshow'][0]]); ?></p>
                                        </div>
                                    </div>

                                <?php endif; ?>


                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>



    <!-- modal -->
    <?php foreach ($data['data'] as $k => $i) : ?>
        <div class="modal fade" id="slide<?= str_replace(" ", "", $data['utils']['judul']); ?><?= $i['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="slide<?= str_replace(" ", "", $data['utils']['judul']); ?><?= $i['id']; ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header px-3 py-2 d-flex" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>; background-color:<?= tema('secondary'); ?>">

                        <div class="p-1"> <i class="fa fa-square" style="font-size:small; color:<?= tema('mid_dark'); ?>"></i></div>
                        <div class="p-1">
                            <p class="modal-title" id="slide<?= str_replace(" ", "", $data['utils']['judul']); ?><?= $i['id']; ?>Label"><?= $i[$data['utils']['colshow'][0]]; ?></p>
                        </div>
                        <div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="row">
                                <?php foreach ($data['props'] as $p) : ?>
                                    <?php if ($p['col'] !== 'profile') : ?>
                                        <div class="col-md-6">
                                            <ul class="list-group list-group-horizontal mb-2" style="font-size:<?= tema('font_size'); ?>;">
                                                <li style="font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;color:<?= tema('dark'); ?>; width:30%;" class="list-group-item py-2 px-3"><?= $p['label']; ?></li>
                                                <li style="font-size:<?= tema('font_size'); ?>;background-color:<?= tema('light'); ?>; color:<?= tema('dark'); ?>; width:70%;" class="list-group-item py-2 px-3"><?= $i[$p['col']]; ?></li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<?php endif; ?>