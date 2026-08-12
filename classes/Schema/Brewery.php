<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class Brewery extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → LocalBusiness → FoodEstablishment → Brewery';
}
