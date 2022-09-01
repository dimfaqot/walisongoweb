<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php
    $set = \App\Models\Settings::class;
    $set = new $set;
    $isdb = substr($data['props']['query'], 0, 1);
    if ($isdb == '$q') {
        $ops = $set->selectdb($data['utils']['menu'], 'submit', $data['props']['query']);
    } else {
        $ops = $set->selectself($data['utils']['menu'], $data['props']['query']);
    }

    // dd($ops);
    ?>
    <?php if ($data['props']['format'] == 'main') : ?>
        <div class="col-md-6" style="<?= ($data['props']['display'] ? 'display:none;' : ''); ?>">
            <div class="input-group input-group-sm mb-1" style="font-size:<?= tema('font_size'); ?>">
                <span class="input-group-text" id="inputGroup-sizing-sm" style="width:100px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>"><?= $data['props']['label']; ?></span>
                <?php foreach ($ops['data'] as $i) : ?>
                    <div class="form-check form-switch pt-2" style="font-size:<?= tema('font_size'); ?>">
                        <input class="form-check-input submit submit<?= str_replace(".", "", str_replace(" ", "", $data['props']['label'])); ?>" data-order="submit" value="<?= $i['val']; ?>" name="submit<?= str_replace(".", "", str_replace(" ", "", $data['props']['label'])); ?>" <?php foreach ($data['datajs'] as $d) : ?><?php if ($data['props'][$d] !== '') : ?> <?= "data-$d="; ?><?= ($d == 'label' ? str_replace(".", "", str_replace(" ", "", $data['props'][$d])) : $data['props'][$d]); ?><?php endif; ?><?php endforeach; ?> style="font-size:<?= tema('font_size'); ?>" type="<?= $data['props']['type']; ?>" role="switch" id="<?= $data['props']['col'] . $i['val']; ?>" <?= ($data['props']['required'] ? 'required' : ''); ?> <?= ($data['props']['disabled'] ? 'disabled' : ''); ?>>
                        <label class="form-check-label" style="font-size:<?= tema('font_size'); ?>" for="<?= $data['props']['col'] . $i['val']; ?>"><?= $i['text']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>