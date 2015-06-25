<?php namespace App\Transformers;

use App\Continent;
use League\Fractal\TransformerAbstract;

class ContinentTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Continent $continent)
    {
        return [
            'id'       => $continent->getKey(),
            'name'     => $continent->name,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/continents/'.$continent->getKey(),
                ]
            ],
        ];
    }

}