<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 24/04/2017
 * Time: 13:19
 */

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;


class SmallFilter implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(100, 100);
    }
}
