<?php
namespace App\Controller;

use App\Controller\AppController;

class ShopsController extends AppController {

////////////////////////////////////////////////////////////

    public $components = array('Paginator');

////////////////////////////////////////////////////////////

    public function index() {
        $shops = $this->Shops->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'Shops.active' => 1
            ),
            'order' => 'RAND()'
        ));
        $this->set(compact('shops'));

        $title_for_layout = 'Ice Hockey Stores - kende.com';
        $description = 'Ice Hockey Stores - kende.com';
        $keywords = 'ice hockey, shop, store';

        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function view($slug = null) {

        $shop = $this->Shops->find('all', [
            'conditions' => ['Shops.slug' => $slug]
        ])->first();

        if (empty($shop)) {
            return $this->redirect(array('action' => 'index'));
        }
        $this->set(compact('shop'));


        $title_for_layout = $shop->name . ' Hockey Store - Ice Hockey Pickup';
        $description = $shop->name . ' Hockey Store - Ice Hockey Pickup';
        $keywords = $shop->name;

        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    // public function add() {
    //  if ($this->request->is('post')) {
    //      $this->Shop->create();
    //      if ($this->Shop->save($this->request->data)) {
    //          $this->Session->setFlash('The shop has been saved.');
    //          return $this->redirect(array('action' => 'index'));
    //      } else {
    //          $this->Session->setFlash('The shop could not be saved. Please, try again.');
    //      }
    //  }
    // }

////////////////////////////////////////////////////////////

    public function admin_index() {
        $this->Shop->recursive = 0;
        $this->set('shops', $this->Paginator->paginate());
    }

////////////////////////////////////////////////////////////

    public function admin_view($id = null) {
        if (!$this->Shop->exists($id)) {
            throw new NotFoundException('Invalid shop');
        }
        $options = array('conditions' => array('Shop.id' => $id));
        $this->set('shop', $this->Shop->find('first', $options));
    }

////////////////////////////////////////////////////////////

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Shop->create();
            if ($this->Shop->save($this->request->data)) {
                $this->Session->setFlash('The shop has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The shop could not be saved. Please, try again.');
            }
        }
    }

////////////////////////////////////////////////////////////

    public function admin_edit($id = null) {
        if (!$this->Shop->exists($id)) {
            throw new NotFoundException('Invalid shop');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Shop->save($this->request->data)) {
                $this->Session->setFlash('The shop has been saved.');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The shop could not be saved. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('Shop.id' => $id));
            $this->request->data = $this->Shop->find('first', $options);
        }
    }

////////////////////////////////////////////////////////////

    public function admin_delete($id = null) {
        $this->Shop->id = $id;
        if (!$this->Shop->exists()) {
            throw new NotFoundException('Invalid shop');
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Shop->delete()) {
            $this->Session->setFlash('The shop has been deleted.');
        } else {
            $this->Session->setFlash('The shop could not be deleted. Please, try again.');
        }
        return $this->redirect(array('action' => 'index'));
    }

////////////////////////////////////////////////////////////

}
