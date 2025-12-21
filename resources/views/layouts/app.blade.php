<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <title>@yield('title')</title>
    <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>

<body>
    <nav class="navbar bg-white border py-3">
        <div class="container d-flex col justify-content-between">
            <a class="fw-bold text-decoration-none text-black fs-4" href="/">BerbagiNow</a>
            <div class="d-flex w-auto gap-5">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <a class="text-decoration-none text-black" href="/admin/dashboard">Dashboard</a>
                        <a class="text-decoration-none text-black" href="/admin/volunteer">Volunteer</a>
                    @else
                        <a class="text-decoration-none text-black" href="/volunteer/dashboard">Dashboard</a>
                        <a class="text-decoration-none text-black" href="/volunteer/donasi">Donasi</a>
                    @endif
                @else
                    <a class="text-decoration-none text-black" href="/#about">About</a>
                    <a class="text-decoration-none text-black" href="/#contact">Contact</a>
                    <a class="text-decoration-none text-black" href="/donate">Donate</a>
                @endauth
            </div>
            @auth
                @if (Auth::user()->role === 'volunteer' && Auth::user()->expired_member === null)
                    <div class="d-flex gap-2 align-items-center">
                        <button type="button" class="rounded-pill border-2 bg-white border-black py-1 px-2"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-wallet"></i>
                        </button>
                        <a class="btn bg-black text-white" href="/logout">Logout</a>
                        <a class="btn text-black border border-black"
                            href="{{ url('profile/' . Auth::user()->id) }}">Profil</a>
                    </div>
                @else
                    <div class="d-flex gap-2 align-items-center">
                        <a class="btn bg-black text-white" href="/logout">Logout</a>
                        <a class="btn text-black border border-black"
                            href="{{ url('profile/' . Auth::user()->id) }}">Profil</a>
                    </div>
                @endif
            </div>
        @else
            <a class="btn bg-black text-white" href="/login">Login</a>
        @endauth
        </div>
    </nav>
    <div class="min-vh-100" style="height: 100%;">
        <div class="modal" tabindex="-1" id="exampleModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Berlangganan Premium</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Pilih Langganan Premium</p>
                        <div class="d-flex row gap-3 align-items-center justify-content-center text-center"
                            id="paymentForm" method="POST" action="javascript:void(0)">
                            <div class="d-flex gap-3 col-12 row align-items-center justify-content-center">
                                <select name="membership" id="membership" class="form-select"
                                    aria-label="Default select example">
                                    <option value="14">14 Hari - Rp. 10.000</option>
                                    <option value="30">30 Hari - Rp. 15.000</option>
                                    <option value="60">60 Hari - Rp. 30.000</option>
                                </select>
                                <button type="submit" id="pay-button" class="btn bg-black text-white">Bayar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container h-100 ">@yield('content')</div>
    </div>
    </div>
    <footer class="border col-12 py-3 d-flex align-items-center justify-content-center">
        <span>© <b>BerbagiNow</b> 2025.</span>
    </footer>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function(e) {
            e.preventDefault();

            let premiumType = document.getElementById('membership').value;

            fetch('/payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        premium_type: premiumType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log("Payment Success:", result);
                                fetch('/midtrans/webhook', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content')
                                        },
                                        body: JSON.stringify({
                                            order_id: result.order_id,
                                            transaction_status: result
                                                .transaction_status,
                                            user_id: {{ Auth::id() }},
                                            premium_type: premiumType
                                        })
                                    }).then(response => response.json())
                                    .then(data => {
                                        alert(data.message);
                                    });
                            },
                            onPending: function(result) {
                                console.log("Payment Pending:", result);
                            },
                            onError: function(result) {
                                console.log("Payment Error:", result);
                            },
                            onClose: function() {
                                console.log("Payment Dialog Closed");
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching snap token:', error);
                });
        });
    </script>
</body>

</html>
