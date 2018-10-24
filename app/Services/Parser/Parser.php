<?php

namespace App\Services\Parser;
use SimpleXMLElement;

abstract class Parser
{
    protected $tempResult;

    abstract protected function refactor(SimpleXMLElement $xml);

    public function toParse($sources = [])
    {
        foreach ($sources as $source) {
            $xml = $this->getXml($source);

            $this->refactor($xml);
        }
    }

    protected function getXml($source) :SimpleXMLElement
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $xmlStr = curl_exec($ch);
        curl_close($ch);

        return new SimpleXMLElement($xmlStr);
    }
}