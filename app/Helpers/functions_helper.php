<?php
// req berupa url dari filter logged
function akses($req)
{
    // mengecek uri memalui 2 tahap: mencari tahu id menu uri yang diakses lalu dicocokkan di tabel akses
    $dbakses = \App\Models\Akses::class;
    $dbakses = new $dbakses;

    $role_id = session('role_id');
    // dd($role_id);
    // $role_id = session('role_id');
    $dbmenu = \App\Models\Menus::class;
    $dbmenu = new $dbmenu;

    // cari id menu di tabel menu. Hasil bisa banyak
    $qm = $dbmenu->where('menu', $req)->find();
    // jika banyak maka dicari berdasarkan role_id
    if (count($qm) > 1) {
        $qm = $dbmenu->where('menu', $req)->where('role_id', $role_id)->first();
    } else {

        $qm = $dbmenu->where('menu', $req)->first();
    }

    // dd($qm);
    // query lagi mencari id
    // cari menu_id di akses
    $qa = $dbakses->where('role_id', $role_id)->where('menu_id', $qm['id'])->first();

    if ($qa) {
        // jika $qa ada
        return true;
    }
    // jika $qa tidak ada
    return false;
}

function role($order, $param)
{
    $db = \App\Models\Roles::class;
    $db = new $db;

    if ($order == 'id') {
        $q = $db->where('role', $param)->first();
        return $q['id'];
    } else {
        $q = $db->where('id', $param)->first();
        return $q['role'];
    }
}

function menus()
{
    // mencari menu berdasarkan akses
    $db = \App\Models\Akses::class;
    $db = new $db;

    // $role_id = session('role_id');
    $role_id = session('role_id');

    $q = $db->join('menu', 'menu.id=menu_id')->where('akses.role_id', $role_id)->orderBy('menu.id')->find();
    return $q;
}

