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

            <div class="upload-container">
                
            </div>
        </div>
    </div>
</body>
</html>