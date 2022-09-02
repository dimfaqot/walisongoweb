<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    function __construct()
    {
        $this->judul = 'Dashboard';
    }
    public function index()
    {
        helper('functions');


        $set = \App\Models\Settings::class;
        $set = new $set;
        // dd($set->edit('Tilawati'));
        $data = [
            'data' => [
                'judul' => $this->judul,
                'html' => $set->html($this->judul)['html']
            ]
        ];
        return view('template', $data);
    }

    public function rows()
    {
        $menu = \App\Models\Menus::class;
        $menu = new $menu;
        $idmenu = $this->request->getVar('idmenu');
        $val = $this->request->getVar('val');
        $q = $menu->where('id', $idmenu)->first();
        if ($q) {
            $q['limits'] = $val;
            $save = $menu->save($q);
            if ($save) {
                echo json_encode(['status' => '200']);
            }
        } else {
            echo json_encode(['status' => '400', 'message' => "Gagal!. Data tidak ditemukan!."]);
        }
    }
    public function datashow()
    {
        $set = \App\Models\Settings::class;
        $set = new $set;
        $menu = $this->request->getVar('menu');
        $val = $this->request->getVar('val');
        $order = $this->request->getVar('order');

        $data = $set->edit($menu);
        if ($order == 'search') {
            $data = $set->search($menu, $val);
        }
        $res = [
            'status' => '200',
            'data' => $data
        ];
        echo json_encode($res);
    }
    public function select()
    {
        helper('functions');
        $set = \App\Models\Settings::class;
        $set = new $set;
        if ($this->request->getVar('order') == 'dokumen' || $this->request->getVar('order') == 'dokumensukses') {
            $data = $set->call($this->request->getVar('menu'), $this->request->getVar('val'), $this->request->getVar('id'));
        } else {

            $menu = $this->request->getVar('menu');
            $query = $this->request->getVar('query');
            $order = $this->request->getVar('type');
            $datamulti = $this->request->getVar('datamulti');
            $val = $this->request->getVar('val');

            $isdb = substr($query, 0, 2);

            if ($isdb == 'db') {
                $ops = $set->selectdb($menu, $order, $query, $val, $datamulti);
            } else {
                $ops = $set->selectself($menu, $query, $datamulti);
            }
            $data = $ops;
        }

        $res = [
            'status' => '200',
            'data' => $data

        ];
        echo json_encode($res);
    }
    public function selectpreview()
    {
        $set = \App\Models\Settings::class;
        $set = new $set;
        $menu = $this->request->getVar('menu');
        $cols = $this->request->getVar('cols');
        $val = $this->request->getVar('val');

        $data = $set->selectpreview($menu, $cols, $val);
        $res = [
            'status' => '200',
            'data' => $data

        ];
        echo json_encode($res);
    }
    public function save()
    {
        helper('functions');
        $data = json_decode(json_encode($this->request->getVar('data')), true);
        $idmenu = $this->request->getVar('idmenu');
        $tabel = $this->request->getVar('tabel');
        $order = $this->request->getVar('order');
        $id = $this->request->getVar('id');
        $res = save($data, $tabel, $order, $idmenu, $id);
        echo json_encode($res);
    }
    public function delete()
    {
        helper('functions');
        $tabel = $this->request->getVar('tabel');
        $id = $this->request->getVar('id');
        $idmenu = $this->request->getVar('idmenu');

        $res = delete($tabel, $id, $idmenu);
        echo json_encode($res);
    }

    public function dokumen()
    {
        helper('functions');
        $tabel = $this->request->getVar('tabel');
        $id = $this->request->getVar('id');
        $menu = $this->request->getVar('menu');
        $col = $this->request->getVar('col');
        $ext = explode(",", $this->request->getVar('ext'));
        $folder = folder($this->request->getVar('col'));
        $dokumen = $this->request->getFile('dokumen');

        $nama = $dokumen->getRandomName();
        if ($dokumen->getError() == 4) {
            session()->setFlashdata('gagal', 'Gagal!. Tidak ada file yang diupload!.');
            return redirect()->to(base_url(strtolower(str_replace(" ", "", $menu))));
        }
        $size = (int)str_replace(".", "", $dokumen->getSizeByUnit('mb'));

        if ($size > 2000) {
            session()->setFlashdata('gagal', 'Gagal!. Ukuran maksimal file 2MB.');
            return redirect()->to(base_url(strtolower(str_replace(" ", "", $menu))));
        }

        $exp = explode(".", $dokumen->getName());
        $exe = strtolower(end($exp));
        if (array_search($exe, $ext) === false) {
            session()->setFlashdata('gagal', 'Gagal!. Format file harus ' . implode(", ", $ext) . '.');
            return redirect()->to(base_url(strtolower(str_replace(" ", "", $menu))));
        }

        $db      = \Config\Database::connect();
        $db = $db->table($tabel);
        $q = $db->where('id', $id)->get()->getRowArray();
        // dd($tabel);
        if (!$q) {
            session()->setFlashdata('gagal', 'Gagal!. File tidak ditemukan.');
            return redirect()->to(base_url(strtolower(str_replace(" ", "", $menu))));
        }

        $randomChar = randomstring($folder);
        $dokumen->move('images/' . $folder, $randomChar . $nama);
        $not = $col . '.jpg';

        if ($q[$col] !== $not) {
            unlink('images/' . $folder . '/' . $q[$col]);
        }
        $q[$col] = $randomChar . $nama;
        $db->where('id', $id);
        $db->update($q);

        session()->setFlashdata('sukses', 'dokumensukses,' . $menu . ',' . $id . ',' . $tabel);
        return redirect()->to(base_url(strtolower(str_replace(" ", "", $menu))));
    }

    public function loadmore()
    {
        $con = \App\Models\Configs::class;
        $con = new $con;
        $query = $this->request->getVar('query');
        $menu = $this->request->getVar('menu');
        $order = $this->request->getVar('order');

        $q = $con->where('code', $query)->first();
        preg_match_all("/\[[^\]]*\]/", $q['value'], $val);

        $value = $val[0];
        $typeof = '';
        $index = '';
        foreach ($value as $k => $i) {
            $removebracket = str_replace("[", "", str_replace("]", "", $i));
            $exp = explode(" ", $removebracket);
            if ($exp[0] == 'typeof') {
                $index = $k;
                $exp2 = explode("|", $exp[1]);
                if ($exp2[2] >= 10 && $order == 'plus') {
                    $mod = 10 - fmod($exp2[2], 10);
                    $typeof = $exp2[0] . '|' . $exp2[1] . '|' . ($exp2[2] + $mod);
                }
                if ($exp2[2] >= 10 && $order == 'minus') {
                    $typeof = $exp2[0] . '|' . $exp2[1] . '|' . ($exp2[2] > 10 ? $exp2[2] - 10 : $exp2[2]);
                }
                $typeof = '[typeof ' . $typeof . ']';
            }
        }

        $value[$index] = $typeof;
        $q['value'] = implode(" ", $value);

        $con->save($q);

        $set = \App\Models\Settings::class;
        $set = new $set;
        $menu = $this->request->getVar('menu');
        $qmenu = menu($menu)['preview'];
        $res = ['status' => '200', 'data' => $set->preview($menu)];
        echo json_encode($res);
    }

    public function copy()
    {
        $set = \App\Models\Settings::class;
        $set = new $set;

        $tabel = $this->request->getVar('tabel');
        $id = $this->request->getVar('id');
        $menu = $this->request->getVar('menu');
        $data = $set->copy($tabel, $id, $menu);
        $data['status'] = '200';
        echo json_encode($data);
    }
    public function gantipassword()
    {
        $menu = $this->request->getVar('menu');
        $passwordsekarang = $this->request->getVar('passwordsekarang');
        $passwordbaru = $this->request->getVar('passwordbaru');
        $konfirmasi = $this->request->getVar('konfirmasi');
        $id = session('id');
        if ($passwordsekarang == "" || $passwordbaru == "" || $konfirmasi === "") {
            session()->setFlashdata('gagal', 'Gagal!. Semua input harus diisi.');
            return redirect()->to(base_url($menu));
        }

        $user = \App\Models\Users::class;
        $user = new $user;

        // cek password sekarang
        $q = $user->where('id', $id)->first();
        if (!password_verify($passwordsekarang, $q['password'])) {
            session()->setFlashdata('gagal', "Gagal!. Password sekarang salah!");
            return redirect()->to(base_url($menu));
        }

        // cek password match
        if ($passwordbaru !== $konfirmasi) {
            session()->setFlashdata('gagal', "Gagal!. Konfirmasi password baru tidak cocok!");
            return redirect()->to(base_url($menu));
        }

        $q['password'] = password_hash($passwordbaru, PASSWORD_DEFAULT);

        $user->save($q);
        session()->setFlashdata('sukses', '');
        return redirect()->to(base_url($menu));
    }
    public function fontsize()
    {
        $val = $this->request->getVar('val');

        $db = \App\Models\Temas::class;
        $db = new $db;

        $role_id = session('role_id');

        $q = $db->where('role_id', $role_id)->first();
        $q['font_size'] = $val;

        $save = $db->save($q);

        if ($save) {
            $res = [
                'status' => '200',
                'reload' => true
            ];
            echo json_encode($res);
        }
    }

    public function colortema()
    {
        $id = $this->request->getVar('id');

        $db = \App\Models\Temas::class;
        $db = new $db;

        $role_id = session('role_id');

        $q = $db->where('role_id', $role_id)->first();
        $q['color_id'] = $id;

        $save = $db->save($q);

        if ($save) {
            $res = [
                'status' => '200',
                'reload' => true
            ];
            echo json_encode($res);
        }
    }
    public function preview()
    {
        $set = \App\Models\Settings::class;
        $set = new $set;
        $menu = $this->request->getVar('menu');
        $qmenu = menu($menu)['preview'];
        $res = ['status' => '200', 'data' => []];
        if ($qmenu !== '') {
            $res['data'] = $set->preview($menu);
        }
        echo json_encode($res);
    }
    public function changepreview()
    {
        $cols = json_decode(json_encode($this->request->getVar('cols')), true);
        $selected = json_decode(json_encode($this->request->getVar('selected')), true);
        $query = $this->request->getVar('query');
        $menu = $this->request->getVar('menu');

        $config = folder($query);
        preg_match_all("/\[[^\]]*\]/", $config, $val);

        $value = $val[0];

        foreach ($value as $k => $i) {
            $removebracket = str_replace("[", "", str_replace("]", "", $i));
            $expremove = explode(" ", $removebracket);
            if ($expremove[0] == 'where') {
                $exp = explode("=", $expremove[1]);

                foreach ($selected as $s) {
                    if ($exp[0] == $s['req']) {
                        unset($value[$k]);
                    }
                }
            }
        }

        if ($selected) {
            foreach ($selected as $s) {
                if ($s['val'] !== 'Semua') {
                    $value[] = '[where ' . $s['req'] . '=' . str_replace(" ", "-", $s['val']) . ']';
                }
            }
        }


        $namagelar = false;

        foreach ($value as $k => $i) {
            $removebracket = str_replace("[", "", str_replace("]", "", $i));
            $expremove = explode(" ", $removebracket);
            if ($expremove[0] == 'remove') {
                $newremove = [];
                foreach ($cols as $r) {
                    if ($r['val'] == 'off') {
                        if ($r['col'] !== 'namagelar') {
                            $newremove[] = $r['col'];
                        }
                    } else {
                        if ($r['col'] == 'namagelar') {
                            $namagelar = true;
                        }
                    }
                }

                unset($value[$k]);
                $value[] = '[remove all ' . implode(",", $newremove) . ',password,role_id,profile,ktp,kk,berkas]';
            }
        }


        $db = \App\Models\Configs::class;
        $db = new $db;

        $q = $db->where('code', $query)->first();
        $q['value'] = implode(" ", $value);
        $db->save($q);

        $data = preview($menu);

        if ($namagelar) {
            $newdata = [];

            $index = '';
            foreach ($data as $k => $i) {
                if ($i['query'] == $query) {
                    $index = $k;
                    foreach ($i['data'] as $d) {
                        if ($d['gelar'] !== '') {
                            $d['nama'] = $d['nama'] . ', ' . $d['gelar'];
                        }
                        $newdata[] = $d;
                    }
                }
            }
            $data[$index]['data'] = $newdata;
        }
        $res = [
            'status' => '200',
            'data' => $data
        ];
        echo json_encode($res);
    }


    public function createabsen()
    {

        $set = \App\Models\Settings::class;
        $set = new $set;

        $ak = \App\Models\Anggotakelas::class;
        $ak = new $ak;


        $tabel = $this->request->getVar('tabel');
        $menu = $this->request->getVar('menu');
        // dd($set->preview($menu));

        $at = $ak->where('tahun', date('Y'))->where('cabang', firstUpCase($tabel))->find();

        $db      = \Config\Database::connect();
        $db = $db->table($tabel);

        $cols = $set->cols($tabel);

        foreach ($at as $i) {
            $data = [];
            foreach ($cols as $c) {
                if ($c == 'anggotakelas_id') {
                    $data[$c] = $i['id'];
                }
                if ($c == 'user_id') {
                    $data[$c] = $i['user_id'];
                } else if ($c == 'absen' || $c == 'keterangan') {
                    $data[$c] = '';
                } else {
                    $data[$c] = 0;
                }
            }
            $data['tanggal'] = date('d-m-Y');
            $data['bulan'] = date('m');
            $data['updated_at'] = date("Y-m-d H:i:s");
            $data['created_at'] = date("Y-m-d H:i:s");
            $db->insert($data);
        }

        $res = ['status' => '200', 'data' => $set->preview($menu)];

        echo json_encode($res);
    }
    public function bestoftahfidz()
    {
        $set = \App\Models\Settings::class;
        $set = new $set;
        $cols = $set->cols('tahfidz');
        $newcols = [];
        foreach ($cols as $i) {
            $new = [
                'col' => $i,
                'label' => firstWordUpCase(str_replace("_", " ", $i))
            ];
            $exp = explode("_", $i);
            if (count($exp) > 1) {
                if ($exp[0] == 'akhlaq') {
                    $new['label'] = 'Adab Kepada ' . $exp[1];
                }
                if ($exp[0] == 'kedisiplinan') {
                    $new['label'] = firstWordUpCase($exp[1]);
                }
            }
            $newcols[] = $new;
        }
        // dd($newcols);
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');
        $sortby = $this->request->getVar('sortby');
        $semester = $this->request->getVar('semester');

        $db      = \Config\Database::connect();
        $db = $db->table('tahfidz');

        $db->select('user_id')->join('anggotakelas', 'anggotakelas.id=anggotakelas_id');
        if ($tahun !== 'Semua') {
            $db->where('tahun', $tahun);
        }
        $q = $db->get()->getResultArray();


        $user_id = [];

        foreach ($q as $i) {
            if (array_search($i['user_id'], $user_id) === false) {
                $user_id[] = $i['user_id'];
            }
        }


        $data = [];

        $val = [];
        $sort = [];
        foreach ($user_id as $i) {
            $user = $db->join('anggotakelas', 'anggotakelas.id=anggotakelas_id')->join('user', 'user_id=user.id')->where('user_id', $i)->orderBy('juz', 'DESC')->get()->getRowArray();

            $res = [];
            $res['user_id'] = $i;
            $res['kelas'] = $user['kelas'];
            $res['nama'] = $user['nama'];
            $expket = explode(" ", strtolower($user['keterangan']));
            $newket = [];
            if (array_search('halaman', $expket) !== false) {
                foreach ($expket as $nk) {
                    if ($nk == 'halaman') {
                        $nk = 'hal.';
                    }
                    $newket[] = $nk;
                }
            }

            $res['keterangan'] = firstWordUpCase(implode(" ", $newket));

            $sum = [];

            foreach ($newcols as $c) {
                if ($c['col'] !== 'anggotakelas_id' && $c['col'] !== 'juz' && $c['col'] !== 'absen' && $c['col'] !== 'keterangan' && $c['col'] !== 'tanggal' && $c['col'] !== 'bulan') {
                    // jumlah
                    $db->join('anggotakelas', 'anggotakelas.id=anggotakelas_id')->selectSum($c['col'])->where('user_id', $i);
                    if ($bulan == 'Semua') {
                        if ($semester !== 'Semua') {
                            $sem = [
                                'ganjil' => ['07', '08', '09', '10', '11', '12'],
                                'genap' => ['01', '02', '03', '04', '05', '06']
                            ];
                            if ($semester == 'ganjil') {
                                $db->whereIn('bulan', $sem[$semester]);
                            }
                        }
                    } else {
                        if ($semester !== 'Semua') {
                            $sem = [
                                'ganjil' => ['07', '08', '09', '10', '11', '12'],
                                'genap' => ['01', '02', '03', '04', '05', '06']
                            ];
                            if ($semester == 'ganjil') {
                                $db->whereIn('bulan', $sem[$semester]);
                            }
                        } else {
                            $db->where('bulan', $bulan);
                        }
                    }
                    $jumlah = $db->get()->getRowArray();

                    // total
                    $sum[] = $jumlah[$c['col']];

                    $res['jumlah'][] = ['label' => $c['label'], 'col' => $c['col'], 'val' => $jumlah[$c['col']]];

                    // avg
                    $db->join('anggotakelas', 'anggotakelas.id=anggotakelas_id')->selectAvg($c['col'])->where('user_id', $i);
                    if ($bulan !== 'Semua') {
                        $db->where('bulan', $bulan);
                    }
                    $avg = $db->get()->getRowArray();
                    $res['avg'][] = ['label' => $c['label'], 'col' => $c['col'], 'val' => ($avg[$c['col']] == null ? 0 : round($avg[$c['col']]))];
                }
            }


            // absen
            $absen = [];
            $absentahfidz = folder('absentahfidz');
            $absentahfidz = explode(",", $absentahfidz);

            foreach ($absentahfidz as $a) {
                $db->join('anggotakelas', 'anggotakelas.id=anggotakelas_id')->where('user_id', $i)->where('absen', $a);
                if ($bulan !== 'Semua') {
                    $db->where('bulan', $bulan);
                }
                $absen[] = ['col' => $a, 'val' => $db->countAllResults()];
            }

            $res['absen'] = $absen;


            // total
            if ($sortby !== 'Semua') {
                if ($sortby == 'absen') {
                    $sum = [$absen['Hafalan']];
                } else if ($sortby == 'juz') {
                    $jz = $db->join('anggotakelas', 'anggotakelas.id=anggotakelas_id')->join('user', 'user_id=user.id')->where('user_id', $i)->orderBy('juz', 'DESC')->get()->getRowArray();
                    $sum = [$jz['juz']];
                } else {
                    foreach ($res['jumlah'] as $s) {
                        if ($s['col'] == $sortby) {
                            $sum = [$s['val']];
                        }
                    }
                }
            }


            $sort[$i] = array_sum($sum);

            $res['total'] = array_sum($sum);

            $val[] = $res;
        }

        arsort($sort);

        foreach ($sort as $k => $s) {
            foreach ($val as $v) {
                if ($v['user_id'] == $k) {
                    $data[] = $v;
                }
            }
        }


        $res = ['status' => '200', 'data' => $data, 'props' => $newcols, 'set' => set(), 'absen' => $absentahfidz];

        echo json_encode($res);
    }
}
