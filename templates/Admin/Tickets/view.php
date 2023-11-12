<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ticket'), ['action' => 'edit', $ticket->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ticket'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tickets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ticket'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tickets view content">
            <h3><?= $events[$this->Number->format($ticket->event)].' Ticket: '.h($ticket->name) ?></h3>
            <table>
                <tr>
                    <th>Ticket <?= __('Name') ?></th>
                    <td><?= h($ticket->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($ticket->description) ?></td>
                </tr>
                <tr>
                    <th>Ticket <?= __('Id') ?></th>
                    <td><?= $this->Number->format($ticket->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($ticket->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $ticketCategory[$this->Number->format($ticket->category)] ?></td>
                </tr>
                <tr>
                    <th><?= __('Event') ?></th>
                    <td><?= $events[$this->Number->format($ticket->event)] ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Quantity') ?></th>
                    <td><?= $this->Number->format($ticket->total_quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Avilable Quantity') ?></th>
                    <td><?= $this->Number->format($ticket->avilable_quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Max Purchase Value') ?></th>
                    <td><?= $this->Number->format($ticket->max_purchase_value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Expiry') ?></th>
                    <td><?= h($ticket->expiry) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($ticket->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($ticket->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
