<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Email\Email;

class EventsController extends AppController {

////////////////////////////////////////////////////////////

    // public $components = array('Paginator');

////////////////////////////////////////////////////////////

    public function index() {
        $events = $this->Events->find('all', array(
            'contain' => ['Users', 'Locations'],
            'conditions' => array(
                'Events.active' => 1,
                'Events.start_date >' => date('Y-m-d'),
            ),
            'order' => array(
                'Events.start_date' => 'ASC'
            ),
        ));
        $this->set(compact('events'));

        $title_for_layout = 'kende.com';
        $description = 'Ice Hockey Pickup Games Organizer. Find Ice Hockey Pickup Games with kende.com';
        $keywords = 'ice hockey, pickup game, pickup hockey, open hockey';
        $this->set(compact('business', 'title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function view($id = null) {

        $event = $this->Events->find('all', array(
            'contain' => ['Users', 'Locations', 'Registrations'],
            'conditions' => array(
                'Events.id' => $id,
                'Events.active' => 1,
            )
        ))->first();

        if(empty($event)) {
            $this->Flash->error('The Event is not found.');
            return $this->redirect(array('action' => 'index'));
        }

        $registration = array();

        if($this->request->session()->read('Auth.User')) {

            $registration = $this->Events->Registrations->find('all', array(
                'contain' => array(
                    'Users'
                ),
                'conditions' => array(
                    'Registrations.event_id' => $event->id,
                    'Registrations.user_id' => $this->Auth->user('id'),
                    'Registrations.active' => 1,
                )
            ))->first();

            if ($this->request->is('post')) {

                if(!empty($registration)) {
                    $this->Flash->error('You already registered to this event!');
                    return $this->redirect($this->referer());
                }

                $reg = $this->Events->Registrations->newEntity();
                $reg->user_id = $this->Auth->user('id');
                $reg->event_id = $event->id;
                $reg->location_id = $event->location_id;
                $reg->play_as = $this->request->data['play_as'];
                $reg->price = $event->price;
                $reg->status = 'Pending';
                $reg->active = 1;

                if ($this->Events->Registrations->save($reg)) {

                    $registration = $this->Events->Registrations->find('all', array(
                        'contain' => array(
                            'Users'
                        ),
                        'conditions' => array(
                            'Registrations.event_id' => $event->id,
                            'Registrations.user_id' => $this->Auth->user('id'),
                        )
                    ))->first();

                    $Email = new Email();
                    $Email->from(array('info@kende.com' => 'kende.com'))
                        ->transport('default')
                        ->sender('info@kende.com', 'kende.com')
                        ->domain('www.kende.com')
                        ->emailFormat('html')
                        ->template('eventregistration', 'default')
                        ->viewVars(array('registration' => $registration, 'event' => $event, 'user' => $this->Auth->user()))
                        ->to($this->Auth->user('email'))
                        ->subject('kende.com event registration...')
                        ->send();

                    $this->Flash->success('The Registration has been successful.');
                    return $this->redirect($this->referer());
                } else {
                    $this->Flash->error('The event could not be saved. Please, try again.');
                }
            }

        }

        $registrations = $this->Events->Registrations->find('all', array(
            'contain' => ['Users'],
            'conditions' => array(
                'Registrations.event_id' => $event->id,
                'Registrations.active' => 1,
                'Registrations.play_as' => 'skater',
            )
        ));

        $goaltenders = $this->Events->Registrations->find('all', array(
            'contain' => ['Users'],
            'conditions' => array(
                'Registrations.event_id' => $event->id,
                'Registrations.active' => 1,
                'Registrations.play_as' => 'goaltender',
            )
        ));

        $deletedregistrations = $this->Events->Registrations->find('all', array(
            'contain' => ['Users'],
            'conditions' => array(
                'Registrations.event_id' => $event->id,
                'Registrations.active' => 0,
            )
        ));

        $play_as = array();

        if(($event->capacity - $registrations->count()) > 0) {
            $play_as['skater'] = 'skater';
        }
        if((2 - $goaltenders->count()) > 0) {
            $play_as['goaltender'] = 'goaltender';
        }

        $this->set(compact('event', 'registration', 'play_as', 'registrations', 'goaltenders', 'deletedregistrations'));

        // App::uses('CakeTime', 'Utility');

        $title_for_layout = '';
        $description = '';
        $keywords = $event['Location']['name'];

        $this->set(compact('business', 'title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function organizer_index() {
        $this->Paginator->settings = array(
            'Event' => array(
                'recursive' => -1,
                'contain' => array(
                    'Location',
                    'User',
                ),
                'limit' => 20,
                'conditions' => array(
                    'Event.user_id' => $this->Auth->user('id'),
                ),
                'order' => array(
                    'Event.start_date' => 'DESC'
                ),
                'paramType' => 'querystring',
            )
        );
        $events = $this->Paginator->paginate();
        $this->set(compact('events'));
    }

////////////////////////////////////////////////////////////

    public function organizer_view($id = null) {
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

    }

////////////////////////////////////////////////////////////

    public function organizer_invite($id = null) {

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

    public function organizer_add() {

        $eventLast = $this->Event->find('first', array(
            'recursive' => -1,
            'contain' => array(
                'Location',
            ),
            'conditions' => array(
                'Event.user_id' => $this->Auth->user('id'),
            ),
            'order' => array(
                'Event.start_date' => 'DESC'
            )
        ));
        if(!empty($eventLast)) {
            $location = $eventLast['Location']['id'];
            $capacity = $eventLast['Event']['capacity'];
            $price = $eventLast['Event']['price'];
        } else {
            $location = '';
            $capacity = '';
            $price = '';
        }

        if ($this->request->is('post')) {
            $this->Event->create();

            $this->request->data['Event']['start_date'] = $this->request->data['Event']['date'] . ' ' . $this->request->data['Event']['time']['hour'] . ':' . $this->request->data['Event']['time']['min'] . ':00';

            // print_r($this->request->data);
            // die;

            $this->request->data['Event']['user_id'] = $this->Auth->user('id');

            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash('The event has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The event could not be saved. Please, try again.');
                $location = $this->request->data['Event']['location_id'];
                $capacity = $this->request->data['Event']['capacity'];
                $price = $this->request->data['Event']['price'];
            }
        }

        $this->set(compact('location', 'capacity', 'price'));

        $locations = $this->Event->Location->locationslist();
        $this->set(compact('locations'));

    }

////////////////////////////////////////////////////////////

    public function organizer_edit($id = null) {

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

    public function organizer_delete($id = null) {
        $this->Event->id = $id;

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

        $this->request->onlyAllow('post', 'delete');
        if ($this->Event->delete()) {
            $this->Session->setFlash('The event has been deleted.');
        } else {
            $this->Session->setFlash('The event could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

    public function admin_crypt() {
        for ($i = 121233428; $i <= 121233458; $i++) {
            $str = base_convert($i * 7, 10, 36);
            $rev = intval($str, 36) / 7;
            echo $i . ' = ' . strtoupper($str)  . ' = ' . $rev;
            echo '<br />';
        }

        die('under contruction');
    }

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Event->recursive = 0;
        $this->set('events', $this->Paginator->paginate());
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException('Invalid event');
        }
        $event = $this->Event->find('first', array(
            'contain' => array(
                'User',
                'Location',
            ),
            'conditions' => array(
                'Event.id' => $id
            )
        ));
        $this->set(compact('event'));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Event->create();
            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash('The event has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The event could not be saved. Please, try again.');
            }
        }
        $users = $this->Event->User->find('list', array(
            'recursive' => -1,
            'conditions' => array(
                'User.role' => 'organizer',
                'User.active' => 1,
            ),
            'order' => array(
                'User.name' => 'ASC'
            )
        ));
        $locations = $this->Event->Location->locationslist();
        $this->set(compact('users', 'locations'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException('Invalid event');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash('The event has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The event could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->Event->find('first', array('conditions' => array('Event.id' => $id)));
        }

        $users = $this->Event->User->find('list', array(
            'recursive' => -1,
            'conditions' => array(
                'User.role' => 'organizer',
                'User.active' => 1,
            ),
            'order' => array(
                'User.name' => 'ASC'
            )
        ));
        $locations = $this->Event->Location->locationslist();
        $this->set(compact('users', 'locations'));
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Event->id = $id;
        if (!$this->Event->exists()) {
            throw new NotFoundException('Invalid event');
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
