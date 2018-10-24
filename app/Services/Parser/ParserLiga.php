<?php

namespace App\Services\Parser;

use App\Models\Item;
use SimpleXMLElement;

class ParserLiga extends Parser
{
    protected function refactor(SimpleXMLElement $xml) :array
    {
        $items = [];
        foreach ($xml->shop->offers->offer as $offer) {
            $items[] = [
                'url' => $offer->url,
                'title' => $offer->name,
                'vendor' => $offer->vendor ?? null,
                'description' => $offer->description ?? '',
                'price' => $offer->price ?? 0,
                'image' => $offer->picture ?? null
            ];
        }

        return $items;
    }

}