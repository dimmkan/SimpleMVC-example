<?php


namespace application\controllers\admin;


use application\models\Articles;
use application\models\Categories;
use application\models\Subcategories;
use ItForFree\SimpleMVC\mvc\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        $Articles = new Articles();
        $Articles->tableName = 'articles';
        $Articles->orderBy = 'publicationDate DESC';
        $results = $Articles->getList(5);
        foreach ($results['results'] as $article){
            $article->getShortContent();
        }
        $Categories = new Categories();
        foreach($Categories->getList()['results'] as $category){
            $results['categories'][$category->id] = $category;
        }
        $Subcategories = new Subcategories();
        foreach($Subcategories->getList()['results'] as $subcategory){
            $results['subcategories'][$subcategory->id] = $subcategory;
        }
        $this->view->addVar('results', $results);
        $this->view->render('admin/index.php');
    }

    public function editArticleAction(){
        echo $_GET['id'];
    }
}