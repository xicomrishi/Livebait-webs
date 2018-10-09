<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReportSpams Model
 *
 * @property \App\Model\Table\RequestsTable|\Cake\ORM\Association\BelongsTo $Requests
 *
 * @method \App\Model\Entity\ReportSpam get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReportSpam newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReportSpam[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReportSpam|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReportSpam patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReportSpam[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReportSpam findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportSpamsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('report_spams');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Requests', [
            'foreignKey' => 'request_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('FromUser', [
            'className' => "Users",
            'foreignKey' => 'fromuser',
            'joinType' => 'INNER'
        ]);

         $this->belongsTo('ToUser', [
            'className' => "Users",
            'foreignKey' => 'touser',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->integer('fromuser')
            ->requirePresence('fromuser', 'create')
            ->notEmpty('fromuser');

        $validator
            ->integer('touser')
            ->requirePresence('touser', 'create')
            ->notEmpty('touser');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['request_id'], 'Requests'));

        return $rules;
    }
}
