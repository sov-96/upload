<?
namespace core\Tools;
use core\Model\c_article;
class coutput
{
    public static function outbyname($name)
    {
       /* $cdb= "mysql:host=127.0.0.1;dbname=upload;charset=utf8";
        $pdo = ctools::initMySqlCon($cdb);
        $q=$pdo->prepare("SELECT * FROM advertising where filename=?");
        var_dump($name);
        //$q->bindParam(':filename', $name);
        $q->execute(array($name));*/
        $q=c_article::findByField('filename', $name);
        while ($row = $q->fetch(\PDO::FETCH_LAZY))
        {
            include_once(__DIR__ . '/../View/singleArticle.php');
        }
    }

}

