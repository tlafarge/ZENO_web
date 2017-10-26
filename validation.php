

<?php


$params = array();
parse_str($_POST["data"], $params);

foreach($params as $key => $value) {
//	if (!is_array($value))
		$params[$key] = htmlentities($value, ENT_QUOTES);
}
var_dump($params);



?>
