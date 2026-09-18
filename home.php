<?php
    require './db/config.php';
    require './db/boot.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <div class="homepage-container">
        <div class="homepage-camera-container">
            <button class="homepage-camera-button" onclick="toggleHomepageButton(this)">Patchnotes</button>
            <div id="homepageButton">
                <h1>Patchnotes</h1>
                <h3>[18-09-2026]</h3>
                <p>Fixed homepage responsiveness text </p>
                <p>Added upload (Frontend)</p>
                <p>Reworked cool static effect (a little)</p>
                <p>Added homepage background</p>
                <p>Added account (backend)</p>
                <h3>[11-09-2026]</h3>
                <p>Added login & signup (backend)</p>
                <p>Changed "index.html" -> "home.php"</p>
                <p>Added wireframe (with cool static effect)</p>
                <h3>[10-09-2026]</h3>
                <p>Added login & signup (frontend)</p>
                <h3>[09-09-2026]</h3>
                <p>Added homepage</p>
                <p>Added announcements (frontend)</p>
                <p>Added patchnotes</p>
            </div>

            <div class="homepage-camera-top" style="color: red;">Test Text (will get deleted soon: <b><?= $_SESSION['user'] ?></b></div>

            <a href="accsettings.php" class="homepage-camera-button-upload-link">
                <div class="homepage-camera-button-account">
                    <div class="homepage-camera-button-account-title">Account</div>
                </div>
            </a>

            <a href="groups.php" class="homepage-camera-button-upload-link">
                <div class="homepage-camera-button-groups">
                    <div class="homepage-camera-button-groups-title">Groups</div>
                    <button onclick="homepageAnnouncements.style.display = 'block'" class="homepage-camera-button-groups-red-button">
                        <div style="color: white; font-size: clamp(0.01em, 3.5cqmin, 1.8rem);">2</div>
                        <!-- The number needs later to be connected to the announcements. The amount of announcements you get is the amount that needs to be shown! -->
                    </button>

                    <div id="homepageAnnouncements">
                        <button class="homepageAnnouncements-close" onclick="homepageAnnouncements.style.display = 'none'" style="width: 14%; height: 10%;">+</button>
                        <h2>Announcements</h2>
                        <!-- In announcements their needs to be the following 3 possibilites that can happen
                        1. They get a groupchat invite, which they can accept or decline
                        2. They get an announcement that they have been removed from [groupchatname] 
                        3. We should somehow be able to announce something to all users-->
                    </div>
                </div>
            </a>

            <a href="settings.php" class="homepage-camera-button-upload-link">
                <div class="homepage-camera-button-settings">
                    <div class="homepage-camera-button-settings-title">Setings</div>
                </div>
            </a>

            <a href="upload.php" class="homepage-camera-button-upload-link">
                <div class="homepage-camera-button-upload">
                    <div class="homepage-camera-button-upload-title">Upload</div>
                </div>
            </a>

            <div class="homepage-camera-outer-lense">
                <div class="homepage-camera-inner-lense"> 
                   <div class="homepage-lense-h1">LYPMY</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const homepageAnnouncements = document.getElementById('homepageAnnouncements')

        const homepageButton = document.getElementById('homepageButton')
        function toggleHomepageButton(buttonElement) {
            if (homepageButton.style.display === 'block') {
            homepageButton.style.display = 'none';
            } else {
            homepageButton.style.display = 'block';
            }

            buttonElement.classList.toggle('active');
        }
    </script>
</body>
</html>