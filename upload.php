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
                        header('Location: affichage.php');

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

    }}
?>
