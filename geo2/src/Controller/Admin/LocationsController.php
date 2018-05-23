<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Locations Controller
 *
 * @property App\Model\Table\LocationsTable $Locations
 */
class LocationsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
    public function index() {
        $this->set('locations', $this->paginate($this->Locations));
    }

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function view($id = null) {
        $location = $this->Locations->get($id, [
            'contain' => []
        ]);
        $this->set('location', $location);
    }

/**
 * Add method
 *
 * @return void
 */
    public function add() {
        $location = $this->Locations->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Locations->save($location)) {
                $this->Flash->success('The location has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The location could not be saved. Please, try again.');
            }
        }
        $this->set(compact('location'));
    }

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function edit($id = null) {
        $location = $this->Locations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->data);
            if ($this->Locations->save($location)) {
                $this->Flash->success('The location has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The location could not be saved. Please, try again.');
            }
        }
        $this->set(compact('location'));
    }

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function delete($id = null) {
        $location = $this->Locations->get($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Locations->delete($location)) {
            $this->Flash->success('The location has been deleted.');
        } else {
            $this->Flash->error('The location could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
