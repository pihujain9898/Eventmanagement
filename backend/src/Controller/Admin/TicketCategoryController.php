<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * TicketCategory Controller
 *
 * @property \App\Model\Table\TicketCategoryTable $TicketCategory
 */
class TicketCategoryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->TicketCategory->find();
        $ticketCategory = $this->paginate($query);

        $this->set(compact('ticketCategory'));
    }

    /**
     * View method
     *
     * @param string|null $id Ticket Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticketCategory = $this->TicketCategory->get($id, contain: []);
        $this->set(compact('ticketCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ticketCategory = $this->TicketCategory->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['name'] = ucwords(strtolower($data['name']));
            $ticketCategory = $this->TicketCategory->patchEntity($ticketCategory, $data);
            if ($this->TicketCategory->save($ticketCategory)) {
                $this->Flash->success(__('The ticket category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ticket category could not be saved. Please, try again.'));
        }
        $this->set(compact('ticketCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticketCategory = $this->TicketCategory->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['name'] = ucwords(strtolower($data['name']));
            $ticketCategory = $this->TicketCategory->patchEntity($ticketCategory, $data);
            if ($this->TicketCategory->save($ticketCategory)) {
                $this->Flash->success(__('The ticket category has been saved.'));

                // return $this->redirect(['action' => 'index']);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The ticket category could not be saved. Please, try again.'));
        }
        $this->set(compact('ticketCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticketCategory = $this->TicketCategory->get($id);
        if ($this->TicketCategory->delete($ticketCategory)) {
            $this->Flash->success(__('The ticket category has been deleted.'));
        } else {
            $this->Flash->error(__('The ticket category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
