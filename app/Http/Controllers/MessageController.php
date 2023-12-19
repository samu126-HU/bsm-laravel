<?php

namespace App\Http\Controllers;
use App\Models\Messages;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        Log::info($request->all());
        Log::info("hi");
        Messages::create(['name' => $request->name, 'email' => $request->email, 'subject' => $request->subject, 'message' => $request->message]);

    return redirect()->back()->with('success', 'Üzenet sikeresen elküldve!');        
    }

}
