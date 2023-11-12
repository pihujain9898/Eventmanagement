<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\TicketCategory> $ticketCategory
 */
?>
<div class="ticketCategory index content">
    <?= $this->Html->link(__('New Ticket Category'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ticket Category') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= "SNo" ?></th>
                    <!-- <th><?= $this->Paginator->sort('id') ?></th> -->
                    <th>Category <?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ticketCategory as $key => $ticketCategory): ?>
                <tr>
                    <td><?= h($key+1) ?></td>
                    <!-- <td><?= $this->Number->format($ticketCategory->id) ?></td> -->
                    <td><?= h($ticketCategory->name) ?></td>
                    <td><?= h($ticketCategory->created_at) ?></td>
                    <td><?= h($ticketCategory->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ticketCategory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticketCategory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticketCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticketCategory->id)]) ?>
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