// untuk request warna tema, header, body, dan footer
function tema($req)
{
    // memanggil tabel tema
    // jika $req adalah nama kolom maka langsung berikan
    // jika tidak ada berarti $req berisi permintaan warna tema

    $role_id = session('role_id');
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
function color($req = null)
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

function menu($menu)
{
    // mengecek uri memalui 2 tahap: mencari tahu id menu uri yang diakses lalu dicocokkan di tabel akses


    $role_id = session('role_id');
    // $role_id = session('role_id');
    $dbmenu = \App\Models\Menus::class;
    $dbmenu = new $dbmenu;

    // cari id menu di tabel menu. Hasil bisa banyak
    $qm = $dbmenu->where('menu', $menu)->find();

    // jika banyak maka dicari berdasarkan role_id
    if (count($qm) > 1) {
        $q = $dbmenu->where('menu', $menu)->where('role_id', $role_id)->first();
    } else {
        $q = $dbmenu->where('menu', $menu)->first();
    }
    // dd($q);
    return $q;
}


function firstWordUpCase($text)
{
    $newText = ucwords(strtolower($text));
    return $newText;
}

function firstUpCase($text)
{
    $newText = ucfirst(strtolower($text));
    return $newText;
}

function clear($string)
{
    return htmlspecialchars(trim($string));
}

function replace($text, $target, $to)
{
    return str_replace($target, $to, $text);
}




// tahap 1 props
// proses menjadikan query di config dan menu untuk menjadi props
// proses pemecah dilakukan di bracket
// params berisi menu, order, nama query di cofig, req
function props($req)
{
    // dd($req);

    $menu = menu($req['menu']);  // memanggil menu untuk mendapatkan query



    $queryconfig = bracket($menu['query'])['queryconfig'];


    $queryconfig = folder($queryconfig); // mengambil query di config berdasar kode


    $querymenu = $menu['query'];  // mengambil query di menu berdasar menu



    // proses pemecahan bracket yang diproses di bracket
    $bracketmenu = bracket($querymenu); //menu
    $bracketconfig = bracket($queryconfig); //config
    if (array_key_exists("req", $req)) {
        // dd($bracketmenu);
        if ($req['req'] == 'call') {
            // dd($req);
            $bracketconfig = bracket(folder($bracketmenu['configcall']));
            // dd($bracketconfig);
            $bracketmenu['querycall'] = $bracketmenu['querycall'][$bracketmenu['configcall']];
            // dd($bracketmenu);
        }
        if ($req['req'] == 'prev') {
            // dd($req);
            $bracketconfig = bracket(folder($req['query']));
            $bracketmenu = [];
            $bracketmenu['querymenu'] = [];
            $bracketmenu['props'] = [];
            $bracketmenu['query'] = [];
        }
        // jika req select maka hanya diproses sampai sini
        if ($req['req'] == 'select') {
            // dd($req);
            $queryconfig = folder($req['queryconfig']);
            $bracketconfig = bracket($queryconfig);

            // dd($bracketmenu);

            $cols = '';
            $qconfig = [];
            foreach ($bracketconfig['query'] as $i) {
                if ($i['req'] == 'cols') {
                    $cols = $i['val'];
                } else {
                    $qconfig[] = $i;
                }
            }
            $res = [
                'cols' => $cols,
                'table' => $bracketconfig['table'],
                'req' => $req['req'],
                'query' => [
                    'config' => $qconfig,
                    'menu' => (array_key_exists($req['queryconfig'], $bracketmenu['querymenu']) ? $bracketmenu['querymenu'][$req['queryconfig']] : [])
                ]
            ];
            // dd(array_key_exists($req['queryconfig'], $bracketmenu['querymenu']));
            return $res;
        }
    }



    $bracket['config'] = $bracketconfig['props']; //hasil bracket config
    $bracket['menu'] = $bracketmenu['props']; //hasil bracket menu
    $brct = ['config', 'menu'];

    if ($req['order'] == 'all') {
        $kat = ['submit', 'edit'];
    } else {
        $kat = [$req['order']];
    }

    // dd($bracketmenu);

    $value = [];

    // dd($bracket);
    // dd($bracket);
    // penyusunan key dan value
    foreach ($brct as $b) {
        foreach ($bracket[$b] as $i) {
            foreach ($kat as $o) {
                foreach ($i[$o] as $s) {
                    $key = 'label';
                    $result = strtolower($s['val']);
                    $query = '';
                    $datamulti = '';
                    if ($i['req'] == 'display' || $i['req'] == 'disabled') {
                        $key = 'default';
                        $result = $s['val'];
                    }
                    if ($i['req'] == 'case') {
                        $key = 'case';
                    }
                    if ($i['req'] == 'label') {
                        $result = $s['val'];
                    }
                    if ($i['req'] == 'file') {
                        $key = 'query';
                    }

                    if ($i['req'] == 'click') {
                        $key = 'type';
                        $format = strtolower($i['req']);
                        $query = strtolower($s['query']);
                    }

                    if ($i['req'] == 'multi') {
                        // dd($s);
                        $key = 'data';
                        $format = strtolower($i['req']);
                        $datamulti = str_replace(";", ",", strtolower($s['val']));
                    }

                    if ($i['req'] == 'select' || $i['req'] == 'radio' || $i['req'] == 'checkbox') {
                        $key = 'query';
                    }
                    if ($i['req'] == 'required') {
                        $key = 'required';
                        $result = true;
                    }
                    if ($i['req'] == 'textarea') {
                        $key = 'type';
                        $result = $i['req'];
                    }

                    $val = [
                        'req' => $i['req'],
                        'col' => $s['col'],
                        $key => ($i['req'] == 'file' ? str_replace(";", ",", $result) : $result)
                    ];
                    // dd($val);
                    if ($i['req'] == 'display' || $i['req'] == 'disabled') {
                        $val[$i['req']] = true;
                    }
                    if ($i['req'] == 'select' || $i['req'] == 'radio' || $i['req'] == 'checkbox' || $i['req'] == 'file') {
                        $val['type'] = $i['req'];
                    }
                    if ($i['req'] == 'click') {
                        $val['query'] = $query;
                        $val['format'] = $format;
                    }
                    if ($i['req'] == 'multi') {
                        $val['datamulti'] = $datamulti;
                        $val['format'] = $format;
                    }

                    $value[$o][] = $val;
                }
            }
        }
    }

    // dd($value);
    // dd($remove);
    $set = \App\Models\Settings::class;
    $set = new $set;
    $columns = $set->cols($bracketconfig['table']);

    // dd($value);
    $values = [];
    // dd($columns);
    foreach ($kat as $o) {
        foreach ($columns as $i) {
            $val = [];
            $remove = [];
            foreach ($value[$o] as $v) {
                if ($v['req'] == 'remove') {
                    $remove[] = $v['col'];
                    continue;
                }
                if ($v['col'] == $i) {
                    ksort($v);
                    foreach ($v as $k => $t) {
                        if ($k !== 'req') {
                            $val[$k] = $t;
                        }
                    }
                }
            }

            if (array_search($i, $remove) !== false) {
                continue;
            }
            if (count($val) <= 0) {
                foreach (datajs() as $a) {
                    $val[$a['key']] = $a['val'];
                }
                $val['col'] = $i;
                $val['label'] = firstWordUpCase(str_replace("_", " ", $i));
            } else {
                $key = array_keys($val);
                $arrdiff = array_diff(datajs('key'), $key);

                foreach ($arrdiff as $a) {

                    if (array_search("label", $arrdiff) === false) {
                        if ($a !== 'label') {
                            $val[$a] = datajs($a);
                        }
                    } else {
                        $val[$a] = datajs($a);
                        $val['label'] = firstWordUpCase(str_replace("_", " ", $i));
                    }
                }
            }
            $values[$o][] = $val;
        }
    }


    // dd($values);
    // menambah col
    foreach ($kat as $o) {

        foreach ($value[$o] as $v) {
            if ($v['req'] == 'add') {
                $key = array_keys($v);
                $arrdiff = array_diff(datajs('key'), $key);
                // dd($arrdiff);
                foreach ($arrdiff as $a) {
                    $v[$a] = datajs($a);
                }
                $val = [];

                ksort($v);
                foreach ($v as $k => $q) {
                    if ($k !== 'req') {
                        $val[$k] = $q;
                    }
                }
                $values[$o][] = $val;
            }
        }
    }
    // dd($values);
    if (array_key_exists("req", $req)) {

        if ($req['req'] == 'query' || $req['req'] == 'search' || $req['req'] == 'call' || $req['req'] == 'prev') {
            $cols = [];
            foreach ($kat as $k) {
                foreach ($values[$k] as $i) {
                    $cols[$k][] = $i['col'];
                }
            }
            $res = [
                'cols' => implode(",", $cols[$req['order']]),
                'props' => $values,
                'table' => $bracketconfig['table'],
                'req' => $req['req'],
                'query' => [
                    'config' => $bracketconfig['query'],
                    'menu' => ($req['req'] == 'call' ? $bracketmenu['querycall'] : $bracketmenu['query'])
                ]
            ];
            return $res;
        } else {

            $request = $req['req'];
            if ($req['req'] == 'icol') {
                $request = 'col';
            } else if ($req['req'] == 'ilabel') {
                $request = 'label';
            }

            $cols = [];
            foreach ($kat as $k) {
                foreach ($values[$k] as $i) {
                    $cols[$k][] = ($request == 'label' ? str_replace(" ", "", $i[$request]) : $i[$request]);
                }
            }
            if ($req['req'] == 'icol' || $req['req'] == 'ilabel') {
                $values = implode(",",  $cols[$req['order']]);
            } else {
                $values = $cols;
            }
        }
    }
    $newvalues = [];
    foreach ($kat as $k) {
        foreach ($values[$k] as $i) {
            $expc = explode(".", $i['col']);
            if (count($expc) > 1) {
                $exps = explode("-", $i['col']);
                $i['col'] = end($exps);

                $expg = explode("_", end($exps));
                if (end($expg) == 'id') {
                    $l = [];
                    foreach ($expg as $g) {
                        if ($g !== 'id') {
                            $l[] = $g;
                        }
                    }
                    $i['label'] = firstWordUpCase(implode(" ", $l));
                    $i['type'] = 'select';
                    $i['required'] = true;
                    $i['query'] = 'db' . strtolower(str_replace(" ", "", $i['label']));
                }
            }
            $newvalues[$k][] = $i;
        }
    }
    // dd($newvalues);
    return $newvalues;
}

// tahap 2 props
// memecah data dengan bracket
// data diproses di collabel
// hasil dikembalikan ke props
// params berisi query yang akan diproses berasal dari props
function bracket($query)
{
    // query dari propsconfig
    preg_match_all("/\[[^\]]*\]/", $query, $val);
    // dd($val);
    foreach ($val as $i) {
        // dd($i);
        $removebracket = str_replace("[", "", $i);
        $removebracket = str_replace("]", "", $removebracket);

        $res = [];
        $query = [];
        $querymenu = [];
        $querycall = [];
        $configcall = [];
        $table = '';
        foreach ($removebracket as $i) {
            $expspace = explode(" ", $i);
            if ($expspace[0] == 'table') {
                $table = $expspace[1];
            }
        }
        // dd($removebracket);
        // mencari order dan query
        $data = [];
        $queryconfig = '';
        foreach ($removebracket as $i) {
            // dd($i);
            $expspace = explode(" ", $i);
            if ($expspace[0] !== 'table') {

                $v = [];
                foreach ($expspace as $k => $e) {
                    if ($k > 0) {
                        $v[] = $e;
                    }
                }

                if ($expspace[0] == 'query') {
                    $queryconfig = $expspace[1];
                } else if ($expspace[0] == 'call') {
                    $expc = explode(" ", $i);
                    // dd($expc);
                    $configcall = $expc[1];
                    $datac = [];
                    foreach ($expc as $k => $x) {
                        if ($k > 1) {
                            $datac[] = $x;
                        }
                    }
                    $imp = implode(" ", $datac);
                    $expc3 = explode(",", $imp);
                    foreach ($expc3 as $z) {
                        $expc4 = explode(" ", $z);
                        $querycall[$configcall][] = ['req' => $expc4[0], 'val' => str_replace("-", " ", str_replace(";", ",",  $expc4[1]))];
                    }
                } else if ($expspace[0] == 'judul' || $expspace[0] == 'typeof' || $expspace[0] == 'ops' || $expspace[0] == 'limits' || $expspace[0] == 'join' || $expspace[0] == 'where' || $expspace[0] == 'orWhere' || $expspace[0] == 'whereIn' || $expspace[0] == 'orWhereIn' || $expspace[0] == 'orderBy' || $expspace[0] == 'whereNotIn' || $expspace[0] == 'orWhereNotIn' || $expspace[0] == 'colshow' || $expspace[0] == 'colsubmit' || $expspace[0] == 'coltext' || $expspace[0] == 'colsearch' || $expspace[0] == 'cols' || $expspace[0] == 'icon' || $expspace[0] == 'menu') {
                    $query[] = ['req' => $expspace[0], 'val' => str_replace("-", " ", $expspace[1])];
                } else {
                    if (substr($expspace[0], 0, 2) == 'db') {
                        $v = [];
                        foreach ($expspace as $k => $e) {
                            if ($k > 1) {
                                $v[] = $e;
                            }
                        }
                        // dd($v);
                        $querymenu[$expspace[0]][] = ['req' => $expspace[1], 'val' => implode(" ", $v)];
                    } else {
                        $data[] = ['req' => $expspace[0], 'val' => implode(" ", $v)];
                    }
                }
            }
        }
        // dd($querycall);
        // dd($data);
        foreach ($data as $i) {
            // data diproses di collabelconfig

            $res[] = collabel($i['req'], $i['val']);
        }
    }
    // dd($res);
    // dd($querymenu);
    $last = [
        'props' => $res,
        'table' => $table,
        'queryconfig' => $queryconfig,
        'querymenu' => $querymenu,
        'querycall' => $querycall,
        'configcall' => $configcall,
        'query' => $query
    ];
    // dd($last);
    return $last;
}

// tahap 3 props
// pemrosesan data dari bracket
// hasil dikembalikan ke bracket
// params req berasal dari bracket berisi add. remove, label, dll
// text berisi query yang dikirim dari bracket
// params berisi query yang akan diproses berasal dari bracket
function collabel($req, $text)
{


    $expspace = explode(" ", $text);
    $res = ['req' => $req, 'submit' => [], 'edit' => []];
    // dd($req);
    $expkoma = explode(",", $expspace[1]);
    foreach ($expkoma as $i) {
        $expsamadengan = explode("=", $i);

        if ($expspace[0] == 'all') {
            if (count($expsamadengan) == 1) {
                $res['submit'][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("_", " ", $expsamadengan[0]))];
                $res['edit'][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("_", " ", $expsamadengan[0]))];
            } elseif (count($expsamadengan) == 2) {
                $res['submit'][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("-", " ", $expsamadengan[1]))];
                $res['edit'][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("-", " ", $expsamadengan[1]))];
            } elseif (count($expsamadengan) == 3) {
                $res['submit'][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("-", " ", $expsamadengan[1])), 'query' => $expsamadengan[2]];
                $res['edit'][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("-", " ", $expsamadengan[1])), 'query' => $expsamadengan[2]];
            }
        } else {
            if (count($expsamadengan) == 1) {
                $res[$expspace[0]][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("_", " ", $expsamadengan[0]))];
            } elseif (count($expsamadengan) == 2) {
                $res[$expspace[0]][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("-", " ", $expsamadengan[1]))];
            } elseif (count($expsamadengan) == 3) {
                $res[$expspace[0]][] = ['col' => $expsamadengan[0], 'val' => firstWordUpCase(str_replace("-", " ", $expsamadengan[1])), 'query' => $expsamadengan[2]];
            }
        }
    }
    // dd($res);
    return $res;
}
// ___________________________________________________________________________________
// tahap 1 query
// function inlah yang dipanggil dari luar
// sekaligus menjadi final query
//  $params = ['menu' => 'Santri', 'query' => 'user', 'order' => 'edit', 'req' => 'query'];
function query($req)
{

    if ($req['req'] == 'selectself') {
        $query = folder($req['code']);
        $expkoma = explode(",", $query);
        $ops = [];
        foreach ($expkoma as $i) {
            $expsamadengan = explode("=", $i);
            if (count($expsamadengan) == 1) {
                $ops[] = ['text' => $expsamadengan[0], 'val' => $expsamadengan[0]];
            } else {
                $ops[] = ['text' => $expsamadengan[0], 'val' => $expsamadengan[1]];
            }
        }

        return $ops;
    }
    $props = props($req);


    // memanggil props
    if (array_key_exists('val', $req)) {
        $props['val'] = $req['val'];
    }
    if (array_key_exists('id', $req)) {
        $props['id'] = $req['id'];
    }
    if (array_key_exists('datamulti', $req)) {
        $props['datamulti'] = $req['datamulti'];
    }


    $props['menu'] = $req['menu'];
    $props['order'] = $req['order'];

    // memanggil queryprocess
    $queryproccess = queryproccess($props);
    return $queryproccess;
}

