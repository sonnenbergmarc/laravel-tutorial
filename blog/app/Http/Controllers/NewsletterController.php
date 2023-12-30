<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    // This is called automatic resoluation: automatic resoluation dependencies. We didn't say new Newsletter and yet it still worked.
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate(['email'=> 'required|email']);

        try {
            // $newsletter = new Newsletter();

            // $newsletter->subscribe(request('email'));
            // Can do the below inline version and works the same as the above
            // (new Newsletter())->subscribe(request('email'));
            // Can do the below with Newsletter $newsletter in the function and Laravel will handle things.
            $newsletter->subscribe(request('email'));

        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
    }
}
