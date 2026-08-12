<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class PhysiciansOffice extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → LocalBusiness → MedicalBusiness → Physician → PhysiciansOffice';
}
