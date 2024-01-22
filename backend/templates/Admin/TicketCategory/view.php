<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TicketCategory $ticketCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ticket Category'), ['action' => 'edit', $ticketCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ticket Category'), ['action' => 'delete', $ticketCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticketCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ticket Category'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ticket Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="ticketCategory view content">
            <h3><?= "Ticket Category: ".h($ticketCategory->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($ticketCategory->name) ?></td>
                </tr>
                <tr>
                    <th>Ticket <?= __('Id') ?></th>
                    <td><?= $this->Number->format($ticketCategory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($ticketCategory->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($ticketCategory->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
