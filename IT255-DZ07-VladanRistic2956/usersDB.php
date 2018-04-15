<?php 

function getUsers() {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "IT255DZ07";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		return "Connection failed";
	}

	$sql = "SELECT * FROM user";
	$result = mysqli_query($conn, $sql);
	$usersArray = [];
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$usersArray[] = $row;
		}
	} else {
		return "No users found";
	}

	mysqli_close($conn);	
	return $usersArray;
}

function getUserById($idUser) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "IT255DZ07";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		return "Connection failed";
	}
	
	$stmt = $conn->prepare('SELECT * FROM user WHERE idUser = ?');
	$stmt->bind_param('i', $idUser);

	$stmt->execute();
	
	$usersArray = [];
	
	$result = $stmt->get_result();
	if (mysqli_num_rows($result) > 0) {
		while ($row = $result->fetch_assoc()) {
			$usersArray[] = $row;
		}
	} else {
		return "No users found";
	}
	$stmt->close();
	mysqli_close($conn);	
	return $usersArray;
}

function createUser($name, $surname, $username, $password, $email){
	$servername = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "IT255DZ07";

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		return "Connection failed";
	}

	$stmt = $conn->prepare("INSERT INTO user (name, surname, username, password, email) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("sssss", $name, $surname, $username, $password, $email);

	$stmt->execute();


	$stmt->close();
	$conn->close();

	return "New user successfully created!";
}

function updateUser($id, $name, $surname, $username, $password, $email){
	$servername = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "IT255DZ07";

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		return "Connection failed";
	}

	$stmt = $conn->prepare("UPDATE user SET name = ?,surname = ?,username = ?,password = ?,email = ? WHERE idUser = ?");
	$stmt->bind_param("ssssss", $name, $surname, $username, $password, $email, $id);

	$stmt->execute();


	$stmt->close();
	$conn->close();
	
	return "User successfully updated!";
}

function deleteUser($id){
	$servername = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "IT255DZ07";

	$conn = new mysqli($servername, $user, $pass, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		return "Connection failed";
	}

	$stmt = $conn->prepare("DELETE FROM user WHERE idUser = ?");
	$stmt->bind_param("i", $id);

	$stmt->execute();


	$stmt->close();
	$conn->close();
	
	return "User successfully deleted!";
}

?>