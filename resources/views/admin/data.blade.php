@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Adatok') }}</div>
                    @if (count($data) == 0)
                        <div class="m-2 alert alert-danger">
                            Nincs megjeleníthető adat.
                            <form class="d-inline-block float-end" action="{{ route('admin.modify', ['table' => $table, 'mode' => 'insert']) }}" method="post">
                                @csrf
                                <button class="btn btn-primary" type="submit">Hozzáadás</button>
                            </form>
                        </div>
                    @else
                        <form class="text-end m-1 p-0" action="{{ route('admin.data', ['table' => $table]) }}" method="post">
                            @csrf
                            <input class="m-1 p-0" type="text" name="search" id="search">
                            <button class="btn btn-dark border m-1 p-2" type="submit">Keresés</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered rounded">
                                <thead>
                                    <tr>
                                        @foreach ($columns as $item)
                                            <th> {{ $item }} </th>
                                        @endforeach
                                    <tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $record)
                                        <tr>
                                            @foreach ($record as $value)
                                                <td> {{ $value }} </td>
                                            @endforeach
                                            <td class="text-center">
                                                @if ($table != 'admins')
                                                    <form class="d-inline-block m-1" action="{{ route('admin.modify', ['table' => $table, 'mode' => 'update', 'id' => $record->id]) }}" method="post">
                                                        @csrf
                                                        <button class="btn btn-success" type="submit">Szerkesztés</button>
                                                    </form>
                                                @endif
                                                <form class="d-inline-block m-1" action="{{ route('admin.modify', ['table' => $table, 'mode' => 'delete', 'id' => $record->id]) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-danger" type="submit">Törlés</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="100%" class="text-end">
                                            <form class="d-inline-block" action="{{ route('admin.modify', ['table' => $table, 'mode' => 'insert']) }}" method="post">
                                                @csrf
                                                <button class="btn btn-primary" type="submit">Hozzáadás</button>
                                            </form>
                                            <form class="d-inline-block" action="{{ route('admin') }}" method="GET">
                                                @csrf
                                                <button class="btn btn-dark border" type="submit">Vissza</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endSection
