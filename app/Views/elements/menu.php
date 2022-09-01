<?php if ($data['utils']['tema'] == 'main') : ?>
    <div class="container" style="margin-bottom: 20px;">
        <div class="card p-4" style="border-radius: 40px;">
            <div class="card-body">
                <div class="row g-3">
                    <?php foreach (menus() as $k => $i) : ?>

                        <div class="col-6">
                            <a href="<?= base_url() . '/' . strtolower(str_replace(' ', '', $i['menu'])); ?>" style="text-decoration: none;">
                                <div class="card" style="border-radius: 30px; border-color:<?= tema('mid_dark'); ?>">
                                    <div class="card-body text-center">
                                        <div class="mb-2">
                                            <i class="<?= $i['icon']; ?>" style="font-size:30px; color: <?= tema('main'); ?>;"></i>
                                        </div>
                                        <hr style="width: 100px; margin:auto;color:<?= tema('dark'); ?>;">
                                        <h6 style="color: <?= tema('main'); ?>;"><?= $i['menu']; ?></h6>
                                    </div>
                                </div>
                            </a>

                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>