// tahap 2 query
// menggabungkan props mebu dan props config dari props
// params req berasal dari query
function queryproccess($req)
{
    // dd($req);
    $menu = menu($req['menu']);

    $kat = ['config', 'menu'];

    if (array_key_exists('datamulti', $req)) {

        if ($req['datamulti'] !== null) {
            $req['cols'] = $req['cols'] . ',' . $req['datamulti'];
        }
    }

    // dd($req);
    $querymix = [];
    // penggabungan queryconfig dan querymenu
    foreach ($kat as $k) {

        foreach ($req['query'][$k] as $i) {
            $querymix[] = [
                'req' => $i['req'],
                'val' => $i['val']
            ];
        }
    }

    // dd($querymix);
    // proses memecah query mix

    $db      = \Config\Database::connect();
    $db = $db->table($req['table']);

    $select = $req['cols'] . ',' . $req['table'] . '.id as id';
    $select = str_replace("-", " ", $select);
    // dd($select);
    $colshow = [];
    $joins = [];
    $judul = '';
    $ops = '';
    $typeof = '';
    $ultah = [];
    $jenis = [];
    $limits = 0;
    $db->select($select);
    foreach ($querymix as $i) {
        if ($i['req'] == 'join') {
            $expkoma = explode(",", $i['val']);
            foreach ($expkoma as $ek) {
                $exptitikdua = explode(":", $ek);
                $joins[] = ($exptitikdua[0] == 'user' ? 'nama' : $exptitikdua[0]);
                $expsamadengan = explode("=", $exptitikdua[1]);
                if (count($expsamadengan) == 2) {
                    $db->join($exptitikdua[0], $expsamadengan[0] . '=' . $expsamadengan[1]);
                } else if (count($expsamadengan) == 3) {
                    $db->join($exptitikdua[0], $expsamadengan[0] . '=' . $expsamadengan[1], $expsamadengan[2]);
                }
            }
        }


        if ($i['req'] == 'where') {
            $expkoma = explode(",", $i['val']);
            foreach ($expkoma as $ek) {
                $expsamadengan = explode("=", $ek);
                if ($expsamadengan[0] == 'ultah') {
                    if ($expsamadengan[1] !== 'Semua') {
                        // dd($expsamadengan);
                        $ultah = ['key' => $expsamadengan[0], 'val' => $expsamadengan[1]];
                        $db->select($select . ',ttl');
                    }
                } else if ($expsamadengan[0] == 'jenis') {
                    if ($expsamadengan[1] !== 'Semua') {
                        // dd($expsamadengan);
                        $jenis = ['key' => $expsamadengan[0], 'val' => $expsamadengan[1]];
                    }
                } else {
                    $db->where($expsamadengan[0], $expsamadengan[1]);
                }
            }
        }

        if ($i['req'] == 'orWhere') {
            $expkoma = explode(",", $i['val']);
            foreach ($expkoma as $ek) {
                $expsamadengan = explode("=", $ek);
                $db->orWhere($expsamadengan[0], $expsamadengan[1]);
            }
        }

        if ($i['req'] == 'whereIn') {

            $expsamadengan = explode("=", $i['val']);
            $expkoma = explode(",", $expsamadengan[1]);
            $where = [];
            foreach ($expkoma as $ek) {
                if ($ek == 'tglnow') {
                    $ek = date("d-m-Y");
                }
                $where[] = $ek;
            }

            $db->whereIn($expsamadengan[0], $where);
        }
        if ($i['req'] == 'judul') {
            $judul = strtoupper(str_replace("-", " ", $i['val']));
        }
        if ($i['req'] == 'limits') {
            $limits = $i['val'];
        }

        if ($i['req'] == 'orWhereIn') {
            $expsamadengan = explode("=", $i['val']);
            $expkoma = explode(",", $expsamadengan[1]);
            $where = [];
            foreach ($expkoma as $ek) {
                $where[] = $ek;
            }
            $db->orWhereIn($expsamadengan[0], $where);
        }

        if ($i['req'] == 'whereNotIn') {
            $expsamadengan = explode("=", $i['val']);
            $expkoma = explode(",", $expsamadengan[1]);
            $where = [];
            foreach ($expkoma as $ek) {
                $where[] = $ek;
            }

            $db->whereNotIn($expsamadengan[0], $where);
        }
        if ($i['req'] == 'orWhereNotIn') {
            $expsamadengan = explode("=", $i['val']);
            $expkoma = explode(",", $expsamadengan[1]);
            $where = [];
            foreach ($expkoma as $ek) {
                $where[] = $ek;
            }
            $db->orWhereNotIn($expsamadengan[0], $where);
        }

        if ($i['req'] == 'orderBy') {
            $expkoma = explode(",", $i['val']);
            $db->orderBy($expkoma[0], $expkoma[1]);
        }
        if ($i['req'] == 'colshow') {
            $expkoma = explode(",", $i['val']);
            foreach ($expkoma as $ek) {
                $expsamadengan = explode("=", $ek);
                $colshow[] = $expsamadengan[0];
            }
        }
        if ($i['req'] == 'colsubmit') {
            $colsubmit = $i['val'];
        }
        if ($i['req'] == 'coltext') {
            $coltext = $i['val'];
        }
        if ($i['req'] == 'colsearch') {
            $colsearch = $i['val'];
        }
        if ($i['req'] == 'ops') {
            $ops = $i['val'];
        }
        if ($i['req'] == 'typeof') {
            $typeof = $i['val'];
        }
    }
    // $db->whereNotIn('role', ['Santri']);
    // dd($req);
    if ($typeof !== '') {
        $exptypeof = explode("|", $typeof);
        if (count($exptypeof) > 2) {
            $menu['limits'] = $exptypeof[2];
        }
    }
    // dd($limits);

    $utils = utils($req['menu']);
    $utils['table'] = $req['table'];
    $utils['judul'] = $judul;
    $utils['colshow'] = $colshow;
    $utils['typeof'] = $typeof;
    $utils['ops'] = $ops;

    // dd($utils);
    $res = [
        'utils' => $utils,
        'set' => set()
    ];

    if ($req['req'] == 'select') {
        $data = $db->like($colsearch, $req['val'], 'both')->get()->getResultArray();
        // dd($req);
        $res = [
            'colsearch' => $colsearch,
            'colsubmit' => $colsubmit,
            'colshow' => $colshow,
            'coltext' => $coltext,
            'data' => $data
        ];

        // dd($res);
    } else if ($req['req'] == 'search') {
        foreach ($colshow as $k => $i) {
            if ($k == 0) {
                $db->like($i, $req['val'], 'both');
            } else {
                $db->orLike($i, $req['val'], 'both');
            }
        }
        foreach ($querymix as $i) {

            if ($i['req'] == 'where') {
                $expkoma = explode(",", $i['val']);
                foreach ($expkoma as $ek) {
                    $expsamadengan = explode("=", $ek);
                    $db->where($expsamadengan[0], $expsamadengan[1]);
                }
            }

            if ($i['req'] == 'orWhere') {
                $expkoma = explode(",", $i['val']);
                foreach ($expkoma as $ek) {
                    $expsamadengan = explode("=", $ek);
                    $db->orWhere($expsamadengan[0], $expsamadengan[1]);
                }
            }

            if ($i['req'] == 'whereIn') {

                $expsamadengan = explode("=", $i['val']);
                $expkoma = explode(",", $expsamadengan[1]);
                $where = [];
                foreach ($expkoma as $ek) {

                    $where[] = $ek;
                }

                $db->whereIn($expsamadengan[0], $where);
            }

            if ($i['req'] == 'orWhereIn') {
                $expsamadengan = explode("=", $i['val']);
                $expkoma = explode(",", $expsamadengan[1]);
                $where = [];
                foreach ($expkoma as $ek) {
                    $where[] = $ek;
                }
                $db->orWhereIn($expsamadengan[0], $where);
            }

            if ($i['req'] == 'whereNotIn') {
                $expsamadengan = explode("=", $i['val']);
                $expkoma = explode(",", $expsamadengan[1]);
                $where = [];

                foreach ($expkoma as $ek) {
                    $where[] = $ek;
                }
                $db->whereNotIn($expsamadengan[0], $where);
            }
            if ($i['req'] == 'orWhereNotIn') {
                $expsamadengan = explode("=", $i['val']);
                $expkoma = explode(",", $expsamadengan[1]);
                $where = [];
                foreach ($expkoma as $ek) {
                    $where[] = $ek;
                }
                $db->orWhereNotIn($expsamadengan[0], $where);
            }
        }
        $data = $db->get()->getResultArray();

        $props = $req['props'][$req['order']];
        // dd($joins);
        $newprops = [];
        foreach ($props as $i) {
            if (array_search($i['col'], $joins) === false) {
                $expc = explode(".", $i['col']);
                if (count($expc) > 1) {
                    $exps = explode("-", $i['col']);
                    $i['col'] = end($exps);

                    $expg = explode("_", end($exps));
                    if (end($expg) == 'id') {
                        $l = [];
                        foreach ($expg as $g) {
                            if ($g !== 'id') {
                                $l[] = $g;
                            }
                        }
                        $i['label'] = firstWordUpCase(implode(" ", $l));
                        $i['type'] = 'select';
                        $i['required'] = true;
                        $i['query'] = 'db' . strtolower(str_replace(" ", "", $i['label']));
                    }
                }
                $newprops[] = $i;
            }
        }
        $res['props'] = $newprops;
        $res['data'] = $data;
        $res['datajs'] = datajs('js');

        // dd($res);
    } else {
        // dd($req);
        if (array_key_exists('val', $req) || array_key_exists('id', $req)) {
            if ($req['val'] !== '') {
                $data = $db->like('nama', $req['val'], 'both')->get()->getResultArray();
            } else if ($req['id'] !== '') {
                $data = $db->where($req['table'] . '.id', $req['id'])->get()->getResultArray();
            } else {
                $data = $db->limit(($req['req'] == 'call' ? $limits : $menu['limits']))->get()->getResultArray();
            }
        } else {
            $data = $db->limit(($req['req'] == 'call' ? $limits : $menu['limits']))->get()->getResultArray();

            if (count($ultah) > 0) {
                $newdata = [];
                foreach ($data as $i) {
                    $expultah = explode(",", $i['ttl']);
                    $expultah2 = explode(" ", $expultah[1]);

                    if ($expultah2[2] == $ultah['val']) {
                        $newdata[] = $i;
                    }
                }
                $data = $newdata;
            }
            if (count($jenis) > 0) {
                $newdata = [];
                foreach ($data as $i) {
                    $len = strlen($i['username']);
                    if ($jenis['val'] == 'Santri' && $len < 9) {
                        $newdata[] = $i;
                    } else if ($jenis['val'] == 'Karyawan' && $len > 7) {
                        $newdata[] = $i;
                    }
                }
                $data = $newdata;
            }
        }

        $props = $req['props'][$req['order']];
        // dd($props);
        // dd($joins);
        $newprops = [];
        foreach ($props as $i) {
            if (array_search($i['col'], $joins) === false) {
                $expc = explode(".", $i['col']);
                if (count($expc) > 1) {
                    $exps = explode("-", $i['col']);
                    $i['col'] = end($exps);

                    $expg = explode("_", end($exps));
                    if (end($expg) == 'id') {
                        $l = [];
                        foreach ($expg as $g) {
                            if ($g !== 'id') {
                                $l[] = $g;
                            }
                        }
                        $i['label'] = firstWordUpCase(implode(" ", $l));
                        $i['type'] = 'select';
                        $i['required'] = true;
                        $i['query'] = 'db' . strtolower(str_replace(" ", "", $i['label']));
                    }
                }
                $newprops[] = $i;
            }
        }
        // dd($newprops);
        $res['limits'] = $limits;
        $res['props'] = $newprops;
        $res['datajs'] = datajs('js');
        $res['data'] = $data;
        // dd($res);
    }
    // dd($data);
    return $res;
}



