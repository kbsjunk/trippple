<?php namespace App\Transformers;

use App\Region;
use League\Fractal\TransformerAbstract;

class RegionTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'country',
        'geometry',
        'geometry',
        'timezone',
    ];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    public function transform(Region $region)
    {
        return [
            'id'       => $region->getKey(),
            'name'     => $region->name,
            'name_alt' => $region->name_alt,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/regions/'.$region->getKey(),
                ]
            ],
        ];
    }

    /**
     * Include Country
     *
     * @return League\Fractal\ItemResource
     */
    public function includeCountry(Region $region)
    {
        $country = $region->country;

        return $this->item($country, new CountryTransformer);
    }

    /**
     * Include Geometry
     *
     * @return League\Fractal\ItemResource
     */
    public function includeGeometry(Region $region)
    {
        $geometry = $region->geometry;

        return $this->item($geometry, new ArrayTransformer);
    }

    /**
     * Include Timezone
     *
     * @return League\Fractal\ItemResource
     */
    public function includeTimezone(Region $region)
    {
        $timezone = $region->timezone;

        return $this->item($timezone, new ArrayTransformer);
    }

}