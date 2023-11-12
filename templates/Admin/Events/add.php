<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="events form content">
            <?= $this->Form->create($event, ['enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <legend><?= __('Add Event') ?></legend>
                <?php
                    echo $this->Form->control('name');
                ?>

                <!-- echo $this->Form->control('image'); -->
                <?= $this->Form->label('image', 'Event Image', ['class' => 'control-label']) ?>
                <?= $this->Form->file('image', ['id' => 'image', 'accept' => 'image/*']) ?>

                <?php
                    echo $this->Form->control('introduction');
                    echo $this->Form->control('information');
                    echo $this->Form->control('notices');
                    echo $this->Form->control('policies');
                    echo $this->Form->control('start_time');
                    echo $this->Form->control('end_time');
                    // echo $this->Form->control('category');
                    // echo $this->Form->control('created_by');
                    // echo $this->Form->control('created_at');
                    // echo $this->Form->control('updated_at');
                ?>

                <?= $this->Form->label('category', 'Select Event Category', ['class' => 'control-label']) ?>
                <?= $this->Form->select('category', $eventCategory, ['empty' => true, 'label' => 'Select Category', 'class' => 'form-control']) ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
