<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Image Preview</title>
</head>
<body>
    <h1>Image Preview</h1>
    
    <!-- Display the preview image -->
    <img id="preview" src="" alt="Preview will show here" style="max-width: 100%;">

    <script>
        // Fetch the preview image from the controller
        fetch("/preview-enhanced-image/{{ $image_id }}")
            .then(response => response.json())
            .then(data => {
                if (data.preview_url) {
                    document.getElementById("preview").src = data.preview_url;
                } else {
                    alert('Image preview is not ready yet.');
                }
            })
            .catch(err => console.error('Error fetching preview:', err));
    </script>
</body>
</html>
