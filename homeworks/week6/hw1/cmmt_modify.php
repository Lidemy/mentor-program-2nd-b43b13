<?php
require_once('conn.php');

$data = json_decode(file_get_contents("php://input"));
$cmmt_id = $data->cmmt_id;	
$content = $data->content;

$stmt = $conn->prepare("UPDATE abbie_comments SET content = ? WHERE id =?");
$stmt->bind_param('ss',$content, $cmmt_id);

if( $stmt->execute() ){

	echo  'modified';

}else{
	echo 'error';
}

?>