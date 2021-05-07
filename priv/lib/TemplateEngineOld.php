<?php
    require_once(realpath(dirname(__FILE__) . "/../config.php"));
 
    function renderLayoutWithContentFile($contentFile, $variables = array(), $errors=array())
    {
        $contentFileFullPath = TEMPLATES_PATH . "/" . $contentFile;

        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }
        
        include_once("dbConnect.php");
    	if($errors==0){
    		include_once("classesConnect.php");
    	}
    	
        require_once(TEMPLATES_PATH . "/header.php");
     
        echo "<div id=\"container\">\n";
        
        require_once(TEMPLATES_PATH . "/leftPanel.php");
        
        echo "\t<div id=\"content\">\n";
    	
        if (file_exists($contentFileFullPath)) {
            require_once($contentFileFullPath);
        } else {
            array_push($errors, "404 - File not found error");
        }
        
        if (count($errors)>0){
        	require_once(TEMPLATES_PATH . "/error.php");
        }
        
        echo "\t</div>\n";
        
        echo "</div>\n";
        
        require_once(TEMPLATES_PATH . "/footer.php");
    }
?>