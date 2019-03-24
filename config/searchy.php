<?php

return [

    'default' => 'CustomSearch',

    'fieldName' => 'relevance',

    'drivers' => [

        'fuzzy' => [
            'class' => 'TomLingham\Searchy\SearchDrivers\FuzzySearchDriver',
        ],

        'ufuzzy' => [
            'class' => 'TomLingham\Searchy\SearchDrivers\FuzzySearchUnicodeDriver',
        ],

        'simple' => [
            'class' => 'TomLingham\Searchy\SearchDrivers\SimpleSearchDriver',
        ],

        'levenshtein' => [
            'class' => 'TomLingham\Searchy\SearchDrivers\LevenshteinSearchDriver',
        ],

        'CustomSearch' => [
            'class' => 'App\CustomSearch',
        ],

    ],

];
