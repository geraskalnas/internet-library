<?php

require_once(realpath(dirname(__FILE__) . '/../config/core.php'));

function renderLayout($contentFiles=array(), $variables=array()){
    foreach ($variables as $key => $value) {
        if (strlen($key) > 0) {
            ${$key} = $value;
        }
    }

    foreach ($contentFiles as $contentFile){
        require_once(TEMPLATES_PATH . '/' . $contentFile);
    }
}

?>