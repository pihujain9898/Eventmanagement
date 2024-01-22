<?php
    $user_name = $booking->ticket_association->event_association->user->fname;
    $l_name = $booking->ticket_association->event_association->user->lname;
    $user_name = $l_name != "" ? $user_name ." ".$l_name : $user_name;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('All Bookings'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Place one more booking'), ['action' => 'add', $booking->ticket], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="bookings view content">
            <h3><?= h($booking->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Booking ID') ?></th>
                    <td><?= $this->Number->format($booking->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ticket ID') ?></th>
                    <td><?= $this->Number->format($booking->ticket) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Name') ?></th>
                    <td><?= $user_name ?></td>
                </tr>
                <tr>
                    <th><?= __('Event') ?></th>
                    <td><?= $booking->ticket_association->event_association->name ?></td>
                </tr>
                <tr>
                    <th><?= __('Ticket Name') ?></th>
                    <td><?= $booking->ticket_association->name ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($booking->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Individual Ticket Price') ?></th>
                    <td><?= $this->Number->format($booking->individual_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Ticket Price') ?></th>
                    <td><?= $this->Number->format($booking->quantity) * $this->Number->format($booking->individual_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($booking->created_at) ?></td>
                </tr>        
            </table>
        </div>
    </div>
</div>
