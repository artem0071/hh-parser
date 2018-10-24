<?php

namespace App\Services\Parser;

use SimpleXMLElement;
use App\Models\Item;

class ParserOzone extends Parser
{
    public function refactor(SimpleXMLElement $xml)
    {
        foreach ($xml->shop->offers->offer as $offer) {
            Item::firstOrCreate([
                'url' => $offer->url
            ], [
                'title' => $offer->name,
                'vendor' => $offer->vendor,
                'description' => $offer->description ?? '',
                'price' => $offer->price ?? 0,
                'image' => $offer->picture ?? null
            ]);
        }
    }
}