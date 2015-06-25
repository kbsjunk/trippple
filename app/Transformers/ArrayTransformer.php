<?php namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class ArrayTransformer extends TransformerAbstract
{

    /**
     * Turn this item object/array into a generic array
     *
     * @return array
     */
    public function transform($array)
    {
        return (array) $array;
    }

}