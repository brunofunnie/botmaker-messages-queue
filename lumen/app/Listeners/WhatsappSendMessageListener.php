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

    public function handle($event)
    {
        $eventData = json_decode(json_encode($event));
        $wpp = new BotmakerWhatsappService();

        Log::info("Event data" . json_encode($eventData->data));

        $wpp->sendMessage($eventData->data->src_number, $eventData->data->dst_number, $eventData->data->message);
    }
}