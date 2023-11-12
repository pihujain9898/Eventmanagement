<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventCategoryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventCategoryTable Test Case
 */
class EventCategoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EventCategoryTable
     */
    protected $EventCategory;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.EventCategory',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('EventCategory') ? [] : ['className' => EventCategoryTable::class];
        $this->EventCategory = $this->getTableLocator()->get('EventCategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->EventCategory);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EventCategoryTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
