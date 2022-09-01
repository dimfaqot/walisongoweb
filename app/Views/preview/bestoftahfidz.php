<?php if ($data['utils']['tema'] == 'main') : ?>
  <?php
  $utils = \App\Models\Utils::class;
  $utils = new $utils;
  $th = date('Y');
  $bl = date('m');

  if (date('n') < 7) {
    $th = $th - 1;
  }
  ?>

  <div class="container mb-3">
    <div class="title"><?= $data['utils']['judul']; ?></div>
    <div class="row mt-2" style="background-color:<?= tema('light'); ?>">
      <div class="col-6 col-md-2">
        <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
          <label style="width:60px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="jenis">Tahun</label>
          <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select bestoftahfidz" data-query="<?= $data['query']; ?>" id="tahunbestoftahfidz">
            <?php foreach ($utils->tahun() as $i) : ?>
              <?php if ($i == $th) : ?>
                <option value="<?= $i; ?>" selected><?= $i; ?></option>
              <?php else : ?>
                <option value="<?= $i; ?>"><?= $i; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
          <label style="width:60px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="jenis">Bulan</label>
          <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select bestoftahfidz" data-query="<?= $data['query']; ?>" id="bulanbestoftahfidz">
            <option selected>Semua</option>
            <?php foreach ($utils->bulan() as $i) : ?>
              <?php if ($i['angka'] == $bl) : ?>
                <option selected value="<?= $i['angka']; ?>"><?= $i['bulan']; ?></option>

              <?php else : ?>
                <option value="<?= $i['angka']; ?>"><?= $i['bulan']; ?></option>

              <?php endif; ?>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
          <label style="width:60px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="jenis">Sort By</label>
          <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select bestoftahfidz" data-query="<?= $data['query']; ?>" id="sortbybestoftahfidz">
            <option selected>Semua</option>
            <option value="juz">By Juz</option>
            <option value="nilai">By Nilai</option>
            <option value="akhlaq_pengurus">By Adab Kpd. Pengurus</option>
            <option value="akhlaq_guru">By Adab Kpd. Guru</option>
            <option value="kedisiplinan_ketertiban">By Ketertiban</option>
            <option value="kedisiplinan_kerapian">By Kerapian</option>
            <option value="kedisiplinan_pelanggaran">By Pelanggaran</option>
            <option value="absen">By Absen</option>
          </select>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <div class="input-group input-group-sm my-1" style="font-size:<?= tema('font_size'); ?>">
          <label style="width:60px;font-size:<?= tema('font_size'); ?>; background-color:<?= tema('secondary'); ?>;border-color:<?= tema('mid_light'); ?>" class="input-group-text" for="jenis">Semester</label>
          <select data-type='select' data-menu="<?= $data['utils']['menu']; ?>" style="font-size:<?= tema('font_size'); ?>" class="form-select bestoftahfidz" data-query="<?= $data['query']; ?>" id="semesterbestoftahfidz">
            <option selected>Semua</option>
            <option value="ganjil">Ganjil</option>
            <option value="genap">Genap</option>
          </select>
        </div>
      </div>


    </div>
    <div class="mt-1 bodypreview<?= $data['query']; ?>">

    </div>
  </div>
<?php endif; ?>