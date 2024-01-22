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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ticketCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ticketCategory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Ticket Category'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="ticketCategory form content">
            <?= $this->Form->create($ticketCategory) ?>
            <fieldset>
                <legend><?= __('Edit Ticket Category') ?></legend>
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
