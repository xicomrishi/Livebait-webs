<?php

    namespace App\Model\Table;

    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    class RequestsTable extends Table {
        
        public function initialize(array $config) {
            $this->addBehavior('Timestamp');

            $this->belongsTo('UsersTo', [
                'foreignKey' => 'to_user_id',
                'joinType' => 'INNER',
                'className' => 'Users'
            ]);
            $this->belongsTo('UsersFrom', [
                'foreignKey' => 'from_user_id',
                'joinType' => 'INNER',
                'className' => 'Users'
            ]);
        }

        // public function validationDefault(Validator $validator) {            
        //     return $validator
        //             ->notEmpty('email', 'A email is required');                    
        // }

    }

?>