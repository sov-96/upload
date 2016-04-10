<?






// Находим общее число страниц
$total = intval(($posts - 1) / $num) + 1;

// Определяем начало сообщений для текущей страницы
$page = intval($page);
// Если значение $page меньше единицы или отрицательно
// переходим на первую страницу
// А если слишком большое, то переходим на последнюю
if(empty($page) or $page < 0) $page = 1;
if($page > $total) $page = $total;
// Вычисляем начиная к какого номера
// следует выводить сообщения
$start = $page * $num - $num;

// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<a href="/?page=1"><<</a>
<a href="/?page='. ($page - 1).'"><</a> ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = '  <a href="/?page='. ($page + 1).'">></a>
<a href="/index.php?page='.$total.'">>></a> ';
// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 2 > 0) $page2left = ' <a href="/?page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
if($page - 1 > 0) $page1left = '<a href="/?page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
if($page + 2 <= $total) $page2right = '  <a href="/?page='. ($page + 2).'">'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = '  <a href="/?page='. ($page + 1).'">'. ($page + 1) .'</a>';

 if ($total>1): ?>
    <p><div align="center" class="navigation">
        <?php echo $pervpage. $page2left. $page1left; ?><span><?php echo $page;?></span> <?php echo $page1right.$page2right;?>
        <?php echo $nextpage;?>
     </div>
     </p>
<?php endif; 