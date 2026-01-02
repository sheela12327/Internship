<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Log;
   use Exception;

class ContactusController extends Controller
{
    //

    public function contact()
    {
        return view('frontend.contact.contact');
    }


public function submitContactForm(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|max:255',
        'message'    => 'required|string',
    ]);

    $mailData = [
        'name'    => $validatedData['first_name'].' '.$validatedData['last_name'],
        'email'   => $validatedData['email'],
        'message' => $validatedData['message'],
    ];

    try {
        Mail::to('saritasth220@gmail.com')
            ->send(new ContactFormMail($mailData));

        return response()->json([
            'status' => 'success',
            'message' => 'Email sent successfully'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}
}
