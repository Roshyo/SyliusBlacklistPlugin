<?php

declare(strict_types=1);

namespace BitBag\SyliusBlacklistPlugin\Checker\BlacklistingRule\Customer;

use BitBag\SyliusBlacklistPlugin\Checker\BlacklistingRule\BlacklistingRuleCheckerInterface;
use BitBag\SyliusBlacklistPlugin\Model\FraudSuspicionCommonModel;
use Doctrine\ORM\QueryBuilder;

class EmailBlacklistingRuleChecker implements BlacklistingRuleCheckerInterface
{
    /** @var string */
    public const EMAIL_ATTRIBUTE_NAME = 'email';

    public function checkIfCustomerIsBlacklisted(QueryBuilder $builder, FraudSuspicionCommonModel $fraudSuspicionCommonModel): void
    {
        $builder
            ->andWhere('o.email = :email')
            ->setParameter('email', $fraudSuspicionCommonModel->getEmail())
        ;
    }

    public function getAttributeName(): string
    {
        return self::EMAIL_ATTRIBUTE_NAME;
    }
}