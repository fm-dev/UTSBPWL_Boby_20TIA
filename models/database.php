<?php 
class database {

	var $host = "localhost";
	var $username = "root";
	var $pass = "";
	var $db = "uts_bpwl_20tia_boby";
	var $con;

	function __construct(){
		$this->con=mysqli_connect($this->host,$this->username,$this->pass,$this->db);
		mysqli_select_db($this->con,$this->db);
		session_start();
	}

	function tampil_data_user(){
		$data = mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db),"SELECT * from user");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		} return $hasil;
	}

    function tampil_data_order(){
		$data = mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db)
		,"SELECT * from customerorder ORDER BY idOrder desc");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		} return $hasil;
	}

	function input_user($name_user,$email_user,$password){
		mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db),"INSERT INTO user (username, email, registration_date, password) 
		 VALUES ('$name_user', '$email_user', now(), '$password')");
	}

	function login_admin($name_admin,$email_admin,$password){
		$data = mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db)
		,"SELECT admin_name, email, password FROM admin where admin_name='$name_admin' AND email='$email_admin'");
		$_SESSION['name'] = $name_admin;
		while($d = mysqli_fetch_row($data)){
			$hasil[] = $d;
		} return $hasil;
	}

	function login_user($name_user,$email_user,$password){
		$data = mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db)
		,"SELECT username, email, password FROM user where username='$name_user' AND email='$email_user'");
		$_SESSION['name'] = $name_user;
		while($d = mysqli_fetch_row($data)){
			$hasil[] = $d;
		} return $hasil;
	}

	function delete_user($id_user){
		mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db),"DELETE from user where idUser='$id_user'");
	}

	function edit_user($id_user){
		$data = mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db),"SELECT idUser, username, 
		email, password FROM user where idUser='$id_user'");
		while($d = mysqli_fetch_array($data)){
			$hasil[] = $d;
		} return $hasil;
	}

	function update_user($id_user,$name_user,$email_user,$password){
        mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db),"UPDATE user SET username = '$name_user'
		, email = '$email_user', password = '$password' WHERE idUser = '$id_user'");
    }
    
	function input_order($customer_name,$phone_number,$amount){
		mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db)
		,"INSERT into customerorder(customer_name, phone_number, amount, status) VALUES ('$customer_name', '$phone_number', $amount, 'Pending')");
	}

	function delete_order($id_order){
		mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db)
		,"DELETE from customerorder where idOrder='$id_order'");
	}

	function edit_order($id_order){
		$data = mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db)
		,"SELECT * FROM customerorder where idOrder='$id_order'");
		while($d = mysqli_fetch_array($data)){
			$hasil[] = $d;
		} return $hasil;
	}
	function update_order($id_order,$customer_name,$phone_number,$amount){
        mysqli_query(mysqli_connect($this->host, $this->username, $this->pass, $this->db),"UPDATE customerorder
		SET customer_name = '$customer_name', phone_number = '$phone_number' 
		,amount = '$amount' WHERE idOrder = '$id_order'");
    }
}
?>