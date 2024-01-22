<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TicketsFixture
 */
class TicketsFixture extends TestFixture
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
                'description' => 'Lorem ipsum dolor sit amet',
                'price' => 1,
                'category' => 1,
                'event' => 1,
                'total_quantity' => 1,
                'avilable_quantity' => 1,
                'max_purchase_value' => 1,
                'expiry' => 1695185907,
                'created_at' => 1695185907,
                'updated_at' => 1695185907,
            ],
        ];
        parent::init();
    }
}
