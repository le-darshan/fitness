 
<?php
 
include($_SERVER['DOCUMENT_ROOT']."/wp-load.php");
global $wpdb;
$user_ID = get_current_user_id();

$oid = $_REQUEST['oid1'];
$uid=mysql_real_escape_string($_REQUEST['uid1']);
$user=mysql_real_escape_string($_REQUEST['user1']);
$total=mysql_real_escape_string($_REQUEST['total']);
$date=mysql_real_escape_string($_REQUEST['date1']);
$day=$_REQUEST['exercises_days'];

update_user_meta($user_ID, "order_id",$oid);
update_user_meta($user_ID, "order_date", $date);
update_user_meta($user_ID, "exercises_days", $day);
?>
