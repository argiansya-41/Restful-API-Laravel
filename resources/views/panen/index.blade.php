<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hasil Panen</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Daftar Hasil Panen Pertanian</h2>
    <hr>

    @if(session('success'))
        <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background-color: #f9f9f9; padding: 15px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 20px;">
        <h3 style="margin-top: 0;">Tambah Hasil Panen Baru</h3>
        <form action="/data-panen" method="POST" style="display: flex; gap: 15px; align-items: flex-end; flex-wrap: wrap;">
            @csrf
            
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Komoditas:</label>
                <input type="text" name="nama_komoditas" value="{{ old('nama_komoditas') }}" style="padding: 8px; width: 200px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Jumlah (Kg):</label>
                <input type="text" name="jumlah_kg" value="{{ old('jumlah_kg') }}" style="padding: 8px; width: 120px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div>
                <button type="submit" style="padding: 9px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>No</th>
                <th>Nama Komoditas</th>
                <th>Jumlah (Kg)</th>
                <th>Tanggal Panen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataPanen as $index => $item)
            <tr>
                <td align="center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_komoditas }}</td>
                <td align="center">{{ $item->jumlah_kg }}</td>
                <td align="center">{{ $item->tanggal_panen }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>