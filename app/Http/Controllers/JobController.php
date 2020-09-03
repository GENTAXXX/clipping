<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendWelcomeMail;

class JobController extends Controller
{
    //
    public function processQueue()
    {
        dispatch(new SendWelcomeMail('Sender Code Briefly'));
        echo 'Mail Sent';
    }
}
