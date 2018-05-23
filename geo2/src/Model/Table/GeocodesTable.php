<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class GeocodesTable extends Table {

////////////////////////////////////////////////////////////

    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
    }

////////////////////////////////////////////////////////////

    public function lookup($address) {
        $geocode = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'Geocodes.address' => $address,
            )
        ))->first();
        if ($geocode) {
            return $geocode;
        }
        return false;
    }

////////////////////////////////////////////////////////////

    public function geocode($address, $region = null) {

        // $url = 'http://maps.google.com/maps/api/geocode/json?address=' . urlencode($address) . '&region=' . urlencode($region) . '&sensor=false';
        $url = 'http://maps.google.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=false';
        // echo $url;

        $response = @file_get_contents($url);

        if($response === false) {
            return false;
        }

        $response = json_decode($response);

        if($response->status != 'OK') {
            return false;
        }

        foreach ($response->results['0']->address_components as $data) {
            if($data->types['0'] == 'country') {
                $country = $data->long_name;
                $country_code = $data->short_name;
            }
        }

        $result = array(
            'lat'  => $response->results['0']->geometry->location->lat,
            'lng' => $response->results['0']->geometry->location->lng,
            'country' => $country,
            'country_code' => $country_code,
            'formatted_address' => $response->results['0']->formatted_address,
        );
        return $result;
    }

////////////////////////////////////////////////////////////

}
