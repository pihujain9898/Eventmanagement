<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Tickets Model
 *
 * @method \App\Model\Entity\Ticket newEmptyEntity()
 * @method \App\Model\Entity\Ticket newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ticket[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ticket get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ticket findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ticket patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ticket[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ticket|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ticket saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ticket[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TicketsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('tickets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->belongsTo('Events', [
            'foreignKey' => 'event',
            'propertyName' => 'event_association'
        ]);
        $this->belongsTo('TicketCategory', [
            'foreignKey' => 'category',
            'propertyName' => 'ticketCategory_association'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

        $validator
            ->requirePresence('event', 'create')
            ->notEmptyString('event');

        $validator
            ->integer('total_quantity')
            ->requirePresence('total_quantity', 'create')
            ->notEmptyString('total_quantity');

        $validator
            ->integer('avilable_quantity')
            ->requirePresence('avilable_quantity', 'create')
            ->notEmptyString('avilable_quantity')
            ->add('avilable_quantity', 'smallerThanTotalQty', [
                'rule' => function ($value, $context) {
                    $total_quantity = $context['data']['avilable_quantity'];
                    $avilable_quantity = $value;
                    return $avilable_quantity <= $total_quantity;
                },
                'message' => "Avilable quantity can't be greater than total quantity."
            ]);

        $validator
            ->integer('max_purchase_value')
            ->requirePresence('max_purchase_value', 'create')
            ->notEmptyString('max_purchase_value')
            ->add('max_purchase_value', 'smallerThanTotalQty', [
                'rule' => function ($value, $context) {
                    $total_quantity = $context['data']['total_quantity'];
                    $max_purchase_value = $value;
                    return $max_purchase_value <= $total_quantity;
                },
                'message' => "Maximum purchase value can't be greater than total quantity."
            ]);

        $validator
            ->dateTime('expiry')
            ->notEmptyDateTime('expiry')
            ->add('expiry', 'custom', [
                'rule' => function ($value, $context) {
                    $eventId = $context['data']['event'];
                    $eventsTable = TableRegistry::getTableLocator()->get('Events');
                    $event = $eventsTable->get($eventId, ['fields' => ['end_time']]);
                    $eventEndTime = $event->end_time->format('Y-m-d H:i:s');
                    $eventEndTime = new \DateTime($eventEndTime);
                    $value = new \DateTime($value);
                    return $value <= $eventEndTime && $value > new \DateTime();
                },
                'message' => 'Ticket expiry time should be lesser than or equal to the event end time and greater than the current timestamp.',
            ]);

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }
}
