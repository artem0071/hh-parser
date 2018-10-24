<?php

namespace App\Services\Parser;

use App\Models\Item;
use SimpleXMLElement;

class ParserLiga extends Parser
{
    protected function refactor(SimpleXMLElement $xml)
    {
        foreach ($xml->shop->offers->offer as $offer) {
            Item::firstOrCreate([
                'url' => $offer->url
            ], [
                'title' => $offer->name,
                'vendor' => $offer->vendor ?? null,
                'description' => $offer->description ?? '',
                'price' => $offer->price ?? 0,
                'image' => $offer->picture ?? null
            ]);
        }
    }

}