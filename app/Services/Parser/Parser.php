<?php

namespace App\Services\Parser;
use App\Models\Item;
use SimpleXMLElement;

abstract class Parser
{
    protected $tempResult;

    abstract protected function refactor(SimpleXMLElement $xml) :array;

    static public function startAllParsers()
    {
        $parsers = config('parser.sources');
        $multi = curl_multi_init();
        $handles = [];

        foreach ($parsers as $parser => $sources) {
            foreach ($sources as $source) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $source);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

                curl_multi_add_handle($multi, $ch);

                $handles[$source] = [
                    'parser' => $parser,
                    'channel' => $ch
                ];
            }
        }

        do {
            $mrc = curl_multi_exec($multi, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($active && $mrc == CURLM_OK) {
            if (curl_multi_select($multi) != -1) {
                usleep(100);
            }
            do {
                $mrc = curl_multi_exec($multi, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }

        foreach ($handles as $handle) {
            $channel = $handle['channel'];
            $parser = $handle['parser'];

            $xmlStr = curl_multi_getcontent($channel);
            curl_multi_remove_handle($multi, $channel);

            try {
                $xml = new SimpleXMLElement($xmlStr);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
                echo '<br/>';
                echo $parser;
            }

            /** @var Parser $parser */
            $parser = new $parser;

            $items = $parser->refactor($xml);

            self::storeDB($items);
        }

        curl_multi_close($multi);
    }

    static function storeDB($items)
    {
        foreach ($items as $item) {
            Item::firstOrCreate(
                array_only($item, [
                    'url'
                ]),
                array_only($item, [
                    'title', 'vendor', 'description', 'price', 'image'
                ])
            );
        }
    }
}