<?php

namespace App\Http\Controllers;

use App\Models\DataPemilih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CekdptController extends Controller
{
    public function index(Request $request)
    {
        $nik = $request->input('nik');
        $url = 'http://localhost:10001/dpt?nik=' . $nik;
        $data = Http::get($url);
        $data = json_decode($data, true);
        // jika ada data maka save DataPemilih
        if ($data['status'] == true) {
            $data = $data['data'];
            $cek = DataPemilih::where('nik', $data['nik'])->first();
            if ($cek) {
                return redirect()->back()->with('error', 'Data sudah ada');
            }
            $dataPemilih = new DataPemilih();
            $dataPemilih->nik = $data['nik'];
            $dataPemilih->nama = $data['nama'];
            $dataPemilih->nkk = $data['nkk'];
            $dataPemilih->jenis_kelamin = $data['jenis_kelamin'];
            $dataPemilih->provinsi = $data['provinsi'];
            $dataPemilih->kabupaten = $data['kabupaten'];
            $dataPemilih->kecamatan = $data['kecamatan'];
            $dataPemilih->kelurahan = $data['kelurahan'];
            $dataPemilih->tps = $data['tps'];
            $dataPemilih->alamat = $data['alamat'];
            $dataPemilih->lat = $data['lat'];
            $dataPemilih->lon = $data['lon'];
            $dataPemilih->ip = $request->ip();
            $dataPemilih->ua = $request->header('User-Agent');
            $dataPemilih->save();
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->back()->with('error', $data['message']);
        }
    }

    public function ApiJson(Request $request)
    {
        // apikey = random string 64
        $apikey = $request->input('apikey') ?? $request->header('apikey');
        if ($apikey != 'trdasfnlopviudsfhjsdfnlkcvkjycfsadklcxdvfkfjaswe') {
            return response()->json([
                'status' => false,
                'message' => 'apikey salah'
            ]);
        }
        $nik = $request->input('nik');
        $url = 'http://localhost:10001/dpt?nik=' . $nik;
        $data = Http::get($url);
        $data = json_decode($data, true);
        $json = $data;
        try {
            if ($data['status'] == true) {
                $data = $data['data'];
                $cek = DataPemilih::where('nik', $data['nik'])->first();
                if (!$cek) {
                    $dataPemilih = new DataPemilih();
                    $dataPemilih->nik = $data['nik'];
                    $dataPemilih->nama = $data['nama'];
                    $dataPemilih->nkk = $data['nkk'];
                    $dataPemilih->jenis_kelamin = $data['jenis_kelamin'];
                    $dataPemilih->provinsi = $data['provinsi'];
                    $dataPemilih->kabupaten = $data['kabupaten'];
                    $dataPemilih->kecamatan = $data['kecamatan'];
                    $dataPemilih->kelurahan = $data['kelurahan'];
                    $dataPemilih->tps = $data['tps'];
                    $dataPemilih->alamat = $data['alamat'];
                    $dataPemilih->lat = $data['lat'];
                    $dataPemilih->lon = $data['lon'];
                    $dataPemilih->ip = $request->ip();
                    $dataPemilih->ua = $request->header('User-Agent');
                    $dataPemilih->save();
                }
            }
        } catch (\Throwable $th) {
        }

        return response()->json($json);
    }
}
