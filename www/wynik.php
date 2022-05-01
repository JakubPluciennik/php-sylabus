<?php
foreach($_POST as $key => $value)
{
    
    if (gettype($value) == "array")
    {
        echo $key .": <br>" . var_dump($value) . "<br>";
    }
    else{
        echo $key . ": " . $value . "<br>";
    }
}
?>