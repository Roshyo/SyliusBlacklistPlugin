<?php

/*
 * This file was created by developers working at BitBag
 * Do you need more information about us and what we do? Visit our https://bitbag.io website!
 * We are hiring developers from all over the world. Join us and start your new, exciting adventure and become part of us: https://bitbag.io/career
*/

namespace spec\BitBag\SyliusBlacklistPlugin\Checker\BlacklistingRule\Address;

use BitBag\SyliusBlacklistPlugin\Checker\BlacklistingRule\Address\StreetBlacklistingRuleChecker;
use BitBag\SyliusBlacklistPlugin\Checker\BlacklistingRule\BlacklistingRuleCheckerInterface;
use BitBag\SyliusBlacklistPlugin\Model\FraudSuspicionCommonModel;
use BitBag\SyliusBlacklistPlugin\Model\FraudSuspicionCommonModelInterface;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;

final class StreetBlacklistingRuleCheckerSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(StreetBlacklistingRuleChecker::class);
    }

    function it_implements_blacklisting_rule_checker_interface(): void
    {
        $this->shouldHaveType(BlacklistingRuleCheckerInterface::class);
    }

    function it_adds_part_of_query(QueryBuilder $builder, FraudSuspicionCommonModelInterface $fraudSuspicionCommonModel): void
    {
        $fraudSuspicionCommonModel->getStreet()->willReturn('Groove Street');
        $builder->andWhere('o.street = :street')->willReturn($builder);
        $builder->setParameter('street', 'Groove Street')->willReturn($builder);

        $fraudSuspicionCommonModel->getStreet()->shouldBeCalled();
        $builder->andWhere('o.street = :street')->shouldBeCalled();
        $builder->setParameter('street', 'Groove Street')->shouldBeCalled();

        $this->checkIfCustomerIsBlacklisted($builder, $fraudSuspicionCommonModel);
    }

    function it_gets_attribute_name(): void
    {
        $this->getAttributeName()->shouldReturn(StreetBlacklistingRuleChecker::STREET_ATTRIBUTE_NAME);
    }
}
