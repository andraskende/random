<?php
namespace App\Controller;

use App\Controller\AppController;


class CitiesController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'order' => [
                'Cities.city'
            ],
            'limit' => 100,
        ];
        $cities = $this->paginate($this->Cities);
        $this->set(compact('cities'));
    }


////////////////////////////////////////////////////////////

    public function map() {

        if($this->request->getQuery('latitude') && ($this->request->getQuery('latitude') != 0)) {
            $latitude = $this->request->getQuery('latitude');
            $longitude = $this->request->getQuery('longitude');
        }

        $location = $this->request->getQuery('location');

        $distance = $this->request->getQuery('distance') ? $this->request->getQuery('distance') : 6;
        $unit = $this->request->getQuery('unit') ? $this->request->getQuery('unit') : 'm';
        $unit = ($unit == 'km') ? 1.609344 : 1 ;

        $cities = $this->Cities->find();
        $cities->limit(200);

        if (isset($latitude) && isset($longitude)) {

            $cities->select(['id', 'city', 'latitude', 'longitude']);
            $cities->order(['distance' => 'ASC', 'city' => 'ASC']);

            if ($distance > 0 ) {
                $cities->order(['distance' => 'ASC', 'city' => 'ASC']);
                $cities->having("distance <= $distance");
            }

            $cities->select(["id", "city", "latitude", "longitude", "distance" => "TRUNCATE((3958 * 3.1415926 * SQRT((`latitude` - {$latitude}) * (`latitude` - {$latitude}) + COS(`latitude` / 57.29578) * COS({$latitude} / 57.29578) * (`longitude` - {$longitude}) * (`longitude` - {$longitude})) / 180) * {$unit}, 1)"]);

        }

        $cities->all();

        $locations = json_encode($cities);

        $this->set(compact('cities', 'locations', 'location', 'latitude', 'longitude', 'distance'));

    }

////////////////////////////////////////////////////////////

    public function view($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => []
        ]);

        $this->set('city', $city);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $city = $this->Cities->newEntity();
        if ($this->request->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $this->set(compact('city'));
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->Cities->patchEntity($city, $this->request->getData());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $this->set(compact('city'));
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('The city has been deleted.'));
        } else {
            $this->Flash->error(__('The city could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
