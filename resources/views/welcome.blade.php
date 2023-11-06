<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Input Data Pemilih</title>
</head>

<body>
    {{-- container --}}
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h1>Input Data</h1>
                {{-- form input nik cek dpt --}}
                <form action="{{ route('cek') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIK</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter NIK" name="nik">
                        <small id="emailHelp" class="form-text text-muted">Masukkan NIK anda.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                {{-- alert sukses --}}
                @if (session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- alert gagal --}}
                @if (session('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>

        {{-- table --}}
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h1>Data</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th>Tps</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                {{-- hide 5 digit nik ditengah --}}
                                <td>{{ substr($item->nik, 0, 5) }}*****{{ substr($item->nik, -5) }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->tps }}</td>
                                <td>{{ $item->kabupaten }}</td>
                                <td>{{ $item->kecamatan }}</td>
                                <td>{{ $item->kelurahan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- pagination --}}
                {{ $data->links() }}
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
