<?php namespace App\Transformers;

use App\Place;

use League\Fractal\TransformerAbstract;

class PlaceTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'region',
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
        'region',
        'country',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Place $place)
    {
        return [
            'id'       => $place->getKey(),
            'name'     => $place->name,
            'name_alt' => $place->alternate_names,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/places/'.$place->getKey(),
                ]
            ],
        ];
    }

    /**
     * Include Region
     *
     * @return League\Fractal\ItemResource
     */
    public function includeRegion(Place $place)
    {
        if ($region = $place->region)

        return $this->item($region, new RegionTransformer);
    }

    /**
     * Include Country
     *
     * @return League\Fractal\ItemResource
     */
    public function includeCountry(Place $place)
    {
        if ($country = $place->country)

        return $this->item($country, new CountryTransformer);
    }

    /**
     * Include Geometry
     *
     * @return League\Fractal\ItemResource
     */
    public function includeGeometry(Place $place)
    {
        $geometry = $place->geometry;

        return $this->item($geometry, new ArrayTransformer);
    }

    /**
     * Include Timezone
     *
     * @return League\Fractal\ItemResource
     */
    public function includeTimezone(Place $place)
    {
        $timezone = $place->timezone;

        return $this->item($timezone, new ArrayTransformer);
    }
    
}