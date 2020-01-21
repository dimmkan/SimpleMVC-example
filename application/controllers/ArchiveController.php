<?php


namespace application\controllers;


use application\models\Articles;
use application\models\Categories;
use ItForFree\SimpleMVC\mvc\Controller;

class ArchiveController extends Controller
{
    public $homepageTitle = "Архив";

    public function indexAction()
    {

    }

    public function byCategoryAction()
    {
        $catId = $_GET['categoryId'];
        $Article = new Articles();
        $data = $Article->getListByCategoryId($catId);
        $results['articles'] = $data['results'];
        $results['totalRows'] = $data['totalRows'];
        $results['pageHeading'] = $this->homepageTitle;
        $Category = new Categories();
        $results['category'] = $Category->getById($catId);
        $this->view->addVar('results', $results);
        $this->view->render('archive/index.php');
    }
}