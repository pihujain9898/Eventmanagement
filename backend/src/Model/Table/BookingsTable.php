<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class BookingsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->belongsTo('Tickets', [
            'foreignKey' => 'ticket',
            'propertyName' => 'ticket_association'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->requirePresence('user', 'create')
            ->notEmptyString('user');

        $validator
            ->requirePresence('ticket', 'create')
            ->notEmptyString('ticket');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity')
            ->add('quantity', 'limit_check', [
                'rule' => function ($value, $context) {
                    $ticketId = $context['data']['ticket'];
                    $ticketsTable = TableRegistry::getTableLocator()->get('Tickets');
                    $ticket = $ticketsTable->get($ticketId, ['fields' => ['max_purchase_value']]);
                    $ticketLimit = $ticket->max_purchase_value;
                    return $value <= $ticketLimit;
                },
                'message' => 'Tickets purcahse limit exceed.',])
            ->add('quantity', 'avilability_check', [
                'rule' => function ($value, $context) {
                    $ticketId = $context['data']['ticket'];
                    $ticketsTable = TableRegistry::getTableLocator()->get('Tickets');
                    $ticket = $ticketsTable->get($ticketId, ['fields' => ['avilable_quantity']]);
                    $ticketLimit = $ticket->avilable_quantity;
                    return $value < $ticketLimit;
                },
                'message' => 'Out of stock.',
            ]);

        $validator
            ->integer('individual_price')
            ->requirePresence('individual_price', 'create')
            ->notEmptyString('individual_price');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }
}
