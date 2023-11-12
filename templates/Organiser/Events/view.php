<?php 
    $name=$event->user->fname; 
    $lname=$event->user->lname; 
    $name=$lname!=''?$name." ".$lname : $name; 
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id], ['class' => 'side-nav-item']) ?>
            <?php // $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?php // $this->Html->link(__('New Event'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="events view content">
            <h3><?= "Event: ".h($event->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($event->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <?php $eventimg = $event->image ? $event->image : 'default.jpg'; ?>
                    <td><img class="admin-event-img" <?php echo 'src="'.$this->Url->webroot('uploads/' . $eventimg ).'" alt="'.$event->name.' Image"' ?>></td>
                </tr>
                <tr>
                    <th><?= __('Introduction') ?></th>
                    <td><?= h($event->introduction) ?></td>
                </tr>
                <tr>
                    <th><?= __('Information') ?></th>
                    <td><?= h($event->information) ?></td>
                </tr>
                <tr>
                    <th><?= __('Notices') ?></th>
                    <td><?= h($event->notices) ?></td>
                </tr>
                <tr>
                    <th><?= __('Policies') ?></th>
                    <td><?= h($event->policies) ?></td>
                </tr>
                <tr>
                    <th>Event <?= __('Id') ?></th>
                    <td><?= $this->Number->format($event->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $eventCategory[$this->Number->format($event->category)] ?></td>
                </tr>
                <tr>
                    <th><?= __('Created By') ?></th>
                    <td>
                        <?= $name ?>
                        <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $this->Number->format($event->created_by)]) ?> -->
                    </td>
                </tr>
                <tr>
                    <th><?= __('Start Time') ?></th>
                    <td><?= h($event->start_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Time') ?></th>
                    <td><?= h($event->end_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($event->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($event->updated_at) ?></td>
                </tr>
            </table>
            <div class="row">
                <h3 class="column column-50"><?= h($event->name). " Tickets" ?></h3>
                <!-- <div class=""><a>Add New</button></div> -->
                <?php if(sizeof($tickets->toArray())>0) 
                    echo $this->Html->link(__('All Tickets'), ['controller' => 'Tickets', 'action' => 'index', $event->id], ['class' => 'side-nav-item'])                 
                ?>                
                <?= $this->Html->link(__('New Ticket'), ['controller' => 'Tickets', 'action' => 'add', $event->id], ['class' => 'column column-50']) ?>
            </div>
            <div class="row" style="margin-top: 2rem;">
               
                <?php foreach ($tickets as $key => $ticket) { ?>
                    <div class="column column-30"><button class="btn">
                        <?= $this->Html->link(__(''.$ticket->name.''), ['controller' => 'Tickets', 'action' => 'view', $event->id, $ticket->id]) ?>
                    </button></div>                
                <?php } ?>
            </div>
        </div>
    </div>
</div>
