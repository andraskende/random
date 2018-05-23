<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Registrations Controller
 *
 * @property App\Model\Table\RegistrationsTable $Registrations
 */
class RegistrationsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
    public function index() {
        $this->paginate = [
            'contain' => ['Users', 'Events', 'Locations']
        ];
        $this->set('registrations', $this->paginate($this->Registrations));
    }

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function view($id = null) {
        $registration = $this->Registrations->get($id, [
            'contain' => ['Users', 'Events', 'Locations']
        ]);
        $this->set('registration', $registration);
    }

/**
 * Add method
 *
 * @return void
 */
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

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
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

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
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
