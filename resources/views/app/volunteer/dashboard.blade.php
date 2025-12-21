@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="h-100 gap-5 row justify-content-center text-black py-5">
        <h1 class="text-center">Dashboard</h1>
        <div class="d-flex justify-content-between">
            <div class="card border-black text-center rounded-4 mb-3" style="width: 18rem;">
                <div class="card-header border-black text-black fw-semibold">Jumlah Volunteer</div>
                <div
                    class="card-body d-flex align-items-center rounded-bottom-4 text-black text-center justify-content-center">
                    <span class="fs-title fw-semibold">{{ $volunteer }}</span>
                </div>
            </div>
            <div class="card border-black text-center rounded-4 mb-3" style="width: 18rem;">
                <div class="card-header border-black text-black fw-semibold">Jumlah Donasi</div>
                <div
                    class="card-body d-flex align-items-center rounded-bottom-4 text-white text-center justify-content-center">
                    <span class="fs-title text-black fw-semibold">{{$donasi}}</s>
                </div>
            </div>
            <div class="card border-black text-center rounded-4 mb-3" style="width: 18rem;">
                <div class="card-header border-black text-black fw-semibold">Jumlah Donatur</div>
                <div
                    class="card-body d-flex align-items-center rounded-bottom-4 text-white text-center justify-content-center">
                    <span class="fs-title fw-semibold text-black">{{$donatur}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