function removejoin($props)
{
    $joins = [];
    foreach ($props as $i) {
        $exp = explode("_", $i['col']);
        $col = [];
        if (end($exp) == 'id') {
            // dd($i);
            foreach ($exp as $k => $e) {
                if ($k < (count($exp) - 1)) {
                    $col[] = ($e == 'user' ? 'nama' : $e);
                }
            }
        }

        $joins[] = implode("_", $col);
    }
    $newprops = [];
    foreach ($props as $i) {
        if (array_search($i['col'], $joins) === false) {

            $newprops[] = $i;
        }
    }
    // dd($newprops);
    return $newprops;
}
// ___________________________________________________________________________________
function datajs($req = null)
{
    $props = folder('props');
    $expkoma = explode(",", $props);

    $res = [];
    foreach ($expkoma as $i) {
        $exp2 = explode("=", $i);
        if (count($exp2) == 1) {
            $res[] = [
                'key' => $exp2[0],
                'val' => ''
            ];
        } else {
            $res[] = [
                'key' => $exp2[0],
                'val' => ($exp2[1] == 'false' ? false : $exp2[1])
            ];
        }
    }


    if ($req == null) {
        return $res;
    } else if ($req == 'key') {
        $keys = [];
        foreach ($res as $i) {
            $keys[] = $i['key'];
        }
        return $keys;
    } else if ($req == 'js') {

        $keys = [];
        foreach ($res as $i) {
            if ($i['key'] !== 'required' && $i['key'] !== 'disabled' && $i['key'] !== 'display') {
                $keys[] = $i['key'];
            }
        }
        return $keys;
    } else {
        foreach ($res as $i) {
            if ($i['key'] == $req) {
                return $i['val'];
            }
        }
    }
}


