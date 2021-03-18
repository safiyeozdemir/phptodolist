<html>
<head>
    <meta charset="UTF-8">
    <title>My TODOLİST app</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

include('config.php');
include('todolist.php');

$app = new TodoList( date('Ymd') );

$todolist = $app->getTodos();
$reqMethod = $_SERVER['REQUEST_METHOD'];

if($reqMethod == 'POST' && empty($_GET['id'])){
    $app->add();
}
elseif ($reqMethod == 'POST' && !empty($_GET['id'])){
    $app->update($_GET['id']);
}
elseif ($reqMethod == 'GET' && !empty($_GET['id'])){
    if ($_GET['delete']==='delete' && !empty($_GET['id'])){
        $app->delete($_GET['id']);
    }
}

$todolist = $app->getTodos();
?>
<div class="heading">
    <h2 style="font-style: 'Hervetica';">ToDo List Application PHP </h2>
</div>
<form action="/index.php" method="post">
    <input type="text" name="mytodo"  class="task_input"/>
    <input type="submit"  class="addBtn" value="EKLE">
</form>

<ul>
    <?php
    foreach($todolist as $k=>$v){
        echo '<li>
            <div style="display:inline-block">'.$v.'</div> 
            <form action="/index.php" style="display:inline-block" >
            <input type="hidden" value="delete" name="delete" />
            <input type="hidden" value="'.($k+1).'" name="id" />
            <input type="submit" value="SİL" class="deletebtn" />
            <input type="text" name="update" placeholder="Güncellenecek veri..." />
            <input type="hidden"   name="update" value="update">
            <input type="submit" value="GÜNCELLE" class="updatebtn"/>
            
            </form>
            
            
           
          
           
       
            </li>';
    }
    ?>
    <?php
     // <input type="submit" value="DÜZENLE" class="deletebtn" />

    ?>
</ul>
</body>
</html>
