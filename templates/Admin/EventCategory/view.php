<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EventCategory $eventCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Event Category'), ['action' => 'edit', $eventCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Event Category'), ['action' => 'delete', $eventCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Event Category'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Event Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="eventCategory view content">
            <h3><?= "Event Category: ".h($eventCategory->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($eventCategory->name) ?></td>
                </tr>
                <tr>
                    <th>Event Category <?= __('Id') ?></th>
                    <td><?= $this->Number->format($eventCategory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($eventCategory->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($eventCategory->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
