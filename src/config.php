<?php

return [
    'game' => [
        'roundsNumber' => 20
    ],
    'abilities' => [
        [
            'name' => 'Rapid Strike',
            'chance' => 10,
            'power' => 2,
            'type' => 'attack'
        ],
        [
            'name' => 'Magic Shield',
            'chance' => 20,
            'power' => 2,
            'type' => 'defence'
        ]
    ],
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
                'Rapid Strike',
                'Magic Shield'
            ]
        ],
        [
            'name' => 'Orderus2',
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
                'Rapid Strike',
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
    ],
];