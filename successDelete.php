<?php


if( file_exists ( 'upload/' . $_GET['name'])){
    unlink( 'upload/' . $_GET['name'] ) ;
    header('Location: affichage.php');
}
