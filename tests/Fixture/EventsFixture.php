<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventsFixture
 */
class EventsFixture extends TestFixture
{
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
                'image' => 'Lorem ipsum dolor sit amet',
                'introduction' => 'Lorem ipsum dolor sit amet',
                'information' => 'Lorem ipsum dolor sit amet',
                'notices' => 'Lorem ipsum dolor sit amet',
                'policies' => 'Lorem ipsum dolor sit amet',
                'start_time' => '2023-09-20 04:58:27',
                'end_time' => '2023-09-20 04:58:27',
                'category' => 1,
                'created_by' => 1,
                'created_at' => 1695185907,
                'updated_at' => 1695185907,
            ],
        ];
        parent::init();
    }
}
