<?php

namespace App\Actions;

use Http;
use App\Models\Deal;

class SendAddDealRequestAction
{
    public function execute(Deal $deal, float $amount): bool
    {
        $bot = $deal->bot;

        $response = Http::post(config('connector.url'), [
            'type_of_signal' => 'add',
            'bot_id' => $bot->id,
            'deal_id' => $deal->id,
            'amount' => $amount,
            'connector_secret' => $bot->secret,
            'pair' => $deal->pair,
        ]);

        return $response->successful();
    }
}
