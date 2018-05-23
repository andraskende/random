<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller {

    public $components = [
        // 'Session',
        'Flash',
        'Auth' => [
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login',
                'prefix' => false,
            ],
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email']
                    // 'passwordHasher' => 'Default',
                ]
            ],
            'authorize' => ['Controller']
        ]
    ];

    public function beforeFilter(Event $event) {

        $authuser = $this->Auth->user();
        $this->set(compact('authuser'));

        if(isset($this->request->params['prefix']) && ($this->request->params['prefix'] == 'admin')) {
            // if(isset($authUser)) {
            $this->layout = 'admin';
            // }
        } elseif(isset($this->request->params['prefix']) && ($this->request->params['prefix'] == 'organizer')) {
            $this->layout = 'organizer';
        } else {
            $this->Auth->allow();
        }


    }

    public function isAuthorized($user) {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        if (isset($user['role']) && $user['role'] === 'organizer') {
            return true;
        }
        return false;
    }

}
