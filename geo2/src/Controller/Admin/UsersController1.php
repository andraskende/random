<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {

    public $components = ['Paginator'];

////////////////////////////////////////////////////////////

    public function dashboard() {
    }

////////////////////////////////////////////////////////////

    public function index() {

        // $this->Paginator = $this->Components->load('Paginator');


        // $this->Videos->recursive = 0;
        $this->set('users', $this->paginate());

        // $this->Paginator->settings = array(
        //  'User' => array(
        //      'recursive' => -1,
        //      'contain' => array(
        //      ),
        //      'conditions' => array(
        //      ),
        //      'order' => array(
        //          'Users.name' => 'ASC'
        //      ),
        //      'limit' => 20,
        //      'paramType' => 'querystring',
        //  )
        // );
        // $users = $this->Paginator->paginate();
        // $this->set(compact('users'));
    }

////////////////////////////////////////////////////////////

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        $this->set('user', $this->User->read(null, $id));
    }

////////////////////////////////////////////////////////////

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');
            }
        }
    }

////////////////////////////////////////////////////////////

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function password($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['User']['password_clear'] = $this->request->data['User']['password'];
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }
        if ($this->User->delete()) {
            $this->Session->setFlash('User deleted');
            return $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash('User was not deleted');
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
