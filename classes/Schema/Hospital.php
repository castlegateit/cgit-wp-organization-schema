<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class Hospital extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → MedicalOrganization → Hospital';
}
