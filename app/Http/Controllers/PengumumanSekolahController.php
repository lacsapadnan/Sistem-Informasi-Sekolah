<?php

namespace App\Http\Controllers;

use App\Models\PengumumanSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PengumumanSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumans = PengumumanSekolah::orderBy('id', 'desc')->get();
        return view('pages.admin.pengumuman.index', compact('pengumumans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'description' => 'nullable|string',
        ], [
            'start_at.required' => 'Tanggal mulai harus diisi.',
            'start_at.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_at.required' => 'Tanggal akhir harus diisi.',
            'end_at.date' => 'Tanggal akhir harus berupa tanggal yang valid.',
            'end_at.after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal mulai.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ]);

        try {
            DB::beginTransaction();

            $pengumuman = new PengumumanSekolah();
            $pengumuman->start_at = $request->start_at;
            $pengumuman->end_at = $request->end_at;
            $pengumuman->description = $request->description;
            $pengumuman->save();

            DB::commit();

            return redirect()->route('pengumuman-sekolah.index')->with('success', 'Pengumuman berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengumuman = PengumumanSekolah::findOrFail(Crypt::decrypt($id));
        return view('pages.admin.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'start_at' => 'required|date',
            'end_at' => 'required|date|after_or_equal:start_at',
            'description' => 'nullable|string',
        ], [
            'start_at.required' => 'Tanggal mulai harus diisi.',
            'start_at.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'end_at.required' => 'Tanggal akhir harus diisi.',
            'end_at.date' => 'Tanggal akhir harus berupa tanggal yang valid.',
            'end_at.after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal mulai.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ]);

        try {
            DB::beginTransaction();

            $pengumuman = PengumumanSekolah::findOrFail($id);
            $pengumuman->start_at = $request->start_at;
            $pengumuman->end_at = $request->end_at;
            $pengumuman->description = $request->description;
            $pengumuman->save();

            DB::commit();

            return redirect()->route('pengumuman-sekolah.index')->with('success', 'Pengumuman berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui pengumuman: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $pengumuman = PengumumanSekolah::findOrFail($id);
            $pengumuman->delete();

            DB::commit();

            return redirect()->route('pengumuman-sekolah.index')->with('success', 'Pengumuman berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus pengumuman: ' . $e->getMessage());
        }
    }
}
