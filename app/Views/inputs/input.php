<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php if ($data['props']['format'] == 'main' || $data['props']['format'] == 'click') : ?>
        <?php
        if ($data['props']['col'] == 'tempat') {
            // dd($data);
        }
        ?>
        <div class="col-md-6" style="<?= ($data['props']['display'] ? 'display:none;' : ''); ?>">
            <div class="input-group input-group-sm mb-1 <?= $data['props']['type']; ?>" style="border-color:<?= tema('main'); ?>;font-size:<?= tema('font_size'); ?>">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>"><?= $data['props']['label']; ?></span>
                <input data-order="submit" <?php foreach ($data['datajs'] as $d) : ?><?php if ($data['props'][$d] !== '') : ?> <?= "data-$d="; ?><?= ($d == 'label' ? str_replace(".", "", str_replace(" ", "", $data['props'][$d])) : $data['props'][$d]); ?><?php endif; ?><?php endforeach; ?> style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>;" type=" text" name="<?= $data['props']['col']; ?>" value="<?= ($data['props']['disabled'] || $data['props']['display'] ? $data['props']['default'] : ''); ?>" class="form-control <?= ($data['props']['format'] == 'click' ? "click" : ""); ?> submit submit<?= str_replace(".", "", str_replace(" ", "", $data['props']['label'])); ?>" placeholder="<?= $data['props']['label']; ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" <?= ($data['props']['required'] ? 'required' : ''); ?> <?= ($data['props']['disabled'] ? 'disabled' : ''); ?>>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>