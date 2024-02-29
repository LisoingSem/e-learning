<?php

$greetings = [];

foreach (range('a','z') as $char) {
   $path = "alphabet/en_".$char.".php";
   $file_path = resource_path('../lang/en/'.$path);
   if(file_exists($file_path)) {
     include($path);
     $arr = "en_".$char;
     $arr = $$arr;
     $greetings = array_merge($greetings, $arr);
   }
}

// $file_path = resource_path('lang/en/en_other.php');
// include($file_path);

// $greetings = array_merge($greetings, $en_other);

return $greetings;
