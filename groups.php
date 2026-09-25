<?php
	require './db/config.php';
    require './db/boot.php';

    $groups = [];

    $invites = sql(true, 'SELECT by FROM invite WHERE user = :USER AND accept = TRUE;', [
    	'USER' => $_SESSION['user']['user']
	]);

	foreach ($invites as $group) {
    	$groups[] = sql(false, 'SELECT * FROM groups WHERE name = :BY;', [
        	'BY' => $group['by']
    	]);
	}

	$owned = sql(true, 'SELECT * FROM groups WHERE owner = :ID;', [
    	'ID' => $_SESSION['user']['userID']
	]);

	$groups = array_filter(array_merge($groups, $owned)); // we cry
	// var_dump($groups);

    // Delete this later when the invites r moved to the homepage
    $invites = sql(true, 'SELECT * FROM invite WHERE user = :USER AND accept = FALSE;', [
        'USER' => $_SESSION['user']['user']
    ]);
?>

	<?php foreach (($groups ?? $groups[0]) as $group) { ?>
		<fieldset style="display: inline-block;">
			<legend><?= $group['name'] ?? $group[0]['name'] ?></legend>
			<p><?= $group['desc'] ?? $group[0]['desc'] ?></p>
			<b>Owned By userID: <?= $group['owner'] ?? $group[0]['owner'] ?></b><br>
			<button onclick="window.location = './chat.php?group=<?= $group['groupID'] ?? $group[0]['groupID'] ?>'">View Yo</button>
		</fieldset>
	<?php } ?>

<br><br>
<button onclick="window.location = './maekgroup.php'">Maek Group</button>
<button onclick="window.location = './home.php'">Bak</button>