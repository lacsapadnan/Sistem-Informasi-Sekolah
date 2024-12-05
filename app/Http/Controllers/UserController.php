<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Guru;
use App\Models\Orangtua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::OrderBy('roles', 'asc')->get();
        $siswaList = Siswa::with('user')->OrderBy('id', 'asc')->get();
        return view('pages.admin.user.index', compact('user', 'siswaList'));
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
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'required'
        ], [
            'email.unique' => 'Email sudah terdaftar',
        ]);

        DB::beginTransaction();

        try {
            if ($request->roles == 'guru') {
                $countGuru = Guru::where('nip', $request->nip)->count();
                $guruId = Guru::where('nip', $request->nip)->get();
                foreach ($guruId as $val) {
                    $guru = Guru::findOrFail($val->id);
                }

                if ($countGuru >= 1) {
                    User::create([
                        'name' => $guru->nama,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'roles' => $request->roles,
                        'nip' => $request->nip
                    ]);

                    // Add user id to guru table
                    $guru->user_id = User::where('email', $request->email)->first()->id;
                    $guru->save();

                    DB::commit();
                    return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
                } else {
                    DB::rollBack();
                    return redirect()->route('user.index')->withInput()->with('error', 'NIP tidak terdaftar sebagai guru');
                }
            } elseif ($request->roles == "siswa") {
                $countSiswa = Siswa::where('nis', $request->nis)->count();
                $siswaId = Siswa::where('nis', $request->nis)->get();
                foreach ($siswaId as $val) {
                    $siswa = Siswa::findOrFail($val->id);
                }

                if ($countSiswa >= 1) {
                    User::create([
                        'name' => $siswa->nama,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'roles' => $request->roles,
                        'nis' => $request->nis
                    ]);

                    // Add user id to siswa table
                    $siswa->user_id = User::where('email', $request->email)->first()->id;
                    $siswa->save();

                    DB::commit();
                    return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
                } else {
                    DB::rollBack();
                    return redirect()->route('user.index')->withInput()->with('error', 'NIS tidak terdaftar sebagai siswa');
                }
            } elseif ($request->roles == 'orangtua') {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'roles' => 'orangtua'
                ]);

                $orangtua = Orangtua::create([
                    'user_id' => $user->id,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
                ]);

                if ($request->has('siswa') && is_array($request->siswa)) {
                    $siswaIds = array_map('intval', $request->siswa);
                    $orangtua->siswas()->sync($siswaIds);
                }

                DB::commit();
                return redirect()->route('user.index')->with('success', 'Data orangtua berhasil ditambahkan');
            } else {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'roles' => $request->roles
                ]);

                DB::commit();
                return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
        $admin = User::findOrFail(Auth::user()->id);
        $orangtua = Orangtua::where('user_id', Auth::user()->id)->first();

        return view('pages.profile', compact('guru', 'siswa', 'admin', 'orangtua'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            if (Auth::user()->roles == 'guru') {
                // Save to guru table
                $guru = Guru::where('user_id', Auth::user()->id)->first();
                $guru->nama = $data['nama'];
                $guru->nip = $data['nip'];
                $guru->alamat = $data['alamat'];
                $guru->no_telp = $data['no_telp'];
                $guru->update($data);
            } else if (Auth::user()->roles == 'siswa') {
                // Save to siswa table
                $siswa = Siswa::where('user_id', Auth::user()->id)->first();
                $siswa->nama = $data['nama'];
                $siswa->nis = $data['nis'];
                $siswa->alamat = $data['alamat'];
                $siswa->telp = $data['telp'];
                $siswa->update($data);
            } else if (Auth::user()->roles == 'orangtua') {
                // Save to orangtua table
                $orangtua = Orangtua::where('user_id', Auth::user()->id)->first();
                $orangtua->alamat = $data['alamat'];
                $orangtua->no_telp = $data['no_telp'];
                $orangtua->update($data);

                if (isset($data['siswas']) && is_array($data['siswas'])) {
                    $siswaIds = array_map('intval', $data['siswas']); // Ensure IDs are integers
                    $orangtua->siswas()->sync($siswaIds); // Update the pivot table
                }
            }

            // Save to user table
            $user = Auth::user();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->update($data);

            DB::commit();
            return redirect()->route('profile')->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }

    public function editPassword()
    {
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
        $admin = User::findOrFail(Auth::user()->id);

        return view('pages.ubah-password', compact('guru', 'siswa', 'admin'));
    }

    public function updatePassword(Request $request)
    {

        // dd($request->all());

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Password lama tidak sesuai");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with("error", "Password baru tidak boleh sama dengan password lama");
        }

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
        ], [
            'new-password.min' => 'Password baru minimal 6 karakter',
        ]);

        // Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();


        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}
