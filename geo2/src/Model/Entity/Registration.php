<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Registration Entity.
 */
class Registration extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
    protected $_accessible = [
        'user_id' => true,
        'event_id' => true,
        'location_id' => true,
        'play_as' => true,
        'price' => true,
        'memo' => true,
        'status' => true,
        'active' => true,
        'user' => true,
        'event' => true,
        'location' => true,
    ];

}
