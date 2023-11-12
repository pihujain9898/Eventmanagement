<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BookingsFixture
 */
class BookingsFixture extends TestFixture
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
                'user' => 1,
                'ticket' => 1,
                'quantity' => 1,
                'individual_price' => 1,
                'created_at' => 1698302103,
                'updated_at' => 1698302103,
            ],
        ];
        parent::init();
    }
}
