<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Jawaban;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $tugas = Tugas::where('guru_id', $guru->id)->get();
        $jadwal = Jadwal::where('mapel_id', $guru->mapel_id)->get();

        return view('pages.guru.tugas.index', compact('tugas', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.guru.tugas.create', compact('kelas'));
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
            $file = $file->storeAs('file/tugas', $namaFile, 'public');
        }

        $tugas = new Tugas;
        $tugas->guru_id = $guru->id;
        $tugas->kelas_id = $request->kelas_id;
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->file = $file;
        $tugas->save();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tugas = Tugas::find($id);
        $kelas = Kelas::find($tugas->kelas_id);
        $jawaban = Jawaban::where('tugas_id', $id)->get();
        return view('pages.guru.tugas.show', compact('tugas', 'kelas', 'jawaban'));
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
        $tugas = Tugas::find($id);
        $kelas = Kelas::all();
        return view('pages.guru.tugas.edit', compact('tugas', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();

        $tugas = Tugas::find($id);
        $tugas->update($data);

        $this->validate($request, [
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('file/tugas', $namaFile, 'public');
            $tugas->file = $file;
            $tugas->save();

            // Delete old file
            $oldFile = $tugas->file;
            $path = storage_path('app/public/file/tugas/' . $oldFile);
            if (File::exists($path)) {
                File::delete($path);
            } else {
                File::delete($path);
            }
        }

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tugas = Tugas::find($id);
        $lokasi = 'file/tugas/' . $tugas->file;
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        }
        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus');
    }

    public function siswa()
    {
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();
        $kelas = Kelas::findOrFail($siswa->kelas_id);
        $tugas = Tugas::where('kelas_id', $kelas->id)->get();
        $guru = Guru::findOrFail($kelas->guru_id);

        // Get jawaban from tugas
        $jawaban = Jawaban::where('siswa_id', $siswa->id)->get();

        return view('pages.siswa.tugas.index', compact('tugas', 'guru', 'kelas', 'jawaban'));
    }

    public function download($id)
    {
        $file = Tugas::findOrFail($id);
        $path = storage_path('/app/public/' . $file->file);
        return Response::download($path);
    }

    public function kirimJawaban(Request $request)
    {
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();

        if (isset($request->file)) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('file/jawaban', $namaFile, 'public');
        }

        $jawaban = new Jawaban;
        $jawaban->tugas_id = $request->tugas_id;
        $jawaban->siswa_id = $siswa->id;
        $jawaban->jawaban = $request->jawaban;
        $jawaban->file = $file;
        $jawaban->save();

        return redirect()->back()->with('success', 'Jawaban berhasil dikirim');
    }

    public function downloadJawaban($id)
    {
        $file = Jawaban::findOrFail($id);
        $path = storage_path('/app/public/' . $file->file);
        return Response::download($path);
    }
}
