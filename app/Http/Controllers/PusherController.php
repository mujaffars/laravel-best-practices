<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherController extends Controller
{
    public function triggerPusherEvent()
    {
        $options = [
            'cluster' => "ap2",
            'useTLS' => true
        ];

        $pusher = new Pusher(
            "f7b43fc05d00d401d485",
            "8e8d91b3c3b4b85f9b6b",
            "1811294",
            $options
        );

        $data['message'] = 'hello world';

        $pusher->trigger('my-channel', 'MessageSent', $data);

        return 'Event triggered successfully!';
    }
}
