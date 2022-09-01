    <?php if ($data['utils']['tema'] == 'main') : ?>

        <?php
        // dd($data);
        $folderttd = folder('ttd');
        $ttd = explode(",", folder('ttds'));
        $folderkop = folder('kop');
        $kop = explode(",", folder('kops'));
        ?>
        <!-- Modal -->
        <div style="z-index:99999;" class="modal fade" id="ttds" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog">
                <div class="modal-content">
                    <div class="modal-header px-3 py-2 d-flex" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('dark'); ?>; background-color:<?= tema('mid_dark'); ?>">

                        <div class="p-1"> <i class="fa fa-square" style="font-size:small; color:<?= tema('light'); ?>"></i></div>
                        <div class="p-1">
                            <p class="modal-title" style="color:<?= tema('light'); ?>" id="submitLabel">Tambah Data <?= $data['utils']['menu']; ?></p>
                        </div>
                        <div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>

                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <?php foreach ($ttd as $i) : ?>
                                <div class="col text-center">
                                    <p><?= $i; ?></p>
                                    <img width="200px" class="insertclick insertclickttds" data-format="ttds" data-val="<?= $i; ?>" src="images/<?= $folderttd; ?>/<?= $i; ?>" alt="<?= $i; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="z-index:99999;" class="modal fade" id="kops" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="submitLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog">
                <div class="modal-content">
                    <div class="modal-header px-3 py-2 d-flex" style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('dark'); ?>; background-color:<?= tema('mid_dark'); ?>">

                        <div class="p-1"> <i class="fa fa-square" style="font-size:small; color:<?= tema('light'); ?>"></i></div>
                        <div class="p-1">
                            <p class="modal-title" style="color:<?= tema('light'); ?>" id="submitLabel">Tambah Data <?= $data['utils']['menu']; ?></p>
                        </div>
                        <div class="ms-auto p-1"><button type="button" style="font-size:smaller" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>

                    </div>
                    <div class="modal-body">
                        <div class="row g-3 justify-content-center">
                            <?php foreach ($kop as $i) : ?>
                                <div class="col text-center">
                                    <p><?= $i; ?></p>
                                    <img width="340px" class="insertclick insertclickkops" data-format="kops" data-val="<?= $i; ?>" src="images/<?= $folderkop; ?>/<?= $i; ?>" alt="<?= $i; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- off cancas -->

    <?php endif; ?>