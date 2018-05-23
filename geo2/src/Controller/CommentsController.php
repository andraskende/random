<?php
namespace App\Controller;

use App\Controller\AppController;

class CommentsController extends AppController {

////////////////////////////////////////////////////////////

    // public $components = array('Paginator');

////////////////////////////////////////////////////////////

    public function add() {

        $n1 = mt_rand(1, 5);
        $n2 = mt_rand(1, 5);
        $captcha = $n1 + $n2;
        $hash = md5($captcha);
        $this->set(compact('n1', 'n2', 'hash'));

        $this->loadModel('Comments');

        $comment = $this->Comments->newEntity($this->request->data);
        $this->set(compact('comment'));

        if ($this->request->is('post')) {
            if(md5($this->request->data['captcha']) == $this->request->data['hash']) {
                if ($this->Comments->save($comment)) {

                    $body = '';
                    foreach ($this->request->data as $key => $value) {
                        $body .= $key . ' = ' . $value  . "\n";
                    }
                    $body = "PLEASE EDIT AT: http://www.kende.com/admin/comments/\n\n\n" . $body . "\n\n";
                    mail('andras@kende.com', 'contact form', $body);

                    $this->Flash->success('Your data has been saved.');
                    return $this->redirect(['action' => 'add']);
                }
                $this->Flash->error('Unable to add your data.');
            } else {
                $this->Flash->error('Invalid Captcha');
            }
        }

        $title_for_layout = 'Contact Us';
        $description = 'Contact Us';
        $keywords = '';
        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Paginator->settings = array(
            'Comment' => array(
                'recursive' => -1,
                'contain' => array(
                ),
                'limit' => 50,
                'conditions' => array(
                ),
                'order' => array(
                    'Comment.created' => 'DESC'
                ),
                'paramType' => 'querystring',
            )
        );
        $comments = $this->Paginator->paginate();
        $this->set(compact('comments'));
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException('Invalid comment');
        }
        $this->set('comment', $this->Comment->read(null, $id));
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException('Invalid comment');
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('The comment has been saved');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The comment could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->Comment->read(null, $id);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException('Invalid comment');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Comment->delete()) {
            $this->Session->setFlash('Comment deleted');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('Comment was not deleted');
        $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
