<?php
namespace App\Controller\Organizer;

use App\Controller\AppController;

class RegistrationsController extends AppController {

    public function index() {
        $this->paginate = [
            'contain' => ['Users', 'Events', 'Locations'],
            'conditions' => ['Events.user_id' => $this->Auth->user('id')],
        ];
        $this->set('registrations', $this->paginate($this->Registrations));
    }

    public function view($id = null) {
        $registration = $this->Registrations->get($id, [
            'contain' => ['Users', 'Events', 'Locations'],
        ]);
        $this->set('registration', $registration);
    }

    public function add() {
        $registration = $this->Registrations->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Registrations->save($registration)) {
                $this->Flash->success('The registration has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The registration could not be saved. Please, try again.');
            }
        }
        $users = $this->Registrations->Users->find('list');
        $events = $this->Registrations->Events->find('list');
        $locations = $this->Registrations->Locations->find('list');
        $this->set(compact('registration', 'users', 'events', 'locations'));
    }

    public function edit($id = null) {
        $registration = $this->Registrations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registration = $this->Registrations->patchEntity($registration, $this->request->data);
            if ($this->Registrations->save($registration)) {
                $this->Flash->success('The registration has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The registration could not be saved. Please, try again.');
            }
        }
        $users = $this->Registrations->Users->find('list');
        $events = $this->Registrations->Events->find('list');
        $locations = $this->Registrations->Locations->find('list');
        $this->set(compact('registration', 'users', 'events', 'locations'));
    }

    public function delete($id = null) {
        $registration = $this->Registrations->get($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Registrations->delete($registration)) {
            $this->Flash->success('The registration has been deleted.');
        } else {
            $this->Flash->error('The registration could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
