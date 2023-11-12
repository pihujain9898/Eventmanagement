<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property int $category
 * @property int $event
 * @property int $total_quantity
 * @property int $avilable_quantity
 * @property int $max_purchase_value
 * @property \Cake\I18n\DateTime $expiry
 * @property \Cake\I18n\DateTime $created_at
 * @property \Cake\I18n\DateTime $updated_at
 */
class Ticket extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'description' => true,
        'price' => true,
        'category' => true,
        'event' => true,
        'total_quantity' => true,
        'avilable_quantity' => true,
        'max_purchase_value' => true,
        'expiry' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
