<?php

namespace App\Http\Controllers;

use App\Models\Ayat;
use App\Models\Surat;
use Illuminate\Http\Request;

class QuranController extends Controller
{
    public function index()
    {
        return response()->json([
            'surats' => Surat::all(),
            'akhir' => Ayat::with('surat:id,nama')->firstWhere('akhir', 1)
        ], 200);
    }

    public function surat(Surat $surat)
    {
        return response()->json([
            'surat' => $surat,
        ], 200);
    }

    public function ayat($surat_id)
    {
        $surat = Surat::find($surat_id);
        return response()->json([
            'surat' => $surat,
            'ayats' => $surat->ayats()->withNamaSurat()->get(),
            'nextSurat' => Surat::find($surat_id + 1)
        ], 200);
    }

    public function juz()
    {
        return response()->json([
            'juzs' => Ayat::with('surat:id,nama')->select(['surat_id', 'ayat'])->where('startjuz', 1)->get(),
        ], 200);
    }

    public function penanda()
    {
        return response()->json([
            'penandas' => Ayat::with('surat:id,nama')->whereNotNull('catatan')->orWhere('penanda', 1)->orderBy('updated_at')->get(['id', 'ayat', 'surat_id', 'catatan', 'updated_at'])
        ], 200);
    }

    public function penandaEdit($id)
    {
        return response()->json([
            'ayat' => Ayat::withNamaSurat()->find($id)
        ], 200);
    }

    public function setAkhir(Request $request)
    {
        try {
            Ayat::where('akhir', 1)->update(['akhir' => null]);
            Ayat::find($request->id)->update($request->input());
            $status['status'] = 'Berhasil';
            $status['message'] = 'Bacaan Terkahir Disimpan';
        } catch (\Throwable $th) {
            report($th);
            $status['status'] = 'Gagal';
            $status['message'] = $th->getMessage();
        }

        return response()->json([
            'status' => $status
        ], 200);
    }

    public function setPenanda(Request $request)
    {
        try {
            Ayat::find($request->id)->update($request->input());
            $status['status'] = 'Berhasil';
            $status['message'] = 'Penanda Disimpan';
        } catch (\Throwable $th) {
            report($th);
            $status['status'] = 'Gagal';
            $status['message'] = $th->getMessage();
        }

        return response()->json([
            'status' => $status
        ], 200);
    }

    public function setCatatan(Request $request)
    {
        try {
            Ayat::find($request->id)->update($request->input());
            $status['status'] = 'Berhasil';
            $status['message'] = 'Catatan Disimpan di Penanda';
        } catch (\Throwable $th) {
            report($th);
            $status['status'] = 'Gagal';
            $status['message'] = $th->getMessage();
        }

        return response()->json([
            'status' => $status
        ], 200);
    }

    public function updateCatatan(Request $request)
    {
        try {
            Ayat::find($request->id)->update($request->input());
            $status['status'] = 'Berhasil';
            $status['message'] = 'Perubahan Disimpan';
        } catch (\Throwable $th) {
            report($th);
            $status['status'] = 'Gagal';
            $status['message'] = $th->getMessage();
        }

        return response()->json([
            'status' => $status
        ], 200);
    }

    public function deleteCatatan($id)
    {
        try {
            Ayat::find($id)->update(['catatan' => null]);
            $status['status'] = 'Berhasil';
            $status['message'] = 'Catatan Dihapus';
        } catch (\Throwable $th) {
            report($th);
            $status['status'] = 'Gagal';
            $status['message'] = $th->getMessage();
        }

        return response()->json([
            'status' => $status
        ], 200);
    }
}
