<?php

    namespace App\Model\Table;

    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    class ContentsTable extends Table {
        
        public function initialize(array $config) {
            $this->addBehavior('Timestamp');
        }

        public function validationDefault(Validator $validator) {            
            return $validator
                    ->notEmpty('content','Content is required.')
                    ->notEmpty('heading','Heading is required.')                   
                    ->notEmpty('type','Type is required.');
                    
        }

    }

?>