@if (!isset($bookid))
@php
abort(404);
@endphp
@endif
@extends('layouts.app')

@section('content')

@php
$selectedbook = DB::table('books')->get()->where('id', $bookid)->first();
@endphp
<div class="card col-lg-8 m-auto">
<div class="card-header">{{ $selectedbook->title }}</div>
<div class="card-body">
    <div class="row m-auto my-4" style="width: 90%">
        <div class="card col-6">
            <img class="m-auto my-5" src="{{asset('media/book-covers/' . $selectedbook->cover)}}" alt="" style="width: 60%;">
        </div>
        <div class="col-6 ml-5">
            <div class="p-5 pb-0 d-flex flex-column h-100">
                <h1>{{ $selectedbook->title }}<br><hr></h1><br>
                <p class="fs-3">Író: {{ $selectedbook->author }}</p><br>
                <p>{{ $selectedbook->description }}</p>

                <a class="btn btn-outline-secondary px-5 text-white mt-auto ms-auto" style="width: fit-content" href="{{ route('store')}}">Vissza</a>

            </div>

         
        </div>
    </div>
</div>
</div>
@endsection