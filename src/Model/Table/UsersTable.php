<?php

    namespace App\Model\Table;

    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    class UsersTable extends Table {
        
        public function initialize(array $config) {
            $this->addBehavior('Timestamp');
            
            $this->hasMany('UserImages', [
                'foreignKey' => 'user_id',
                'joinType' => 'INNER'
            ]);
            
             $this->belongsTo('UserSettings', [
                'foreignKey' => 'id',
                'bindingKey' => 'user_id',
                'joinType' => 'LEFT'
            ]);
        }

        public function validationDefault(Validator $validator) {            
            return $validator
                    ->allowEmpty('email')                    
                    ->add('email', 'validFormat', ['rule' => 'email', 'message' => 'E-mail must be valid.']);
        }

        public function validationApiUpdate(Validator $validator) {            
            return $validator
                    ->notEmpty('age', 'Age required.')
                    ->notEmpty('username', 'Username required.')
                    ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', "message" => "Username is already existing"])
                    ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', "message" => "Email already existing"]);                    
        }

    }

?>