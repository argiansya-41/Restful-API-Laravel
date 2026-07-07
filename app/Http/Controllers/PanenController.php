<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilPanen; // Wajib import Model
use App\Http\Requests\StoreHasilPanenRequest;
use App\Http\Resources\HasilPanenResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            $query = HasilPanen::query();

            // Fitur Filtering berdasarkan nama komoditas
            if ($request->has('commodity')) {
                $query->where('nama_komoditas', 'like', '%' . $request->commodity . '%');
            }

            // Fitur Filtering berdasarkan rentang tanggal
            if ($request->has('start_date') && $request->has('end_date')) {
                $query->whereBetween('tanggal_panen', [$request->start_date, $request->end_date]);
            }

            // Fitur Pagination (Default 10 data per halaman)
            $harvests = $query->paginate(10);

            // Mengembalikan data menggunakan Resource Collection (Otomatis menyertakan Metadata Pagination)
            return HasilPanenResource::collection($harvests)->additional([
                'success' => true,
                'message' => 'Daftar data hasil panen'
            ]);
        }

        // Mengambil seluruh data dari tabel hasil_panens (Web)
        $dataPanen = HasilPanen::all();
        
        // Mengirim data ke View (Web)
        return view('panen.index', compact('dataPanen'));
    }

    /**
     * Menampilkan halaman form tambah hasil panen (Web)
     */
    public function create()
    {
        return view('panen.create');
    }

    /**
     * Memproses dan menyimpan data panen baru dengan validasi
     */
    public function store(StoreHasilPanenRequest $request)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            $panen = HasilPanen::create($request->validated());

            return (new HasilPanenResource($panen))
                ->additional([
                    'success' => true,
                    'message' => 'Data panen berhasil dicatat'
                ])
                ->response()
                ->setStatusCode(201); // 201 Created
        }

        // Web flow:
        HasilPanen::create([
            'nama_komoditas' => $request->nama_komoditas,
            'jumlah_kg' => $request->jumlah_kg,
            'tanggal_panen' => now(), // Otomatis mengisi tanggal hari ini
        ]);

        // Redirect kembali ke halaman utama dengan pesan sukses
        return redirect('/data-panen')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            try {
                $panen = HasilPanen::findOrFail($id);
                return new HasilPanenResource($panen);
            } catch (ModelNotFoundException $e) {
                // Error Handling: Mengembalikan HTTP Status Code yang tepat (404 Not Found)
                return response()->json([
                    'error' => 'Resource tidak ditemukan',
                    'message' => 'Data panen dengan ID ' . $id . ' tidak ada di sistem.'
                ], 404);
            }
        }

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreHasilPanenRequest $request, $id)
    {
        try {
            $panen = HasilPanen::findOrFail($id);
            $panen->update($request->validated());

            return (new HasilPanenResource($panen))
                ->additional([
                    'success' => true,
                    'message' => 'Data panen berhasil diperbarui'
                ]);
        } catch (ModelNotFoundException $e) {
            // Error Handling: Mengembalikan HTTP Status Code yang tepat (404 Not Found)
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data panen dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        try {
            $panen = HasilPanen::findOrFail($id);
            $panen->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data panen berhasil dihapus.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            // Error Handling: Mengembalikan HTTP Status Code yang tepat (404 Not Found)
            return response()->json([
                'error' => 'Resource tidak ditemukan',
                'message' => 'Data panen dengan ID ' . $id . ' tidak ada di sistem.'
            ], 404);
        }
    }
}