<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Ticket> $tickets
 */
?>
<div class="tickets index content">
    <?=  $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add', $event_id], ['class' => 'button float-right']) ?>
    <h3><?= __('Tickets') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= "SNo" ?></th>
                    <!-- <th><?= $this->Paginator->sort('id') ?></th> -->
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('category') ?></th>
                    <th><?= $this->Paginator->sort('event') ?></th>
                    <th><?= $this->Paginator->sort('total_quantity') ?></th>
                    <th><?= $this->Paginator->sort('avilable_quantity') ?></th>
                    <th><?= $this->Paginator->sort('max_purchase_value') ?></th>
                    <th><?= $this->Paginator->sort('expiry') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $key => $ticket): ?>
                <tr>
                    <td><?= h($key+1) ?></td>
                    <!-- <td><?= $this->Number->format($ticket->id) ?></td> -->
                    <td><?= h($ticket->name) ?></td>
                    <td><?= h($ticket->description) ?></td>
                    <td><?= $this->Number->format($ticket->price) ?></td>
                    <td><?= $ticket->ticketCategory_association->name ?></td>
                    <td><?= $ticket->event_association->name ?></td>
                    <td><?= $this->Number->format($ticket->total_quantity) ?></td>
                    <td><?= $this->Number->format($ticket->avilable_quantity) ?></td>
                    <td><?= $this->Number->format($ticket->max_purchase_value) ?></td>
                    <td><?= h($ticket->expiry) ?></td>
                    <td><?= h($ticket->created_at) ?></td>
                    <td><?= h($ticket->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ticket->event, $ticket->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticket->event, $ticket->id]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
