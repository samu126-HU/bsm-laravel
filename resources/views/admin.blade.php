@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-1">
                    <div class="card-header">{{ __('Admin') }}</div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <span class="navbar-brand" href="#"></span>
                                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                                    @php
                                        $tables = ['books' => 'Könyvkezelés', 'categories' => 'Kategóriakezelés', 'users' => 'Felhasználókezelés', 'admins' => 'Adminkezelés'];
                                    @endphp
                                    @foreach ($tables as $table => $title)
                                        <li class="nav-item">
                                            <form action="{{ route('admin.data', ['table' => $table]) }}" method="post">
                                                @csrf
                                                <button class="btn btn-dark border mx-2" type="submit">{{ $title }}</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                @php
                    $messages = DB::table('messages')->get();
                @endphp

                <div class="card m-1">
                    <div class="card-header">Üzenetek</div>
                    <div class="card-body">

                        @if (count($messages) == 0)
                            <div class="m-2 alert alert-danger">
                                Nincs üzenet.
                            </div>
                        @else

                        @foreach ($messages as $message)
                            <div class="card m-1 mb-3">
                                <div class="card-header">
                                    {{ $message->name . ' > ' . $message->subject }}
                                </div>
                                <div class="card-body">
                                    {{ $message->message }}
                                </div>
                                <div class="card-footer text-end">
                                    <form action="{{ route('admin.modify', ['table' => 'messages', 'mode' => 'delete', 'id' => $message->id]) }}" method="post">
                                        @csrf
                                        <span class="mx-3">{{ $message->created_at}} </span>
                                    <a class="btn btn-success" href="mailto:{{ $message->email }}?subject={{'RE: '.  $message->subject }}&body={{ "Küldte: " . Auth::user()->name . "\n\n" . ", Könnyshop Supporttól." }}">Válasz</a>
                                        <button class="btn btn-danger" type="submit">Törlés</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection