<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Reviews Controller
 *
 * @property App\Model\Table\ReviewsTable $Reviews
 */
class ReviewsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
    public function index() {
        $this->set('reviews', $this->paginate($this->Reviews));
    }

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function view($id = null) {
        $review = $this->Reviews->get($id, [
            'contain' => []
        ]);
        $this->set('review', $review);
    }

/**
 * Add method
 *
 * @return void
 */
    public function add() {
        $review = $this->Reviews->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Reviews->save($review)) {
                $this->Flash->success('The review has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The review could not be saved. Please, try again.');
            }
        }
        $this->set(compact('review'));
    }

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function edit($id = null) {
        $review = $this->Reviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->data);
            if ($this->Reviews->save($review)) {
                $this->Flash->success('The review has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The review could not be saved. Please, try again.');
            }
        }
        $this->set(compact('review'));
    }

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function delete($id = null) {
        $review = $this->Reviews->get($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Reviews->delete($review)) {
            $this->Flash->success('The review has been deleted.');
        } else {
            $this->Flash->error('The review could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
