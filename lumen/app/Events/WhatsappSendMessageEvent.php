<?php
namespace App\Events;

class WhatsappSendMessageEvent extends Event
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}