<?php
namespace application\controllers;

use application\models\Articles;

/**
 * Можно использовать для обработки ajax-запросов.
 */
class AjaxController extends \ItForFree\SimpleMVC\mvc\Controller 
{
    /**
     * Подгрузка "лайков" статей или товаров
     */
    public function likeAction()
    {
       echo 'привет!';
    }

    public function postAction()
    {
        if(isset($_POST['id'])){
            $article = new Articles();
            $res = $article->getById($_POST['id']);
            echo json_encode($res->content);
        }
    }

    public function getAction()
    {
        if (isset($_GET['id'])) {
            $article = new Articles();
            $res = $article->getById($_GET['id']);
            echo json_encode($res->content);
        }
    }

    public function newPostAction()
    {
        if(isset($_POST['id'])){
            $article = new Articles();
            $res = $article->getById($_POST['id']);
            echo json_encode($res->content);
        }
    }

    public function newGetAction()
    {
        if (isset($_GET['id'])) {
            $article = new Articles();
            $res = $article->getById($_GET['id']);
            echo json_encode($res->content);
        }
    }
}

