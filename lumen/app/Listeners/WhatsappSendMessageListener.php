<?php
namespace App\Listeners;

use Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\WhatsappSendMessageEvent;
use App\Services\BotmakerWhatsappService;

class WhatsappSendMessageListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(WhatsappSendMessageEvent $event)
    {
        $data = json_decode(json_encode($event));
        $wpp = new BotmakerWhatsappService();
        $wpp->sendMessage($data['src_number'], $data['dst_number'], $data['message']);

        Log::info("Whatsapp message sent successfuly! " . json_encode($event));
    }
}