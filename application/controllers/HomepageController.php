<?php
namespace application\controllers;

use application\models\Articles;
use application\models\Categories;

class HomepageController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /**
     * @var string Название страницы
     */
    public $homepageTitle = "Домашняя страница";
    
    public $layoutPath = 'main.php';

    /**
     * Выводит на экран страницу "Домашняя страница"
     */
    public function indexAction()
    {
        $Articles = new Articles();
        $Articles->tableName = 'articles';
        $Articles->orderBy = 'publicationDate DESC';
        $results = $Articles->getList();
        foreach ($results['results'] as $article){
            $article->getShortContent();
        }
        $Categories = new Categories();
        foreach($Categories->getList()['results'] as $category){
            $results['categories'][$category->id] = $category;
        }
        $this->view->addVar('results', $results);
        $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
        $this->view->render('homepage/index.php');
    }
}

