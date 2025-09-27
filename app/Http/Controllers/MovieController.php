<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(2); // 10 adalah jumlah item per halaman
        return view('homepage', ['movies' => $movies]);
        // $movies = Movie::paginate(10); // Menggunakan `paginate()` untuk mendapatkan daftar film dengan paginasi
        // return view('homepage', compact('movies'));
    }

    public function detail($id)
    {
        $movie = Movie::find($id);
        return view('detail', compact('movie'));
    }



    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!empty($query)) {
            // Menggunakan metode `where` untuk melakukan pencarian berdasarkan judul film
            $results = Movie::where('judul', 'LIKE', "%$query%")->get();
        } else {
            // Menampilkan pesan jika query pencarian kosong
            $results = [];
        }

        return view('results', compact('results', 'query'));
    }
}
