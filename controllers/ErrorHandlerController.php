<?php

/**
 * Class HelpersController
 */
class ErrorHandlerController{

    /**
     *  Display errors on page.
     */
    public static function get(){
        if(isset($_SESSION['errors']))
        {
            foreach($_SESSION['errors'] as $i => $error)
            {
                //ToDo: Remove HTML from method..
                echo "<div class='alert alert-danger'>";
                foreach($error as $key => $val)
                {
                    echo "{$val}<br>";
                }
                echo "</div>";
            }
            return true;
        }
        return false;
    }

    //ToDo: Add timelife for errors.
}