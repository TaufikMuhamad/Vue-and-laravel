<?php

namespace App\Http\Controllers\Api;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    public function index()
    {
        try {
            $siswa = Siswa::with('hobi')->get();
            return response()->json($siswa);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan pada server: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:siswa,email',
            'degree' => 'required|string|max:255',
            'hobi_id' => 'required|exists:hobi,id',
        ]);

        try {
            $siswa = Siswa::create($validated);
            return response()->json($siswa, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan data siswa: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $siswa = Siswa::with('hobi')->findOrFail($id);
            return response()->json($siswa);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Siswa tidak ditemukan: ' . $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if (!$siswa) {
            return response()->json(['message' => 'Siswa not found'], 404);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:siswa,email,' . $id,
            'degree' => 'required|string|max:255',
            'hobi_id' => 'required|exists:hobi,id',
        ]);

        $siswa->update($validated);
        return response()->json($siswa, 200);
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        $siswa->delete();
        return response()->json(['message' => 'Siswa berhasil dihapus'], 200);
    }
}
