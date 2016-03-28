<?
namespace core\Tools;
class tools
{
    public static function filedel($filename)
    {
        if(file_exists($filename)) unlink($filename);
    }
    public static function initMySqlCon($cdb)
    {


        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try
        {
            $pdo = new PDO($cdb, 'upload', '123', $opt);
        }
        catch (PDOException $e)
        {
            die( $e->getMessage());
        }
        return $pdo;
    }
    public function doSql($cdb, $sql)
    {

            $i=0;
            $pdo = tools::initMySqlCon($cdb);
        $stmt = $pdo->query($sql);
        while ($row = $stmt->fetch())
        {
            $x[$i]=$row;
            $i++;
        }
        return $x;
    }
}