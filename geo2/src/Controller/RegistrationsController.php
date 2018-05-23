<?php
namespace App\Controller;

use App\Controller\AppController;

class RegistrationsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = array('Paginator');

////////////////////////////////////////////////////////////

    public function delete($id = null) {

        $this->request->allowMethod('post', 'delete');



        if($this->request->session()->check('Auth.User')) {

            $registration = $this->Registrations->find('all', array(
                'contain' => array(
                    'Users'
                ),
                'conditions' => array(
                    'Registrations.id' => $id,
                    'Registrations.user_id' => $this->Auth->user('id'),
                )
            ))->first();

            $r = $this->Registrations->newEntity();

            $r->id = $registration->id;
            $r->active = 0;

            if ($this->Registrations->save($r)) {
                $this->Flash->success('The registration has been deleted.');
            } else {
                $this->Flash->error('The registration could not be deleted. Please, try again.');
            }
            return $this->redirect($this->referer());

        }


    }

////////////////////////////////////////////////////////////

    public function organizer_index() {
        $this->Paginator->settings = array(
            'Registration' => array(
                'recursive' => -1,
                'contain' => array(
                    'Event',
                    'Location',
                    'User',
                ),
                'limit' => 20,
                'conditions' => array(
                    'Event.user_id' => $this->Auth->user('id'),
                ),
                'order' => array(
                    'Registration.date' => 'DESC'
                ),
                'paramType' => 'querystring',
            )
        );
        $registrations = $this->Paginator->paginate();
        $this->set(compact('registrations'));
    }

////////////////////////////////////////////////////////////

    public function organizer_view($id = null) {
        $registration = $this->Registration->find('first', array(
            'recursive' => -1,
            'contain' => array(
                'Event',
                'Location',
                'User',
            ),
            'conditions' => array(
                'Registration.id'  => $id,
                'Event.user_id' => $this->Auth->user('id'),
            )
        ));
        if(empty($registration)) {
            return $this->redirect(array('action' => 'index'));
        }
        $this->set(compact('registration'));
    }

////////////////////////////////////////////////////////////

    public function organizer_add() {
        if ($this->request->is('post')) {
            $this->Registration->create();
            if ($this->Registration->save($this->request->data)) {
                $this->Session->setFlash('The registration has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The registration could not be saved. Please, try again.');
            }
        }
        $users = $this->Registration->User->find('list');
        $events = $this->Registration->Event->find('list');
        $locations = $this->Registration->Location->find('list');
        $this->set(compact('users', 'events', 'locations'));
    }

////////////////////////////////////////////////////////////

    public function organizer_edit($id = null) {
        if (!$this->Registration->exists($id)) {
            throw new NotFoundException('Invalid registration');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Registration->save($this->request->data)) {
                $this->Session->setFlash('The registration has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The registration could not be saved. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('Registration.id'  => $id));
            $this->request->data = $this->Registration->find('first', $options);
        }
        $users = $this->Registration->User->find('list');
        $events = $this->Registration->Event->find('list');
        $locations = $this->Registration->Location->find('list');
        $this->set(compact('users', 'events', 'locations'));
    }

////////////////////////////////////////////////////////////

    public function organizer_delete($id = null) {
        $this->Registration->id = $id;
        if (!$this->Registration->exists()) {
            throw new NotFoundException('Invalid registration');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Registration->delete()) {
            $this->Session->setFlash('The registration has been deleted.');
        } else {
            $this->Session->setFlash('The registration could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Paginator->settings = array(
            'Registration' => array(
                'recursive' => -1,
                'contain' => array(
                    'Event',
                    'Location',
                    'User',
                ),
                'limit' => 20,
                'conditions' => array(
                ),
                'order' => array(
                    'Registration.date' => 'DESC'
                ),
                'paramType' => 'querystring',
            )
        );
        $registrations = $this->Paginator->paginate();
        // print_r($registrations);
        $this->set(compact('registrations'));
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Registration->exists($id)) {
            throw new NotFoundException('Invalid registration');
        }
        $options = array('conditions' => array('Registration.id'  => $id));
        $this->set('registration', $this->Registration->find('first', $options));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Registration->exists($id)) {
            throw new NotFoundException('Invalid registration');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Registration->save($this->request->data)) {
                $this->Session->setFlash('The registration has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The registration could not be saved. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('Registration.id'  => $id));
            $this->request->data = $this->Registration->find('first', $options);
        }
        $locations = $this->Registration->Location->find('list');
        $events = $this->Registration->Event->find('list');
        $users = $this->Registration->User->find('list');

        $this->set(compact('users', 'events', 'locations'));
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Registration->id = $id;
        if (!$this->Registration->exists()) {
            throw new NotFoundException('Invalid registration');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Registration->delete()) {
            $this->Session->setFlash('The registration has been deleted.');
        } else {
            $this->Session->setFlash('The registration could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
