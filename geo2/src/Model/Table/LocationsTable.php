<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Hash;

class LocationsTable extends Table {

////////////////////////////////////////////////////////////

    public function locationslist() {
        $locations = $this->find('all', array(
            'field' => array(
                'Locations.id',
                'Locations.name',
                'Locations.city',
                'Locations.state',
            ),
            'conditions' => array(
                'Locations.active' => 1
            ),
            'order' => array(
                'Locations.name' => 'ASC'
            ),
        ));
        $loc = array();
        foreach ($locations as $l) {
            $loc[] = array(
                'Locations' => array(
                    'id' => $l->id,
                    'name' => $l->name,
                    'city' => $l->city,
                    'state' => $l->state,
                )
            );
        }
        // print_r($loc);
        $loc1 = Hash::combine($loc, '{n}.Locations.id', array('%s - %s, %s', '{n}.Locations.name', '{n}.Locations.city', '{n}.Locations.state'));
        // print_r($loc1);
        return $loc1;
    }

////////////////////////////////////////////////////////////

}
