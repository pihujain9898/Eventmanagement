<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TicketCategoryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketCategoryTable Test Case
 */
class TicketCategoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketCategoryTable
     */
    protected $TicketCategory;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.TicketCategory',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TicketCategory') ? [] : ['className' => TicketCategoryTable::class];
        $this->TicketCategory = $this->getTableLocator()->get('TicketCategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TicketCategory);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TicketCategoryTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
