<?php
	function sql($mode, $query, $flags=[]) {
		$pdo = new PDO('sqlite:./LYPMY.db');
		$stmt = $pdo->prepare($query);
		$stmt->execute($flags);

		if ($mode) {return $stmt->fetchAll(PDO::FETCH_ASSOC);}
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	session_start();
?>