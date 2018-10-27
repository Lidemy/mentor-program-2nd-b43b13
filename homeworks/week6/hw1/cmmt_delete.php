<?php
require_once('conn.php');

$data = json_decode(file_get_contents("php://input"));
$cmmt_id = $data->cmmt_id;	


$stmt = $conn->prepare("DELETE FROM abbie_comments WHERE id =?");
$stmt->bind_param('s',$cmmt_id);

if( $stmt->execute() ){

	echo  'deleted';

}else{
	echo 'error';
}

?>