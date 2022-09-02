<?php


function prints($tabel, $props, $id)
{

    $db      = \Config\Database::connect();
    $db = $db->table($tabel);

    $select = [];

    $joins = [];
    $prop = [];
    foreach ($props as $i) {
        $exp = explode("_", $i['col']);
        $col = $i['col'];
        if (end($exp) == 'id') {
            if ($i['col'] == 'user_id' || $i['col'] == 'anggotakelas_id') {
                $col = 'nama';
            } else {
                $c = [];
                foreach ($exp as $k => $e) {
                    if ($k < (count($exp) - 1)) {
                        $c[] = $e;
                    }
                }
                $col = implode("_", $c);
            }
            $joins = ['col' => $exp[0], 'val' => $exp[0] . '.id=' . $exp[0] . '_id'];
        }
        $i['col'] = $col;
        $select[] = $i['col'];
        $prop[] = $i;
    }

    $select = implode(",", $select);
    $select = $select . ',' . $tabel . '.id as id';


    $db->select($select);
    if (count($joins) > 0) {
        $db->join($joins['col'], $joins['val']);

        if ($joins['col'] == 'anggotakelas') {
            $db->join('user', 'user_id=user.id');
        }
    }


    $data = $db->whereIn($tabel . '.id', $id)->get()->getResultArray();
    // dd($data);
    $res = [
        'data' => $data,
        'props' => $prop
    ];
    // dd($res);
    return $res;
}

function folderprint($code, $img = null)
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
