<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('md5',[$this,'md5Generator'])
        ];
    }

    public function md5Generator($string)
    {
        return md5($string);
    }
}