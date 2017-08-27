<?php

//  Изменям статью. Выводим форму, заполненную из данными из базы

include 'db.php';

$id_Article=$_GET ['id'];


$sql = mysqli_query($db,"SELECT * FROM Articles WHERE id_Article=$id_Article" ) or die("Ошибка");
$pole= mysqli_fetch_array($sql);

echo '<form action="add_article.php" method="POST">
            <div align="center">
                <table border="0" cellspacing="20" align="center">
                          <tr><td align="center">Автор</td></tr>
                          <tr><td align="center"><input type="text" name="Author" maxlength="20" required value="'.htmlspecialchars_decode($pole['Author']).'"></td></tr>
                          <tr><td align="center">Заголовок</td></tr>
                          <tr><td align="center"><input type="text" name="Head" maxlength="50" size="50" required value="'.htmlspecialchars_decode($pole['Head']).'"></td></tr>
                          <tr><td align="center">Краткое содержание</td></tr>
                          <tr><td align="center"><textarea name="Short_content" cols="80" rows="10" maxlength="250" required">'.htmlspecialchars_decode($pole['Short_content']).'</textarea></td></tr>
                          <tr><td align="center">Статья</td></tr>
                          <tr><td align="center"><textarea name="Content" cols="80" rows="20" maxlength="10000" required">'.htmlspecialchars_decode($pole['Content']).'</textarea></td></tr>     
                          <input type="hidden" name="id_Article" value="'.$pole['id_Article'].'">    
                          <tr><td align="center"><input name="submit" type="submit" value="Отправить"></td></tr>
                </table>
            </div>
        </form>';