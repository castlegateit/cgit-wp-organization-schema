<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class Project extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → Project';
}
