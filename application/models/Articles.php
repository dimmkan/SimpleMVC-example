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

    public function getShortContent()
    {
        $func = function($string, $start = 0, $length = 50, $trimmarker = '...'){
            $len = strlen(trim($string));
            $newstring = ( ($len >= $length) && ($len != 0) ) ? rtrim(mb_substr($string, $start, $length - strlen($trimmarker))) . $trimmarker : $string;
            return $newstring;
        };
        $this->shortContent = $func($this->content);
    }
}