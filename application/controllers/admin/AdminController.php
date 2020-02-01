<?php


namespace application\controllers\admin;


use ItForFree\SimpleMVC\mvc\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        $this->view->render('admin/index.php');
    }
}