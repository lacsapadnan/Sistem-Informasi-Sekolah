<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin() {
        $siswa = Siswa::count();
        $guru = Guru::count();
        $kelas = Kelas::count();
        $mapel = Mapel::count();
        $siswaBaru = Siswa::orderByDesc('id')->take(5)->orderBy('id')->first();

        return view('pages.admin.dashboard', compact('siswa', 'guru', 'kelas', 'mapel', 'siswaBaru'));
    }

    public function guru() {
        $guru = Guru::where('nip', Auth::user()->nip)->first();
        $materi = Materi::where('guru_id', $guru->id)->count();

        return view('pages.guru.dashboard', compact('guru', 'materi'));
    }

    public function siswa() {
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();
        $kelas = Kelas::findOrFail($siswa->kelas_id);
        $materi = Materi::where('kelas_id', $kelas->id)->limit(3)->get();
        $jumlahMateri = $materi->count();
        return view('pages.siswa.dashboard', compact('materi', 'siswa', 'kelas', 'jumlahMateri',));
    }
}
