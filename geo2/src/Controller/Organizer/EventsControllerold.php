<?php
namespace App\Controller\Organizer;

use App\Controller\AppController;

class EventsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = ['Paginator'];

////////////////////////////////////////////////////////////

    public function index() {

        $query = $this->Events->find('all', array(
                'contain' => array(
                    'Locations',
                    'Users',
                ),
                'limit' => 20,
                'conditions' => array(
                    'Events.user_id' => $this->Auth->user('id'),
                ),
                'order' => array(
                    'Events.start_date' => 'DESC'
                ),
            )
        );
        $events = $this->paginate($query);
        $this->set(compact('events'));
    }

////////////////////////////////////////////////////////////

    public function view($id = null) {
        $event = $this->Events->find('all', array(
            'recursive' => -1,
            'contain' => array(
                'Locations',
                'Users',
            ),
            'conditions' => array(
                'Events.id' => $id,
                'Events.user_id' => $this->Auth->user('id'),
            )
        ))->first();
        $this->set(compact('event'));
        if(empty($event)) {
            $this->Flash->error('The event his invalid.');
            return $this->redirect(array('action' => 'index'));
        }

        $registrations = $this->Events->Registrations->find('all', array(
            'recursive' => -1,
            'contain' => array(
                'Events',
                'Users',
            ),
            'conditions' => array(
                'Registrations.event_id' => $id,
                'Registrations.active' => 1,
            ),
            'order' => array(
                'Registrations.created' => 'ASC',
            )
        ));
        $this->set(compact('registrations'));

        $deletedregistrations = $this->Events->Registrations->find('all', array(
            'contain' => array(
                'Events',
                'Users',
            ),
            'conditions' => array(
                'Registrations.event_id' => $id,
                'Registrations.active' => 0,
            ),
            'order' => array(
                'Registrations.created' => 'ASC',
            )
        ));
        $this->set(compact('deletedregistrations'));

    }

////////////////////////////////////////////////////////////

    public function invite($id = null) {

        $event = $this->Event->find('first', array(
            'recursive' => -1,
            'contain' => array(
                'Location',
                'User',
            ),
            'conditions' => array(
                'Event.id' => $id,
                'Event.user_id' => $this->Auth->user('id'),
            )
        ));
        $this->set(compact('event'));
        if(empty($event)) {
            $this->Session->setFlash('The event his invalid.');
            return $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            App::uses('CakeEmail', 'Network/Email');
            $this->loadModel('Contact');

            $i = 0;

            foreach($this->request->data['Contact']['selected'] as $selected) {

                $contact = $this->Contact->find('first', array(
                    'recursive' => -1,
                    'conditions' => array(
                        'Contact.id' => $selected
                    ),
                ));

                if(filter_var($contact['Contact']['email'], FILTER_VALIDATE_EMAIL)) {

                    $Email = new CakeEmail();
                    $Email->from(array('info@kende.com' => 'kende.com'))
                    ->config('default')
                    ->sender('info@kende.com', 'kende.com')
                    ->domain('www.kende.com')
                    ->emailFormat('html')
                    ->template('invite', 'default')
                    ->viewVars(array('event' => $event, 'contact' => $contact))
                    ->to($contact['Contact']['email'])
                    ->subject('kende.com Event Invite')
                    ->send();

                    $i++;
                }

            }

            $this->Session->setFlash('Event invitation sent to ' . $i . ' Contacts');
            return $this->redirect(array('action' => 'invite', $id));

        }

        $registrations = $this->Event->Registration->find('all', array(
            'recursive' => -1,
            'contain' => array(
                'Event',
                'User',
            ),
            'conditions' => array(
                'Registration.event_id' => $id,
                'Registration.active' => 1,
            ),
            'order' => array(
                'Registration.created' => 'ASC',
            )
        ));
        $this->set(compact('registrations'));

        $deletedregistrations = $this->Event->Registration->find('all', array(
            'recursive' => -1,
            'contain' => array(
                'Event',
                'User',
            ),
            'conditions' => array(
                'Registration.event_id' => $id,
                'Registration.active' => 0,
            ),
            'order' => array(
                'Registration.created' => 'ASC',
            )
        ));
        $this->set(compact('deletedregistrations'));

        $contacts = classRegistry::init('Contact')->find('all', array(
            'recursive' => -1,
            'contain' => array(
            ),
            'limit' => 200,
            'conditions' => array(
                'Contact.user_id' => $this->Auth->user('id'),
            ),
            'order' => array(
                'Contact.name' => 'ASC',
                'Contact.email' => 'ASC',
            ),
        ));
        $this->set(compact('contacts'));

    }

////////////////////////////////////////////////////////////

    public function add() {

        $eventLast = $this->Events->find('all', array(
            'contain' => array(
                'Locations',
            ),
            'conditions' => array(
                'Events.user_id' => $this->Auth->user('id'),
            ),
            'order' => array(
                'Events.start_date' => 'DESC'
            )
        ))->first();
        if(!empty($eventLast)) {
            $location = $eventLast->location->id;
            $capacity = $eventLast->capacity;
            $price = $eventLast->price;
        } else {
            $location = '';
            $capacity = '';
            $price = '';
        }

        $event = $this->Events->newEntity($this->request->data);
        if ($this->request->is('post')) {

            $this->request->data['Event']['start_date'] = $this->request->data['Event']['date'] . ' ' . $this->request->data['Event']['time']['hour'] . ':' . $this->request->data['Event']['time']['min'] . ':00';

            // print_r($this->request->data);
            // die;

            $this->request->data['Event']['user_id'] = $this->Auth->user('id');

            if ($this->Events->save($this->request->data)) {
                $this->Session->setFlash('The event has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The event could not be saved. Please, try again.');
                $location = $this->request->data['Event']['location_id'];
                $capacity = $this->request->data['Event']['capacity'];
                $price = $this->request->data['Event']['price'];
            }
        }

        $this->set(compact('event', 'location', 'capacity', 'price'));

        $locations = $this->Events->Locations->locationslist();
        $this->set(compact('locations'));

    }

////////////////////////////////////////////////////////////

    public function edit($id = null) {

        $event = $this->Event->find('first', array(
            'recursive' => -1,
            'contain' => array(
                'Location',
                'User',
            ),
            'conditions' => array(
                'Event.id' => $id,
                'Event.user_id' => $this->Auth->user('id'),
            )
        ));
        $this->set(compact('event'));
        if(empty($event)) {
            $this->Session->setFlash('The event is invalid.');
            return $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash('The event has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The event could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $event;
        }

        $locations = $this->Event->Location->locationslist();
        $this->set(compact('locations'));
    }

////////////////////////////////////////////////////////////

    public function delete($id = null) {
        $this->Event->id = $id;

        $event = $this->Event->find('first', array(
            'recursive' => -1,
            'contain' => array(
                'Locations',
                'Users',
            ),
            'conditions' => array(
                'Events.id' => $id,
                'Events.user_id' => $this->Auth->user('id'),
            )
        ));
        $this->set(compact('event'));
        if(empty($event)) {
            $this->Session->setFlash('The event is invalid.');
            return $this->redirect(array('action' => 'index'));
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->Event->delete()) {
            $this->Session->setFlash('The event has been deleted.');
        } else {
            $this->Session->setFlash('The event could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
