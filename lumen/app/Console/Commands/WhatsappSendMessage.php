<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class WhatsappSendMessage extends Command
{
    protected $name = 'whastapp:sendMessage';

    protected $description = "Send whatsapp message";

    public function handle()
    {
        $data = [
            'src_number' => '+5515996730586',
            'dst_number' => '+5515981187302',
            'message' => 'Ta lá menininho!'
        ];

        event(new \App\Events\WhatsappSendMessageEvent($data));
    }
}