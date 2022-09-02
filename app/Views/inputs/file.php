<?php if ($data['utils']['tema'] == 'main') : ?>
    <?php if ($data['props']['format'] == 'main') : ?>
        <?php
        helper('form');
        // dd($data);
        // $datas = [];
        foreach ($data['utils']['colshow'] as $i) {

            $exp = explode(".", $data['data'][$i]);
            if (count($exp) > 1) {
                $datas[] = ['col' => $i, 'label' => $data['props']['label'], 'id' => $data['data']['id'], 'val' => $data['data'][$i]];
            }
        }
        ?>

        <?php foreach ($datas as $i) : ?>
            <?php $exp = explode(".", $i['val']); ?>
            <div class="col-md-6" style="<?= ($data['props']['display'] ? 'display:none;' : ''); ?>">
                <div class="card py-2">
                    <?php if (end($exp) == 'jpg' || end($exp) == 'jpeg' || end($exp) == 'png') : ?>
                        <div class="m-auto click dokumen<?= str_replace(".", "", str_replace(" ", "", $i['label'])) . $i['id']; ?>" data-format="zoom" style="cursor: pointer;width:100px; height:100px;background-position: center; background-size: contain;background-repeat: no-repeat; background-image:url(images/<?= folder($i['col']); ?>/<?= $i['val']; ?>)">
                        </div>
                    <?php else : ?>
                        <a class="text-center" href="images/<?= folder($i['col']); ?>/<?= $i['val']; ?>">Berkas <?= substr($i['val'], -10); ?></a>
                    <?php endif; ?>
                    <div class="card-body p-0">
                        <?= form_open_multipart(base_url('dashboard') . "/dokumen") ?>
                        <input type="hidden" name="id" value="<?= $i['id']; ?>">
                        <input type="hidden" name="tabel" value="<?= $data['utils']['table']; ?>">
                        <input type="hidden" name="col" value="<?= $data['props']['col']; ?>">
                        <input type="hidden" name="menu" value="<?= $data['utils']['menu']; ?>">
                        <input type="hidden" name="ext" value="<?= $data['props']['query']; ?>">
                        <input type="hidden" name="folder" value="<?= folder($i['col']); ?>">
                        <div class="d-grid gap-2 d-flex justify-content-center mt-2">
                            <label class="uploadLabel" style="background-color:<?= color('primary secondary'); ?>; color:<?= color('primary dark'); ?>; font-size:<?= tema('font_size'); ?>;">
                                <input data-order="dokumen" data-id="<?= $i['id']; ?>" data-label="<?= str_replace(".", "", str_replace(" ", "", $i['label'])); ?>" type="file" name="dokumen" class="uploadButton inputdokumen" />
                                Pilih <?= $i['label']; ?>
                            </label>
                            <button type="submit" class="btn" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; background-color:<?= tema('secondary'); ?>; color:<?= tema('dark'); ?>">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>




    <?php endif; ?>
<?php endif; ?>