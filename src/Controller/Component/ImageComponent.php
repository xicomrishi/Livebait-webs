<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Image component
 */
class ImageComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function uploadImage($image = NULL, $dirPath = NULL, $appRelativePath = false){
        if(empty($image) || $image["error"] == 4)
            return false;
        $imageName = $image["name"];

        if(!is_dir(WWW_ROOT . $dirPath)){
            mkdir(WWW_ROOT . $dirPath, 0777, true);
        }

        // var_dump(WWW_ROOT . $dirPath . $imageName); exit;

        if(move_uploaded_file($image["tmp_name"], WWW_ROOT . $dirPath . $imageName)){
            if($appRelativePath){
                return $dirPath . $imageName;
            }
            return $imageName;
        }
        else
        {
            
        }

        return false;
    }
    
}
