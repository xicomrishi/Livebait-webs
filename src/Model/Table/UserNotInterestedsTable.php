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
class UserNotInterestedsTable extends Table
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

        $this->setTable('user_not_interesteds');

        $this->addBehavior('Timestamp');

        
        $this->belongsTo('FromUser', [
            'className' => "Users",
            'foreignKey' => 'user_from',
            'joinType' => 'INNER'
        ]);

         $this->belongsTo('ToUser', [
            'className' => "Users",
            'foreignKey' => 'user_to',
            'joinType' => 'INNER'
        ]);
    }

    

    
}
