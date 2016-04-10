<?php

/**
 * Created by PhpStorm.
 * User: Seyda
 * Date: 17.03.2016
 * Time: 21:07
 */

namespace core\Model;
use core\Model;
class c_article extends Model
{
    const TABLE = 'advertising';
    const FK='id';
    public $title;
    public $summary;
    public $keywords;
    public $artbody;
    public $filename;
    //private $pdo; CRUD
    public  function save($pdo)
    {

        try
        {
           // $params = array( 'title' => $this->title, 'summary' => $this->summary, 'keywords' => $this->keywords,
            //    'artbody' => $this->artbody, 'filename' => $this->filename );
            $q=$pdo->prepare("INSERT INTO `advertising` (title, summary,  keywords,  artbody, filename) value (:title, :summary, :keywords,:artbody, :filename)");
            $q->bindValue(':title', $this->title);
            $q->bindValue(':summary', $this->summary);
            $q->bindValue(':keywords', $this->keywords);
            $q->bindValue(':artbody',iconv('WINDOWS-1251', 'UTF-8', $this->artbody), \PDO::PARAM_STR);

            $q->bindValue(':filename', $this->filename);
            echo $this->artbody;
            $q->execute();

            return true;
        }
        catch (PDOException $e)
        {
            die('Подключение не удалось: ' . $e->getMessage());
        }
    }


    public static function parse($text)
    {
        $art=new c_article();

            $art->title = $art -> parser("Title: \r\n", $text, 1);


            $art->summary = $art -> parser("Summary:\r\n", $text, 1);


            $art->keywords = $art -> parser("Keywords:\r\n", $text, 1);

            $art->artbody = $art -> parser("Article Body:\r\n", $text, 0);

        return $art;
    }
    private function parser($firstword, $text,$counlines)
    {
        //try {
            $start = array_search($firstword, $text);
        //var_dump( $text);
            if ($start == False) return '';
            $res = '';

            if ($counlines > 0) {
                for ($i = 1; ($i <= $counlines) && ($i < count($text)); $i++) {
                    $res .= $text[$start + $i];

                }
            } else {
                for ($i = 1; $i < count($text); $i++) {
                    $res .= $text[$start + $i];
                }
            }
        //filedel($directory,$filename);

            return $res;
        //}catch(Exception $ex) {
          //  throw new Exception('Ошибка парсинга файла $firstword='.$firstword);
    //}



    }



}

