<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\writer\xlsx;

class Prints extends BaseController
{
    public function mainpdf()
    {
        helper('prints');
        $set = \App\Models\Settings::class;
        $set = new $set;
        $controller = $this->request->getVar('controller');
        $tabel = $this->request->getVar('tabel');
        $list = $this->request->getVar('list');
        $menu = $this->request->getVar('menu');
        $cols = $this->request->getVar('cols');
        $judul = $this->request->getVar('judul');
        $orientasi = $this->request->getVar('orientasi');
        $id = $this->request->getVar('id');

        $props = $set->edit($menu)['props'];
        $data = prints($tabel, $props, $id);
        $set = [
            'mode' => 'utf-8',
            'format' => [210, 330],
            'orientation' => $orientasi
        ];
        $mpdf = new \Mpdf\Mpdf($set);

        if ($list == null) {
            foreach ($data['data'] as $i) {
                $data = [
                    "props" => $data['props'],
                    "cols" => $cols,
                    "list" => $list,
                    "judul" => $judul,
                    "orientasi" => $orientasi,
                    "data" => $i
                ];

                $html = view('prints/' . $controller, $data);
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }
        } else {
            $data = [
                "props" => $data['props'],
                "cols" => $cols,
                "judul" => $judul,
                "list" => $list,
                "orientasi" => $orientasi,
                "data" => $data['data']
            ];

            $html = view('prints/' . $controller, $data);
            $mpdf->WriteHTML($html);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('user.pdf', 'I');
    }
    public function skpdf()
    {
        helper('prints');
        $set = \App\Models\Settings::class;
        $set = new $set;
        $controller = $this->request->getVar('controller');
        $tabel = $this->request->getVar('tabel');
        $list = $this->request->getVar('list');
        $menu = $this->request->getVar('menu');
        $cols = $this->request->getVar('cols');
        $judul = $this->request->getVar('judul');
        $orientasi = $this->request->getVar('orientasi');
        $id = $this->request->getVar('id');
        $props = $set->edit($menu)['props'];


        $data = prints($tabel, $props, $id);
        $isttd = $this->request->getVar('isttd');
        $set = [
            'mode' => 'utf-8',
            'format' => [210, 330],
            'orientation' => $orientasi
        ];
        $mpdf = new \Mpdf\Mpdf($set);

        if ($list == null) {
            foreach ($data['data'] as $i) {
                $kop = '<img src="images/' . folderprint('kop') . '/' . $i['kop'] . '"/>';
                $ttd = '<img style="width:100px;" src="images/' . folderprint('ttd') . '/' . $i['ttd'] . '"/>';
                $data = [
                    "props" => $data['props'],
                    "cols" => $cols,
                    "list" => $list,
                    "isttd" => $isttd,
                    "judul" => $judul,
                    "orientasi" => $orientasi,
                    "kop" => $kop,
                    "ttd" => $ttd,
                    "data" => $i
                ];

                $html = view('prints/' . $controller, $data);
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }
        } else {
            $data = [
                "props" => $data['props'],
                "cols" => $cols,
                "judul" => $judul,
                "list" => $list,
                "orientasi" => $orientasi,
                "data" => $data['data']
            ];

            $html = view('prints/' . $controller, $data);
            $mpdf->WriteHTML($html);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('user.pdf', 'I');
    }

    public function mainexcel()
    {
        helper('prints');
        $set = \App\Models\Settings::class;
        $set = new $set;
        $tabel = $this->request->getVar('tabel');
        $menu = $this->request->getVar('menu');
        $id = $this->request->getVar('id');


        $props = $set->edit($menu)['props'];
        $data = prints($tabel, $props, $id);


        $filename = $menu . '.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();


        $huruf = 'AAZ';

        foreach ($props as $p) {
            $huruf++;
            $sheet->setCellValue(substr($huruf, -1) . '1', $p['label']);
        }

        $rows = 2;
        $huruf = 'AAZ';
        foreach ($data['data'] as $i) {
            foreach ($props as $p) {
                $huruf++;
                $sheet->setCellValue(substr($huruf, -1) . $rows, $i[$p['col']]);
            }
            $huruf = 'AAZ';
            $rows++;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: maxe-age=0');

        $writer = new xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function selfpdf()
    {
        helper('prints');
        $set = \App\Models\Settings::class;
        $set = new $set;


        $menu = $this->request->getVar('menu');
        $printself = $set->preview($menu);
        $query = $this->request->getVar('query');

        $props = [];
        foreach ($printself as $i) {
            if ($i['query'] == $query) {
                foreach ($i['props'] as $p) {
                    if ($p['col'] !== 'gelar') {
                        $props[] = $p;
                    }
                }
            }
        }

        $controller = $this->request->getVar('controller');
        $judul = $this->request->getVar('judul');
        $cols = $this->request->getVar('cols');
        $orientasi = $this->request->getVar('orientasi');
        $cols = $this->request->getVar('cols');
        $file = explode("/", $controller);
        $data = [];

        foreach ($props as $i) {
            $data[] = $this->request->getVar($i['col']);
        }


        $newdata = [];
        foreach ($data as $i) {
            for ($x = 0; $x < count($i); $x++) {
                $newdata[$x][] = $i[$x];
            }
        }

        $newdata2 = [];
        foreach ($newdata as $i) {
            $val = [];
            for ($x = 0; $x < count($i); $x++) {
                $val[] = $i[$x];
            }
            $newdata2[] = $val;
        }



        // dd($tes);
        $set = [
            'mode' => 'utf-8',
            'format' => [210, 330],
            'orientation' => $orientasi
        ];
        $mpdf = new \Mpdf\Mpdf($set);

        $data = [
            "cols" => $cols,
            "judul" => $judul,
            "props" => $props,
            "data" => $newdata2
        ];
        $html = view('prints/' . end($file), $data);
        $mpdf->WriteHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('user.pdf', 'I');
    }

    public function selfexcel()
    {
        helper('prints');
        $set = \App\Models\Settings::class;
        $set = new $set;


        $menu = $this->request->getVar('menu');
        $printself = $set->preview($menu);
        $query = $this->request->getVar('query');

        $props = [];
        foreach ($printself as $i) {
            if ($i['query'] == $query) {
                foreach ($i['props'] as $p) {
                    if ($p['col'] !== 'gelar') {
                        $props[] = $p;
                    }
                }
            }
        }

        $data = [];

        foreach ($props as $i) {
            $data[] = $this->request->getVar($i['col']);
        }


        $newdata = [];
        foreach ($data as $i) {
            for ($x = 0; $x < count($i); $x++) {
                $newdata[$x][] = $i[$x];
            }
        }

        $newdata2 = [];
        foreach ($newdata as $i) {
            $val = [];
            for ($x = 0; $x < count($i); $x++) {
                $val[] = $i[$x];
            }
            $newdata2[] = $val;
        }

        $filename = $menu . '.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();


        $huruf = 'AAZ';

        foreach ($props as $p) {
            $huruf++;
            $sheet->setCellValue(substr($huruf, -1) . '1', $p['label']);
        }

        // A2 noid B2 nama C2 ttl D2 ket
        $huruf = 'AAZ';
        $rows = 2;
        $tes = [];
        foreach ($newdata2 as $k => $i) {
            foreach ($newdata2[$k] as $p) {
                $huruf++;
                $sheet->setCellValue(substr($huruf, -1) . $rows, $p);
            }
            $huruf = 'AAZ';
            $rows++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: maxe-age=0');

        $writer = new xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }


    public function cabangpdf()
    {
        helper('prints');
        $set = \App\Models\Settings::class;
        $set = new $set;
        $controller = $this->request->getVar('controller');
        $tabel = $this->request->getVar('tabel');
        $query = $this->request->getVar('query');
        $list = $this->request->getVar('list');
        $menu = $this->request->getVar('menu');
        $cols = $this->request->getVar('cols');
        $judul = $this->request->getVar('judul');
        $orientasi = $this->request->getVar('orientasi');
        $id = $this->request->getVar('id');

        $prop = $set->preview($menu);
        $props = [];
        foreach ($prop as $i) {
            if ($i['query'] == $query) {
                $props = $i['props'];
            }
        }



        $data = prints($tabel, $props, $id);
        // dd($data);
        $set = [
            'mode' => 'utf-8',
            'format' => [210, 330],
            'orientation' => $orientasi
        ];
        $mpdf = new \Mpdf\Mpdf($set);

        if ($list == null) {
            foreach ($data['data'] as $i) {
                $data = [
                    "props" => $data['props'],
                    "cols" => $cols,
                    "list" => $list,
                    "judul" => $judul,
                    "orientasi" => $orientasi,
                    "data" => $i
                ];

                $html = view('prints/' . $controller, $data);
                $mpdf->AddPage();
                $mpdf->WriteHTML($html);
            }
        } else {
            $data = [
                "props" => $data['props'],
                "cols" => $cols,
                "judul" => $judul,
                "list" => $list,
                "orientasi" => $orientasi,
                "data" => $data['data']
            ];

            $html = view('prints/' . $controller, $data);
            $mpdf->WriteHTML($html);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('user.pdf', 'I');
    }

    public function cabangexcel()
    {
        helper('prints');
        helper('prints');
        $set = \App\Models\Settings::class;
        $set = new $set;
        $tabel = $this->request->getVar('tabel');
        $query = $this->request->getVar('query');
        $menu = $this->request->getVar('menu');
        $id = $this->request->getVar('id');

        $prop = $set->preview($menu);
        $props = [];
        foreach ($prop as $i) {
            if ($i['query'] == $query) {
                $props = $i['props'];
            }
        }



        $data = prints($tabel, $props, $id);

        // dd($data);
        $filename = $menu . '.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();


        $huruf = 'AAZ';

        foreach ($data['props'] as $p) {
            $huruf++;
            $sheet->setCellValue(substr($huruf, -1) . '1', $p['label']);
        }

        $rows = 2;
        $huruf = 'AAZ';
        foreach ($data['data'] as $i) {
            foreach ($data['props'] as $p) {
                $huruf++;
                $sheet->setCellValue(substr($huruf, -1) . $rows, $i[$p['col']]);
            }
            $huruf = 'AAZ';
            $rows++;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: maxe-age=0');

        $writer = new xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
