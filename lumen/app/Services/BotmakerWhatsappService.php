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

    public function sendToken(string $destinationNumber, string $token): bool
    {
        $data = [
            "chatPlatform" => "whatsapp",
            "chatChannelNumber" => env('BOTMAKER_WHASTAPP_CHANNEL_NUMBER'),
            "platformContactId" => $destinationNumber,
            "ruleNameOrId" => "template_token",
            "params" => [
                "imageURL" => $token
            ]
        ];

        Log::info(json_encode($data));

        $response = $this->http->withBody(json_encode($data, true), 'application/json')->post(env('BOTMAKER_WHASTAPP_API_INTENT_URL', ''));

        if (!$response->successful()) {
            Log::error('Whatsapp >> Não foi possível enviar mensagem ' . $response->body());

            return false;
        }

        Log::info('Whatsapp >> Mensagem enviada ' . $response->body());
        return true;
    }
}