<?php


namespace application\models;


use ItForFree\SimpleMVC\mvc\Model;

class Subcategories extends Model
{
    // Свойства
    /**
     * @var int ID подкатегории из базы данных
     */
    public $id = null;
     /**
     * @var string Короткое описание подкатегории
     */
    public $description = null;
    /**
     * @var int ID родительской категории
     */
    public $parentId = null;
    /**
     * @var string Имя обрабатываемой таблицы
     */
    public $tableName = 'subcategories';
    /**
     *  @var string Имя поля по котору сортируем
     */
    public $orderBy = 'id ASC';
}