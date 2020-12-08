<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusBlacklistPlugin\Behat\Page\Admin\BlacklistingRule;

use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;
use Tests\BitBag\SyliusBlacklistPlugin\Behat\Behaviour\ContainsEmptyListTrait;

class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    use ContainsEmptyListTrait;

    public function getBlocksWithTypeCount(string $type): int
    {
        $tableAccessor = $this->getTableAccessor();
        $table = $this->getElement('table');

        return count($tableAccessor->getRowsWithFields($table, ['type' => $type]));
    }

    public function deleteBlacklistingRule(string $name): void
    {
        $this->deleteResourceOnPage(['name' => $name]);
    }

    public function isBlacklistingRuleDisabled(string $name): bool
    {
        $tableAccessor = $this->getTableAccessor();
        $table = $this->getElement('table');

        $updatedRow = $tableAccessor->getRowWithFields($table, ['name' => $name]);
        $enabledText = $tableAccessor->getFieldFromRow($table, $updatedRow, 'enabled');

        return $enabledText !== 'Enabled';
    }
}
