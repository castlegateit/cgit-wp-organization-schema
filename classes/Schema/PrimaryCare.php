<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class PrimaryCare extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → LocalBusiness → MedicalBusiness → PrimaryCare';
}
