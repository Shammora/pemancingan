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
        //$data = Pemancingan::where('status', 'Disetujui')->get(); <- Metode lama mengambil data dari db

        // Array yang digunakan untuk pencarian menggunakan sequential search
        $data = [
            [
                "id" => "2",
                "nama" => "Telaga Tongyang",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1702034871/web_pemancingan_fahri/x9zbkbon0nyylzzh0msw.jpg",
                "deskripsi" => "Pemancingan Galatama Ikan Mas"
            ],
            [
                "id" => "3",
                "nama" => "Telaga Ngongkon",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1702987696/web_pemancingan_fahri/c7on57o98cgcgwo7coki.jpg",
                "deskripsi" => "Pemancingan Galatama Ikan Lele"
            ],
            [
                "id" => "4",
                "nama" => "Galatama Bawal Pelangi",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1704894547/web_pemancingan_fahri/lq0ozzd18slqsnjldtbo.jpg",
                "deskripsi" => "Pemancingan Galatama Ikan Bawal"
            ],
            [
                "id" => "5",
                "nama" => "Pemancingan Kylexdosel",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1705412282/web_pemancingan_fahri/tzjjhppey4xkjgsa2eva.jpg",
                "deskripsi" => "Pemancingan Galatama Ikan Mas"
            ],
            [
                "id" => "7",
                "nama" => "Pemancingan Damai Indah",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706076771/web_pemancingan_fahri/bwjlsoq6kgp0ob84ewte.jpg",
                "deskripsi" => "Pemancingan Galatama Ikan Mas"
            ],
            [
                "id" => "9",
                "nama" => "Pemancingan Komandan Galapung",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706698416/web_pemancingan_fahri/vietlg7z2gi3eqdn7kwr.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Mas"
            ],
            [
                "id" => "10",
                "nama" => "Pemancingan Lingga",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706699332/web_pemancingan_fahri/jiptazyx9b6v7kvg017y.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Mas"
            ],
            [
                "id" => "11",
                "nama" => "Pemancingan Jarwo",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706699723/web_pemancingan_fahri/l46ipepnd7p0y1tw4jlt.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Mas"
            ],
            [
                "id" => "12",
                "nama" => "Telaga Ebysora",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706700048/web_pemancingan_fahri/pfs8zo6josdgqr6wpwdh.jpg",
                "deskripsi" => "Pemancingan Galatama Lele"
            ],
            [
                "id" => "13",
                "nama" => "Pemancingan Kong Iman",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706700773/web_pemancingan_fahri/rdutrwidmyt26ycrj0tz.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Mas"
            ],
            [
                "id" => "15",
                "nama" => "Telaga Aster",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706702176/web_pemancingan_fahri/nhpnnmdsyeqr34ubf5xw.jpg",
                "deskripsi" => "Pemancingan Galatama Ikan Mas"
            ],
            [
                "id" => "16",
                "nama" => "Pemancingan Saruni Fishing",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706704334/web_pemancingan_fahri/isun9zpbezens1d3whxc.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Mas"
            ],
            [
                "id" => "17",
                "nama" => "Pemancingan H.Yonli",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706704624/web_pemancingan_fahri/gz4sonwxzemslxq4f0ow.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Mas"
            ],
            [
                "id" => "18",
                "nama" => "Pemancingan Bima Fishing",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706704912/web_pemancingan_fahri/flqnbhgnrdrkydlhcybz.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Bawal"
            ],
            [
                "id" => "19",
                "nama" => "Pemancingan Teras Biru",
                "gambar" => "https://res.cloudinary.com/zul-spk-api/image/upload/v1706705508/web_pemancingan_fahri/pth7w9rjxr8v6dmws9oh.jpg",
                "deskripsi" => "Pemancingan Galapung Ikan Mas"
            ],
        ];

        // Jika data yang dicari tidak ditemukan, kembali ke halaman pemancingan
        if (empty($request->search)) {
            return Redirect::route('pemancing.pemancingan');
        }

        $hasilData = 'Data tidak ditemukan';
        $hasilIndex = null;
        $status = 'false';
        $searchProcess = [];

        // Proses perulangan pada algoritma pencarian sequential
        for ($i = 0; $i < count($data); $i++) {
            $searchProcess[] = [
                'search' => $request->search,
                'step' => $i + 1,
                'comparison' => "Bandingkan dengan index ke " . $i . " (" . $data[$i]['nama'] . ")",
                'found' => false,
            ];

            // Bandingkan data nama dalam array dengan nama di kolom pencarian
            if (strtolower($data[$i]['nama']) == strtolower($request->search)) {
                // Jika data ditemukan, kembalikan id dari data tersebut dan tampilkan hasil pencarian
                $hasilData = Pemancingan::find($data[$i]['id']);
                $hasilIndex = $i;
                $status = 'true';
                $searchProcess[$i]['found'] = true;
                break;
            }
        }

        return view('pemancing.search', compact('title', 'data', 'hasilData', 'hasilIndex', 'status', 'searchProcess'));
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
