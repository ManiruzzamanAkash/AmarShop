<?php 
$days = array('22:00', '01:00', '01:00', '02:00', '23:30');
$hour = 0;
$minute = 0;


echo '<br />';
echo date('H:i', array_sum(array_map('strtotime', $days)) / count($days));

echo '<br />';

foreach($days as $day) {
	// $hour += substr($day, 0, 2);
	// $minute += substr($day, 3, 2);
}

echo $hour;
echo '<br />';
echo $minute;
 ?>