<?php

namespace App\Models;

use CodeIgniter\Model;

class Settings extends Model
{

    function __construct()
    {

        helper('functions');
    }

    public function tables()
    {
        $db = db_connect();

        $tables = $db->listTables();
        return $tables;
    }

    public function edit($menu)
    {
        $content = menu($menu)['contents'];
        $content = explode(",", $content);

        $data = query(['menu' => $menu, 'order' => 'edit', 'req' => 'query']);
        // dd($data);
        $newdata = [];
        foreach ($data['props'] as $i) {

            if ($i['type'] == 'checkbox' || $i['type'] == 'radio') {
                if (array_key_exists("query", $i) && $i['query'] !== '' && substr($i['query'], 0, 2) !== 'db') {
                    $res = $this->selectself($menu, $i['query']);

                    // dd($res);
                    $query = [];

                    foreach ($res['data'] as $x) {
                        $query[] = $x['text'] . '=' . $x['val'];
                    }
                    $i['query'] = implode(",", $query);
                }
            }
            $newdata[] = $i;
        }
        $data['props'] = $newdata;
        if (array_search("dokumen", $content) !== false) {
            $data['dokumen'] = $this->call($menu);
        }
        return $data;
    }


    public function search($menu, $val)
    {
        return query(['menu' => $menu, 'order' => 'edit', 'req' => 'search', 'val' => $val]);
    }


