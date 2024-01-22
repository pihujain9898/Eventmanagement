<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string $introduction
 * @property string $information
 * @property string $notices
 * @property string $policies
 * @property \Cake\I18n\DateTime $start_time
 * @property \Cake\I18n\DateTime $end_time
 * @property int $category
 * @property int $created_by
 * @property \Cake\I18n\DateTime $created_at
 * @property \Cake\I18n\DateTime $updated_at
 */
class Event extends Entity
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
        'image' => true,
        'introduction' => true,
        'information' => true,
        'notices' => true,
        'policies' => true,
        'start_time' => true,
        'end_time' => true,
        'category' => true,
        'created_by' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
