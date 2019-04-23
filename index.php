<!DOCTYPE html>
<html>
<head>
    <!-- En-tête de la page -->
    <meta charset="utf-8" />
    <title>Titre</title>
</head>

<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="files[]" multiple>
    <input type="submit" value="Upload">

    <a href="affichage.php">Show images</a>


</form>

</body>
</html>