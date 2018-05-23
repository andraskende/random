<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {

////////////////////////////////////////////////////////////

    public function initialize(array $config) {

        $this->addBehavior('Timestamp');

        $this->hasMany('Events', [
            'foreignKey' => 'user_id',
        ]);

        $this->hasMany('Registrations', [
            'foreignKey' => 'user_id',
        ]);

    }

////////////////////////////////////////////////////////////

    public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('name')
            ->notEmpty('email');

        $validator->add('email', [
            'unique' => [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Email already in use.'
            ]
        ]);

        return $validator;
    }

////////////////////////////////////////////////////////////

}
