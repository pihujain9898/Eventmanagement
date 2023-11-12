<?php
    // pr($ticket); die;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('All Tickets'), ['action' => 'tickets', $ticket->event_association->id], ['class' => 'side-nav-item']) ?>
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
            </table>
            <?= $this->Html->link(__('Book Now'), ['prefix' => 'User','controller' => 'Bookings', 'action' => 'add', $ticket->id], ['class' => 'button']) ?>
        </div>
    </div>
</div>
