@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Daftar Transaksi</h2>
    </div>
    <div class="table-responsive">
        <table class="table" id="data-table">
            <thead>
                <tr>
                    <th>Transaksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>
                            <a href="{{ route('transaction.detail', ['id' => $transaction->id]) }}" target="_blank" class="text-decoration-none text-black">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <p class="m-0">Kode: {{ $transaction->number }}</p>
                                                <p class="m-0">Tanggal: {{ date_format(date_create($transaction->time), 'd/m/Y H:i:s') }}</p>
                                                <p class="m-0">Kasir: {{ $transaction->user->name }}</p>
                                            </div>
                                            <div class="col">
                                                <p class="m-0">Total: Rp {{ number_format($transaction->total) }}</p>
                                                <p class="m-0">Bayar: Rp {{ number_format($transaction->pay) }}</p>
                                                <p class="m-0">Kembalian: Rp {{ number_format($transaction->pay - $transaction->total) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
