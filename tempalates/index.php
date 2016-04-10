

<a href='http://upload2.com/uplpage'>Загрузить файл</a><br>
<?
//var_dump($page);?>

<?php foreach($out as $value): ?>
    <a href='http://upload2.com/pages/<?echo $value->filename;?>'><?echo $value->title;?></a><br>
<?php endforeach;?>
<div id="content"></div>

