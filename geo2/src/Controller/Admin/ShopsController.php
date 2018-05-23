<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Shops Controller
 *
 * @property App\Model\Table\ShopsTable $Shops
 */
class ShopsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
    public function index() {
        $this->set('shops', $this->paginate($this->Shops));
    }

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function view($id = null) {
        $shop = $this->Shops->get($id, [
            'contain' => []
        ]);
        $this->set('shop', $shop);
    }

/**
 * Add method
 *
 * @return void
 */
    public function add() {
        $shop = $this->Shops->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Shops->save($shop)) {
                $this->Flash->success('The shop has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The shop could not be saved. Please, try again.');
            }
        }
        $this->set(compact('shop'));
    }

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function edit($id = null) {
        $shop = $this->Shops->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $shop = $this->Shops->patchEntity($shop, $this->request->data);
            if ($this->Shops->save($shop)) {
                $this->Flash->success('The shop has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The shop could not be saved. Please, try again.');
            }
        }
        $this->set(compact('shop'));
    }

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function delete($id = null) {
        $shop = $this->Shops->get($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Shops->delete($shop)) {
            $this->Flash->success('The shop has been deleted.');
        } else {
            $this->Flash->error('The shop could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