function preview($req)
{
    // dd($req);
    $menu = menu($req);
    if ($menu['preview'] == "") {
        return false;
    }
    $exp = explode(",", $menu['preview']);

    $params = ['menu' => $menu['menu'], 'order' => 'edit', 'req' => 'prev'];
    $params2 = ['menu' => $menu['menu'], 'order' => 'submit', 'req' => 'prev'];
    $res = [];
    foreach ($exp as $i) {
        $query = 'prev' . $i;
        $print = utils($req, $query)['print'];
        // dd($print);
        $params['query'] = $query;
        $data = query($params);
        // dd($data);
        $ops = [];
        if ($data['utils']['ops'] !== '') {
            $params2['query'] = $data['utils']['ops'];
            $dataops = query($params2)['props'];

            $ops = [];
            foreach ($dataops as $d) {
                if (array_search($d['col'], $data['utils']['colshow']) === false) {

                    $ops[] = ['col' => $d['col'], 'label' => $d['label']];
                }
            }
            // dd($ops);
        }
        $type = explode("|", $data['utils']['typeof']);
        $data['utils']['typeof'] = $type[0];
        $data['utils']['edited'] = $type[1];
        if (count($type) == 3) {
            $data['utils']['limits'] = $type[2];
        }
        $res[] = ['ops' => $ops, 'data' => $data['data'], 'utils' => $data['utils'], 'set' => $data['set'], 'props' => $data['props'], 'query' => $query, 'datajs' => datajs('js'), 'print' => $print];
    }
    // dd($res);
    return $res;
}


