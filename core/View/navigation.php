<?
namespace core\View;
class navigation
{
    public static function getlast()
    {
        $cdb= "mysql:host=127.0.0.1;dbname=upload;charset=utf8";
        $sql="SELECT * FROM advertising ORDER BY id DESC LIMIT 0,10";
        $res = tools :: doSql($cdb, $sql);
        return $res;
    }

    public static  function  navigator($page, $num, $tbname, $cdb)
    {
        if ($page==0) $page=1;
        //$cdb= "mysql:host=127.0.0.1;dbname=upload;charset=utf8";
        $sql="SELECT count(`id`) FROM `$tbname`";
        $res = tools :: doSql($cdb, $sql);
        $posts = $res[0]['count(`id`)'];

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
        if ($page != 1) $pervpage = '<a href="/?page=-1"><<</a>
<a href="/?page='. ($page - 1).'"><</a> ';
// Проверяем нужны ли стрелки вперед
        if ($page != $total) $nextpage = '  <a href="/?page='. ($page + 1).'">></a>
<a href="/index.php?page='.$total.'">>></a> ';
// Находим две ближайшие станицы с обоих краев, если они есть
        if($page - 2 > 0) $page2left = ' <a href="/?page='. ($page - 2) .'">'. ($page - 2) .'</a>  ';
        if($page - 1 > 0) $page1left = '<a href="/?page='. ($page - 1) .'">'. ($page - 1) .'</a>  ';
        if($page + 2 <= $total) $page2right = '  <a href="/?page='. ($page + 2).'">'. ($page + 2) .'</a>';
        if($page + 1 <= $total) $page1right = '  <a href="/?page='. ($page + 1).'">'. ($page + 1) .'</a>';

//получаем записи из БД (начиная с $start, кол-во записей = $num)

        $query = "SELECT * FROM `$tbname` LIMIT $start, $num";
        $out = tools :: doSql($cdb, $query);
        echo " <a href='http://upload2.com/uplpage'>Загрузить файл</a><br>";
        foreach($out as $value)
        {
            ?><a href='http://upload2.com/pages/<?echo $value['filename'];?>'><?echo $value['title'];?></a><br><?

            //echo $value['title'];
        }

        if ($total>1) echo '<p><div align="center" class="navigation">'
            .$pervpage.$page2left.$page1left.'<span>'.$page.'</span>'.$page1right.$page2right
            .$nextpage.'</div></p>';
    }
}

