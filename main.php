<?php
require_once __DIR__.'/bootstap.php';

if (!isset($_SESSION['access_token'])) {
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/callback.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Anadolu Gündem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- stylesheets -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="select2.css">
    <style type="text/css">
        body {
            padding: 40px;
        }
    </style>

    <!-- scripts -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="select2.js"></script>

    <script>
        $(function(){
            // turn the element to select2 select style
            $('#select2').select2();
        });
    </script>
</head>
<body>

<div align="center">
<form action="index.php" method="POST" >
    <fieldset class="form-group">
        <legend>Anadolu Gündem</legend>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="talep" id="optionsRadios1" value="GÜNCEL" checked>
                GÜNCEL
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="talep" id="optionsRadios2" value="Güncel Değil">
                GÜNCEL DEĞİL
            </label>
        </div>
    </fieldset>

    <div class="form-group">
        <label for="select3">Güncel İş Girilecek Birim</label>
        <select class="form-control" name="mt"  id="select3" >
            <?php

            $mt= file_get_contents("material.json");
            $mt=json_decode($mt,false);
            foreach ($mt as $material){
                echo "<option value='{$material}' > {$material}</option>";
            }
            ?>
        </select>
    </div>

        <div class="form-group">
            <label for="information" >Aciklama</label>
            <textarea class="form-control" name="aciklama" id="information" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    <a class="button" href="guncel.php" target="_blank">Güncel Liste</a>

    </form>
</div>
</body>
</html>