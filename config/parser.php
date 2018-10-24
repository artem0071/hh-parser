<?php

return [
    'sources' => [
        \App\Services\Parser\ParserOzone::class => [
            'http://static.ozone.ru/multimedia/yml/facet/div_soft.xml'
        ],
        \App\Services\Parser\ParserTrenazhery::class => [
            'http://www.trenazhery.ru/market2.xml'
        ],
        \App\Services\Parser\ParserLiga::class => [
            'http://www.radio-liga.ru/yml.php'
        ],
        \App\Services\Parser\ParserArmprodukt::class => [
            'http://armprodukt.ru/bitrix/catalog_export/yandex.php'
        ]
    ]
];