@extends('layouts.app')
@section('title', 'Donate')

@section('content')
    <div class="h-100 gap-5 row justify-content-center text-black py-5">
        <h1 class="text-center">Donate Now</h1>
        <div class="row col-12 justify-content-center align-items-center gap-5">
            @if ($data->isEmpty())
                <span class="text-center">Belum ada donasi.</span>
            @endif
            @foreach ($data as $donasi)
                <div class="card" style="width: 18rem;">
                    <a href="{{ url('donate-detail/' . $donasi->id) }}" class="text-decoration-none text-black">
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
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
