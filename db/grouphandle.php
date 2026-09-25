<?php
	if (!$_POST && !isset($_GET['chat']) && !isset($_GET['accept']) && !isset($_GET['decline'])) { exit(); }

	require 'config.php';
	require 'boot.php';


	if (isset($_GET['accept'])) {
		sql(false, 'UPDATE invite SET accept = TRUE WHERE user = :USER AND by = :BY', [
			'USER' => $_SESSION['user']['user'],
			'BY' => $_GET['accept']
		]);
		header('location: ./../home.php');
	} else if (isset($_GET['decline'])) {
		sql(false, 'DELETE FROM invite WHERE user = :USER AND by = :BY', [
			'USER' => $_SESSION['user']['user'],
			'BY' => $_GET['decline'] ?? random_bytes(99)
		]);
		header('location: ./../home.php');
	} else if (isset($_GET['chat'])) {
		if ($_GET['chat'] != '§') {
			sql(false, 'INSERT INTO message(by, cont) VALUES(:BY, :CONT)', [
				'BY' => $_SESSION['group'],
				'CONT' => $_SESSION['user']['display'] . '§' . $_GET['chat']
			]);
		}

		$fetch = sql(true, 'SELECT * FROM message WHERE by = :ID', [
			'ID' => $_SESSION['group']
		]);

		$api = '';
		foreach ($fetch as $msg) {
			$api .= $msg['cont'] . '§§';
		}
	} else if ($_POST['method'] == 'invite') {
		sql(false, 'INSERT INTO invite(by, user) VALUES(:BY, :USER);', [
			'BY' => $_POST['group'],
			'USER' => $_POST['user']
		]);
		header('location: ./../settings.php');
	} else if ($_POST['method'] == 'promo') {
		sql(false, 'UPDATE invite SET co = TRUE WHERE by = :BY AND user = :USER;', [
			'BY' => $_POST['group'],
			'USER' => $_POST['user']
		]);
		header('location: ./../settings.php');
	} else if ($_POST['method'] == 'kick') {
		sql(false, 'DELETE FROM invite WHERE by = :BY AND user = :USER;', [
			'BY' => $_POST['group'],
			'USER' => $_POST['user']
		]);
		header('location: ./../settings.php');
	} else if ($_POST['method'] == 'del') {
		sql(false, 'DELETE FROM groups WHERE name = :GROUP;', [
			'GROUP' => $_POST['group'],
		]);
		header('location: ./../settings.php');
	} else if ($_POST['method'] == 'create') {
		sql(false, 'INSERT INTO groups(owner, name, desc) VALUES(:ID, :NAME, :DESC)', [
			'ID' => $_SESSION['user']['userID'],
			'NAME' => $_POST['name'] ?? '???',
			'DESC' => $_POST['desc'] ?? '???'
		]);

		foreach (explode('§', $_POST['invite']) as $invite) {
			sql(false, 'INSERT INTO invite(by, user) VALUES(:BY, :ID)', [
				'BY' => $_POST['name'] ?? '???',
				'ID' => $invite
			]);
		}
		header('location: ./../groups.php');
	}
?><?= $api ?? '' ?>
