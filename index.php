<?php
include 'db.php';

echo "<div align='center'><h1>Список статей</h1></div><br>
      <div align='right'><a href='add_article.html'>Создать новую статью</a> </div>";

//Количество выводимых статей

$countView = 5; 

//Вычисляем с какого значения выводим

if(isset($_GET['page'])){
    $pageNum = $_GET['page'];
}else{
    $pageNum = 1;
}
$startIndex = ($pageNum-1)*$countView;

//Запрос к базе, складываем результат в массив

$sql = mysqli_query($db,"SELECT SQL_CALC_FOUND_ROWS * FROM Articles ORDER BY id_Article DESC LIMIT $startIndex, $countView") or die("Ошибка");

$Articles = array();
while($result = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
    $Articles[] = $result;
}

// вычисляем номер последней страницы
$sql2 = mysqli_query($db,"SELECT FOUND_ROWS()");
$result2 = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
$countAllNews = $result2["FOUND_ROWS()"];
$lastPage = ceil($countAllNews/$countView);

//Выводим статьи
 
foreach($Articles as $pole)
               {
                    $id_Article=$pole['id_Article'];
                     echo "
                         <div align='center'>
                            <table border='0' cellspacing='10' width='1000'>
                                <tr><td><a href='article.php?id=$id_Article'>".htmlspecialchars_decode($pole['Head'])."</a></td></tr>
                                <tr><td>".htmlspecialchars_decode($pole['Short_content'])."</td></tr>
                            </table>
                         </div><br><br><br><br>";
                
                }     
                
//Выводим пагинатор
    
    echo "<ul>";
        if($pageNum > 1) { 
            $page=$pageNum-1;
            echo <<<EOD
            <li><a href="index.php?page=1">&lt;&lt;</a></li>
            <li><a href="index.php?page=$page">&lt;</a></li>
EOD;

        }        
       
        
         
       if($pageNum < $lastPage) {
           $page=$pageNum+1;
           echo <<<EOD
            <li><a href="index.php?page=$page">&gt;</a></li>
            <li><a href="index.php?page=$lastPage">&gt;&gt;</a></li>
EOD;
        } 
    echo "</ul>";
                  
 ?>
 
