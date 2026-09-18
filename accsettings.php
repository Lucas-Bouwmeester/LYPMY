<?php
   require './db/config.php';
   require './db/boot.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="black-container">
        <svg class="camera-static" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" preserveAspectRatio="none">
            <filter id="staticNoise">
                <feTurbulence type="fractalNoise" baseFrequency="0.80" numOctaves="3" stitchTiles="stitch" />
            </filter>
            <rect width="100%" height="100%" filter="url(#staticNoise)" fill="white" />
        </svg>  

         <div class="title">Account</div>

         <div class="border-container">
            <div class="REC-container">
               <div class="REC-indicator">REC</div>
            </div>
            <div class="battery-container">
                <div class="battery-shell">
                    <div class="battery-bar" style='background-color: black'></div>
                    <div class="battery-bar"></div>
                    <div class="battery-bar"></div>
                    <div class="battery-bar"></div>
                </div>
            </div>
         </div>

         <div class="account-container">
            <form class="account-form" action="./db/accounthandle.php" method="POST">
               <div class="account-form-row">
                  <div class="account-box">
                     <label for="nameInput">Username:</label>
                     <input type="text" id="nameInput" name="name" value="<?= $_SESSION['user']['user'] ?>">
                  </div>
                  <div class="account-box">
                     <label for="displayInput">Display name:</label>
                     <input type="text" id="displayInput" name="display" value="<?= $_SESSION['user']['display'] ?>">
                  </div>
               </div>

               <div class="account-form-row">
                  <div class="account-box">
                     <label for="passInput">Password:</label>
                     <input type="password" id="passInput" name="pass" value="<?= $_SESSION['user']['dehash'] ?>">

                     <span class=".account-toggle-passwords" onclick="togglePassword()">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path id="eyeShape" d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"></path>
                           <circle id="pupil" cx="12" cy="12" r="3"></circle>
                           <line id="slash" x1="2" y1="2" x2="22" y2="22" style="display:none"></line>
                        </svg>
                     </span>
                  </div>

                  <div class="account-button-row">
                     <button type="submit" name="method" value="update" class="account-button">Confirm changes</button>
                     <button type="button" class="account-button" onclick="window.location='./home.php'">Close</button>
                  </div>
               </div>

               <button type="button" class="account-button account-button-outline" onclick="window.location='./db/accounthandle.php?logout=Arf Arf :3'">Log out</button>
            </form>
         </div>

   <script>
      function togglePassword() {
         const input = document.getElementById('passInput');
         const slash = document.getElementById('slash');
         const isHidden = input.type === 'password';
         input.type = isHidden ? 'text' : 'password';
         slash.style.display = isHidden ? 'block' : 'none';
      }
   </script>
</body>
</html>
