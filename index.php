<?php 
    include 'bd/BD.php';
    header('Access-Control-Allow-Origin: *');

    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id'])){
            $query="select * from framework where id=".$_GET['id'];
            $resultado=metodoGet($query);
            echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
        }else{
            $query="select * from framework";
            $resultado=metodoGet($query);
            echo json_encode($resultado->fetchAll()); 
        }
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='POST'){
        unset($_POST['METHOD']);
        $nombre=$_POST['nombre'];
        $lanzamiento=$_POST['lanzamiento'];
        $desarrollador=$_POST['desarrollador'];
        $query="insert into framework(nombre, lanzamiento, desarrollador) values ('$nombre', '$lanzamiento', '$desarrollador')";
        $queryAutoIncrement="select MAX(id) as id from framework";        //MODIFICAR EST0, VEREMOS
        $resultado=metodoPost($query, $queryAutoIncrement);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='PUT'){
        unset($_POST['METHOD']);
        $id=$_GET['id'];
        $nombre=$_POST['nombre'];
        $lanzamiento=$_POST['lanzamiento'];
        $desarrollador=$_POST['desarrollador'];
        $query="UPDATE framework SET nombre='$nombre', lanzamiento='$lanzamiento', desarrollador='$desarrollador' WHERE id='$id'";
        $resultado=metodoPut($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
    
    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id=$_GET['id'];
        $query="DELETE FROM framework WHERE id='$id'";
        $resultado=metodoDelete($query);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
    
    header("HTTP/1.1 400 Bad Request");  
?>