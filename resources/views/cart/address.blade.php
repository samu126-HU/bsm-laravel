@extends('layouts.app')

@section('content')
<script src="{{ asset('js/custom.js') }}"></script>

    <form action="{{ route('cart/order') }}" method="post">
        @csrf
        <div class="form-group mx-auto my-3" style="max-width: 70%">
            <div class="form-group my-2">
                <label for="name">Név:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Név" required autocomplete="name">
            </div>
            <div class="form-group my-2">
                <label for="phone">Telefonszám:</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Telefonszám" required autocomplete="tel">
            </div>
            <div class="row my-2">
                <div class="col-8">
                    <label for="street">Utca:</label>
                    <input type="text" class="form-control" name="street" id="street" placeholder="Utca" required>
                </div>
                <div class="col-4">
                    <label for="houseNumber">Házszám:</label>
                    <input type="text" class="form-control" name="houseNumber" id="houseNumber" placeholder="Házszám" required>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-5">
                    <label for="postalCode">Irányítószám:</label>
                    <input type="text" class="form-control" name="postalCode" id="postalCode" placeholder="Irányítószám" required autocomplete="postal-code">
                </div>
                <div class="col-7">
                    <label for="city">Város:</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Város" required autocomplete="address-level2">
                </div>
            </div>


            <div class="form-group mb-2 mt-3">

                <span>Szállítási mód:</span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="deliveryMethod" id="home" value="home" checked>
                    <label class="form-check-label" for="home">
                        Házhoz szállítás
                    </label>
                </div>

                <div class="form-check">

                    <input class="form-check-input" type="radio" name="deliveryMethod" id="shop" value="shop">
                    <label class="form-check-label" for="shop">
                        Boltba szállítás
                    </label>

                </div>


            
            <div class="form-group mb-2 mt-3">

                <span>Fizetési mód:</span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="cash" checked>
                    <label class="form-check-label" for="cash">
                        Készpénz
                    </label>
                </div>

                <div class="form-check">

                    <input class="form-check-input" type="radio" name="paymentMethod" id="card" value="card">
                    <label class="form-check-label" for="card">
                        Bankkártya
                    </label>

                    <div id="carddata"></div>

                </div>

            </div>
            
            <button type="submit" class="btn btn-outline-secondary my-2 px-4 text-white">Fizetés</button>

        </div>
    </form>           
@endsection