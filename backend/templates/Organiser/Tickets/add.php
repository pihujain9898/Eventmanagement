<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ticket $ticket
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tickets'), ['action' => 'index', $event_id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tickets form content">
            <?= $this->Form->create($ticket) ?>
            <fieldset>
                <legend><?= __('Add Ticket') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('description');
                    echo $this->Form->control('price');
                ?>
                <?= $this->Form->label('category', 'Ticket Category', ['class' => 'control-label']) ?>
                <?= $this->Form->select('category', $ticketCategory, ['empty' => true, 'label' => 'Select Category', 'class' => 'form-control']) ?>

                <input type="hidden" name="event" value='<?php echo $event_id; ?>'>
                
                <?php                 
                    // echo $this->Form->control('category');
                    // echo $this->Form->control('event');
                    echo $this->Form->control('total_quantity');
                    echo $this->Form->control('avilable_quantity');
                    echo $this->Form->control('max_purchase_value');
                    echo $this->Form->control('expiry');
                    // echo $this->Form->control('created_at');
                    // echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    var expiryInput = document.querySelector('input[name="expiry"]');
    expiryInput.value = '';
</script>