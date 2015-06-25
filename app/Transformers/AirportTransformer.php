<?php namespace App\Transformers;

use App\Airport;
use League\Fractal\TransformerAbstract;

class AirportTransformer extends TransformerAbstract
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
    public function transform(Airport $airport)
    {
        return [
            'id'        => $airport->getKey(),
            'name'      => $airport->name,
            'codes' => [
                'iata' => $airport->iata,
                'icao' => $airport->icao,
                'faa'  => $airport->faa,
            ],
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/airports/'.$airport->getKey(),
                ]
            ],
        ];
    }

    /**
     * Include Country
     *
     * @return League\Fractal\ItemResource
     */
    public function includeCountry(Airport $airport)
    {
        $country = $airport->country;

        return $this->item($country, new CountryTransformer);
    }

    /**
     * Include Geometry
     *
     * @return League\Fractal\ItemResource
     */
    public function includeGeometry(Airport $airport)
    {
        $geometry = $airport->geometry;

        return $this->item($geometry, new ArrayTransformer);
    }

    /**
     * Include Timezone
     *
     * @return League\Fractal\ItemResource
     */
    public function includeTimezone(Airport $airport)
    {
        $timezone = $airport->timezone;

        return $this->item($timezone, new ArrayTransformer);
    }

}