function folder($code, $img = null)
{
    $config = \App\Models\Configs::class;
    $config = new $config;

    $q = $config->where('code', $code)->first();

    if ($img == null) {
        return $q['value'];
    } else {
        return 'images/' . $q['value'] . '/' . $img;
    }
}

function contents($req)
{
    $menu = menu($req);
    $exp = explode(",", $menu['contents']);
    return $exp;
}

function set()
{
    $dbcol = \App\Models\Colors::class;
    $col = new $dbcol;
    $q = $col->where('id', tema('color_id'))->first();

    $color = $col->findAll();
    $colors = [];
    foreach ($color as $i) {
        $colors[strtolower($i['color'])] = [
            'secondary' => $i['secondary'],
            'support' => $i['support'],
            'main' => $i['main'],
            'mid_dark' => $i['mid_dark'],
            'dark' => $i['dark'],
            'mid_light' => $i['mid_light'],
            'light' => $i['light'],
        ];
    }
    $set = [
        'font_size' => tema('font_size'),
        'colors' => $colors,
        'colortema' => $q,
    ];
    return $set;
}

function utils($menu, $order = null)
{

    $men = menu($menu);
    $tab = bracket($men['query']);
    $qcon = bracket(folder($tab['queryconfig']));

    $colshow = [];

    foreach ($qcon['query'] as $i) {
        if ($i['req'] == 'colshow') {
            $exp = explode(",", $i['val']);
            foreach ($exp as $e) {
                $exp2 = explode("=", $e);
                $colshow[] = $exp2[0];
            }
        }
    }

    $copy = folder('copy');
    $copy = str_replace("[", "", $copy);
    $copy = str_replace("]", "", $copy);
    $exp = explode(",", $copy);
    $copys = [];
    foreach ($exp as $x) {
        if ($x == $menu) {
            $copys[] = $x;
        }
    }


    $print = folder('print');
    preg_match_all("/\[[^\]]*\]/", $print, $val);
    // dd($val);
    $prints = [];

    foreach ($val[0] as $i) {
        $print = str_replace("[", "", $i);
        $print = str_replace("]", "", $print);
        $exp = explode(",", $print);
        $res = [];

        $mn = '';
        $tabel = '';
        foreach ($exp as $k => $x) {
            $exp2 = explode(' ', $x);
            if ($k == 0) {
                $mn = $exp2[1];
            } else if ($k == 1) {
                $tabel = $exp2[1];
            } else {
                $data['format'] = $exp2[0];
                $data['type'] = $exp2[1];
                $data['tabel'] = $tabel;
                $data['menu'] = $mn;
                $data['icon'] = ($exp2[0] == 'pdf' ? 'fa fa-file-pdf-o' : 'fa fa-file-excel-o');
                $data['controller'] = $exp2[1] . $exp2[0];
                $res[] = $data;
            }
        }
        if ($order == null) {
            if ($mn == $menu) {
                $prints = $res;
            }
        } else {
            if ($mn == $order) {
                $prints = $res;
            }
        }
    }

    $printself = folder('printself');
    preg_match_all("/\[[^\]]*\]/", $printself, $val);
    // dd($val);
    $printselfs = [];

    foreach ($val[0] as $i) {
        $print = str_replace("[", "", $i);
        $print = str_replace("]", "", $print);
        $exp = explode(",", $print);

        $data = [];
        $preview = '';
        foreach ($exp as $k => $x) {
            $exp2 = explode(' ', $x);
            if ($k == 0) {
                $preview = $exp2[1];
            } else {
                $data[] = [
                    'format' => $exp2[0],
                    'type' => $exp2[1],
                    'icon' => ($exp2[0] == 'pdf' ? 'fa fa-file-pdf-o' : 'fa fa-file-excel-o'),
                    'controller' => $exp2[1] . $exp2[0],
                ];
            }
        }

        $printselfs[] = ['preview' => $preview, 'data' => $data];
    }



    $utils = [
        'menu' => $men['menu'],
        'idmenu' => $men['id'],
        'tabel' => $qcon['table'],
        'colshow' => $colshow,
        'limits' => $men['limits'],
        'print' => $prints,
        'printself' => $printselfs,
        'copy' => $copys,
        'tema' => tema('tema')
    ];

    return $utils;
}



