<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Registrations Model
 */
class RegistrationsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config) {
        $this->table('registrations');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
        ]);
    }

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
    public function validationDefault(Validator $validator) {
        $validator
            ->add('id', 'valid', ['rule' => 'uuid'])
            ->allowEmpty('id', 'create')
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('user_id')
            ->add('event_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('event_id')
            ->add('location_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('location_id')
            ->allowEmpty('play_as')
            ->add('price', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('price')
            ->allowEmpty('memo')
            ->allowEmpty('status')
            ->add('active', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('active');

        return $validator;
    }

}
