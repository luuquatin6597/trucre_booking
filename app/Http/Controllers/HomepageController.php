<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Mail\Mailable;

class HomepageController extends Controller
{
    function index()
    {
        return view('homepage.homepage');
    }

    public function contact()
    {
        // $email = 'luuquangtinh6597@gmail.com';
        // Mail::to($email)->send(new ContactMail());
        return view('contact.contact');
    }
    public function sendMail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required'
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactMail($validatedData['name'], $validatedData['email'], $validatedData['body']));

        return redirect()->route('contact.contact-return')->with('success', 'Message sent successfully.');
    }

    public function contactReturn()
    {
        return view('contact.contact-return');
    }
}
