<?php

//Заносим статью в базу

if (isset ($_POST['Author']) && isset ($_POST['Head']) && isset ($_POST['Short_content']) && isset ($_POST['Content']))
    {
        include 'db.php';
        
        
        //Убираем спец символы
        
        $Author=htmlspecialchars($_POST['Author']);
        $Head=htmlspecialchars($_POST['Head']);
        $Short_content=htmlspecialchars($_POST['Short_content']);
        $Content=htmlspecialchars($_POST['Content']);
        
        
        if   (isset ($_POST['id_Article'])){
            
            //Если пришло id страницы, значит сюда привела ссылка из change_article и данные нужно изменить, а не добавить
            
            $id_Article=$_POST['id_Article'];
            
            //находим страницу по id и заменяем содержимое
            
            if(mysqli_query($db, "UPDATE Articles SET Author='$Author', Head='$Head',Short_content='$Short_content', Content='$Content' WHERE id_Article=$id_Article"))
                echo "Запись успешно добавлена. </br> <a href='index.php'> Вернуться на главную</a>";  
            
            
            else {
                echo "Возникли трудности. Попробуйте опубликовать запись позднее";
        echo mysqli_error($db);}}
        
        
        else { 
            
            //Если нет id страницы, значит создаём новую запись в бд
            
            if(mysqli_query($db, "INSERT INTO Articles (Author,Head,Short_content,Content) VALUES ('$Author','$Head','$Short_content','$Content')"))
                echo "Запись успешно добавлена. </br> <a href='index.php'> Вернуться на главную</a>";  
            
            
            else {
                echo "Возникли трудности. Попробуйте опубликовать запись позднее";
                echo mysqli_error($db);
        } }
    }
 else 
    echo "Записи затерялись по пути. Попробуйте ещё раз";
?>      

   
           
           
 