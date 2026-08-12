<?php

declare(strict_types=1);

namespace Castlegate\OrganizationSchema\Schema;

class InsuranceAgency extends Organization
{
    /**
     * Human-readable label
     *
     * @var string
     */
    public const LABEL = 'Organization → LocalBusiness → FinancialService → InsuranceAgency';
}
