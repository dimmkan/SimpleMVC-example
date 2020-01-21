<?php


namespace application\controllers;


use ItForFree\SimpleMVC\mvc\Controller;
use application\models\Articles;
use application\models\Categories;

class ViewArticleController extends Controller
{
    public $homepageTitle = "Статья";

    public function indexAction()
    {
        $Article = new Articles();
        $Article->tableName = 'articles';
        $result = $Article->getById($_GET['id']);
        $data['article'] = $result;
        $Category = new Categories();
        $result = $Category->getById($result->categoryId);
        $data['category'] = $result;
        $this->view->addVar('results', $data);
        $this->view->addVar('homepageTitle', $this->homepageTitle);
        $this->view->render('article/index.php');


    }
}