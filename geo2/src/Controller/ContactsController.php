<?php
namespace App\Controller;

use App\Controller\AppController;

class ContactController extends AppController {

////////////////////////////////////////////////////////////

    // public $components = array('Paginator');

////////////////////////////////////////////////////////////

    public function organizer_index() {

        if ($this->request->is('post') || $this->request->is('put')) {

            $selectedstring = '';

            foreach($this->request->data['Contact']['selected'] as $selected) {
                $selectedstring .= $selected . ', ';
            }

            echo $selectedstring;

        }


        $this->Paginator->settings = array(
            'Contact' => array(
                'recursive' => -1,
                'contain' => array(
                ),
                'limit' => 50,
                'conditions' => array(
                    'Contact.user_id' => $this->Auth->user('id'),
                ),
                'order' => array(
                    'Contact.name' => 'ASC',
                    'Contact.email' => 'ASC',
                ),
                'paramType' => 'querystring',
            )
        );
        $contacts = $this->Paginator->paginate();
        $this->set(compact('contacts'));

    }

////////////////////////////////////////////////////////////

    public function organizer_view($id = null) {
        $contact = $this->Contact->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Contact.id' => $id,
                'Contact.user_id' => $this->Auth->user('id'),
            )
        ));
        if(empty($contact)) {
            $this->Session->setFlash('The contact is invalid.');
            return $this->redirect(array('action' => 'index'));
        }
        $this->set(compact('contact'));
    }

////////////////////////////////////////////////////////////

    public function organizer_add() {
        if ($this->request->is('post')) {
            $this->Contact->create();
            $this->request->data['Contact']['user_id'] = $this->Auth->user('id');
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash('The contact has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The contact could not be saved. Please, try again.');
            }
        }
    }

////////////////////////////////////////////////////////////

    public function organizer_edit($id = null) {
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException('Invalid contact');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash('The contact has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The contact could not be saved. Please, try again.');
            }
        } else {
            $contact = $this->Contact->find('first', array(
                'conditions' => array(
                    'Contact.id' => $id,
                    'Contact.user_id' => $this->Auth->user('id'),
                )
            ));
            if(empty($contact)) {
                $this->Session->setFlash('The contact is invalid.');
                return $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $contact;
        }
    }

////////////////////////////////////////////////////////////

    public function organizer_delete($id = null) {
        $this->Contact->id = $id;

        $contact = $this->Contact->find('first', array(
            'recursive' => -1,
            'contain' => array(
            ),
            'conditions' => array(
                'Contact.id' => $id,
                'Contact.user_id' => $this->Auth->user('id'),
            )
        ));
        if(empty($contact)) {
            $this->Session->setFlash('The contact is invalid.');
            return $this->redirect(array('action' => 'index'));
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->Contact->delete()) {
            $this->Session->setFlash('The contact has been deleted.');
        } else {
            $this->Session->setFlash('The contact could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Paginator->settings = array(
            'Contact' => array(
                'recursive' => -1,
                'contain' => array(
                    'User'
                ),
                'limit' => 50,
                'conditions' => array(
                ),
                'order' => array(
                    'Contact.name' => 'ASC',
                    'Contact.email' => 'ASC',
                ),
                'paramType' => 'querystring',
            )
        );
        $contacts = $this->Paginator->paginate();
        $this->set(compact('contacts'));
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException('Invalid contact');
        }
        $contact = $this->Contact->find('first', array(
            'contain' => array(
                'User'
            ),
            'conditions' => array(
                'Contact.id' => $id
            )
        ));
        $this->set(compact('contact'));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Contact->create();
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash('The contact has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The contact could not be saved. Please, try again.');
            }
        }
        $users = $this->Contact->User->find('list', array(
            'recursive' => -1,
            'conditions' => array(
                'User.role' => 'organizer',
                'User.active' => 1,
            ),
            'order' => array(
                'User.name' => 'ASC',
            ),
        ));
        $this->set(compact('users'));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException('Invalid contact');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash('The contact has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The contact could not be saved. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('Contact.id' => $id));
            $this->request->data = $this->Contact->find('first', $options);
        }
        $users = $this->Contact->User->find('list');
        $this->set(compact('users'));
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Contact->id = $id;
        if (!$this->Contact->exists()) {
            throw new NotFoundException('Invalid contact');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Contact->delete()) {
            $this->Session->setFlash('The contact has been deleted.');
        } else {
            $this->Session->setFlash('The contact could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
