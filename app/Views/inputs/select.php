<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php if ($data['props']['format'] == 'main' || $data['props']['format'] == 'multi') : ?>

        <?php
        // dd($data);

        ?>
        <div class="col-md-6" style<?= ($data['props']['display'] ? 'display:none;' : ''); ?>">
            <div class="input-group input-group-sm mb-1" style="border-color:<?= tema('main'); ?>; font-size:<?= tema('font_size'); ?>">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>"><?= $data['props']['label']; ?></span>
                <input data-oldval="" data-order="submit" data-type="select" data-menu="<?= $data['utils']['menu']; ?>" <?php foreach ($data['datajs'] as $d) : ?><?php if ($data['props'][$d] !== '') : ?> <?= "data-$d="; ?><?= ($d == 'label' ? str_replace(".", "", str_replace(" ", "", $data['props'][$d])) : $data['props'][$d]); ?><?php endif; ?><?php endforeach; ?> style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>;" type="text" name="<?= $data['props']['col']; ?>" value="<?= ($data['props']['disabled'] || $data['props']['display'] ? $data['props']['default'] : ''); ?>" class="form-control select submit submit<?= str_replace(" ", "", $data['props']['label']); ?>" placeholder="<?= $data['props']['label']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" <?= ($data['props']['required'] ? 'required' : ''); ?> <?= ($data['props']['disabled'] ? 'disabled' : ''); ?>>
                <div class="list-group bodyselectsubmit<?= str_replace(" ", "", $data['props']['label']); ?>" style="font-size:<?= tema('font_size'); ?>;position:absolute;z-index:10;left:95px;top:34px;width:230px; display:none;">

                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>