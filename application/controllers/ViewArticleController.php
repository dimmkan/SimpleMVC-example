<?php


namespace application\controllers;


use ItForFree\SimpleMVC\mvc\Controller;
use application\models\Articles;
use application\models\Categories;

class ViewArticleController extends Controller
{
    public function indexAction()
    {
        $Article = new Articles();
        $Article->tableName = 'articles';
        $result = $Article->getById($_GET['id']);
    }
}