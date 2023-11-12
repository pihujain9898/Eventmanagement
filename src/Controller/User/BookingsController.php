<?php
declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\AppController;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 */
class BookingsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Tickets = $this->getTableLocator()->get('Tickets');
    }
    public function index()
    {
        $query = $this->Bookings->find()
        ->contain(['Tickets.Events'])
        ->where(['user' => $this->Authentication->getIdentity()['id']]);
        $bookings = $this->paginate($query);        
        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode(['bookings' => $bookings->toArray()]));
        return $this->response;
    }
    public function view($id = null)
    {
        $booking = $this->Bookings->find()
        ->contain(['Tickets.Events.Users'])
        ->where(['Bookings.id' => $id, 'user' => $this->Authentication->getIdentity()['id']])->first();
        // pr($booking->toArray());die;
        $this->set(compact('booking'));
    }
    public function add($id)
    {
        $ticket = $this->Tickets->get($id, ['contain' => []]);
        $booking = $this->Bookings->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['user'] = $this->Authentication->getIdentity()['id'];
            $data['ticket'] = $id;
            $data['individual_price'] = intval($ticket->price);
            $booking = $this->Bookings->patchEntity($booking, $data);

            $avilable_quantity = $ticket->avilable_quantity - $data['quantity'];            
            $ticket = $this->Tickets->patchEntity($ticket, ['avilable_quantity' => $avilable_quantity]);
            
            // pr($ticket->toArray()); die;

            if ($this->Bookings->save($booking) && $this->Tickets->save($ticket)) {
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));


        }
        $this->set(compact('booking'));
    }

    /*
    public function edit($id = null)
    {
        $booking = $this->Bookings->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $this->set(compact('booking'));
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */
}
