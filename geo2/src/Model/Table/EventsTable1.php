<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 */
class EventsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
    public function initialize(array $config) {
        $this->table('events');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
        ]);
        $this->hasMany('Registrations', [
            'foreignKey' => 'event_id',
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('user_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('user_id')
            ->add('location_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('location_id')
            ->add('start_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('start_date')
            ->add('end_date', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('end_date')
            ->allowEmpty('timezone')
            ->add('privacy', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('privacy')
            ->add('capacity', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('capacity')
            ->add('price', 'valid', ['rule' => 'decimal'])
            ->allowEmpty('price')
            ->allowEmpty('description')
            ->add('active', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('active');

        return $validator;
    }

}
