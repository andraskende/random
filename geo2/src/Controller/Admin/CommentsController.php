<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
    public function index() {
        $this->set('comments', $this->paginate($this->Comments));
    }

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function view($id = null) {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        $this->set('comment', $comment);
    }

/**
 * Add method
 *
 * @return void
 */
    public function add() {
        $comment = $this->Comments->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Comments->save($comment)) {
                $this->Flash->success('The comment has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The comment could not be saved. Please, try again.');
            }
        }
        $this->set(compact('comment'));
    }

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function edit($id = null) {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success('The comment has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The comment could not be saved. Please, try again.');
            }
        }
        $this->set(compact('comment'));
    }

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws NotFoundException
 */
    public function delete($id = null) {
        $comment = $this->Comments->get($id);
        $this->request->allowMethod('post', 'delete');
        if ($this->Comments->delete($comment)) {
            $this->Flash->success('The comment has been deleted.');
        } else {
            $this->Flash->error('The comment could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
