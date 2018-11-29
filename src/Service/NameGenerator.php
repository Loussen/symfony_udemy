<?php
/**
 * Created by PhpStorm.
 * User: fhasanli
 * Date: 11/25/2018
 * Time: 7:24 PM
 */

namespace App\Service;

class NameGenerator
{
    public function randomName()
    {
        $names = [
            'Fuad',
            'Elsen',
            'Murad',
            'Ali'
        ];

        $index = array_rand($names);

        return $names[$index];
    }
}