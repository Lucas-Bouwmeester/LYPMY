<?php
	if (!$_POST && !isset($_GET['logout'])) { exit(); }

	require './config.php';

	// print_r($_POST);

	if (isset($_GET['logout'])) { session_destroy(); }
	else if (!isset($_POST['name']) || !isset($_POST['pass'])) {
		$_SESSION['accountmsg'] = 'Fill in all fields';
	} else if ($_POST['method'] == 'update') {

		sql(false, 'UPDATE user SET user = :USER, display = :DIS, pass = :PASS WHERE userID = :ID', [
			'USER' => $_POST['name'] ?? $_SESSION['user']['user'],
			'DIS' => $_POST['display'] ?? $_SESSION['user']['display'],
			'PASS' => sha1($_POST['pass']) ?? $_SESSION['user']['pass'],
			'ID' => $_SESSION['user']['userID']
		]);

		$res = sql(false, 'SELECT * FROM user WHERE user = :USER AND pass = :PASS', [
			'USER' => $_POST['name'],
			'PASS' => sha1($_POST['pass'])
		]);

		$_SESSION['user'] = $res;
		$_SESSION['user']['dehash'] = $_POST['pass'];

		header('location: ./../accsettings.php');
		exit();

	} else if ($_POST['method'] == 'register') {
		if ($_POST['pass'] != $_POST['repeat']) {
			$_SESSION['accountmsg'] = 'Password and Repeated password don\'t match';
		} else {
			sql(false, 'INSERT INTO user(user, display, pass) VALUES(:USER, :DIS, :PASS)', [
				'USER' => $_POST['name'],
				'DIS' => $_POST['display'] ?? $_POST['name'],
				'PASS' => sha1($_POST['pass'])
			]);
			$_SESSION['accountmsg'] = 'Registered "' . $_POST['name'] . '"';
		}

	} else if ($_POST['method'] == 'login') {
		$res = sql(false, 'SELECT * FROM user WHERE user = :USER AND pass = :PASS', [
			'USER' => $_POST['name'],
			'PASS' => sha1($_POST['pass'])
		]);
		// var_dump($res);
		// exit();
		if ($res) {
			$_SESSION['user'] = $res;
			$_SESSION['user']['dehash'] = $_POST['pass'];
		} else { $_SESSION['accountmsg'] = 'Login Incorrect'; }
	} else { $_SESSION['accountmsg'] = 'Didn\'t understand the request'; }

	header('location: ./../index.php');
?>