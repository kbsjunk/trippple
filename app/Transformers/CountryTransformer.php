<?php namespace App\Transformers;

use App\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'continent',
        'geometry',
        'timezone',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Country $country)
    {
        return [
            'id'       => $country->getKey(),
            'name'     => $country->name,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/countries/'.$country->getKey(),
                ]
            ],
        ];
    }

    /**
     * Include Continent
     *
     * @return League\Fractal\ItemResource
     */
    public function includeContinent(Country $country)
    {
        $continent = $country->continent;

        return $this->item($continent, new ContinentTransformer);
    }

    /**
     * Include Geometry
     *
     * @return League\Fractal\ItemResource
     */
    public function includeGeometry(Country $country)
    {
        $geometry = $country->geometry;

        return $this->item($geometry, new ArrayTransformer);
    }

    /**
     * Include Timezone
     *
     * @return League\Fractal\ItemResource
     */
    public function includeTimezone(Country $country)
    {
        $timezone = $country->timezone;

        return $this->item($timezone, new ArrayTransformer);
    }

}