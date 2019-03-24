<?php

namespace App;
use TomLingham\Searchy\SearchDrivers\BaseSearchDriver;

class CustomSearch extends BaseSearchDriver
{
    protected $matchers = [
        'TomLingham\Searchy\Matchers\ExactMatcher'                 => 100,
        'TomLingham\Searchy\Matchers\InStringMatcher'              => 60,
        'TomLingham\Searchy\Matchers\StartOfWordsMatcher'          => 50,
        'TomLingham\Searchy\Matchers\ConsecutiveCharactersMatcher' => 40,
        'TomLingham\Searchy\Matchers\AcronymMatcher'               => 42,
        'TomLingham\Searchy\Matchers\StudlyCaseMatcher'            => 32,
        'TomLingham\Searchy\Matchers\StartOfStringMatcher'         => 20,
        'TomLingham\Searchy\Matchers\TimesInStringMatcher'         => 8,
    ];
}