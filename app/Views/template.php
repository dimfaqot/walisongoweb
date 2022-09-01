<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $data['judul']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
    <style>
        .active {
            background-color: <?= tema('mid_light'); ?>;
            color: <?= tema('dark'); ?>;

        }

        .bgactive {
            background-color: <?= tema('mid_light'); ?>;
        }

        .coloractive {
            color: <?= tema('dark'); ?>;
        }

        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: inset 0px 0px 0px <?= color('success main'); ?>;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both
        }


        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px <?= color('success main'); ?>
            }
        }

        /* loading */
        .load span {
            display: block;
            height: 20px;
            width: 20px;
            background: <?= color('primary dark'); ?>;
            border-radius: 50%;
            animation: all-effect 0.6s linear infinite alternate;
            transform: scale(0);
        }

        .load span:nth-child(4) {
            animation-delay: 0.4s;
            background: <?= color('info main'); ?>;
        }

        .boxlist {
            background-color: <?= tema('light'); ?>;
            border: 1px solid <?= tema('mid_light'); ?>;
            border-radius: 10px;
            padding: 10px;
        }

        .bglist {
            background-color: <?= tema('secondary'); ?>;
            border-radius: 10px;
            color: <?= tema('dark'); ?>;
            padding: 5px 10px 5px 10px;
            font-size: <?= tema('font_size'); ?>;
            font-weight: 700;
        }

        .form-check-input:checked {
            background-color: <?= tema('main'); ?>;
            border-color: <?= tema('mid_dark'); ?>;
        }

        .form-check-input:checked {
            background-color: <?= tema('main'); ?>;
            border-color: <?= tema('mid_dark'); ?>;
        }

        .title {
            border-radius: 10px 10px 0px 0px;
            background-color: <?= tema('main'); ?>;
            color: <?= tema('light'); ?>;
            font-weight: 600;
            font-size: <?= tema('font_size'); ?>;
            padding-top: 4px;
            padding-bottom: 4px;
            padding-bottom: 4px;
            text-align: center;
        }

        .print {
            /* border-radius: 10px 10px 0px 0px; */
            background-color: <?= tema('secondary'); ?>;
            color: <?= tema('light'); ?>;
            font-weight: 600;
            font-size: <?= tema('font_size'); ?>;
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: center;
            margin-top: -2;
        }

        .hapus {
            border-radius: 10px;
            width: 23px;
            height: 23px;
            background-color: <?= color('danger secondary'); ?>;
            color: <?= color('danger main'); ?>;
            cursor: pointer;
            position: relative;
        }
    </style>

</head>

<body>

    <form id="form">
        <div id="bodyform"></div>
    </form>
    <!-- <div class="container">
        <div class="row py-2" style="font-size:<?= tema('font_size'); ?>;">
            <div style="font-size:<?= tema('font_size'); ?>;" class="col-1">NO.</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="col-6 col-md-2">NAMA</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">KELAS</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="col-4 col-md-1">JUZ</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">ADP</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">ADG</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">KTTB</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">ALPHA</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">PEL</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">NILAI</div>
            <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">TOTAL</div>
        </div>
        <?php for ($i = 0; $i < 10; $i++) : ?>
            <?php $bg = tema('secondary');
            if ($i % 2 == 1) {
                $bg = tema('light');
            }
            ?>
            <a href="" style="text-decoration:none; color:<?= tema('dark'); ?>;">
                <div class="row py-2" style="font-size:<?= tema('font_size'); ?>;background-color:<?= $bg; ?>">
                    <div style="font-size:<?= tema('font_size'); ?>;" class="col-1"><?= $i + 1; ?></div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="col-6 col-md-2">Boolean ALinea Pertama</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">XII IPA 4</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="col-4 col-md-1">Juz 1 Hal. 6-10</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">10987</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">10987</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">10987</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">10987</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">10987</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">10987</div>
                    <div style="font-size:<?= tema('font_size'); ?>;" class="d-none col-1 d-md-block">10987</div>
                </div>
            </a>
        <?php endfor; ?>
    </div> -->


    <?php

    foreach ($data['html'] as $i) {
        echo $i;
    }
    ?>
    <div class="container bodycopy"></div>
    <div style="height:100px;"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        const baseUrl = "<?= base_url(); ?>";
        const mainMenu = "<?= $data['judul']; ?>";
        const date = new Date();
    </script>
    <script src="<?= base_url(); ?>/js/functions.js"></script>
    <script src="<?= base_url(); ?>/js/execute.js"></script>

    <!-- sukses  php-->

    <?php if (session()->getFlashdata('sukses')) : ?>
        <script>
            $('.sukses').show();
            setTimeout(() => {
                $('.sukses').fadeOut();
            }, 1500);
            let res = "<?= session()->getFlashdata('sukses'); ?>";
            let exp = res.split(",");
            if (exp[0] == 'dokumensukses') {
                let data = {
                    'order': exp[0],
                    'menu': exp[1],
                    'id': exp[2],
                    'val': ''
                }
                post('dashboard/select', data)
                    .then(res => {
                        dokumen(res.data);
                    })
            }
        </script>
    <?php endif; ?>

</body>

</html>