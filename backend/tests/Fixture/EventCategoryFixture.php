<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventCategoryFixture
 */
class EventCategoryFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'event_category';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1695185907,
                'updated_at' => 1695185907,
            ],
        ];
        parent::init();
    }
}
