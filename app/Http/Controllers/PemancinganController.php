<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use DB;
use App\Models\User;
use App\Models\Pemancingan;
use App\Models\Jadwal;

class PemancinganController extends Controller
{
    public function index() {
        $title = 'Home';
        return view('pemancingan.index', compact('title'));
    }
    public function profile()
    {
        $title = 'Profile';
        $pemancingan = User::find(Auth::user()->id);
        return view('pemancingan.profile', compact('title','pemancingan'));
    }
    public function updateProfile(Request $request){
        DB::beginTransaction();
        try {
            if (empty($request->foto)) {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }else {
                if (empty($request->password)) {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->foto = $photo;
                    $user->save();
                }else {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
             DB::commit();
            \Session::flash('msg_success','Profile Berhasil Diubah!');
            return Redirect::route('pemancingan.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('pemancingan.profile');
        }
    }

    public function dataPemancingan(){
        $pemancingan = Pemancingan::where('user_id',Auth::user()->id)->get();
        $title = 'Data Pemancingan';
        return view('pemancingan.data_pemancingan', compact('pemancingan','title'));
    }
    public function addPemancingan(Request $request) {
         DB::beginTransaction();
            try {
                    $pemancingan = new Pemancingan;

                    $namafoto = "Gambar"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('gambar')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('gambar')->move($destination,$photo);

                    $pemancingan->nama = $request->nama;
                    $pemancingan->gambar = $photo;
                    $pemancingan->deskripsi = $request->deskripsi;
                    $pemancingan->alamat = $request->alamat;
                    $pemancingan->telpon = $request->telp;
                    $pemancingan->fasilitas = $request->fasilitas;
                    $pemancingan->umpan = $request->umpan;
                    $pemancingan->user_id = Auth::user()->id;
                    $pemancingan->status = 'Menunggu';
                    $pemancingan->save();

                DB::commit();
                \Session::flash('msg_success','Pemancingan Berhasil Ditambah!');
                return Redirect::route('pemancingan.dataPemancingan');

            } catch (Exception $e) {
                DB::rollback();
                \Session::flash('msg_error','Somethings Wrong!');
                return Redirect::route('pemancingan.dataPemancingan');
            }
    }
    public function updatePemancingan(Request $request) {
        DB::beginTransaction();
            try {
                if (empty($request->gambar)) {
                    $pemancingan = Pemancingan::find($request->id);
                    $pemancingan->nama = $request->nama;
                    $pemancingan->deskripsi = $request->deskripsi;
                    $pemancingan->alamat = $request->alamat;
                    $pemancingan->telpon = $request->telp;
                    $pemancingan->fasilitas = $request->fasilitas;
                    $pemancingan->umpan = $request->umpan;
                    $pemancingan->user_id = Auth::user()->id;
                    $pemancingan->status = 'Menunggu';
                    $pemancingan->save();
                }else{
                    $pemancingan = Pemancingan::find($request->id);

                    \File::delete(public_path('foto/'.$pemancingan->gambar));

                    $namafoto = "Gambar"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('gambar')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('gambar')->move($destination,$photo);

                    $pemancingan->nama = $request->nama;
                    $pemancingan->gambar = $photo;
                    $pemancingan->deskripsi = $request->deskripsi;
                    $pemancingan->alamat = $request->alamat;
                    $pemancingan->telpon = $request->telp;
                    $pemancingan->fasilitas = $request->fasilitas;
                    $pemancingan->umpan = $request->umpan;
                    $pemancingan->user_id = Auth::user()->id;
                    $pemancingan->status = 'Menunggu';
                    $pemancingan->save();
                }

                DB::commit();
                \Session::flash('msg_success','Pemancingan Berhasil Ditambah!');
                return Redirect::route('pemancingan.dataPemancingan');

            } catch (Exception $e) {
                DB::rollback();
                \Session::flash('msg_error','Somethings Wrong!');
                return Redirect::route('pemancingan.dataPemancingan');
            }
    }
    public function deletePemancingan($id)
    {
        DB::beginTransaction();
        try {
            $getPemancingan = Pemancingan::where('id',$id)->first();
            \File::delete(public_path('foto/'.$getPemancingan->gambar));
            $pemancingan = Pemancingan::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Pemancingan Berhasil Dihapus!');
            return Redirect::route('pemancingan.dataPemancingan');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('pemancingan.dataPemancingan');
        }
    }
    public function dataJadwal(){
        $pemancingan = Pemancingan::where('user_id',Auth::user()->id)->get();
        $jadwal = Jadwal::where('user_id',Auth::user()->id)->get();
        $title = 'Data Pemancingan';
        return view('pemancingan.jadwal', compact('pemancingan','title','jadwal'));
    }
    public function addJadwal(Request $request) {
         DB::beginTransaction();
        //  return $request;
            try {
                    $jadwal = new Jadwal;

                    $jadwal->hari = $request->hari;
                    $jadwal->jam = $request->jam;
                    $jadwal->tiket = $request->tiket;
                    $jadwal->opsional = $request->opsional;
                    $jadwal->user_id = Auth::user()->id;
                    $jadwal->pemancingan_id = $request->pemancinganId;
                    $jadwal->save();

                DB::commit();
                \Session::flash('msg_success','Pemancingan Berhasil Ditambah!');
                return Redirect::route('pemancingan.dataJadwal');

            } catch (Exception $e) {
                DB::rollback();
                \Session::flash('msg_error','Somethings Wrong!');
                return Redirect::route('pemancingan.dataJadwal');
            }
    }
    public function updateJadwal(Request $request) {
         DB::beginTransaction();
        //  return $request;
            try {
                    $jadwal = Jadwal::find($request->id);

                    $jadwal->hari = $request->hari;
                    $jadwal->jam = $request->jam;
                    $jadwal->tiket = $request->tiket;
                    $jadwal->opsional = $request->opsional;
                    $jadwal->pemancingan_id = $request->pemancinganId;
                    $jadwal->save();

                DB::commit();
                \Session::flash('msg_success','Pemancingan Berhasil Diubah!');
                return Redirect::route('pemancingan.dataJadwal');

            } catch (Exception $e) {
                DB::rollback();
                \Session::flash('msg_error','Somethings Wrong!');
                return Redirect::route('pemancingan.dataJadwal');
            }
    }
    public function deleteJadwal($id)
    {
        DB::beginTransaction();
        try {
            $jadwal = Jadwal::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Jadwal Berhasil Dihapus!');
            return Redirect::route('pemancingan.dataJadwal');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('pemancingan.dataJadwal');
        }
    }
}
