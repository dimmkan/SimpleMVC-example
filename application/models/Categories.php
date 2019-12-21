<?php


namespace application\models;


use ItForFree\SimpleMVC\mvc\Model;

class Categories extends Model
{
    // Свойства
    /**
     * @var int ID категории из базы данных
     */
    public $id = null;
    /**
     * @var string Название категории
     */
    public $name = null;
    /**
     * @var string Короткое описание категории
     */
    public $description = null;
    /**
     * @var string Имя обрабатываемой таблицы
     */
    public $tableName = 'categories';
    /**
     *  @var string Имя поля по котору сортируем
     */
    public $orderBy = 'id ASC';
}