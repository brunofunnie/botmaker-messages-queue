<?php
namespace App\Events;

class WhatsappSendTokenEvent extends Event
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}