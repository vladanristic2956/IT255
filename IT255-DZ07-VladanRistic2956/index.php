<?php

header("Content-type: application/json");
include 'usersDB.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (!empty($_GET['id'])) {
		echo json_encode(getUserById($_GET['id']));
	} else {
		echo json_encode(getUsers());
	}
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$result = updateUser($id, $name, $surname, $username, $password, $email);
		$jsonify = array (
			'message' => $result,
		);
		echo json_encode($jsonify);
	} else if (isset($_POST['idDelete'])) {
		$id = $_POST['idDelete'];
		$result = deleteUser($id);
		$jsonify = array (
			'message' => $result,
		);
		echo json_encode($jsonify);
	} else {
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$result = createUser($name, $surname, $username, $password, $email);
		$jsonify = array (
			'message' => $result,
		);
		echo json_encode($jsonify);
	}
}

?>