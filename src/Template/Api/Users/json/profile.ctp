<?php
$images = [];
if(!empty($data['user_images'])){
	foreach ($data['user_images'] as $key => $value) {		
		if(strpos($value['image'], 'http') === false){			
			$images[$key] = $this->Url->build('/',true).$value['image'];
		}
		else
			$images[$key] = $value['image'];
	}
}

$data['images'] = $images;
unset($data['user_images']);

$this->response->type('json');
echo json_encode(compact(['status', "message", 'data']));
$this->response->send();                        
?>