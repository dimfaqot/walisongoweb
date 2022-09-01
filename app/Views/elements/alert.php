<?php if ($data['utils']['tema'] == 'main') : ?>

    <!-- loading -->
    <div class="blur waiting" style="display:none;">
        <div class="middlecenter">
            <div class="load">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>
    </div>


    <!-- sukses -->
    <div class="sukses middlecenter" style="display:none;">
        <div class="wrapper"> <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </div>
    </div>


    <div class="gagal blur" style="border-radius: 10px; display:none">
        <div class="middlecenter">
            <div class="d-flex justify-content-between bg-danger px-1" style="border-radius: 10px;width:300px; color:<?= color('danger light'); ?>;font-size:<?= tema('font_size'); ?>;">

                <div class="toast-body p-2" style="border-radius: 10px; font-size:<?= tema('font_size'); ?>;">
                    dfgdffgv
                </div>
                <div>
                    <button type="button" class="btn btn-sm m-auto btnclose" style="color: <?= color('danger light'); ?>;"><i class="fa fa-times-circle"></i></button>

                </div>
            </div>
        </div>
    </div>


    <!-- gagal php -->
    <?php if (session()->getFlashdata('gagal')) : ?>

        <div class="gagal blur" style="border-radius: 10px;">
            <div class="middlecenter">
                <div class="d-flex justify-content-between bg-danger px-1" style="border-radius: 10px;width:300px; color:<?= color('danger light'); ?>;font-size:<?= tema('font_size'); ?>;">

                    <div class="toast-body p-2" style="border-radius: 10px; font-size:<?= tema('font_size'); ?>;">
                        <?= session()->getFlashdata('gagal'); ?>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm m-auto btnclose" style="color: <?= color('danger light'); ?>;"><i class="fa fa-times-circle"></i></button>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>