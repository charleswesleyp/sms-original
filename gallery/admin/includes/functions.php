

<?php

    function classAutoLoad($class){

        $class = strtolower($class);

        $path = "includes/{$class}.php" ;

        if(file_exists($path)){
            require_once ($path);
        }else{
            die("Cannot be found $class.php");
        }

    }

    spl_autoload_register("classAutoLoad");



    ?>