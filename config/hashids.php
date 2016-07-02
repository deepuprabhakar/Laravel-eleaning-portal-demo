<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'F28F86043514AEB26943F1A67F21B94251201F322199855F1DF1B982E3CF7C92',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'course' => [
            'salt' => 'REyUxDUiTEjlSqUBCRMXidLbuCLITJMoaehUoHmKrrZfeiXvaicKHBuUJjngTYzq',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'subject' => [
            'salt' => 'FjaddnadajdadASDSDdsdnsgkfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'news' => [
            'salt' => 'FlkjuytdajdadASDSDdsdnsgkfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'student' => [
            'salt' => 'FjaddnaasdfghASDSDdsdnsgkfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'teacher' => [
            'salt' => 'FjaddnaasdfghASabgqoKLtaffkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],


        'message' => [
            'salt' => 'SDSddtadajdadASDSDqwertykfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'quiz' => [
            'salt' => 'FjaddnadajdadASDSDdDDKKlllMNopfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],
        'unit' => [
            'salt' => 'ASSrjTToUSDSDdDDKKlllMNopfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],
        'article' => [
            'salt' => 'ASSrjaghtengwsqDKKlllMNopfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],
        'project' => [
            'salt' => 'LMNopresqwngwsqDKKlllMNopfkeFkdflKlkdofekfefmdkpoyutkjBFJeufekAS',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'assignment' => [
            'salt' => 'ASSrjaghtengwsqDKKlllMNopfkeFkdflKlkdofSSnvdhfddjfsfjsfjfjsdf',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'category' => [
            'salt' => 'WQErjaghtengwsqDKKlfbmdfbkjgfwqefwyedSSnvdhfddjfsfjsfjfjsdf',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],
        'question' => [
            'salt' => 'QWIUOBJrjagmbfjskgffjfsfKKlfbmdfbkjgfwqefwyedSSnvdhfddjfsfjsfjfjsdf',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],

        'setquestion' => [
            'salt' => 'PPWIUOBJrjagmbfjskgffjfsfKKlfbmjhgsdkjgjdufwyedSSnvdhfddjfsfjsfjfjsdf',
            'length' => 6,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890',
        ],


    ],

];
