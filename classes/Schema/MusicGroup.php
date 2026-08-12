<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class MusicGroup extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → PerformingGroup → MusicGroup';
}
