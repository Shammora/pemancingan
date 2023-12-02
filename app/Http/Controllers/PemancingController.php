<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use DB;
use App\Models\User;
use App\Models\Pemancingan;
use App\Models\Jadwal;
use App\Models\Rating;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PemancingController extends Controller
{
    public function index()
    {
        $title = 'Home';
        return view('pemancing.index', compact('title'));
    }
    public function about()
    {
        $title = 'About';
        return view('pemancing.about', compact('title'));
    }
    public function pemancingan()
    {
        $title = 'Pemancingan';
        $data = Pemancingan::where('status', 'Disetujui')->get();
        return view('pemancing.pemancingan', compact('title', 'data'));
    }
    public function search(Request $request)
    {
        $title = 'Pemancingan';
        $data = Pemancingan::where('status', 'Disetujui')->get(); #cari dan simpan data pemancingan yang statusnya disetujui
        if (empty($request->search)) { #cek apakah inputan kosong
            return Redirect::route('pemancing.pemancingan'); #kalau kosong kembalikan ke halaman pemancingan
        }
        #kalau inputan tidak kosong
        $hasilData = 'Data tidak ditemukan'; #buat variable untuk menampung data
        $hasilIndex = null;
        $status = 'false';
        for ($i = 0; $i < count($data); $i++) { #lakukan perulangan berdasarkan jumlah data pemancingan
            if (strtolower($data[$i]['nama']) == strtolower($request->search)) { #bandingkan data nama pemancingan dengan inputan berdasarkan index array
                #jika hasilnya true
                $hasilData = Pemancingan::find($data[$i]['id']); #simpan data pemancingan
                $hasilIndex = $i; #simpan data index
                $status = 'true'; #simpan data status
            }
        }
        #arahkan kehalaman hasil search
        return view('pemancing.search', compact('title', 'data', 'hasilData', 'hasilIndex', 'status'));
    }
    public function profile()
    {
        $title = 'Profile';
        $pemancing = User::find(Auth::user()->id);
        return view('pemancing.profile', compact('title', 'pemancing'));
    }
    public function detail($id)
    {
        $title = 'Detail';
        $detail = Pemancingan::find($id);
        $jadwal = Jadwal::where('pemancingan_id', $id)->get();
        $rating = Rating::where('pemancingan_id', $id)->get();
        $cekRating = Rating::where('pemancingan_id', $id)->where('user_id', Auth::user()->id)->first();
        return view('pemancing.detail', compact('title', 'detail', 'jadwal', 'cekRating', 'rating'));
    }
    public function addRating(Request $request)
    {
        $rating = new Rating;
        $rating->rating = $request->rate;
        $rating->komentar = $request->komentar;
        $rating->user_id = Auth::user()->id;
        $rating->pemancingan_id = $request->pemancingan_id;
        $rating->save();

        return redirect()->back()->withInput();
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
            return Redirect::route('pemancing.profile');
        } catch (\Exception $e) {
            DB::rollback();

            // Buat error log
            \Log::error('Exception caught: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            \Session::flash('msg_error', 'Somethings Wrong!');
            return Redirect::route('pemancing.profile');
        }
    }
}
