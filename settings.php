<?php
	require './db/config.php';
    require './db/boot.php';

    $owned = [];

    $invites = sql(true, 'SELECT by FROM invite WHERE user = :USER AND co = TRUE;', [
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

	$groups = array_filter(array_merge($groups ?? [], $owned ?? [])); // we cry

	if (isset($_GET['target'])) {
		$target = $groups[(int)$_GET['target']];
		if (isset($target)) {
			$members = sql(true, 'SELECT * FROM invite WHERE by = :BY;', [
    			'BY' => $target['name']
			]);
		}
	}
?>

<?php foreach ($groups as $idx => $group) { ?>
	<button onclick="window.location = 'settings.php?target=<?= $idx ?>'">
		Edit <b><?= $group['name'] ?></b>
	</button>
<?php } ?>

<hr>

<fieldset>
	<?php if (isset($target)) { ?>
		<p>Editing <?= $target['name'] ?></p>

		<form action="./db/grouphandle.php" method="POST">
			<input type="hidden" name="group" value="<?= $target['name'] ?>">
			<select name="user">
				<?php foreach ($members as $person) { ?>
						<option value="<?= $person['user'] ?>"><?= $person['user'] ?></option>
				<?php } ?>
			</select>

			<button type="submit" name="method" value="promo">Promote</button>
			<button type="submit" name="method" value="kick">Kick</button>
			<button type="submit" name="method" value="del">Delete Groupchat</button>
		</form>

		<p>Pending Invites</p>
		<ul>
			<?php
				foreach ($members as $member) {
					if (!$member['accept']) {
			?>
						<li><?= $member['user'] ?></li>
			<?php
					}
				}
			?>
		</ul>

		<form action="./db/grouphandle.php" method="POST">
			<input type="hidden" name="group" value="<?= $target['name'] ?>">
			<input type="type" name="user">
			<button type="submit" name="method" value="invite">Invite</button>
		</form>

	<?php } else { ?>
		<p>Please select el group</p>
	<?php } ?>
</fieldset>

<button onclick="window.location = './home.php'">Bak</button>