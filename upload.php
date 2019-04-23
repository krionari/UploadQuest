<!DOCTYPE html>
<html>
<head>
    <!-- En-tête de la page -->
    <meta charset="utf-8" />
    <title>Titre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<div>

<?php

if(!empty($_FILES['files']['name'][0])){

    $files = $_FILES['files'];
    $uploaded = [];
    $failed = [];
    $allowed = ['jpg', 'png', 'gif'];

    foreach($files['name'] as $position => $file_name)
    {
        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        if(in_array($file_ext, $allowed)){

            if ($file_error === 0){

                if($file_size <= 1000000){

                    $file_name_new = uniqid('image') . '.' . $file_ext;
                    $file_destination = 'upload/' . $file_name_new;

                    if(move_uploaded_file($file_tmp, $file_destination)){

                        $uploaded[$position] = $file_destination;

                    } else {

                        $failed[$position] = $file_name . 'failed to upload';
                    }

                } else {
                    $failed[$position] = $files['name'][$position] . 'size is too big, bro';
                }


            } else {
                $failed[$position] = $files['name'][$position] . ' errored with code ' . $file_error[$position];

            }

        } else {

            $failed[$position] = $files['name'][$position] . ' file extension ' . $file_ext . ' is not allowed';
        }

    }
}

$dir = 'upload/*.{jpg,gif,png}';
$files = glob($dir,GLOB_BRACE);

echo 'Voici mes belles images !' . '<br /><br />' .
'<div class="container">' .
'<div class="row">';
foreach($files as $image)
{ ?>
<div class="col-3 d-flex justify-content-around">
    <div class="card " style="width: 25rem;">
        <img src="<?php echo $image; ?>" class="card-img-top" alt="..." width="200px" height="300px">
        <div class="card-body" >
            <p class="card-text text-center" ><?php $imageName = str_replace('upload/','',$image);
                echo $imageName.'<br />'; ?></p>
        </div>
        <a href="successDelete.php?name=<?php echo $imageName ?>" name="" class="btn btn-primary">Delete</a>
    </div>
</div>
<?php } ?>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
