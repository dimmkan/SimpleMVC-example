<?php
namespace application\controllers\admin;

use application\models\ExampleUser;
use ItForFree\SimpleMVC\mvc\Controller;
use ItForFree\SimpleMVC\Url;

class LoginController extends Controller
{
    public function indexAction()
    {
        $User = ExampleUser::get();
        if(!empty($_POST)){
            if($User->login($_POST['username'], $_POST['password'])){
                $this->redirect(Url::link('admin/admin/'));
            }
        }else{
            $this->view->render('admin/login.php');
        }
    }

    public function logoutAction(){
        $User = ExampleUser::get();
        $User->logout();
        $this->redirect(Url::link('admin/login/'));
    }

}