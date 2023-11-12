<?php
declare(strict_types=1);

namespace App\Controller\Organiser;
use Cake\Event\EventInterface;
use App\Controller\AppController;

class TicketsController extends AppController
{
    public function beforeFilter(EventInterface $event){
        $ticketCategory = $this->fetchTable('TicketCategory')->find()->all();
        foreach ($ticketCategory as $category) {
            $temp[$category['id']] = $category['name'];
        }
        $ticketCategory = $temp;
    
        $events = $this->fetchTable('Events')->find()->where(['created_by' => $this->Authentication->getIdentity()['id']])->all();
        foreach ($events as $event) {
            $temp2[$event['id']] = $event['name'];
        }
        $events = $temp2;
        $this->events = $events;
        $this->set(compact('ticketCategory', 'events'));
    }

    public function index($event_id)
    {
        $query = $this->Tickets->find()->contain(['Events.Users', 'TicketCategory'])
        ->where(['event IS' => $event_id ,'Events.created_by' => $this->Authentication->getIdentity()['id']]);
        $tickets = $this->paginate($query);
        $this->set(compact('tickets','event_id'));
    }
    public function view($event_id, $id = null)
    {
        $ticket = $this->Tickets->get($id, ['contain' => ['TicketCategory', 'Events' => function ($q) use ($event_id) {
            return $q->contain('Users')->where([
                'Events.created_by' => $this->Authentication->getIdentity()['id'], 'Events.id IS' => $event_id,
            ]);
        }]]);
        $this->set(compact('ticket', 'event_id'));
    }
    public function add($event_id)
    {
        if(in_array($event_id, array_keys($this->events))){
            $ticket = $this->Tickets->newEmptyEntity();
            if ($this->request->is('post')) {
                $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());

                if ($this->Tickets->save($ticket)) {
                    $this->Flash->success(__('The ticket has been saved.'));

                    return $this->redirect(['action' => 'index', $event_id]);
                }
                $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
            }
            $this->set(compact('ticket', 'event_id'));
        } else{
            $this->Flash->error(__('Unauthorized access.'));
            return $this->redirect(['prefix' => false, 'controller' => 'Default', 'action' => 'home']);
        }



    }
    public function edit($event_id, $id = null)
    {
        if(in_array($event_id, array_keys($this->events))){
            $ticket = $this->Tickets->get($id, ['contain' => ['Events' => function ($q) use ($event_id) {
                return $q->contain('Users')->where([
                    'Events.created_by' => $this->Authentication->getIdentity()['id'], 'Events.id IS' => $event_id,
                ]);
            }]]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $ticket = $this->Tickets->patchEntity($ticket, $this->request->getData());
                if ($this->Tickets->save($ticket)) {
                    $this->Flash->success(__('The ticket has been saved.'));

                    return $this->redirect(['action' => 'index', $event_id]);
                }
                $this->Flash->error(__('The ticket could not be saved. Please, try again.'));
            }
            $this->set(compact('ticket', 'event_id'));
        } else{
                $this->Flash->error(__('Unauthorized access.'));
                return $this->redirect(['prefix' => false, 'controller' => 'Default', 'action' => 'home']);
        }
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->get($id);
        if ($this->Tickets->delete($ticket)) {
            $this->Flash->success(__('The ticket has been deleted.'));
        } else {
            $this->Flash->error(__('The ticket could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
