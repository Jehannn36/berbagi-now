@extends('layouts.app')
@section('title', 'Donasi')

@section('content')
    <div class="h-100 gap-2 row justify-content-center text-black py-5">
        <h1 class="text-center">Donasi</h1>
        <div class="col-12 d-flex justify-content-end">
            <a href="/volunteer/donasi/create" class="btn bg-black text-white">
                Tambah Donasi
            </a>
        </div>
        <div class="d-flex justify-content-between">
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Jumlah Donasi</th>
                        <th scope="col">Lihat Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($donasi->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endif
                    @foreach ($donasi as $index => $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $jumlah_donasi }}</td>
                            <td><a href="/volunteer/donasi-detail/{{ $item->id }}" class="text-black"><i
                                        class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
