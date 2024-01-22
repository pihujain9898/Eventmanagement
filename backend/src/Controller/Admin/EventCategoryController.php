<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * EventCategory Controller
 *
 * @property \App\Model\Table\EventCategoryTable $EventCategory
 */
class EventCategoryController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->EventCategory->find();
        $eventCategory = $this->paginate($query);

        $this->set(compact('eventCategory'));
    }

    /**
     * View method
     *
     * @param string|null $id Event Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventCategory = $this->EventCategory->get($id, contain: []);
        $this->set(compact('eventCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventCategory = $this->EventCategory->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['name'] = ucwords(strtolower($data['name']));
            $eventCategory = $this->EventCategory->patchEntity($eventCategory, $data);
            if ($this->EventCategory->save($eventCategory)) {
                $this->Flash->success(__('The event category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event category could not be saved. Please, try again.'));
        }
        $this->set(compact('eventCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventCategory = $this->EventCategory->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['name'] = ucwords(strtolower($data['name']));
            $eventCategory = $this->EventCategory->patchEntity($eventCategory, $data);
            if ($this->EventCategory->save($eventCategory)) {
                $this->Flash->success(__('The event category has been saved.'));

                // return $this->redirect(['action' => 'index']);
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The event category could not be saved. Please, try again.'));
        }
        $this->set(compact('eventCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventCategory = $this->EventCategory->get($id);
        if ($this->EventCategory->delete($eventCategory)) {
            $this->Flash->success(__('The event category has been deleted.'));
        } else {
            $this->Flash->error(__('The event category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
