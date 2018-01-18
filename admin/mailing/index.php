<?php
session_start();
/**
 * Created by PhpStorm.
 * User: MERT
 * Date: 27/02/2017
 * Time: 15:11
 */
include 'functions.php';
check_login();
include 'connect_db.php';
check_db($connected);



/* get list */
$list=$db->query("SELECT * FROM mail_list");


?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mailing List</title>
    <script src="js/jquery-3.1.1.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

</head>
<body>
<div class="add">
    <form action="" method="post" class="add_mail">
        <table class="add_email">
            <tr id="1">
                <td>Email1 :</td>
                <td><input type="email" name="mail1"></td>
                <td><a href="" id="ekle">Ekle</a></td>
            </tr>


            <tr>
                <td></td>
                <td><input type="submit"></td>
            </tr>
        </table>
    </form>
</div>
<div class="status">
    <?php
    if($_GET){
        $id=$_GET["delete"];

        $delete=$db->query("DELETE FROM mail_list WHERE id='{$id}' ");
        if($delete){

            echo '<script>alert("Başarıyla Silindi #'.$id.'");location.href="index.php"</script>';

        }else{
            print_r( $db->errorInfo());


        }



    }

    if($_POST){
        $json=array();
        $adana=0;

        foreach ($_POST as $deneme=>$a){
            $search=$db->query("SELECT * FROM mail_list WHERE email='{$a}' ")->rowCount();
            if($search==0){
                $prep=$db->prepare("INSERT INTO mail_list SET email=?");
                $exec=$prep->execute(array($a));
                if($exec){

                    echo "<span class=\"green\">". $a." adlı mail başarıyla eklendi</span><br/>";


                }else{
                    echo "<span class=\"red\">".$a." adlı mail eklenemedi<br/>";
                    print_r($prep->errorInfo());
                }

            }else{
                echo "<span class=\"red\">".$a." adlı mail daha önce eklenmiş<br/>";
            }
            $adana++;
        }
    }
    ?>
</div>

<table id="table_id" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>E-Mail</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while($data=$list->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo @$data["id"] ?></td>
            <td><?php echo @$data["email"] ?></td>
            <td><a href="index.php?delete=<?php echo @$data["id"]?>" target="_self">Sil</a></td>
        </tr>
        
<?php
    }?>
    </tbody>
</table>

<script>
    $(document).ready( function () {
        $('#table_id').DataTable();

        var i=2;

        $("#ekle").on("click",function(e){
            e.preventDefault();
            $(".add_email #"+(i-1)).after('<tr id=\"'+i+'\"><td>Email'+ (i) +' :</td> <td><input type=\"email\" name=\"mail'+i+'\"></td></tr>');
            console.log(i);
            ++i;




        });


    } );



</script>
</body>
</html>
