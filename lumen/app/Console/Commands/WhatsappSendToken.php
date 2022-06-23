<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class WhatsappSendToken extends Command
{
    protected $name = 'whatsapp:sendToken';

    protected $description = "Send whatsapp validation token";

    public function handle()
    {
        $random = rand(100000, 999999);
        [$token1, $token2] = str_split($random, 3);

        $data = [
            'dst_number' => '5515981187302',
            'token' => "$token1-$token2",
        ];

        Log::info($data);

        event(new \App\Events\WhatsappSendTokenEvent($data));
    }
}