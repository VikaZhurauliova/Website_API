<?php

return [
    /*'phone' => [
        'main' => [
            'code' => '800',
            'number' => '333-12-81'
        ],
        'primary' => [
            'code' => '495',
            'number' => '646-80-96'
        ],
        'service' => [
            'code' => '499',
            'number' => '653-97-98'
        ],

        'massage_chairs' => [
            'code' => '800',
            'number' => '333-61-13'
        ]
    ],*/
    /*'mail' => [
        'from' => ['ordersfromsite@market.ru' => 'MARKET'],
        'to' => [
            'allordersfromallsites@market.ru',
        ],

        'directors' => [
            'serg@market.ru', 'KF@market.ru', 'alex@market.ru', 'rogacheva@market.ru', 'piv@us-medica.ru', 'al@market.ru',
            'sergboxg@gmail.com'
        ],
        'service' => ['svc@market.ru', '217@5053210.ru', 'info@market.ru'],
        'dealer' => ['dealers@market.ru', 'info@us-medica.ru', 'dealers@us-medica.ru'],
        'newDealer' => ['sales@market.ru'],
        'catalog' => ['ling06@yandex.ru', 'market@mail.ru'],
    ],*/
    /*'sms' => [
        'send' => true, // false отключает отправку СМС при новом заказе
        'phone' => '', // Номер для СМС
    ],*/
    'telegram' => [
        'send' => true, // false отключает отправку Telegram при новом заказе
        'call_center_chat_id' => '-1001087531011', // Идентификатор чата колл-центра
        'chat_rent_fitness' => '-674399133', // Идентификатор чата
    ],
    /*'yaOrders' => [
        'send' => true,
    ],*/
    /*'credit' => [
        'from' => 10000, // Минимальная стоимость товара для которого доступен кредит
        'time' => 8, // Срок кредита
    ],*/
    'delivery' => [
        'price' => 800, // Стоимость доставки
        'freeFrom' => 10000, // Сумма заказа для бесплатной доставки
    ],
    /*
    'comment' => [
        'limitOnHit' => 5,
        'limitOnProductPage' => 5,
        'teaserLength' => 390,
        'teaserLengthSmall' => 150
    ],
    'expert' => [
        'teaserLength' => 400,
    ],
    'faq' => [
        'limit' => 10
    ],
    'search' => [
        'limitHint' => 10,
        'limit' => 500,
        'maxWords' => 4
    ],
    'waitTimeOrder' => 'Мы&nbsp;с&nbsp;вами свяжемся в&nbsp;течение 10&nbsp;минут для подтверждения заказа. Будьте на&nbsp;связи. Без подтверждения заказ не&nbsp;будет принят в&nbsp;доставку.',


    'nameOOO' => 'Нимбус',

    'related' => [
        [
            'productIds' => '319,159,155, 83, 51',
            'idsCats' => false,
            'forSales' => '125, 85, 126',
            'salesPercent' => '20%',
            'by' => 'productIds',
            'dEnd' => '1547596800',
        ],
        [
            'productIds' => false,
            'idsCats' => '2, 144',
            'forSales' => '346, 349',
            'salesPercent' => '20%',
            'by' => 'idsCats',
            'dEnd' => '1547596800',
        ],
        [
            'productIds' => false,
            'idsCats' => '2',
            'forSales' => '323, 350',
            'salesPercent' => '20%',
            'by' => 'idsCats',
            'dEnd' => '1547596800',
        ],
        [
            'productIds' => false,
            'idsCats' => '2',
            'forSales' => '308',
            'salesPercent' => '30%',
            'by' => 'idsCats',
            'dEnd' => '1547596800',
        ],
    ],

    'ip' => [
        'our' => [
            '46.48.121.110',
            '77.233.11.88',
            '77.233.10.57',
            '78.36.202.114',
            '80.242.88.181',
            '83.219.139.123',
            '84.52.86.205',
            '85.115.224.222',
            '86.62.69.122',
            '87.229.232.18',
            '87.229.217.178',
            '91.229.234.126',
            '94.100.93.96',
            '94.214.205.206',
            '109.188.95.28',
            '109.167.224.168',
            '149.126.19.122',
            '185.36.62.177',
            '188.162.56.35',
            '195.28.53.85',
            '195.28.55.133',
            '195.208.167.140',
            '212.164.235.210',
            '213.193.13.143',
            '213.247.136.130',
        ]
    ],

    'countersEnable' => true, // Включает вывод счетчиков в /themes/default/layouts/site/_footer.php
    'copyEnable' => [ // Страницы на которых не выводится класс "no-copy" (запрещающий копирование)
        '/view.php' => true,
        '/contacts.php' => true,
        '/contacts_piter.php' => true,
        '/contacts_novosibirsk.php' => true,
        '/contacts_kazan.php' => true,
        '/contacts_ekat.php' => true,
        '/contacts_rostov.php' => true,
    ],*/

];
