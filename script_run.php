<?php

if(isset($argv[1])){

    require_once('config.php');

    $task_file = $argv[1] . '.php';
    $task_class = $argv[1];

    require_once(DIR_TASKS . $task_file);

    $task = new $task_class();

} else {
    exit('Please, give me task file name and task class');
}
