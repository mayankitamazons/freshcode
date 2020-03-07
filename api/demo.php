<?php
$arr =     array(
        array('name' => 'John', 'age' => 101, 'website' => 'http://learnphp.co'),
        array('name' => 'Joe', 'age' => 10, 'website' => 'http://johnmorrisonline.com'),
		array('name' => 'Amy', 'age' => 101, 'website' => 'http://amy.com'),
		array('name' => 'Alex', 'age' => 113, 'website' => 'http://thealex.com'),
		array('name' => 'Pat', 'age' => 104, 'website' => 'http://patsjourney.com'),
);

?>

<pre><?php print_r($arr); ?></pre>

<?php
	array_multisort($arr);
?>

<pre><?php print_r($arr); ?></pre>

<?php
	function val_sort($array,$key) {

	//Loop through and get the values of our specified key
	foreach($array as $k=>$v) {
		$b[] = strtolower($v[$key]);
	}

	print_r($b);

	asort($b);

	echo '<br />';
	print_r($b);

	foreach($b as $k=>$v) {
		$c[] = $array[$k];
	}

	return $c;
}
$sorted = val_sort($arr, 'website');
?>

<pre><?php print_r($sorted); ?></pre>