function save($data, $tabel, $order, $idmenu, $id)
{
    $set = \App\Models\Settings::class;
    $set = new $set;

    $reload = false;
    $menu = \App\Models\Menus::class;
    $menu = new $menu;

    $q = $menu->where('id', $idmenu)->first();
    $exp = explode(",", $q['reload']);
    if (array_search($order, $exp) !== false) {
        $reload = true;
    }


    $db      = \Config\Database::connect();
    $db = $db->table($tabel);


    if ($order == 'submit' || $order == 'copy') {
        $cols = $set->cols($tabel);
        $save = [];
        foreach ($cols as $i) {
            if (array_key_exists($i, $data)) {
                $save[$i] = casetext($data[$i]);
            } else {
                $save[$i] = ($i == 'password' ? password_hash('123456', PASSWORD_DEFAULT) : '');
            }
        }
        $save['updated_at'] = date("Y-m-d H:i:s");
        $save['created_at'] = date("Y-m-d H:i:s");
        $s = $db->insert($save);
        if ($s) {
            $res = ['status' => '200', 'reload' => $reload];
        } else {
            $res = ['status' => '400', 'message' => 'Gagal!. Data tidak ditemukan'];
        }
    } else {
        $q = $db->where('id', $id)->get()->getRowArray();
        if ($q) {
            $cols = $set->cols($tabel);
            $save = [];
            foreach ($cols as $i) {
                if (array_key_exists($i, $data)) {
                    $save[$i] = ($i == 'password' ? password_hash('123456', PASSWORD_DEFAULT) : casetext($data[$i]));
                } else {
                    $save[$i] = $q[$i];
                }
            }
            $save['updated_at'] = date("Y-m-d H:i:s");
            $db->where('id', $id);
            $s = $db->update($save);

            if ($s) {
                $res = ['status' => '200', 'reload' => $reload];
            } else {
                $res = ['status' => '400', 'message' => 'Gagal!. Data tidak ditemukan'];
            }
        } else {
            $res = ['status' => '400', 'message' => 'Gagal!. Data tidak ditemukan'];
        }
    }

    return $res;
}

