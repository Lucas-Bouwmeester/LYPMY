<?php
	require './db/config.php';
    require './db/boot.php';

    $data = sql(false, 'SELECT * FROM groups WHERE groupID = :ID;', [
        'ID' => $_GET['group'] ?? 0
    ]);

    $invites = sql(true, 'SELECT by FROM invite WHERE user = :USER AND accept = TRUE;', [
        'USER' => $_SESSION['user']['user']
    ]);

    $_SESSION['group'] = (int)$_GET['group'];

    if (!$data || ($data['owner'] != $_SESSION['user']['userID'] && count($invites) <= 0)) {
        header('location: ./groups.php');
        exit();
    }

    // var_dump($invites);
?>

<h3>
    <?= $data['name'] ?>
</h3>
<p>
    <?= $data['desc'] ?>
</p>

<fieldset id="chat">

</fieldset>
<input type="text" id="sendchat" placeholder="Start Typing">
<button onclick="sendchat()">Send</button>

<script src="./js/chat.js"></script>

<br><button onclick="window.location = './groups.php'">Bak</button>