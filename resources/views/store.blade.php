@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header fs-10">

                        <!--KATEGÓRIÁK START-->

                        <div class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#">Termékek >
                                    @if (session('category'))
                                        @php
                                            $category = \App\Models\Category::where('id', session('category'))->value('category');
                                        @endphp
                                        {{ $category }}
                                    @else
                                        {{ 'Összes' }}
                                    @endif
                                </a>
                                <button class="navbar-toggler collapsed p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">Kategóriák</button>
                                <div class="navbar-collapse collapse text-center" id="navbarNav">
                                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                                        @php
                                            $data = \App\Models\Category::all();
                                            $category = $data->pluck('category')->toArray();
                                            $id = $data->pluck('id')->toArray();
                                        @endphp
                                        <form action="{{ route('store/category', ['id' => 0]) }}" method="post">
                                            @csrf
                                            <button class="btn btn-dark border mx-1 @if (!session('category')) {{ 'disabled' }} @endif" class="nav-item">
                                                {{ 'Összes' }}
                                            </button>
                                        </form>
                                        @foreach (array_combine($category, $id) as $cat => $id)
                                            <form action="{{ route('store/category', ['id' => $id]) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-dark border mx-1 @if (session('category') == $id) {{ 'disabled' }} @endif" class="nav-item">
                                                    {{ $cat }}
                                                </button>
                                            </form>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--KATEGÓRIÁK END-->

                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif
                        @if (session('category') && session('category') != 0)
                            @php
                                $data = \App\Models\Book::where('category', session('category'))->get();
                            @endphp
                        @else
                            @php
                                $data = \App\Models\Book::all();
                            @endphp
                        @endif
                        @if (count($data) == 0)
                            <div class="alert alert-danger" role="alert">{{ 'Nincs még könyv ebben a kategóriában :(' }}</div>
                        @endif
                        <div class="row d-flex justify-content-start wrap-3">
                            @foreach ($data as $book)
                                <div class="card p-0 col-12 col-lg-3">
                                    <div class="card-header">
                                        {{ $book->title }}
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body text-center">
                                            <a href="{{ route('book', ['book_id' => $book->id]) }}"><img src="{{ asset('media/book-covers/' . $book->cover) }}" class="img-fluid" alt="{{ $book->title }}" style="max-width: 100%; height: 300px; display: block; margin: 0 auto;"></a>

                                        </div>
                                        <strong>{{ 'Írta: ' . $book->author }}</strong> <br>
                                        <hr>
                                        <em> {{ $book->description }} </em>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div></div>
                                        <div class="d-flex">
                                            <span class="m-0 p-0 p-2 m-3">{{ $book->price . ' Ft' }} </span>
                                            <form action="{{ route('cart/add', ['id' => $book->id]) }}" method="post">
                                                @csrf
                                                <button class="btn btn-success m-0 p-0 p-2 px-4 m-3">Kosárba</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
