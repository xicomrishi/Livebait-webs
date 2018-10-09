<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Shares Model
 *
 * @method \App\Model\Entity\Share get($primaryKey, $options = [])
 * @method \App\Model\Entity\Share newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Share[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Share|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Share patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Share[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Share findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SharesTable extends Table
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

        $this->setTable('shares');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sender', [
                'foreignKey' => 'fromuser',
                'joinType' => 'INNER',
                'className' => 'Users'
            ]);

        $this->belongsTo('Receiver', [
                'foreignKey' => 'touser',
                'joinType' => 'INNER',
                'className' => 'Users'
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
            ->allowEmpty('id', 'create');

        $validator
            ->integer('touser')
            ->requirePresence('touser', 'create')
            ->notEmpty('touser');

        $validator
            ->integer('fromuser')
            ->requirePresence('fromuser', 'create')
            ->notEmpty('fromuser');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->scalar('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        return $validator;
    }

    public function add($data = [])
    {
        $new = $this->newEntity();
        $new['touser'] = $data['to'];
        $new['fromuser'] = $data['from'];
        $new['type'] = $data['type'];
        $new['data'] = json_encode($data['data']);
        $this->save($new);
        
        
    }
}
