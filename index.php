<?
use core\Tools\coutput;
use core\View;
require_once('auto.php');


$router = new \core\Controller\AltoRouter();

$index=function(){
    $v=new \core\View();
    $start=$_REQUEST['page'];
    $num=2;

    if ($start==0) $start=1;
    $v->num=$num;
    $v->posts=\core\model\c_article::countFieldCells();
    $v->page=$start;
    $v->out=\core\model\c_article::findAllEx($start, $num,-1);
    $v->display(__DIR__ . '\tempalates\index.php');
    $v->display(__DIR__ . '\tempalates\paged.php');

    ?>
    <script   src="http://code.jquery.com/jquery-1.12.3.js"></script>
    <script>

        function show()
        {
            $.ajax({
                url: "http://upload2.com/ajax",
                cache: false,
                success: function(html){
                    var objs = jQuery.parseJSON( html);
                    jQuery.each(objs, function() {
                        $("#content").append('<p><a href="http://upload2.com/pages/'+this.filename+'">'+this.title+'</a></p>');
                    });
                    //$("#content").html('<a href="http://upload2.com/pages/'+obj.filename+'">'+obj.title+'</a>');
                }
            });
        }

        $(document).ready(function(){
            show();
            setInterval('show()',10000);

        });
    </script>
    <?
};

$router->map('GET','/', $index);
$router->map('GET','/index.php', $index);
$router->map('GET','/ajax', function(){
    $v=new \core\View();
    //$v->outrand=\core\model\c_article::findRand(1);
    $offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
    $v->outrand=\core\model\c_article::findLastNews(10, $offset);
    //die(var_dump(\core\model\c_article::findLastNews(10)));
    $v->display(__DIR__ . '\tempalates\outrand.php');

});

$router->map('GET','/uplpage', function(){

   include (__DIR__.'\tempalates\uplpage.php');
});

$router->map('GET','/pages/[*:title]',  function($title){
   // coutput::outbyname($title);
    $v=new \core\View();
    $art=core\Model\c_article::findByField('filename', $title);

    if(!empty($art[0]))
      $v->article=$art[0];
    else $v->article=Null;
    $v->display(__DIR__ . '\tempalates\singleArticle.php');
});


$router->matchAll();