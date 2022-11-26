<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $materi = Materi::where('guru_id', $guru->id)->get();
        $jadwal = Jadwal::where('mapel_id', $guru->mapel_id)->get();
        return view('pages.guru.materi.index', compact('materi', 'jadwal', 'guru'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guru = Guru::where('nip', Auth::user()->nip)->first();

        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
        ]);

        if (isset($request->file)) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('file/materi', $namaFile, 'public');
        }

        $materi = new Materi;
        $materi->guru_id = $guru->id;
        $materi->kelas_id = $request->kelas_id;
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->file = $file;
        $materi->save();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::all();
        $materi = Materi::findOrFail($id);

        return view('pages.guru.materi.edit', compact('materi', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        $data = $request->all();
        $materi->update($data);

        $this->validate($request, [
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('file/materi', $namaFile, 'public');
            $materi->file = $file;
            $materi->save();

            // Delete old file
            $oldFile = $materi->file;
            $path = storage_path('app/public/file/materi/' . $oldFile);
            if (File::exists($path)) {
                File::delete($path);
            } else {
                File::delete($path);
            }
        }

        return redirect()->route('materi.index')->with('success', 'Data materi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materi = Materi::find($id);
        $lokasi = 'file/materi/' . $materi->file;
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        }

        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Data materi berhasil dihapus');
    }

    public function siswa()
    {
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();
        $kelas = Kelas::findOrFail($siswa->kelas_id);
        $materi = Materi::where('kelas_id', $kelas->id)->get();
        $guru = Guru::findOrFail($kelas->guru_id);

        return view('pages.siswa.materi.index', compact('materi', 'guru', 'kelas'));
    }

    public function download($id)
    {
        $file = Materi::findOrFail($id);
        $path = storage_path('/app/public/' . $file->file);
        return Response::download($path);
    }
}