    public function submit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'submit'])['submit']);
        // dd($props);

        $res = [
            'props' => $props,
            'utils' => utils($menu)
        ];
        return $res;
    }


    public function cols($tabel)
    {
        helper('functions');
        $t = firstWordUpCase($tabel);
        if ($tabel !== 'akses' && $tabel !== 'sk' && $tabel !== 'kelas' && $tabel !== 'anggotakelas') {
            $t = firstWordUpCase($tabel) . 's';
        }
        $module = "App\\Models\\" . $t;
        $model = new $module();
        $res = $model->cols();
        return $res;
    }


    public function colsubmit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'submit'])['submit']);
        // dd($props);
        $cols = [];
        foreach ($props as $i) {
            $cols[] = $i['col'];
        }

        return $cols;
    }


    public function coledit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'edit'])['edit']);
        $cols = [];
        foreach ($props as $i) {
            $cols[] = $i['col'];
        }

        return $cols;
    }

    public function icolsubmit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'submit'])['submit']);
        $cols = [];
        foreach ($props as $i) {
            $cols[] = $i['col'];
        }

        return implode(",", $cols);
    }


    public function icoledit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'edit'])['edit']);
        $cols = [];
        foreach ($props as $i) {
            $cols[] = $i['col'];
        }

        return implode(",", $cols);
    }


    public function labelsubmit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'submit'])['submit']);
        $labels = [];
        foreach ($props as $i) {
            $labels[] = str_replace(".", "", str_replace(" ", "", $i['label']));
        }

        return $labels;
    }


    public function labeledit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'edit'])['edit']);
        $labels = [];
        foreach ($props as $i) {
            $labels[] = str_replace(".", "", str_replace(" ", "", $i['label']));
        }

        return $labels;
    }


    public function ilabelsubmit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'submit'])['submit']);
        $labels = [];
        foreach ($props as $i) {
            $labels[] = str_replace(".", "", str_replace(" ", "", $i['label']));
        }

        return implode(",", $labels);
    }


    public function ilabeledit($menu)
    {
        $props = removejoin(props(['menu' => $menu, 'order' => 'edit'])['edit']);
        $labels = [];
        foreach ($props as $i) {
            $labels[] = str_replace(".", "", str_replace(" ", "", $i['label']));
        }

        return implode(",", $labels);
    }


    public function selectdb($menu, $order, $query, $val, $datamulti = null)
    {
        // dd($query);
        $data = query(['menu' => $menu, 'order' => $order, 'req' => 'select', 'queryconfig' => $query, 'val' => $val, 'datamulti' => $datamulti]);
        $res = [
            'coltext' => $data['coltext'],
            'colsubmit' => $data['colsubmit'],
            'colshow' => $data['colshow'],
            'utils' => utils($menu),
            'set' => set(),
            'data' => $data['data']
        ];
        return $res;
    }


    public function selectpreview($menu, $cols, $val)
    {
        $user = \App\Models\Users::class;
        $user = new $user;
        $cols = $cols . ',id';
        $data = $user->select($cols)->like('nama', $val, 'both')->orderBy('nama', 'ASC')->find();
        $prev = $this->preview($menu);
        $props = [];

        foreach ($prev as $i) {
            if ($i['query'] == 'prevcetak') {
                $props = $i['props'];
            }
        }
        $res = [
            'data' => $data,
            'set' => set(),
            'props' => $props
        ];
        return $res;
    }


    public function selectself($menu, $query, $datamulti = null)
    {
        $data = query(['req' => 'selectself', 'code' => $query]);
        // dd($data);
        $res = [
            'coltext' => 'text',
            'colsubmit' => 'val',
            'colshow' => ['text'],
            'utils' => utils($menu),
            'set' => set(),
            'data' => $data
        ];
        return $res;
    }


    public function call($menu, $val = '', $id = '')
    {
        $params = ['menu' => $menu, 'order' => 'edit', 'req' => 'call', 'val' => $val, 'id' => $id];
        $dokumen = query($params);
        // dd($dokumen);

        if ($dokumen['data']) {
            $newdokumen = [];
            foreach ($dokumen['data'] as $i) {
                foreach ($dokumen['utils']['colshow'] as $p) {
                    $exp = explode(".", $i[$p]);
                    if (count($exp) > 1) {
                        $i[$p] = folder($p) . '/' . $i[$p];
                        // dd($i);
                    }

                    foreach ($dokumen['props'] as $x) {
                        if ($p == $x['col']) {
                            foreach (datajs() as $d) {
                                $i[$d['key']] = $x[$d['key']];
                            }
                        }
                    }
                }
                // dd($i);
                $newdokumen[] = $i;
            }
            $colshow = [];
            foreach ($dokumen['utils']['colshow'] as $p) {
                $exp = explode(".", $i[$p]);
                if (count($exp) > 1) {
                    $colshow[] = $p;
                }
            }

            $dokumen['data'] = $newdokumen;
            $dokumen['utils']['colshow'] = $colshow;
        }
        // dd($dokumen);
        return $dokumen;
    }


    public function copy($tabel, $id, $menu)
    {

        $props = removejoin(props(['menu' => $menu, 'order' => 'submit'])['submit']);
        $db      = \Config\Database::connect();
        $db = $db->table($tabel);
        $q = $db->where('id', $id)->get()->getRowArray();

        $res = [
            'props' => $props,
            'utils' => utils($menu),
            'set' => set(),
            'datajs' => datajs('js'),
            'labels' => $this->ilabelsubmit($menu),
            'data' => $q
        ];
        return $res;
    }


    public function html($menu)
    {

        $submit = $this->submit($menu);
        // dd($submit);
        $utils = utils($menu);
        // dd($utils['copy']);
        $res = [];

        $data = [
            'data' => [
                'utils' => $utils
            ]
        ];

        foreach (contents($menu) as $i) {
            if ($i == 'submit') {

                $input = [];
                foreach ($submit['props'] as $x) {

                    $input[] = $this->inputs($x, $utils);
                }
                // dd($input);
                $data['data']['inputs'] = $input;
                $data['data']['labels'] = $this->ilabelsubmit($menu);
                $res['html'][] = view('elements/submit', $data);
            } else if ($i == 'dokumen') {
                $data = [
                    'data' => [
                        'utils' =>  $this->call($menu)['utils']
                    ]
                ];
                $res['html'][] = view('elements/' . $i, $data);
            } else {
                if ($i == 'footer') {

                    $preview = $this->preview($menu);
                    // dd($preview);
                    if ($preview) {
                        foreach ($preview as $p) {
                            // dd($p);
                            $data = [
                                'data' => $p
                            ];
                            // dd($p);
                            $res['html'][] = view('preview/' . $p['utils']['typeof'], $data);
                        }
                    }
                }
                $data = [
                    'data' => [
                        'utils' => $utils
                    ]
                ];
                $res['html'][] = view('elements/' . $i, $data);
            }
        }


        return $res;
    }


    public function preview($menu)
    {

        return preview($menu);
    }


    public function inputs($props, $utils)
    {
        $data = [
            'data' => [
                'props' => $props,
                'datajs' => datajs('js'),
                'utils' => $utils
            ]
        ];
        return view('inputs/' . ($props['type'] == 'checkbox' || $props['type'] == 'radio' ? 'check' : $props['type']), $data);
    }
}
