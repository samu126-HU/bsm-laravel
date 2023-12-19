@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fs-3">
                        Rendeléseim
                    </div>

                    <div class="card-body">

                        @php
                            $orders = \App\Models\Order::where('user_id', Auth::user()->id)
                                ->get()
                                ->groupBy('order_id');

                            $books = \App\Models\Book::all();
                        @endphp

                        @if (count($orders) == 0)
                            <div class="alert alert-warning" role="alert">
                                Nem rendeltél még semmit :(
                            </div>
                        @endif
                        @foreach ($orders as $order)
                            <div class="card mb-3">
                                <div class="card-header">{{ 'Rendelés: #' . $order->first()->order_id }}</div>
                                <div class="card-body border my-2 border-0">
                                @foreach ($order as $item)
                                    

                                        <div class="row">
                                            <div class="col-6 d-flex align-items-start justify-content-start overflow-hidden">
                                                <img src="{{ asset('media/book-covers/' . $books->find($item->book)->cover) }}" alt="" height="100px">
                                                <span class="ms-2 fs-3">{{ $books->find($item->book)->title . ' x' . $item->quantity }} <br></span>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end fs-5">
                                                <span class="position-absolute">{{ $item->created_at }}</span>
                                                <span class="align-self-end">{{ $item->quantity * $books->find($item->book)->price . ' Ft' }}</span>

                                            </div>
                                        </div>

                                    <hr>
                                @endforeach
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
