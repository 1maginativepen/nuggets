<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update-picture"])) {
    // Check if the form was submitted with a file
    if (isset($_FILES["file"])) {
        $targetDirectory = "uploads/"; // Specify the target directory where the file will be uploaded
        $newFileName = "filenamehere." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $targetFile = $targetDirectory . $newFileName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size (adjust the size limit as needed)
        if ($_FILES["file"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats (you can customize this list)
        $allowedFormats = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded and renamed to $newFileName.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file selected.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Example</title>
</head>
<body>
    <h2>File Upload Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="file">Select File:</label>
        <input type="file" name="file" id="file" required>
        <br>
        <input type="submit" value="Upload" name="update-picture">
        <input type="hidden" name="submit" value="update-picture">
    </form>
</body>
</html>
