<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Message
{

    private $contactName;
    private $text;
    private $occurredAt;
    private $fromNumber;

    public function __construct($data)
    {
        $this->contactName = $data['contactName'] ?? '';
        $this->text = $data['text'] ?? '';
        $this->occurredAt = $data['occurredAt'] ?? Carbon::now();
        $this->fromNumber = $data['fromNumber'] ?? '';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getData(): Collection
    {
        return collect([
            "contactName" => $this->contactName,
            "text" => $this->text,
            "occurredAt" => $this->occurredAt,
            "fromNumber" => $this->fromNumber,
        ]);
    }

    public function json()
    {
        return $this->getData()->toJson();
    }

}