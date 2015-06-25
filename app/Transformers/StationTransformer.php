<?php namespace App\Transformers;

use App\Station;
use League\Fractal\TransformerAbstract;

class StationTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'country',
        'geometry',
        'timezone',
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'country',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Station $station)
    {
        return [
            'id'       => $station->getKey(),
            'name'     => $station->name,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/stations/'.$station->getKey(),
                ]
            ],
        ];
    }

    /**
     * Include Country
     *
     * @return League\Fractal\ItemResource
     */
    public function includeCountry(Station $station)
    {
        $country = $station->country;

        return $this->item($country, new CountryTransformer);
    }

    /**
     * Include Geometry
     *
     * @return League\Fractal\ItemResource
     */
    public function includeGeometry(Station $station)
    {
        $geometry = $station->geometry;

        return $this->item($geometry, new ArrayTransformer);
    }

    /**
     * Include Timezone
     *
     * @return League\Fractal\ItemResource
     */
    public function includeTimezone(Station $station)
    {
        $timezone = $station->timezone;

        return $this->item($timezone, new ArrayTransformer);
    }

}