<?php
namespace App\Controller;

use App\Controller\AppController;

class LocationsController extends AppController {

////////////////////////////////////////////////////////////

    public function index() {
        $locations = $this->Locations->find('all', array(
            'limit' => 100,
            'conditions' => array(
                'Locations.active' => 1
            ),
            'order' => 'RAND()'
        ));
        $this->set(compact('locations'));

        $title_for_layout = 'Ice Hockey Pickup Games - kende.com';
        $description = 'Ice Hockey Pickup Games Organizer. Find Ice Hockey Pickup Games with kende.com';
        $keywords = 'ice hockey, pickup game, pickup hockey, open hockey';
        $this->set(compact('business', 'title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function view($slug = null) {

        $location = $this->Locations->find('all', [
            'conditions' => array(
                'Locations.slug' => $slug,
                'Locations.active' => 1,
            )
        ])->first();
        if(empty($location)) {
            return $this->redirect(array('action' => 'index'));
        }
        $this->set(compact('location'));

        // if ($this->request->is('post')) {
        //  $this->request->data['Review']['location_id'] = $location['Location']['id'];
        //  $this->request->data['Review']['ip_address'] = env('REMOTE_ADDR');
        //  $this->request->data['Review']['active'] = 1;
        //  $this->Location->Review->create();
        //  if ($this->Location->Review->save($this->request->data)) {
        //      $this->Session->setFlash('The review has been saved', 'flash_success');
        //      $this->redirect($this->referer());
        //  } else {
        //      $this->Session->setFlash('The review could not be saved. Please, try again.', 'flash_danger');
        //  }
        // }

        // $reviews = $this->Locations->Reviews->find('all', array(
        //  'recursive' => -1,
        //  'conditions' => array(
        //      'Reviews.location_id' => $location['Location']['id']
        //  ),
        //  'order' => array(
        //      'Reviews.created' => 'DESC'
        //  ),
        // ));
        // $this->set(compact('reviews'));

        // $this->Location->updateAll(
        //  array(
        //      'Location.views' => 'Location.views + 1',
        //  ),
        //  array('Location.id' => $location['Location']['id'])
        // );

        // $events = $this->Location->Event->find('all', array(
        //  'contain' => array('User'),
        //  'conditions' => array(
        //      'Event.location_id' => $location['Location']['id'],
        //      'Event.active' => 1,
        //      'Event.start_date >' => date('Y-m-d'),
        //  ),
        //  'order' => array(
        //      'Event.start_date' => 'ASC',
        //  )
        // ));
        // $this->set(compact('events'));

        $title_for_layout = $location->name . ', ' . $location->city . ' - Ice Hockey Pickup';
        $description = $location->name . ' - ' . $location->formatted_address . ' - Ice Hockey Pickup';
        $keywords = $location->name;

        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function autocomplete() {
        $search = null;
        if(!empty($this->request->query['term'])) {
            $search = $this->request->query['term'];
            $search = preg_replace('/[^a-zA-Z0-9-_ ]/', '', $search);
            $search = preg_replace('/\s\s+/', ' ', $search);
            $search = trim($search);

            $terms = explode(' ', trim($search));
            $terms = array_diff($terms, array(''));

            $locations = $this->Locations->find();
            $locations->select(["id", "name", "city", "state"]);

            foreach($terms as $term) {
                $locations->where(["name LIKE" => "%$term%"]);
            }

            $locations->limit(12);
            $locations->all();

        } else {
            $locations = null;
        }
        $this->autoRender = false;
        echo json_encode($locations);
    }

////////////////////////////////////////////////////////////

    public function search() {

        // $c = 0;
        // for ($i=0; $i < 201; $i++) {
        //  echo ".m_".$i."{background-position: -".$c."px 0;}\n";
        //  $c = $c + 25;
        // }
        // die;

        $name = '';
        $loc = '';
        $map = '';
        $lat = 0;
        $lng = 0;

        $distance = isset($this->request->query['distance']) ? $this->request->query['distance'] : 100;
        $unit = isset($this->request->query['unit']) ? $this->request->query['unit'] : 'm';

        if(!empty($this->request->query['name']) || !empty($this->request->query['loc'])) {

            $name = $this->request->query['name'];

            // if(!empty($this->request->query['name'])) {
            //  $name = $this->request->query['name'];
            //  $name = preg_replace('/[^a-zA-Z0-9_\-\,\' ]/', '', $name);
            //  $name = preg_replace('/\s\s+/', ' ', $name);
            //  $name = trim($name);
            //  $names = explode(' ', $name);
            //  $names = array_diff($names, array(''));
            //  foreach($names as $n) {
            //      $conditions .= " AND Locations.name LIKE '%" . addslashes($n) . "%'" ;
            //  }
            // }

            if(!empty($this->request->query['loc'])) {
                $loc = $this->request->query['loc'];
                $this->loadModel('Geocodes');
                if (!$code = $this->Geocodes->lookup(strtolower($loc))) {
                    $geolocation = $this->Geocodes->geocode($loc);
                    if($geolocation !== false) {
                        $geo = $this->Geocodes->newEntity();
                        $geo->address = strtolower($loc);
                        $geo->formatted_address = $geolocation['formatted_address'];
                        $geo->country_code = $geolocation['country_code'];
                        $geo->lat = $geolocation['lat'];
                        $geo->lng = $geolocation['lng'];
                        $geo->distance = $distance;
                        $geo->ip_address = env('REMOTE_ADDR');
                        $geo->count = 1;
                        $this->Geocodes->save($geo);
                        $lat = $geolocation['lat'];
                        $lng = $geolocation['lng'];
                        $formatted_address = $geolocation['formatted_address'];
                    } else {
                        $lat = 0;
                        $lng = 0;
                    }
                } else {
                    $geo = $this->Geocodes->newEntity();
                    $geo->id = $code->id;
                    $geo->distance = $distance;
                    $geo->ip_address = env('REMOTE_ADDR');
                    $geo->count = $code->count + 1;
                    $this->Geocodes->save($geo);
                    $lat = $code->lat;
                    $lng = $code->lng;
                    $formatted_address = $code->formatted_address;
                    $country_code = $code->country_code;
                }
            } else {

            }

            // $locations = $this->Locations->find();
            // $locations->where($conditions);
            // $locations->limit(200);
            // if (isset($lat) && isset($lng)) {
            //  $locations->order(['distance' => 'ASC', 'name' => 'ASC']);
            //  $locations->select(["name", "slug", "lat", "lng", "address", "city", "state", "postal_code", "phone", "distance" => "TRUNCATE((3958 * 3.1415926 * SQRT((`lat` - {$lat}) * (`lat` - {$lat}) + COS(`lat` / 57.29578) * COS({$lat} / 57.29578) * (`lng` - {$lng}) * (`lng` - {$lng})) / 180) * {$unit}, 1)"]);
            //  $locations->having("distance <= $distance");
            // }

            // if(!empty($locations)) {
            //  $search = true;
            //  $lats = array();
            //  $lngs = array();
            //  foreach($locations as $b) {
            //      if($b->lat != 0){
            //          $lats[] = $b->lat;
            //          $lngs[] = $b->lng;
            //          $map = true;
            //      }
            //  }
            //  if($map) {
            //      $minlat = min($lats);
            //      $maxlat = max($lats);
            //      $minlng = min($lngs);
            //      $maxlng = max($lngs);
            //      $this->set(compact('minlat', 'maxlat', 'minlng', 'maxlng'));
            //  }
            // }

            // $lat = 0;
            // $lng = 0;

            $map = true;

        } else {
            $locations = null;
        }

        $this->set(compact('name', 'loc', 'lat', 'lng', 'unit', 'distance', 'search', 'map', 'locations'));

        $title_for_layout = 'Ice Hockey Pickup Games - kende.com';
        $description = 'Ice Hockey Pickup Games Organizer. Find Ice Hockey Pickup Games with kende.com';
        $keywords = 'ice hockey, pickup game, pickup hockeu, open hockey';

        $this->set(compact('business', 'title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function liveupdate() {

        if(isset($this->request->query['lat']) && ($this->request->query['lat'] != 0)) {
            $lat = $this->request->query['lat'];
            $lng = $this->request->query['lng'];
        }

        $distance = isset($this->request->query['distance']) ? $this->request->query['distance'] : 0;
        $unit = isset($this->request->query['unit']) ? $this->request->query['unit'] : 'm';
        $unit = ($unit == 'km') ? 1.609344 : 1 ;

        $locations = $this->Locations->find();
        $locations->limit(200);

        if (isset($lat) && isset($lng)) {

            $locations->select(['id', 'name', 'slug', 'phone', 'address', 'city', 'state', 'postal_code', 'lat', 'lng']);
            $locations->order(['distance' => 'ASC', 'name' => 'ASC']);

            if(isset($this->request->query['swlat']) && ($this->request->query['swlat'] != 0)) {
                $locations->where(['Locations.lat >=' => $this->request->query['swlat']]);
                $locations->where(['Locations.lat <=' => $this->request->query['nelat']]);
                $locations->where(['Locations.lng >=' => $this->request->query['swlng']]);
                $locations->where(['Locations.lng <=' => $this->request->query['nelng']]);
                $distance = 0;
                $locations->order(['name' => 'ASC']);
            }

            if ($distance > 0 ) {
                $locations->order(['distance' => 'ASC', 'name' => 'ASC']);
                $locations->having("distance <= $distance");
            }

            $locations->select(["id", "name", "slug", "phone", "address", "city", "state", "postal_code", "lat", "lng", "distance" => "TRUNCATE((3958 * 3.1415926 * SQRT((`lat` - {$lat}) * (`lat` - {$lat}) + COS(`lat` / 57.29578) * COS({$lat} / 57.29578) * (`lng` - {$lng}) * (`lng` - {$lng})) / 180) * {$unit}, 1)"]);

        } else {
            $locations->order(['name' => 'ASC']);
            $locations->select(['id', 'name', 'slug', 'phone', 'address', 'city', 'state', 'postal_code', 'lat', 'lng']);
        }

        if(!empty($this->request->query['name'])) {
            $name = $this->request->query['name'];
            $name = preg_replace('/[^a-zA-Z0-9_\-\,\']/', '', $name);
            $name = preg_replace('/\s\s+/', ' ', $name);
            $name = trim($name);
            $names = explode(' ', $name);
            $names = array_diff($names, array(''));
            foreach($names as $n) {
                $locations->where(['Locations.name LIKE' => "%$name%"]);
            }

        }

        $locations->all();
        // debug($locations->toArray());
        // debug($locations);
        // die;

        echo json_encode($locations);
        die;

    }

////////////////////////////////////////////////////////////

}