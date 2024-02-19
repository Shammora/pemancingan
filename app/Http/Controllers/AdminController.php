<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use DB;
use App\Models\User;
use App\Models\Pemancingan;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class AdminController extends Controller
{
    public function index()
    {
        $title = 'Home';
        $pemancingan = Pemancingan::where('status', 'Disetujui')->orWhere('status', 'Menunggu')->get();
        $pemancing = User::where('peran', 'Pemancing')->get();
        return view('admin.index', compact('title', 'pemancingan', 'pemancing'));
    }
    public function profile()
    {
        $title = 'Profile';
        $admin = User::find(Auth::user()->id);
        return view('admin.profile', compact('title', 'admin'));
    }
    public function updateProfile(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    $publicId = Cloudinary::privateResource($user->foto)->getPublicId();
                    Cloudinary::destroy($publicId);
                }

                $folder = 'web_pemancingan_fahri';

                $uploadedFile = $request->file('foto')->storeOnCloudinary($folder);

                $user->foto = $uploadedFile->getSecurePath();
            }

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            DB::commit();

            \Session::flash('msg_success', 'Profile Berhasil Diubah!');
            return Redirect::route('admin.profile');
        } catch (\Exception $e) {
            DB::rollback();

            // Buat error log
            \Log::error('Exception caught: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.profile');
        }
    }
    public function dataPemancing()
    {
        $pemancing = User::where('peran', 'Pemancing')->get();
        $title = 'Data Pemancing';
        return view('admin.data_pemancing', compact('pemancing', 'title'));
    }
    public function addPemancing(Request $request)
    {
        DB::beginTransaction();
        try {
            $folder = 'web_pemancingan_fahri';

            $uploadedFile = $request->file('foto')->storeOnCloudinary($folder);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->no_hp = $request->no_hp;
            $user->foto = $uploadedFile->getSecurePath();
            $user->password = bcrypt($request->password);
            $user->peran = 'Pemancing';
            $user->save();

            \Session::flash('msg_success', 'Data Pemancing Berhasil Ditambah!');
            return Redirect::route('admin.dataPemancing');
        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.dataPemancing');
        }
    }
    public function updatePemancing(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    $publicId = Cloudinary::privateResource($user->foto)->getPublicId();
                    Cloudinary::destroy($publicId);
                }

                $folder = 'web_pemancingan_fahri';

                $uploadedFile = $request->file('foto')->storeOnCloudinary($folder);

                $user->foto = $uploadedFile->getSecurePath();
            }

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            DB::commit();

            \Session::flash('msg_success', 'Data Pemancing Berhasil Diubah!');
            return Redirect::route('admin.dataPemancing');
        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.dataPemancing');
        }
    }
    public function deletePemancing($id)
    {
        DB::beginTransaction();
        try {
            $getUser = User::where('id', $id)->first();
            Cloudinary::destroy($getUser->foto);
            User::where('id', $id)->delete();
            DB::commit();
            \Session::flash('msg_success', 'Data Pemancing Berhasil Dihapus!');
            return Redirect::route('admin.dataPemancing');

        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.dataPemancing');
        }
    }

    public function dataPemilik()
    {
        $pemilik = User::where('peran', 'Pihak Pemancingan')->get();
        $title = 'Data Pemilik Pemancingan';
        return view('admin.data_pemilik', compact('pemilik', 'title'));
    }
    public function addPemilik(Request $request)
    {
        DB::beginTransaction();
        try {
            $cekUsername = User::where('username', $request->username)->first();
            if (!empty($cekUsername)) {
                \Session::flash('msg_error', 'Username Sudah Digunakan!');
                return Redirect::route('admin.dataPemilik');
            }

            $folder = 'web_pemancingan_fahri';

            $uploadedFile = $request->file('foto')->storeOnCloudinary($folder);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->no_hp = $request->no_hp;
            $user->foto = $uploadedFile->getSecurePath();
            $user->password = bcrypt($request->password);
            $user->keterangan = $request->keterangan;
            $user->peran = 'Pemancing';
            $user->save();
            DB::commit();
            \Session::flash('msg_success', 'Pemilik Pemancingan Berhasil Ditambah!');
            return Redirect::route('admin.dataPemilik');

        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.dataPemilik');
        }
    }
    public function updatePemilik(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;

            if ($request->hasFile('foto')) {
                if ($user->foto) {
                    $publicId = Cloudinary::privateResource($user->foto)->getPublicId();
                    Cloudinary::destroy($publicId);
                }

                $folder = 'web_pemancingan_fahri';

                $uploadedFile = $request->file('foto')->storeOnCloudinary($folder);

                $user->foto = $uploadedFile->getSecurePath();
            }

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            DB::commit();
            \Session::flash('msg_success', 'Pemilik Pemancingan Berhasil Diubah!');
            return Redirect::route('admin.dataPemilik');

        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.dataPemilik');
        }
    }
    public function deletePemilik($id)
    {
        DB::beginTransaction();
        try {
            $getUser = User::where('id', $id)->first();
            Cloudinary::destroy($getUser->foto);
            User::where('id', $id)->delete();
            DB::commit();
            \Session::flash('msg_success', 'Data Pemilik Pemancingan Berhasil Dihapus!');
            return Redirect::route('admin.dataPemilik');

        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.dataPemilik');
        }
    }

    public function dataPemancingan()
    {
        $pemancingan = Pemancingan::all();
        $title = 'Data Pemancingan';
        return view('admin.data_pemancingan', compact('pemancingan', 'title'));
    }

    public function setuju($id)
    {
        $pemancingan = Pemancingan::find($id);
        $pemancingan->status = 'Disetujui';
        $pemancingan->save();

        \Session::flash('msg_success', 'Status Pemancingan Berhasil Diubah!');
        return Redirect::route('admin.dataPemancingan');
    }
    public function tolak($id)
    {
        $pemancingan = Pemancingan::find($id);
        $pemancingan->status = 'Ditolak';
        $pemancingan->save();

        \Session::flash('msg_success', 'Status Pemancingan Berhasil Diubah!');
        return Redirect::route('admin.dataPemancingan');
    }

    public function setujuSemua()
    {
        DB::beginTransaction();
        try {
            Pemancingan::where('status', 'Menunggu')->update(['status' => 'Disetujui']);
            DB::commit();
            \Session::flash('msg_success', 'Semua Data Pemancingan Berhasil Disetujui!');
            return Redirect::route('admin.dataPemancingan');
        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Terjadi Kesalahan!');
            return Redirect::route('admin.dataPemancingan');
        }
    }

    public function tolakSemua()
    {
        DB::beginTransaction();
        try {
            Pemancingan::where('status', 'Menunggu')->update(['status' => 'Ditolak']);
            DB::commit();
            \Session::flash('msg_success', 'Semua Data Pemancingan Berhasil Ditolak!');
            return Redirect::route('admin.dataPemancingan');
        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Terjadi Kesalahan!');
            return Redirect::route('admin.dataPemancingan');
        }
    }

    public function deletePemancingan($id)
    {
        DB::beginTransaction();
        try {
            $getPemancingan = Pemancingan::where('id', $id)->first();
            Cloudinary::destroy($getPemancingan->gambar);
            Pemancingan::where('id', $id)->delete();
            DB::commit();
            \Session::flash('msg_success', 'Data Pemancingan Berhasil Dihapus!');
            return Redirect::route('admin.dataPemancingan');

        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('admin.dataPemancingan');
        }
    }
}
