@extends('layouts.app')
@section('title', 'Detail Donasi')

@section('content')
    <div class="h-100 gap-2 row justify-content-center text-black py-5">
        <h1 class="text-center">Detail Donasi</h1>
        <div class="d-flex justify-content-between">
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Donatur</th>
                        <th scope="col">Jumlah Donasi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endif
                    @foreach ($data as $donasi)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $donasi->nama_donatur }}</td>
                            <td>Rp. {{ number_format($donasi->nominal_donasi) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
