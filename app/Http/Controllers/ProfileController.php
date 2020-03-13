<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use App\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    /**
     * this method is created dynamically using stub
     * @param $request
     * @return 
     */
    public function index(Request $request)
    {
        return $request->user();
    }

    /**
     * Query Time Cast
     */
    public function getProfile()
    {

        $profiles = Profile::select(['profiles.*', 'created_account_at' => Profile::selectRaw('MAX(created_at)')->whereColumn('created_at', 'profiles.created_at')])
            ->withCasts(['created_account_at' => 'date'])->get();
        return response()->json(['profile' => $profiles]);
    }

    /**
     * Blade X component syntax
     * @param $author
     * @return
     */
    public function welcome($author = "default")
    {
        return view('welcome', ['author' => $author]);
    }

    /**
     * Guzzle Abstraction
     * @param 
     * @return
     */
    public function httpGuzzle()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');
        echo $response->body();
        echo $response->status();
        echo $response->ok();
        echo $response->successful();
        echo $response->serverError();
        echo $response->clientError();
        dd($response->json());
    }

    /**
     * Custom Cast Types store data
     * @param 
     * @return
     */
    public function store()
    {
        return Profile::create([
            'field_string' => ['new', 'laravel', '7'],
            'field_decimal' => 30,
            'field_json' => [
                'address_one' => 'address one',
                'address_two' => 'address two'
            ],
        ]);
    }

    /**
     * fluent string operation
     * @param
     * @return 
     */
    public function fluentString()
    {
        echo Str::of('hello world')->title()->start('begin ')->slug('_');
        echo '<br>';

        echo Str::of('created_post')->slug('-')->title();
        echo '<br>';

        echo Str::of('INV_123')->after('INV_');
        echo '<br>';

        $stub = <<<stub
        Class {{CLASS}}
        {
        }
        stub;
        $className = 'User';
        echo Str::of($stub)->replace('{{CLASS}}', $className);
        echo '<br>';

        echo Str::of('laravel 6.x')->trim()->replace('6.x', '7.x')->slug(' ');
    }

    /**
     * multiple mailer driver in laravel 7
     * @param
     * @return
     */
    public function multipleMailer()
    {
        Mail::to('abc@gmail.com')->send(new sendMail());
        Mail::mailer('mailgun')->to('abc@gmail.com')->send(new sendMail());
        return 'sent';
    }
}
