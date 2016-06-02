<?php

print_r($Url);

$Url[1] = (empty($Url[1]) ? null : $Url[1]);
/*
if (file_exists(REQUIRE_PATH . '/' . $Url[0] . '.php')) {
    require REQUIRE_PATH . '/' . $Url[0] . '.php';
} elseif (file_exists(REQUIRE_PATH . '/' . $Url[0] . '/' . $Url[1] . '.php')) {
    require REQUIRE_PATH . '/' . $Url[0] . '/' . $Url[1] . '.php';
} else {
    require REQUIRE_PATH . '/' . '404.php';
}*/
?>