<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function home()
    {
        $tahun = '';
        return view('main', compact('tahun'));
    }

    public function tampil(Request $req)
    {
        $tahun = $req->tahun;
        $data1 = Http::get('http://tes-web.landa.id/intermediate/menu');
        $menu = json_decode($data1);
        $data2 = Http::get('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $tahun);
        $trans = json_decode($data2);
        $nilai = 0;

        if ($tahun) {
            //total pojok
            foreach ($trans as $hasil) {
                $nilai += $hasil->total;
            }

            //fungsi kolom isi
            foreach ($menu as $item) {
                for ($i = 1; $i <= 12; $i++) {
                    $result[$item->menu][$i] = 0;
                }
            }

            //kolom isi
            foreach ($trans as $data) {
                $bulan = date('n', strtotime($data->tanggal));
                $result[$data->menu][$bulan] += $data->total;
            }

            //fungsi total bwh
            foreach ($trans as $jml) {
                for ($i = 1; $i <= 12; $i++) {
                    $jumlah[$i] = 0;
                }
            }

            //isi total bwh
            foreach ($trans as $perbulan) {
                $bln = date('n', strtotime($perbulan->tanggal));
                $jumlah[$bln] += $perbulan->total;
            }

            //fungsi total kanan
            foreach ($menu as $permenu) {
                $jumlahmenu[$permenu->menu] = 0;
            }

            //isi total kanan
            foreach ($trans as $jmltrans) {
                $jumlahmenu[$jmltrans->menu] += $jmltrans->total;
            }

            $data = [
                'a' => $menu,
                'b' => $trans,
                'c' => $jumlahmenu,
                'd' => $jumlah,
                'e' => $result,
            ];

            return view('main', compact('tahun', 'menu', 'trans', 'result', 'nilai', 'jumlah', 'jumlahmenu','data'));
        }else {
            return redirect('/');
        }
    }
}
