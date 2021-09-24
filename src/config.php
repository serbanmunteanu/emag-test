<?php

use App\Abilities\MagicShield;
use App\Abilities\RapidStrike;

return [
    'champions' => [
        [
            'name' => 'Orderus',
            'type' => 'knight',
            'health' => [
                'min' => 70,
                'max' => 100
            ],
            'strength' => [
                'min' => 70,
                'max' => 80
            ],
            'defence' => [
                'min' => 45,
                'max' => 55
            ],
            'speed' => [
                'min' => 40,
                'max' => 50
            ],
            'luck' => [
                'min' => 10,
                'max' => 30
            ],
            'abilities' => [
                    RapidStrike::class,
                    MagicShield::class
                ]
            ],
        [
            'name' => 'Wild Monster',
            'type' => 'monster',
            'health' => [
                'min' => 60,
                'max' => 90
            ],
            'strength' => [
                'min' => 60,
                'max' => 90
            ],
            'defence' => [
                'min' => 40,
                'max' => 60
            ],
            'speed' => [
                'min' => 40,
                'max' => 60
            ],
            'luck' => [
                'min' => 25,
                'max' => 40
            ],
            'abilities' => []
        ]
    ]
];