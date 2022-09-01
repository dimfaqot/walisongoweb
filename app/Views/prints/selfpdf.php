<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak</title>
    <style>
        body {
            font-size: 12px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        ul {
            list-style-type: none;
            display: inline-block;
        }

        li {
            display: inline-block;
        }
    </style>
</head>

<body>
    <?php if ($judul !== "") : ?>
        <h1 style="text-align:center"><?= $judul; ?></h1>
        <br>
        <br>
    <?php endif; ?>



    <table style="width:100%">
        <tr>
            <th>No.</th>
            <?php foreach ($props as $i) : ?>
                <th><?= $i['label']; ?></th>
            <?php endforeach; ?>
            <?php if ($cols !== '' && $cols !== 0) : ?>
                <?php for ($i = 0; $i < $cols; $i++) : ?>
                    <?php
                    $num = $i + 1;
                    $no = ($num < 10 ? '0' . $num : $num);
                    ?>
                    <th><?= $no; ?></th>
                <?php endfor; ?>
            <?php endif; ?>
        </tr>

        <?php foreach ($data as $k => $i) : ?>
            <tr>
                <td style="text-align:center;"><?= $k + 1; ?></td>
                <?php foreach ($data[$k] as $d) : ?>
                    <td><?= $d; ?></td>
                <?php endforeach; ?>

                <?php if ($cols !== '' && $cols !== 0) : ?>
                    <?php for ($i = 0; $i < $cols; $i++) : ?>
                        <td></td>
                    <?php endfor; ?>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

    </table>
</body>

</html>