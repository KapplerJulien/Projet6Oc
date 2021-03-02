<?php

namespace App\Service;


class Slug
{
    public function slugify($string, $empty = '', $delimiter = '-') 
    {   
        $sluggy = iconv('UTF-8', 'us-ascii//TRANSLIT', $string);
        $sluggy = preg_replace("#[^\w/|+ -]#", $empty, $sluggy);
        $sluggy = strtolower($sluggy);
        $sluggy = preg_replace("#[\/_|+ -]+#", $delimiter, $sluggy);
        $sluggy = trim($sluggy, $delimiter);

        return $sluggy;
    }

}