<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use pimax\FbBotApp;
use pimax\Messages\Message;

class WebhookController extends Controller
{
    public function get(Request $request) {

        $local_verify = env('WEBHOOK_VERIFY_TOKEN');
        $hub_verify_token = \Input::get('hub_verify_token');

        if($local_verify === $hub_verify_token) {

            return \Input::get('hub_challenge');

        } else {

            return "Bad verify token";

        }

    }
}