function delete($tabel, $id, $idmenu)
{

    $reload = false;
    $menu = \App\Models\Menus::class;
    $menu = new $menu;

    $q = $menu->where('id', $idmenu)->first();
    $exp = explode(",", $q['reload']);
    if (array_search('delete', $exp) !== false) {
        $reload = true;
    }


    $db = \Config\Database::connect();
    $db = $db->table($tabel);

    $db->where('id', $id);
    $d = $db->delete();

    if ($d) {
        $res = ['status' => '200', 'reload' => $reload];
    } else {
        $res = ['status' => '400', 'message' => 'Gagal!. Data tidak ditemukan'];
    }


    return $res;
}


function casetext($req)
{
    if ($req['case'] == 'no') {
        return clear($req['val']);
    }
    if ($req['case'] == 'fw') {
        return firstUpCase(clear($req['val']));
    }
    if ($req['case'] == 'fs') {
        return firstWordUpCase(clear($req['val']));
    }
    if ($req['case'] == 'up') {
        return strtoupper(clear($req['val']));
    }
    if ($req['case'] == 'lw') {
        return strtolower(clear($req['val']));
    }
}

function randomstring($characters, $length = 10)
{
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function singkatnama($nama)
{
    $exp = explode(' ', $nama);

    $res = $nama;

    if (count($exp) == 2) {
        if ($exp[0] == "Muhammad" || $exp[0] == "Muhamad" || $exp[0] == "Muhamat" || $exp[0] == "Muhammat") {
            $res = "M. " . $exp[1];
        } else if ($exp[0] == "Ahmad" || $exp[0] == "Ahmat") {
            $res = "A. " . $exp[1];
        } else if ($exp[0] == "Abdul") {
            $res = "A. " . $exp[1];
        }
    }
    if (count($exp) == 3) {
        if ($exp[0] == "Muhammad" || $exp[0] == "Muhamad" || $exp[0] == "Muhamat" || $exp[0] == "Muhammat") {
            $res = "M. " . $exp[1] . ' ' . $exp[2];
        } else if ($exp[0] == "Ahmad" || $exp[0] == "Ahmat") {
            $res = "A. " . $exp[1] . ' ' . $exp[2];
        } else if ($exp[0] == "Abdul") {
            $res = "A. " . $exp[1] . ' ' . $exp[2];
        } else {
            $res = $exp[0] . ' ' . $exp[1] . ' ' . substr($exp[2], 0, 1) . '.';
        }
    }

    if (count($exp) == 4) {
        if ($exp[0] == "Muhammad" || $exp[0] == "Muhamad" || $exp[0] == "Muhamat" || $exp[0] == "Muhammat") {
            $res = "M. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '.';
        } else if ($exp[0] == "Ahmad" || $exp[0] == "Ahmat") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '.';
        } else if ($exp[0] == "Abdul") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '.';
        } else {
            $res = $exp[0] . ' ' . $exp[1] . ' ' . substr($exp[2], 0, 1) . '. ' . substr($exp[3], 0, 1) . '.';
        }
    }

    if (count($exp) == 5) {
        if ($exp[0] == "Muhammad" || $exp[0] == "Muhamad" || $exp[0] == "Muhamat" || $exp[0] == "Muhammat") {
            $res = "M. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '.';
        } else if ($exp[0] == "Ahmad" || $exp[0] == "Ahmat") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '.';
        } else if ($exp[0] == "Abdul") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '.';
        } else {

            $res = $exp[0] . ' ' . $exp[1] . ' ' . substr($exp[2], 0, 1) . '. ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '.';
        }
    }


    if (count($exp) == 6) {
        if ($exp[0] == "Muhammad" || $exp[0] == "Muhamad" || $exp[0] == "Muhamat" || $exp[0] == "Muhammat") {
            $res = "M. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '.';
        } else if ($exp[0] == "Ahmad" || $exp[0] == "Ahmat") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '.';
        } else if ($exp[0] == "Abdul") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '.';
        } else {

            $res = $exp[0] . ' ' . $exp[1] . ' ' . substr($exp[2], 0, 1) . '. ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '.';
        }
    }
    if (count($exp) == 7) {

        if ($exp[0] == "Muhammad" || $exp[0] == "Muhamad" || $exp[0] == "Muhamat" || $exp[0] == "Muhammat") {
            $res = "M. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '.';
        } else if ($exp[0] == "Ahmad" || $exp[0] == "Ahmat") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '.';
        } else if ($exp[0] == "Abdul") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '.';
        } else {

            $res = $exp[0] . ' ' . $exp[1] . ' ' . substr($exp[2], 0, 1) . '. ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '.';
        }
    }

    if (count($exp) == 8) {

        if ($exp[0] == "Muhammad" || $exp[0] == "Muhamad" || $exp[0] == "Muhamat" || $exp[0] == "Muhammat") {
            $res = "M. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '. ' . substr($exp[7], 0, 1) . '.';
        } else if ($exp[0] == "Ahmad" || $exp[0] == "Ahmat") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '. ' . substr($exp[7], 0, 1) . '.';
        } else if ($exp[0] == "Abdul") {
            $res = "A. " . $exp[1] . ' ' . $exp[2] . ' ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '. ' . substr($exp[7], 0, 1) . '.';
        } else {

            $res = $exp[0] . ' ' . $exp[1] . ' ' . substr($exp[2], 0, 1) . '. ' . substr($exp[3], 0, 1) . '. ' . substr($exp[4], 0, 1) . '. ' . substr($exp[5], 0, 1) . '. ' . substr($exp[6], 0, 1) . '. ' . substr($exp[7], 0, 1) . '.';
        }
    }
    return $res;
}
