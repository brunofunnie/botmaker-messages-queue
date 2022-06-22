<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Log;

class BotmakerWhatsappService
{
    public function __construct()
    {
        $this->http = Http::withHeaders([
            'access-token' => env('BOTMAKER_WHASTAPP_TOKEN', ''),
        ]);
    }

    public function sendMessage(string $originNumber, string $destinationNumber, string $message): bool
    {
        $data = [
            "chatPlatform" => "whatsapp",
            "chatChannelNumber" => '5515996730586',
            "platformContactId" => $destinationNumber,
            "messageText" => $message
        ];

        $response = $this->http->withBody(json_encode($data, true), 'application/json')->post(env('BOTMAKER_WHASTAPP_API_URL', ''));

        if (!$response->successful()) {
            Log::error('Whatsapp >> Não foi possível enviar mensagem ' . $response->body());

            return false;
        }

        Log::info('Whatsapp >> Mensagem enviada ' . $response->body());
        return true;
    }
}