<?php

//Добавляем комменты

if (isset ($_POST['Author']) && isset ($_POST['Content'])){
    
    
        include 'db.php';
        
        //Убираем спец сиволы
        
        $Author=htmlspecialchars($_POST['Author']);
        $Content=htmlspecialchars($_POST['Content']);
        $id_Article=$_POST['id_Article'];
        
        if(mysqli_query($db, "INSERT INTO Komments (id_Article,Author,Content) VALUES ('$id_Article','$Author','$Content')"))
                         
            echo "Запись успешно добавлена. </br> <a href='article.php?id=$id_Article'> Вернуться к статье</a>";
        else
        { echo "Возникли трудности. Попробуйте опубликовать запись позднее";
          echo mysqli_error($db);}
}

           
           
    