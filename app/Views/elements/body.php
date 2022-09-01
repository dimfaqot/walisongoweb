<?php if ($data['utils']['tema'] == 'main') : ?>
    <div class="container mb-3">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group input-group-sm" style="font-size:<?= tema('font_size'); ?>">
                    <input style="width:200px; font-size:<?= tema('font_size'); ?>" data-order="search" data-menu="<?= $data['utils']['menu']; ?>" data type="text" class="select form-control" placeholder="Cari data..." autofocus>
                    <input style="width:50px; font-size:<?= tema('font_size'); ?>" type="text" data-idmenu="<?= $data['utils']['idmenu']; ?>" value="<?= $data['utils']['limits']; ?>" class="rows form-control" placeholder="Rows">
                    <button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#submit" class="btn" style="background-color:<?= tema('main'); ?>; border-color:<?= tema('secondary'); ?>; color:<?= tema('light'); ?>" type="button" id="button-addon2"><i class="fa fa-plus-square"></i></button>
                </div>
            </div>
        </div>
        <div class="accordion mt-2" id="accordionPanelsStayOpenExample" style="border:none;">
            <div class="accordion-item" style="border-bottom:1px solid <?= tema('secondary'); ?>; background-color:<?= tema('main'); ?>;">
                <div class="accordion-header d-grid px-2 py-3" id="panelsStayOpen-headingheader">
                    <button style="border:none; background-color:transparent;" href="#" class="collapsed" aria-current="true" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseheader" aria-expanded="false" aria-controls="panelsStayOpen-collapseheader">
                        <div class="d-flex justify-content-between" style="font-size:<?= tema('font_size'); ?>; color:<?= tema('light'); ?>">
                            <?php foreach ($data['utils']['colshow'] as $k => $c) : ?>
                                <div><?= firstWordUpCase(str_replace('_', ' ', $c)); ?></div>
                            <?php endforeach; ?>
                        </div>
                    </button>
                </div>
            </div>

            <div class="accordion-item body" style="border-bottom:1px solid <?= tema('secondary'); ?>;">

            </div>

        </div>
    </div>
<?php endif; ?>

<script>

</script>