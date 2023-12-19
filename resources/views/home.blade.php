@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('A boltról') }}</div>

                    <div class="card-body fs-5">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    <p>
                            KönnyShop, a képzeletbeli könyvüzlet, olyan hely, ahol az olvasók és könyvek találkoznak, hogy
                            együttesen mélyebb élményeket teremtsenek. A bolt a nevével ellentétben nem csak könnyű
                            olvasmányokat kínál, hanem széles választékban szolgálja ki az olvasók sokféle igényét és
                            érdeklődését.

                        </p>
                        <p>
                            A KönnyShop berendezése modern és barátságos atmoszférát teremt, hívogató polcokkal és kényelmes
                            üléshelyekkel, ahol az emberek elmerülhetnek egy könyv lapjai között. A kínálatban megtalálhatók
                            regények, krimik, fantasy kötetek, tudományos és történelmi művek, valamint számos más műfaj,
                            amelyek mind kielégítik az olvasók változatos ízlését.

                        </p>
                        <p>
                            A KönnyShop nem csak könyveket árusít, hanem rendszeresen rendez irodalmi eseményeket,
                            könyvbemutatókat és írói beszélgetéseket is. Ezen események révén a bolt egy közösségi központtá
                            válik, ahol az olvasók megoszthatják gondolataikat és élményeiket a könyvekről.

                        </p>
                        <p>
                            A KönnyShop szem előtt tartja az olvasás örömét és az irodalom sokszínűségét, és minden olvasót
                            üdvözöl egy olyan helyen, ahol a könyvek csodálatos világában való eligazodás egy igazi élmény.

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
