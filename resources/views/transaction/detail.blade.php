<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap5.min.css') }}">
</head>

<body>
    <div class="text-center">
        <h1>e-kasir</h1>
        <h6 class="m-1">Jl.Taman Anggrek - Batam</h6>
        <h6 class="m-1">Telp 0822-8428-2555</h6>
        <h6>{{ $transaction->time }}</h6>
    </div>
    <hr class="border border-2 border-dark">
    <div class="container px-md-5">
        @foreach ($details as $detail)
            <div class="mb-3">
                <h5>{{ $detail->product->name }}</h5>
                <div class="row">
                    <div class="col-9">
                        <div class="row">
                            <h6 class="col">{{ $detail->product->price }}</h6>
                            <h6 class="col">x</h6>
                            <h6 class="col">{{ $detail->quantity }}</h6>
                        </div>
                    </div>
                    <div class="col-3 text-end">
                        <h5>{{ $detail->product->price * $detail->quantity }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-5">
            <h5>Total Belanja <span class="float-end">Rp {{ number_format($transaction->total) }}</span></h5>
            <h5>Tunai <span class="float-end">Rp {{ number_format($transaction->pay) }}</span></h5>
            <h5>Kembali <span class="float-end">Rp {{ number_format($transaction->pay - $transaction->total) }}</span></h5>
        </div>
        <div class="mt-5 text-center">
            <h5>Terima Kasih</h5>
            <h5>Kasir: {{ $transaction->user->name }}</h5>
            <h5>No.{{ $transaction->number }}</h5>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
</body>

</html>
