@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Üzenet küldése') }}</div>
                        <div class="card-body">
                            
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('Név:') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('név') }}" required autocomplete="name">
                                </div>
                                <div class="form-group my-2">
                                    <label for="email">{{ __('Email:') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('email') }}" required autocomplete="email">
                                </div>
                                <div class="form-group my-2">
                                    <label for="subject">{{ __('Tárgy:') }}</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="{{ __('tárgy') }}" required>
                                </div>
                                <div class="form-group my-2">
                                    <label for="message">{{ __('Üzenet:') }}</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="{{ __('üzenet') }}" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-outline-secondary my-1 px-4 text-white">{{ __('Küldés') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
@endsection

