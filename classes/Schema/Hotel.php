<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class Hotel extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → LocalBusiness → LodgingBusiness → Hotel';
}
