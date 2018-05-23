<?php
namespace App\Controller\Organizer;

use App\Controller\AppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Locations']
        ];
        $this->set('events', $this->paginate($this->Events));
        $this->set('_serialize', ['events']);
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Users', 'Locations', 'Registrations']
        ]);
        $this->set('event', $event);
        $this->set('_serialize', ['event']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {


        $eventLast = $this->Events->find('all', array(
            'contain' => array(
                'Locations',
            ),
            'conditions' => array(
                'Events.user_id' => $this->Auth->user('id'),
            ),
            'order' => array(
                'Events.start_date' => 'DESC'
            )
        ))->first();
        if(!empty($eventLast)) {
            $location = $eventLast->location->id;
            $capacity = $eventLast->capacity;
            $price = $eventLast->price;
        } else {
            $location = '';
            $capacity = '';
            $price = '';
        }
        $this->set(compact('location', 'capacity', 'price'));


        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {

            $event->user_id = $this->request->session()->read('Auth.User.id');

            $event->start_date = $this->request->data['date'] . ' ' . $this->request->data['time']['hour'] . ':' . $this->request->data['time']['minute'] . ':00';

            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $locations = $this->Events->Locations->find('list', ['limit' => 2000]);
        $this->set(compact('event', 'locations'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $locations = $this->Events->Locations->find('list', ['limit' => 200]);
        $this->set(compact('event', 'users', 'locations'));
        $this->set('_serialize', ['event']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
