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
            <?= $this->Html->link(__('List Event Category'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="eventCategory form content">
            <?= $this->Form->create($eventCategory) ?>
            <fieldset>
                <legend><?= __('Add Event Category') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    // echo $this->Form->control('created_at');
                    // echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
