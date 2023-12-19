<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    //

    public function switchCategory(Request $request) {
        $request->validate([
            'id' => 'required',
        ]);
        return back()->with('category', $request->id);
    }
}
