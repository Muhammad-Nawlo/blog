<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        try {
            request()->validate([
                'email' => 'required',
            ]);
            $newsletter->subscribe(request('email'));
        } catch (\Throwable $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to out newsletter list.'
            ]);
        }
        return redirect('/')->with('success', 'You are now signed up for out newsletter!');
    }
}
