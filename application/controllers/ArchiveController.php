<?php


namespace application\controllers;


use application\models\Articles;
use application\models\Categories;
use application\models\Subcategories;
use ItForFree\SimpleMVC\mvc\Controller;

class ArchiveController extends Controller
{
    public $homepageTitle = "Архив";

    public function indexAction()
    {
        $Article = new Articles();
        $data = $Article->getList();
        $results['articles'] = $data['results'];
        $results['totalRows'] = $data['totalRows'];
        $results['pageHeading'] = $this->homepageTitle;
        $this->view->addVar('results', $results);
        $this->view->render('archive/index.php');
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

    public function bySubcategoryAction()
    {
        $catId = $_GET['subcategoryId'];
        $Article = new Articles();
        $data = $Article->getListBySubategoryId($catId);
        $results['articles'] = $data['results'];
        $results['totalRows'] = $data['totalRows'];
        $results['pageHeading'] = $this->homepageTitle;
        $Subcategory = new Subcategories();
        $results['subcategory'] = $Subcategory->getById($catId);
        $this->view->addVar('results', $results);
        $this->view->render('archive/index.php');
    }
}