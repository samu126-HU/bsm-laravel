@php
    $route = null;
    $title = null;
    $bookMode = false;
    $adminMode = false;
    $categories = null;
    $ids = null;
    if ($mode == 'insert') {
        $route = route('admin.insert', ['table' => $table]);
        $title = 'Hozzáadás';
    } elseif ($mode == 'update') {
        $route = route('admin.update', ['table' => $table, 'id' => $id]);
        $title = 'Frissítés';
    } else {
        abort(404, 'Unknown mode!');
    }
    if ($table == 'books') {
        $bookMode = true;
        $categories = DB::table('categories')->get()->toArray();
    }
    $columns = array_diff($columns, ['id', 'created_at', 'updated_at']);
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __($title) }}</div>
                    <div class="card-body">

                        <form action="{{ $route }}" method="post">
                            @csrf
                            <table class="table table-striped table-bordered">
                                @foreach ($columns as $column)
                                    <tr>
                                        <th>
                                            {{ $column }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if ($bookMode && $column == 'category')
                                            <select name="{{ $column }}" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if ($mode == 'update' && $category->id == $data[0]->$column) selected @endif>
                                                        {{ $category->category }}
                                                    </option>
                                                @endforeach
                                            @else
                                            <input type="text" name="{{ $column }}" value="@if ($mode == 'update') {{ $data[0]->$column }} @endif"
                                                class="form-control">
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <button class="btn btn-primary" type="submit">{{ $title }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
