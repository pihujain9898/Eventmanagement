<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Table\UsersTable;
use Cake\Event\EventInterface;

use Cake\Http\Response;
use Cake\Http\JsonResponseTrait;
use Cake\Utility\Hash;

use Cake\Http\Session;
use Cake\Http\Cookie\Cookie;
use Cake\I18n\FrozenTime;
use Cake\View\Helper\FormHelper;
use Firebase\JWT\JWT;

class DefaultController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['home', 'login', 'signup', 'view', 'tickets', 'ticket']);
        $this->Users = $this->getTableLocator()->get('Users');
        $this->Events = $this->getTableLocator()->get('Events');
        $this->Tickets = $this->getTableLocator()->get('Tickets');
        $this->autoRender = false; // Disable rendering of the view template
    }
    public function home(){
        $query = $this->Events->find()->contain(['Users', 'EventCategory']);
        $events = $this->paginate($query);
        // $this->set(compact('events'));
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode($events->toArray()));
        return $this->response;
    }  
    public function view($id = null)
    {
        $tickets = $this->fetchTable('Tickets')->find()
        ->contain(['Events.Users'])
        ->where(['event is' => $id ]);
        $event = $this->Events->get($id, contain: ['Users', 'EventCategory']);
        // $this->set(compact('event','tickets'));
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode(['event' => $event->toArray(), 'tickets' => $tickets->toArray()]));
        return $this->response;
    }
    public function tickets($event_id)
    {
        $query = $this->Tickets->find()->contain(['TicketCategory','Events.Users'])->where(['event IS' => $event_id]);
        $tickets = $this->paginate($query);        
        // $this->set(compact('tickets'));
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode( $tickets->toArray()));
        return $this->response;
    }
    public function ticket($id)
    {
        $ticket = $this->Tickets->get($id, ['contain' => ['TicketCategory','Events' => function ($q) {
            return $q->contain('Users');
        }]]);
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode( $ticket->toArray()));
        return $this->response;
    }
    // public function login(){
        // $result = $this->Authentication->getIdentity();    
        // // pr($result['id']);die;  
        // if (isset($result)) {
        //     $response = ['success' => true, 'message' => 'A user is already looged in.'];
        // }
        // $userTable = new UsersTable();            
        // if(isset($this->request->getData()['email']) && isset($this->request->getData()['password']) ){
        //     $user = $userTable->find()
        //     ->where(['email' => $this->request->getData()['email']])
        //     ->where(['password' => $this->request->getData()['password']])
        //     ->first();            
        // }
        // if (isset($user)) {
        //     $this->Authentication->setIdentity($user);
        //     $response = ['success' => true, 'message' => 'User logged in successfully.', 'data' => $user->toArray()];
        // } else {
        //     $response = ['success' => false, 'message' => 'Invalid login credentials.'];
        // }
        // $this->response = $this->response->withType('application/json');
        // $this->response = $this->response->withStringBody(json_encode($response));
        // return $this->response;
    public function login(){
        // $this->request->allowMethod('post', 'options');
        $userTable = new UsersTable();            
        if(isset($this->request->getData()['email']) && isset($this->request->getData()['password']) ){
            $user = $userTable->find()
            ->where(['email' => $this->request->getData()['email']])
            ->where(['password' => $this->request->getData()['password']])
            ->first();            
        } 
        if (isset($user)) {
            $this->Authentication->setIdentity($user);
            $privateKey = file_get_contents(CONFIG . '/jwt.key');
            $payload = [
                'sub' => $user->id,
                'exp' => time() + 60
            ];
            $json = [
                'token' => JWT::encode($payload, $privateKey, 'RS256'),
                'userEnt' =>$user,
                'message' => 'User logged in successfully'
            ];
            $statusCode = 200;
         } else {
            $statusCode = 401;
            $json = ['message' => 'Invalid user'];
        }        
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode($json));
        // $this->response = $this->response->withStatus($statusCode);
        return $this->response;
    }
    public function signup()
    {
        // pr($this->Authentication->getIdentity()); die;
        $data = $this->request->getData();
        $result = $this->Authentication->getIdentity();    
        $user = $this->Users->newEmptyEntity();
        if ($data) $data['fname'] = ucwords(strtolower($data['fname'])); 
        if ($data) $data['lname'] = ucwords(strtolower($data['lname'])); 
        $user = $this->Users->patchEntity($user, $data);
        if ($this->Users->save($user)) {
            $this->Authentication->setIdentity($user);
            $user = $this->Users->get($user->id);
            $privateKey = file_get_contents(CONFIG . '/jwt.key');
            $payload = [
                'sub' => $user->id,
                'exp' => time() + 60
            ];
            $response = [
                'token' => JWT::encode($payload, $privateKey, 'RS256'),
                'userEnt' =>$user,
                'message' => 'User signed up successfully'
            ];
            $statusCode = 200;
        }
        else{
            $statusCode = 401;
            $response = ['success' => false, 'message' => 'User could not be signed up'];
        }
            
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode($response));
        // $this->response = $this->response->withStatus($statusCode);
        return $this->response;
    }
    public function logout()
    {
        // pr("hello"); die;
        $this->Authentication->logout();
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode(['success' => true, 'message' => 'The user logged out successfully.']));
        return $this->response;
    }
}
