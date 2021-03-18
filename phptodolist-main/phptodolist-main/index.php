<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&display=swap" rel="stylesheet">
    <title>ToDo List Application PHP </title>
</head>
<body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" c
        rossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>

<?php

include('config.php');
include('todolist.php');

$app = new TodoList( date('Ymd') );

$todolist = $app->getTodos();
$reqMethod = $_SERVER['REQUEST_METHOD'];


if($reqMethod == 'POST' && empty($_GET['id'])){
    $app->add();
}
elseif ($reqMethod == 'GET' && !empty($_GET['id'])){
  if ($_GET['delete'] && !empty($_GET['id'])){
        $app->delete($_GET['id']);
    }
}
elseif ($reqMethod == 'GET' && !empty($_GET['id'])){
    if ($_GET['update'] && !empty($_GET['id'])){
        $app->update($_GET['id']);
    }
}



$todolist = $app->getTodos();
?>

<div class="container">
    <div class="row">
        <section class="col-12">
            <h1><strong><p class="font-weight-bolder">ToDo List Application PHP</p></strong></h1>
        </section>
    </div>
</div>


<div class="container">
    <form action="index.php" method="post" autocomplete="off">


        <input type="text" class="form-control" id="text" placeholder="Yapılacakları ekleyiniz..." name="mytodo"/>

        <input type="hidden" name="hid_val" value="add">
        <input type="submit" id="ekle" class="btn btn-default btn btn-outline-info" value="EKLE">
    </form>

    <ul>
    <?php


    foreach ($todolist as $k => $v) {

        echo '<li style="list-style-type: square" >
                <form autocomplete="off" action="index.php"  style="display:inline-block" >
            
            <input type="text" name="sval_' . ($k + 1) . '" value="' . $v . '"/>
            
            <input type="hidden" value="' . ($k + 1) . '" name="id" />
            <button id="sil" class="btn btn-default btn-xs btn btn-outline-danger"  type="submit" value="sil" name="delete">SİL</button>
             
            <button id="güncelle" class="btn btn-default btn-xs btn btn-outline-success" type="submit" value="güncelle" name="update">GÜNCELLE</button>
          
      
       
            </li>';
    }
    ?>
    </ul>
</div>
</body>

</html>
