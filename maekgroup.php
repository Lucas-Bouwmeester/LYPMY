<?php
	require './db/config.php';
   require './db/boot.php';
?>

<form action="./db/grouphandle.php" method="POST">
   <input type="hidden" name="invite" id="namefield">
   <input type="text" name="name">
   <input type="text" name="desc"><br>

   <input type="text" oninput="target = this.value">
   <button type="button" onclick="add(target)">+</button>

   <ul id="list"></ul>

   <br><button type="submit" name="method" value="create">Create Group</button>
   <button type="button" onclick="window.location = './groups.php'">Cancel</button>
</form>

<script src="js/maekgroup.js"></script>