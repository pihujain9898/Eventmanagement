<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Event> $events
 */
?>
<div class="events index content">
    <?= $this->Html->link(__('New Event'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Events') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= "SNo" ?></th>
                    <!-- <th><?= $this->Paginator->sort('id') ?></th> -->
                    <th>Event <?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th><?= $this->Paginator->sort('introduction') ?></th>
                    <th><?= $this->Paginator->sort('information') ?></th>
                    <th><?= $this->Paginator->sort('notices') ?></th>
                    <th><?= $this->Paginator->sort('policies') ?></th>
                    <th><?= $this->Paginator->sort('start_time') ?></th>
                    <th><?= $this->Paginator->sort('end_time') ?></th>
                    <th><?= $this->Paginator->sort('category') ?></th>
                    <th><?= $this->Paginator->sort('created_by') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <!-- <?php pr($users) ?> -->
            <tbody>
                <?php foreach ($events as $key => $event): ?>
                <tr>
                    <td><?= h($key+1) ?></td>
                    <!-- <td><?= $this->Number->format($event->id) ?></td> -->
                    <td><?= h($event->name) ?></td>
                    <?php $eventimg = $event->image ? $event->image : 'default.jpg'; ?>
                    <td><img <?php echo 'src="'.$this->Url->webroot('uploads/' . $eventimg ).'" alt="'.$event->name.' Image"' ?>></td>
                    <td><?= h($event->introduction) ?></td>
                    <td><?= h($event->information) ?></td>
                    <td><?= h($event->notices) ?></td>
                    <td><?= h($event->policies) ?></td>
                    <td><?= h($event->start_time) ?></td>
                    <td><?= h($event->end_time) ?></td>
                    <td><?= $eventCategory[$this->Number->format($event->category)] ?></td>
                    <td><?= $users[$this->Number->format($event->created_by)] ?></td>
                    <td><?= h($event->created_at) ?></td>
                    <td><?= h($event->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $event->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $event->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?>
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
