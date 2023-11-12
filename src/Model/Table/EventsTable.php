<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('events');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
        ]);
        $this->belongsTo('EventCategory', [
            'foreignKey' => 'category',
            'propertyName' => 'eventCategory_association'
        ]);
    }
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 29)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('image')
            ->maxLength('image', 255)
            ->allowEmptyFile('image');

        $validator
            ->scalar('introduction')
            ->maxLength('introduction', 179)
            ->requirePresence('introduction', 'create')
            ->notEmptyString('introduction');

        $validator
            ->scalar('information')
            ->maxLength('information', 255)
            ->requirePresence('information', 'create')
            ->notEmptyString('information');

        $validator
            ->scalar('notices')
            ->maxLength('notices', 255)
            ->requirePresence('notices', 'create')
            ->notEmptyString('notices');

        $validator
            ->scalar('policies')
            ->maxLength('policies', 255)
            ->requirePresence('policies', 'create')
            ->notEmptyString('policies');

        $validator
            ->dateTime('start_time')
            ->requirePresence('start_time', 'create')
            ->notEmptyDateTime('start_time')
            ->add('start_time', 'validStarttime', [
                'rule' => function ($value) {
                    $startTime = new \DateTime($value);
                    $currentTime = new \DateTime();
                    return $startTime >= $currentTime;
                },
                'message' => 'Event in past date can not be created.'
            ]);

        $validator
            ->dateTime('end_time')
            ->requirePresence('end_time', 'create')
            ->notEmptyDateTime('end_time')
            ->add('end_time', 'greaterThanStarttime', [
                'rule' => function ($value, $context) {
                    $startTime = new \DateTime($context['data']['start_time']);
                    $endTime = new \DateTime($value);
                    return $endTime > $startTime;
                },
                'message' => 'End time of event should be greater than start time.'
            ]);

        $validator
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

        $validator
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->notEmptyDateTime('updated_at');

        return $validator;
    }
}
