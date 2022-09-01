<?php


function menuFromUri($menu)
{

    $dbakses = \App\Models\Akses::class;
    $dbakses = new $dbakses;

    $role_id = session('role_id');

    if ($role_id === null) {
        return 0;
    }

    $dbmenu = \App\Models\Menus::class;
    $dbmenu = new $dbmenu;


    $wherenotin = ['Dashboard'];
    $qm = $dbmenu->whereNotIn('menu', $wherenotin)->find();
    $val = [];

    foreach ($qm as $i) {
        if (strtolower(str_replace(" ", "", $i['menu'])) == $menu) {
            $val[] = $i;
        }
    }

    $res = [];

    if (count($val) > 1) {
        foreach ($qm as $i) {
            if (strtolower(str_replace(" ", "", $i['menu'])) == $menu && $i['role_id'] == $role_id) {
                $res = $i;
            }
        }
    } else {
        $res = $val[0];
    }

    $akses = $dbakses->where('role_id', $role_id)->where('menu_id', $res['id'])->find();

    if (count($akses) < 1) {
        return 1;
    }

    return $res;
}


function printcontroller()
{
    $config = \App\Models\Configs::class;
    $config = new $config;
    $q = $config->where('code', 'print')->first();

    preg_match_all("/\[[^\]]*\]/", $q['value'], $val);

    $controller = [];


    foreach ($val[0] as $i) {
        $print = str_replace("[", "", $i);
        $print = str_replace("]", "", $print);
        $exp = explode(",", $print);

        foreach ($exp as $k => $x) {
            $exp2 = explode(' ', $x);
            if ($k > 0) {
                $val = $exp2[1] . $exp2[0];
                if (array_search($val, $controller) === false) {
                    $controller[] = $exp2[1] . $exp2[0];
                }
            }
        }
    }


    $qself = $config->where('code', 'printself')->first();
    preg_match_all("/\[[^\]]*\]/", $qself['value'], $val);


    foreach ($val[0] as $i) {
        $print = str_replace("[", "", $i);
        $print = str_replace("]", "", $print);
        $exp = explode(",", $print);

        foreach ($exp as $k => $x) {
            $exp2 = explode(' ', $x);
            if ($k > 0) {
                $val = $exp2[1] . $exp2[0];
                if (array_search($val, $controller) === false) {
                    $controller[] = $exp2[1] . $exp2[0];
                }
            }
        }
    }
    // dd($controller);
    return $controller;
}

// untuk request warna tema, header, body, dan footer
function temaroutes($req)
{
    // memanggil tabel tema
    // jika $req adalah nama kolom maka langsung berikan
    // jika tidak ada berarti $req berisi permintaan warna tema

    $role_id = 0;
    // $role_id = session('role_id');
    $db = \App\Models\Temas::class;
    $db = new $db;


    $q = $db->where('role_id', $role_id)->first();
    $cols = array_keys($q);

    if (in_array($req, $cols)) {
        return $q[$req];
    } else {
        $q = $db->join('color', 'color_id=color.id')->first();
        return $q[$req];
    }
}

// untuk request warna
function colorroutes($req = null)
{
    $dbcol = \App\Models\Colors::class;
    $col = new $dbcol;
    if ($req == null) {
        return $col->orderBy('color', 'ASC')->findAll();
    } else {
        $filter = explode(" ", $req);
        $q = $col->where('color', $filter[0])->first();
        return $q[$filter[1]];
    }
}
function menusroutes()
{

    // mencari menu berdasarkan akses
    $db = \App\Models\Menus::class;
    $db = new $db;

    $q = $db->findAll();
    $val = [];
    foreach ($q as $i) {
        for ($k = 0; $k < 2; $k++) {
            if ($k == 0) {
                $val[] = str_replace(" ", "", strtolower($i['menu']));
            } else {
                $val[] = str_replace(" ", "", strtolower($i['menu'])) . '/*';
            }
        }
    }
    $res['logged']['before'] = $val;
    return $res;
}


function aksesroutes($req)
{
    // mengecek uri memalui 2 tahap: mencari tahu id menu uri yang diakses lalu dicocokkan di tabel akses
    $dbakses = \App\Models\Akses::class;
    $dbakses = new $dbakses;

    $role_id = session('role_id');
    // $role_id = session('role_id');
    $dbmenu = \App\Models\Menus::class;
    $dbmenu = new $dbmenu;

    // cari id menu di tabel menu. Hasil bisa banyak
    $qm = $dbmenu->where('menu', $req)->find();

    // jika banyak maka dicari berdasarkan role_id
    if (count($qm) > 1) {
        $qm = $dbmenu->where('menu', $req)->where('role_id', $role_id)->first();
    }

    // query lagi mencari id
    $qm = $dbmenu->where('menu', $req)->first();
    // cari menu_id di akses
    $qa = $dbakses->where('role_id', $role_id)->where('menu_id', $qm['id'])->first();

    if ($qa) {
        // jika $qa ada
        return true;
    }
    // jika $qa tidak ada
    return false;
}
