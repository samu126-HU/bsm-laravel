@extends('layouts.app')
@section('content')
    @php
        $cart = App\Models\Cart::where('user_id', Auth::user()->id)->get();
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="min-height: 500px">
                    <div class="card-header fs-10">
                        Kosár
                    </div>
                    <div class="col-10 mx-auto my-3">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('delete') && session('id'))
                            <div class="alert alert-danger text-center" role="alert">
                                {{ session('delete') }} 
                                <br>
                            <form action="{{ route('cart/delete', ['id' => session('id')]) }}" class="d-inline-block" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Igen</button>
                                </form>
                                <button type="button" class="close btn btn-danger" data-bs-dismiss="alert" aria-label="Close">Nem</button>
                        @endif
                        @if (count($cart) == 0)
                            <div class="alert alert-warning" role="alert">
                                {{'Eléggé nagy az üresség :(( Menj rakj egy-két könyvet a kosárba!'}}
                            </div>
                        @else
                    </div>
                    @foreach ($cart as $item)
                        @php
                            $book = App\Models\Book::find($item->book_id);
                        @endphp
                        <div class="card-body border rounded" style="max-height: 100px">
                            <div class="row">
                                <div class="col-6 d-flex align-items-start justify-content-start overflow-hidden">
                                    <img height="75px" class="mx-3" src="{{ asset('media/book-covers/' . $book->cover) }}" alt="{{ $book->title }}">
                                    <h4 class="text-wrap" style="width: calc(100% - 75px)">{{ $book->title }}</h4>
                                </div>
                                <div class="col-6 d-flex align-items-end justify-content-end">
                                    <h4 class="p-0 m-0 mx-3" style="height: 25px">{{ $item->quantity * $book->price . ' Ft' }}</h4>
                                    <form action="{{ route('cart/changeQuantity', ['id' => $item->id, 'quantity' => $item->quantity - 1]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-danger p-0 mx-1"style="width: 25px; height: 25px">-</button>
                                    </form>

                                    <span class="mx-1" style="height: 25px">{{ $item->quantity }}</span>

                                    <form action="{{ route('cart/changeQuantity', ['id' => $item->id, 'quantity' => $item->quantity + 1]) }}" method="post">
                                        @csrf
                                        <button class="btn btn-success p-0 mx-1"style="width: 25px; height: 25px">+</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                   
                        <a href="{{ route('address') }}" type="submit" class="btn btn-outline-secondary px-4 text-white my-3 mx-4 fit-content d-flex align-self-end mt-auto">Rendelés</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
