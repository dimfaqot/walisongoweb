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


    <?php if ($list == null) : ?>
        <table style="width:100%; border:none; padding:10px;">
            <?php foreach ($props as $p) : ?>
                <tr style="padding:10px;">
                    <td style="border:none; padding:10px; width:25%;"><?= $p['label']; ?></td>
                    <td style="border:none; padding:10px; width:2%;">:</td>
                    <td style="border:none; padding:10px;"><?= $data[$p['col']]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php if ($cols !== '' && $cols !== 0) : ?>
            <br>
            <br>
            <table style="width:100%; border:none; padding:10px;">
                <?php for ($i = 0; $i < $cols; $i++) : ?>
                    <tr>
                        <td style="height:150px;"></td>
                    </tr>
                <?php endfor; ?>
            </table>
        <?php endif; ?>
    <?php else : ?>
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
                    <?php foreach ($props as $p) : ?>
                        <td><?= $i[$p['col']]; ?></td>
                    <?php endforeach; ?>

                    <?php if ($cols !== '' && $cols !== 0) : ?>
                        <?php for ($i = 0; $i < $cols; $i++) : ?>
                            <td></td>
                        <?php endfor; ?>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>

        </table>

    <?php endif; ?>
</body>

</html>