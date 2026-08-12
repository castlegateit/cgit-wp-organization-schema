<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class Hostel extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → LocalBusiness → LodgingBusiness → Hostel';
}
