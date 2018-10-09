<?php

    namespace App\Model\Table;

    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    class AdminsTable extends Table {
        
        public function initialize(array $config) {
            $this->addBehavior('Timestamp');
        }

        public function validationDefault(Validator $validator) {            
            return $validator
                    ->notEmpty('email', 'A email is required');                    
        }

    }

?>