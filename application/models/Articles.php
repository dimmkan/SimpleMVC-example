<?php


namespace application\models;


use ItForFree\SimpleMVC\mvc\Model;

class Articles extends Model
{
    // Свойства
    /**
     * @var int ID статей из базы данны
     */
    public $id = null;
    /**
     * @var int Дата первой публикации статьи
     */
    public $publicationDate = null;
    /**
     * @var string Полное название статьи
     */
    public $title = null;
    /**
     * @var int ID категории статьи
     */
    public $categoryId = null;
    /**
     * @var string Краткое описание статьи
     */
    public $summary = null;
    /**
     * @var string HTML содержание статьи
     */
    public $content = null;
    /**
     * @var string Поле для задания №1 - 50 первых символов
     * поля content + "..."
     */
    public $shortContent = null;

    public $subcategoryId = null;

    /** @var string  */
    public $orderBy = 'publicationDate DESC';

    /** @var string  */
    public $tableName = 'articles';

    public function getShortContent()
    {
        $func = function($string, $start = 0, $length = 50, $trimmarker = '...'){
            $len = strlen(trim($string));
            $newstring = ( ($len >= $length) && ($len != 0) ) ? rtrim(mb_substr($string, $start, $length - strlen($trimmarker))) . $trimmarker : $string;
            return $newstring;
        };
        $this->shortContent = $func($this->content);
    }

    public function getListByCategoryId($categoryId)
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM $this->tableName WHERE categoryId = :categoryId
                ORDER BY  $this->orderBy ";

        $modelClassName = static::class;

        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":categoryId", $categoryId, \PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $example = new $modelClassName($row);
            $list[] = $example;
        }

        $sql = "SELECT FOUND_ROWS() AS totalRows"; //  получаем число выбранных строк
        $totalRows = $this->pdo->query($sql)->fetch();
        return (array ("results" => $list, "totalRows" => $totalRows[0]));
    }

    public function getList($numRows = 100000)
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM $this->tableName WHERE actions = 1
                ORDER BY  $this->orderBy LIMIT :numRows";

        $modelClassName = static::class;

        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":numRows", $numRows, \PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $example = new $modelClassName($row);
            $list[] = $example;
        }

        $sql = "SELECT FOUND_ROWS() AS totalRows"; //  получаем число выбранных строк
        $totalRows = $this->pdo->query($sql)->fetch();
        return (array ("results" => $list, "totalRows" => $totalRows[0]));
    }

    public function getListBySubategoryId($catId)
    {
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM $this->tableName WHERE subcategoryId = :subcategoryId
                ORDER BY  $this->orderBy ";

        $modelClassName = static::class;

        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":subcategoryId", $catId, \PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $example = new $modelClassName($row);
            $list[] = $example;
        }

        $sql = "SELECT FOUND_ROWS() AS totalRows"; //  получаем число выбранных строк
        $totalRows = $this->pdo->query($sql)->fetch();
        return (array ("results" => $list, "totalRows" => $totalRows[0]));
    }
}