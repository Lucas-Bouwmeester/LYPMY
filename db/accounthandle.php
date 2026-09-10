<?php
	if (!$_POST) { exit(); }

	require './config.php';

	// print_r($_POST);

	if ($_POST['method'] == 'register') {
		if ($_POST['pass'] != $_POST['repeat']) {
			$_SESSION['accountmsg'] = 'Password and Repeated password don\'t match';
		} else {
			sql(false, 'INSERT INTO user(user, display, pass) VALUES(:USER, :DIS, :PASS)', [
				'USER' => $_POST['name'],
				'DIS' => $_POST['display'],
				'PASS' => sha1($_POST['pass'])
			]);
			$_SESSION['accountmsg'] = 'Registered "' . $_POST['name'] . '"';
		}

	} else if ($_POST['method'] == 'login') {
		$res = sql(false, 'SELECT * FROM user WHERE user = :USER AND pass = :PASS', [
			'USER' => $_POST['name'],
			'PASS' => sha1($_POST['pass'])
		]);
		if ($res) {
			$_SESSION['user'] = $res['user'];
		} else { $_SESSION['accountmsg'] = 'Login Incorrect'; }
	} else { $_SESSION['accountmsg'] = 'Didn\'t understand the request'; }

	header('location: ./../index.php');
?>