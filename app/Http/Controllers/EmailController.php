<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;

class EmailController extends Controller
{
    public function mail()
    {
    	Mail::send('emails.test2', ['user' => 'user'], function ($m) {
            $m->from('eltest@coheart.ac.in', 'Mail Test');

            $m->to('deepupv91@gmail.com', 'Deepu')->subject('Your Reminder!');
        });
    }
}
