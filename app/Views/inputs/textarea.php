<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php if ($data['props']['format'] == 'main') : ?>
        <div class="col-md-6" style="<?= ($data['props']['display'] ? 'display:none;' : ''); ?>">
            <div class="input-group input-group-sm mb-1 <?= $data['props']['type']; ?>" style="border-color:<?= tema('main'); ?>;font-size:<?= tema('font_size'); ?>">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>"><?= $data['props']['label']; ?></span>
                <textarea data-order="submit" <?php foreach ($data['datajs'] as $d) : ?><?php if ($data['props'][$d] !== '') : ?> <?= "data-$d="; ?><?= ($d == 'label' ? str_replace(".", "", str_replace(" ", "", $data['props'][$d])) : $data['props'][$d]); ?><?php endif; ?><?php endforeach; ?> style="font-size:<?= tema('font_size'); ?>; border-color:<?= tema('mid_light'); ?>;" name="<?= $data['props']['col']; ?>" class="form-control submit submit<?= str_replace(".", "", str_replace(" ", "", $data['props']['label'])); ?>" placeholder="<?= $data['props']['label']; ?>" aria-label=" With textarea" <?= ($data['props']['required'] ? 'required' : ''); ?> <?= ($data['props']['disabled'] ? 'disabled' : ''); ?>><?= ($data['props']['disabled'] || $data['props']['display'] ? $data['props']['default'] : ''); ?></textarea>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>