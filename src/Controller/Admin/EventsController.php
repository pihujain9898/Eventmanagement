<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Utility\Text;
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
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function beforeFilter(EventInterface $event){
        $eventCategory = $this->fetchTable('EventCategory')->find()->all();
        foreach ($eventCategory as $category) {
            $temp[$category['id']] = $category['name'];
        }
        $eventCategory = $temp;
    
        $users = $this->fetchTable('Users')->find()->all();
        foreach ($users as $user) {
            $temp2[$user['id']] = $user['fname']." ".$user['lname'];
        }
        $users = $temp2;
        $this->set(compact('eventCategory', 'users'));
    }

    public function index()
    {
        $query = $this->Events->find();
        $events = $this->paginate($query);
        $this->set(compact('events'));
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, contain: []);
        $this->set(compact('event'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $event = $this->Events->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['created_by'] = $this->Authentication->getIdentity()['id'];
            $file = $this->request->getData('image');          
            if ($file->getSize() > 0) {
                $filename = Text::uuid() . '.' . pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);  
                $file->moveTo(WWW_ROOT . 'uploads' . DS . $filename);        
                $data['image'] = $filename;
            }
            else{
                $data['image'] = null;
            }

            $event = $this->Events->patchEntity($event, $data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $file = $this->request->getData('image');  
            if ($file->getSize() > 0) {
                $filename = Text::uuid() . '.' . pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);  
                $file->moveTo(WWW_ROOT . 'uploads' . DS . $filename);        
                $data['image'] = $filename;
            }
            else{
                $data['image'] = null;
            }

            $event = $this->Events->patchEntity($event, $data);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been updated.'));

                // return $this->redirect(['action' => 'index']);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $this->set(compact('event'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
