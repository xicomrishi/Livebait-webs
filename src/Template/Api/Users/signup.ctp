<?php

if(isset($errors) && !empty($errors)){
	// $errors = $user->errors();
    foreach ($errors as $key => $error) {
        foreach ($error as $keyInner => $val) {
            $message = $val;
            break 2;
        }
    }
}
else{

	if(!empty($data)){
		$images = [];
	
		if(!empty($data['user_images'])){
			foreach ($data['user_images'] as $key => $value) {
				if(strpos($value['image'], 'http') === false){
					$images[$key] = $this->Url->build('/',true).$value['image'];
				}
				else{
					$images[$key] = $value['image'];
				}			
			}
		}

		unset($data['user_images']);

		if(!empty($data['profile_image']) && strpos($data['profile_image'], 'http') === false){
			$data['profile_image'] = $this->Url->build('/',true).$data['profile_image'];
		}

		if(!empty($images))
		   $data['images'] = $images;
		else{
			$data['images'] = [];
		}
	}
}

$this->response->type('json');
echo json_encode(compact(['status', "message", 'data']));
$this->response->send();                        
?>