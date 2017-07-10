<?php
class db{
	public $conn = '';

	public function __construct(){
		$this->conn = mysqli_connect("localhost", "root", "root", "himani");
		if(mysqli_connect_errno()){
			printf("Connection Failed : \n %s",mysqli_connect_error());
			exit;
		}
	}

	public function insert($params=''){
		if(!empty($params)){
			$sql = "INSERT INTO details(fname,lname,email,pswd) VALUES ('".$params['fname']."','".$params['lname']."','".$params['email']."','".$params['pswd']."')";
			if(mysqli_query($this->conn, $sql)){
				return "success";
			}else{
				return "error";
			}
		}
	}

	public function deleted($id=''){
		if(!empty($id)){
			$sql = "UPDATE data SET deleted='1' WHERE id='".$id."' ";
			if(mysqli_query($this->conn,$sql)){
				return "success";
			}else{	return "error"; }
		}
	}
}
?>