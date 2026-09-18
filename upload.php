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
                <feTurbulence type="fractalNoise" baseFrequency="0.60" numOctaves="3" stitchTiles="stitch" />
            </filter>
            <rect width="100%" height="100%" filter="url(#staticNoise)" fill="white" />
        </svg>  

        <div class="title">Upload</div>

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

    <!-- This form later needs to be send towards where the collages can be automatically made with the fotos the user gives.
    Its a placeholder for now. -->
    <form action="upload.php" method="POST" enctype="multipart/form-data" class="upload-container">
        <div class="upload-dropdown-container">
            <label for="upload-dropdown">Choose to which groupchat:</label>
            <!--For now I put some placeholders as choices. 
            Later the choices has to be all the groupchats the user is in which they haven't uploaded to yet.-->
            <select id="upload-dropdown" name="groupchat" required>
                <option value="" disabled selected hidden>Choose groupchat</option>
                <option value="placeholder">placeholder</option>
                <option value="not_a_placeholder">not a placeholder</option>
            </select>
        </div>

        <div id="upload-file-zone" class="upload-file-zone">
            <div class="upload-file-zone-icon">
                <svg viewBox="0 0 24 24" width="48" height="48" fill="currentColor">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.96-2.36L6.5 17h11l-3.54-4.71z"/>
                    <circle cx="14.5" cy="8.5" r="1.5"/>
                </svg>
            </div>
            <p class="upload-file-zone-text">Drag your foto to add it to the collage</p>
            <label class="upload-file-zone-label">Or 
                <span class="upload-file-zone-highlight">choose your foto</span>
                <!-- I just clasified that you can only use images types.
                For in the future, the image has to become the premade collages we have made. 
                The image limit for now is 1, but later it has to become a minimum of 2, and a maximum of 5  -->
                <input type="file" id="upload-file-zone-file" name="photo"
                    accept="image/png, image/jpeg, image/jpg, image/svg+xml, image/heic, image/heif, image/webp"
                    class="upload-file-zone-hidden-file-input">
            </label>
            <div id="upload-file-zone-file-preview" class="upload-file-zone-file-preview"></div>
        </div>

        <div class="upload-button-container">
            <button type="submit" class="upload-button">Confirm Collage</button>
            <button><a href="home.php" class="upload-button">Close</a></button>
        </div>
    </form>
    <!-- -->
</div>
    <script>
        const form = document.querySelector('.upload-container');
        const zone = document.getElementById('upload-file-zone');
        const file = document.getElementById('upload-file-zone-file');
        const preview = document.getElementById('upload-file-zone-file-preview');
        const dropdown = document.getElementById('upload-dropdown');

        function File(file) {
            if (!file) return;
            if (!file.type.startsWith('image/') && !/\.(heic|heif)$/i.test(file.name)) {
                file.value = '';
                preview.textContent = 'Only image files are allowed.';
                return;
            }

            const data = new DataTransfer();
            data.items.add(file);
            file.files = data.files;
            preview.textContent = 'Selected: ' + file.name;
        }

        file.onchange = () => File(file.files[0]);

        zone.ondragover  = e => { e.preventDefault(); zone.classList.add('upload-drag-over'); };
        zone.ondragleave = () => zone.classList.remove('upload-drag-over');
        zone.ondrop      = e => {
            e.preventDefault();
            zone.classList.remove('upload-drag-over');
            File(e.data.files[0]); 
        };

        window.ondragover = window.ondrop = e => e.preventDefault();

        form.onsubmit = e => {
            if (!file.files.length) {
                e.preventDefault();
                preview.textContent = 'Choose a foto first.';
                return;
            }
            alert('You have uploaded a collage to ' + dropdown.selectedOptions[0].text);
        };
    </script>
</body>
</html>