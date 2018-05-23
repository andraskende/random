<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Email\Email;
use Cake\Utility\String;
// use Cake\Auth\DefaultPasswordHasher;

class UsersController extends AppController {

////////////////////////////////////////////////////////////

    public function signup() {

        $user = $this->Users->newEntity($this->request->data);
        $this->set(compact('user'));

        if ($this->request->is('post')) {

            if(!in_array($this->request->data['role'], array('player', 'organizer'))) {
                $this->Flash->error('Invalid Role. Please, try again.');
                return $this->redirect(array('action' => 'login'));
            }

            $user->active = 1;
            $user->password_clear = $this->request->data['password'];

            if ($this->Users->save($user)) {

                $email = new Email();
                $email->from(array('info@kende.com' => 'kende.com'))
                    ->transport('default')
                    ->sender('info@kende.com', 'kende.com')
                    ->domain('www.kende.com')
                    ->emailFormat('html')
                    ->template('signup', 'default')
                    ->viewVars(array('user' => $this->request->data))
                    ->to($this->request->data['email'])
                    ->subject('kende.com Sign Up')
                    ->send();

                $this->Flash->success('The user has been saved');
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }

        $title_for_layout = 'Sign Up for account - kende.com';
        $description = 'Sign Up for account - kende.com';
        $keywords = 'kende.com';

        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function event($id) {
        $this->request->session()->write('auth_redirect', (integer) $id);
        // $this->Session->write('auth_redirect', (integer) $id);
        return $this->redirect(array('action' => 'login'));
    }

////////////////////////////////////////////////////////////

    public function login() {

        // $passwordHasher = new DefaultPasswordHasher();
        // echo $passwordHasher->hash('ak');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();

            if ($user) {

                $this->Auth->setUser($user);

                if ($user['role'] == 'player') {

                    if($this->request->session()->read('auth_redirect')) {
                        return $this->redirect(array(
                            'controller' => 'events',
                            'action' => 'view',
                            $this->request->session()->read('auth_redirect')
                        ));
                    }

                    return $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'dashboard',
                    ));
                }

                if ($user['role'] == 'organizer') {
                    return $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'dashboard',
                        'prefix' => 'organizer',
                    ));
                }

                if ($user['role'] == 'admin') {
                    return $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'index',
                        'prefix' => 'admin',
                    ));
                }

            } else {
                $this->Flash->error('Username or password is incorrect', 'default', [], 'auth');
            }
        }

        $title_for_layout = 'Sign in -  kende.com';
        $description = '';
        $keywords = '';
        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function logout() {
        $this->Flash->success('Good-Bye');
        return $this->redirect($this->Auth->logout());
    }

////////////////////////////////////////////////////////////

    public function reset($token = null) {

        if (empty($token)) {
            if (!empty($this->request->data)) {

                $user = $this->Users->find('all', array(
                    'conditions' => array(
                        'Users.active' => 1,
                        'Users.email' => $this->request->data['email']
                    )
                ))->first();

                if (!empty($user)) {
                    $u = $this->Users->newEntity();
                    $u->uuid = String::uuid();
                    $u->id = $user->id;
                    $this->Users->save($u);

                    $Email = new Email();
                    $Email->from(array('info@kende.com' => 'kende.com'))
                        ->transport('default')
                        ->sender('info@kende.com', 'kende.com')
                        ->domain('www.kende.com')
                        ->emailFormat('html')
                        ->template('passwordreset', 'default')
                        ->viewVars(array('user' => $user, 'u' => $u))
                        ->to($user->email)
                        ->subject('kende.com Password Reset')
                        ->send();

                    $this->Flash->success('Check your email to continue to reset your password');
                    return $this->redirect(array('action' => 'login'));
                } else {
                    $this->Flash->error('Email has not been found.');
                    return $this->redirect(array('action' => 'reset'));
                }

            }
        } else {

            $user = $this->Users->find('all', array(
                'conditions' => array(
                    'Users.active' => 1,
                    'Users.uuid' => $token
                )
            ))->first();
            if(empty($user)) {
                $this->Flash->error('Invalid token.');
                return $this->redirect(array('action' => 'reset'));
            }

            if (!empty($this->request->data)) {
                if (!empty($user)) {
                    $u = $this->Users->newEntity();
                    $u->id = $user->id;
                    $u->password = $this->request->data['password'];
                    $u->password_clear = $this->request->data['password'];
                    $u->uuid = '';
                    $this->User->save($u);
                    $this->Flash->success('The password has been reset.');
                    return $this->redirect(array('action' => 'login'));
                } else {
                    $this->Flash->error('Invalid request');
                    return $this->redirect(array('action' => 'reset'));
                }

            }

            $this->render('request_password');
        }
    }

////////////////////////////////////////////////////////////

    public function dashboard() {

        if(!$this->Auth->user('id')) {
            return $this->redirect(array('action' => 'login'));
        }

        // if($this->Session->check('auth_redirect')) {
        //     $auth_redirect = $this->Session->read('auth_redirect');
        //     $this->Session->delete('auth_redirect');
        //     return $this->redirect('/events/view/' . $auth_redirect);
        // }

        $user = $this->Users->find('all', array(
            'conditions' => array(
                'Users.id' => $this->Auth->user('id'),
                'Users.active' => 1
            )
        ))->first();
        $this->set(compact('user'));

        $registrations = $this->Users->Registrations->find('all', array(
            'select' => array(
                'Registrations.id',
                'Registrations.price',
                'Registrations.active',
                'Registrations.created',
                'Events.start_date',
                'Locations.*',
            ),
            'contain' => array(
                'Events',
                'Locations',
            ),
            'conditions' => array(
                'Registrations.user_id' => $this->Auth->user('id'),
                'Registrations.active' => 1,
            ),
            'order' => array(
                'Events.start_date' => 'DESC'
            ),
        ));
        $this->set(compact('registrations'));

        $title_for_layout = 'dashboard - kende.com';
        $description = '';
        $keywords = '';
        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

    public function profile($slug = null) {

        $user = $this->Users->find('all', array(
            'conditions' => array(
                'Users.slug' => $slug,
                'Users.active' => 1,
                // 'Users.role' => 'organizer',
            )
        ))->first();
        $this->set(compact('user'));

        $events = $this->Users->Events->find('all', array(
            'contain' => array(
                'Locations',
            ),
            'conditions' => array(
                'Events.user_id' => $user->id,
                'Events.start_date > ' => date('Y-m-d'),
                'Events.active' => 1,
            ),
            'order' => array(
                'Events.start_date' => 'ASC'
            ),
        ));
        $this->set(compact('events'));

        $title_for_layout = 'kende.com';
        $description = 'kende.com';
        $keywords = 'kende.com';

        $this->set(compact('title_for_layout', 'description', 'keywords'));

    }

////////////////////////////////////////////////////////////

}
