<?php
    // pr($ticket); die;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ticket'), ['action' => 'edit', $event_id, $ticket->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tickets'), ['action' => 'index', $event_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ticket'), ['action' => 'add', $event_id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tickets view content">
            <h3><?= $ticket->event_association->name.' Ticket: '.h($ticket->name) ?></h3>
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
                    <td><?= $ticket->ticketCategory_association->name ?></td>
                </tr>
                <tr>
                    <th><?= __('Event') ?></th>
                    <td><?= $ticket->event_association->name ?></td>
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
