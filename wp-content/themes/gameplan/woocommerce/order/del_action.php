 
<?php
include($_SERVER['DOCUMENT_ROOT']."/wp-load.php");
global $wpdb;

$uid=mysql_real_escape_string($_POST['user_id']);
$current_user = wp_get_current_user();

//$current_user = wp_get_current_user();
//echo $current_user->ID ;
//echo "DELETE FROM J2nxj_users  WHERE ID =".$current_user->ID;
//wp_delete_user( $current_user->ID );

$wpdb->query("DELETE FROM 2Jnxj_users WHERE `ID`=".$current_user->ID);

//echo $result;
//$redirect = "http://cleaverfitness.com/";
//wp_logout_url( $redirect );
wp_logout();

?>
