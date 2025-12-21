@extends('layouts.app')
@section('title', 'Volunteer')

@section('content')
    <div class="h-100 row justify-content-center text-black py-5">
        <h1 class="text-start mb-4 border-bottom fw-semibold">Detail Volunteer</h1>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item fw-bold col-2">Nama</li>
            <li class="list-group-item col-4">{{ $user->name }}</li>
            <li class="list-group-item fw-bold col-2">Jumlah Open Donasi</li>
            <li class="list-group-item col-4">{{ $user->total_donation }}</li>
        </ul>
        <ul class="list-group mb-5 list-group-horizontal">
            <li class="list-group-item fw-bold col-2">Status</li>
            <li class="list-group-item col-10">
                @if ($user->expired_member)
                    <span class="badge text-bg-success text-white">
                        Premium
                    </span>
                @else
                    <span class="badge text-bg-warning text-white">
                        Basic
                    </span>
                @endif
            </li>
        </ul>

        <div class="d-flex row gap-5 col-12 justify-content-center py-5" id="about">
            @foreach ($data as $donasi)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('assets/landing_page.jpg') }}" class="card-img-top" alt="...">
                    <div class="mb-2">
                        <h5 class="card-title">{{ $donasi->judul }}</h5>
                        <p class="card-text">{{ $donasi->deskripsi }}</p>
                    </div>
                    <div class="d-flex row">
                        <span class="py-2 border-top fw-semibold">{{ $donasi->nomor_hp }}</span>
                        <span class="py-2 border-top fw-semibold">{{ $donasi->bank }} a.n {{ $donasi->nama_rekening }}
                            ({{ $donasi->nomor_rekening }})
                        </span>
                        <span class="py-2 border-top fw-semibold">Rp. {{ number_format($jumlah_donasi) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
