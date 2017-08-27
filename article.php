<?php
include 'db.php';

//Выводим статью

$id_Article=$_GET ['id'];


$sql = mysqli_query($db,"SELECT * FROM Articles WHERE id_Article=$id_Article" ) or die("Ошибка");
$pole= mysqli_fetch_array($sql);

    echo "
        <div align='center'>                 
            <table border='0' cellspacing='10' width='1000'>                
                <tr><td align='center'><h1>".htmlspecialchars_decode($pole['Head'])."</h1></td></tr>                
                <tr><td>Автор:    ".htmlspecialchars_decode($pole['Author'])."</td></tr>                
                <tr><td>".htmlspecialchars_decode($pole['Content'])."</td></tr>                
            </table>                
        </div><br><br><br><br>                 
        <div align='right'><a href='change_article.php?id=$id_Article'>Изменить статью</a></div>                 
        <div align='right'><a href='index.php'>Вернуться на главную</a></div>";                                     

                        
//Выводим форму для комментариев
    
 echo <<<EOD
    <form action="insert_note.php" method="POST">
        <div align="center">
            <h3>Оставьте свой комментарий здесь</h3>
            <table border="0" cellspacing="10">
                <tr><td align="center">Автор</td></tr>
                <tr><td align="center"><input type="text" name="Author" maxlength="20" required></td></tr>   
                <tr><td align="center">Комментарий</td></tr>
                <tr><td><textarea name="Content" cols="25" rows="8" maxlength="250" required></textarea><br></tr></td>
                <input type="hidden" name="id_Article" value="$id_Article">   
            <tr><td align="center"><input name="submit" type="submit" value="Отправить"></tr></td></div>
    </form>  

EOD;
 
//Выводим сами комментарии 
 
if ($result=mysqli_query($db, "SELECT * FROM Komments WHERE id_Article=$id_Article"))
    
    {    
        while($pole= mysqli_fetch_array($result)){
                echo "
                    <table border='0' cellspacing='10'>
                    <tr><td align='center'><h4>".htmlspecialchars_decode($pole['Author'])."</h4></td><td>
                    <tr><td align='center'>".htmlspecialchars_decode($pole['Content'])."</tr></td></table>";}}
else
        { 
          echo mysqli_error($db);}

