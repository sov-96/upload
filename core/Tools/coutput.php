<?
namespace core\Tools;
class coutput
{
    public static function outbyname($name)
    {
        $cdb= "mysql:host=127.0.0.1;dbname=upload;charset=utf8";
        $pdo = tools::initMySqlCon($cdb);
        $q=$pdo->prepare("SELECT * FROM advertising where filename=?");
        var_dump($name);
        //$q->bindParam(':filename', $name);
        $q->execute(array($name));
        while ($row = $q->fetch(PDO::FETCH_LAZY))
        {
            echo "<br>".$row->title . "<br>";
            echo $row->artbody;
        }
    }
}

