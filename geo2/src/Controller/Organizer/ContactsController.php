<?php
namespace App\Controller\Organizer;

use App\Controller\AppController;

class ContactsController extends AppController {

    public function index() {
        $this->paginate = [
            'conditions' => ['Contacts.user_id' => $this->Auth->user('id')],
        ];
        $this->set('contacts', $this->paginate($this->Contacts));
    }

    public function view($id = null) {
        $contact = $this->Contacts->get($id, [
            'contain' => [],
            'conditions' => ['Contacts.user_id' => $this->Auth->user('id')]
        ]);
        $this->set('contact', $contact);
    }

    public function add() {
        $contact = $this->Contacts->newEntity($this->request->data);
        if ($this->request->is('post')) {

            $contact->user_id = $this->Auth->user('id');

            if ($this->Contacts->save($contact)) {
                $this->Flash->success('The contact has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The contact could not be saved. Please, try again.');
            }
        }
        $this->set(compact('contact'));
    }

    public function edit($id = null) {
        $contact = $this->Contacts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->data);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success('The contact has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The contact could not be saved. Please, try again.');
            }
        }
        $this->set(compact('contact'));
    }

    public function delete($id = null) {
        $contact = $this->Contacts->get($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success('The contact has been deleted.');
        } else {
            $this->Flash->error('The contact could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

}
