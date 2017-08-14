<?php
namespace application\controllers;

/**
 * Класс для работы с ajax-запросами
 */
class AjaxController extends \core\Controller 
{
    /**
     * Подгрузка "лайков" статей или товаров
     */
    public function likesAction()
    {
        $modelClassName = static::class;
        
        $Model = new $modelClassName();
        $Model->likesUpper($_GET['id'], $_GET['tableName']);
        \core\Session::get()->session['user']['userSessionLikesCount']++;
         
        echo $Model->getModelLikes($_GET['id'], $_GET['tableName']);
    }
    
    public function sessionLikesCountAction()
    {
        echo \core\Session::get()->session['user']['userSessionLikesCount'];
    }
    
    public function searchGoodsAction()
    {
        
    }
    
    public function showOnScrollingPageAction()
    {
        $Good = new \application\models\Good();
        
//        \DebugPrinter::debug($_POST);
//        \DebugPrinter::debug($_GET);
        
        $archiveGood = $Good->getPage($_POST['page-number'], $_POST['limit']); 
//        $archiveGood = $Good->getPage($_GET['page-number'], $_GET['limit']); 
        
//        \DebugPrinter::debug($archiveGood);
        $this->view->addVar('archiveGood', $archiveGood);
        
        $this->view->renderPartition('archive/allGoodsAjax.php');
    }
    
    public function addGoodToOrderAction()
    {
       $Order = new \application\models\Order();
        $Correction = new \application\models\Correction();
        $Good = new \application\models\Good();
        
        $newOrder = $Order->loadFromArray($_GET); 
//        \DebugPrinter::debug($newOrder);
//        die();

//        if($_POST['number'] <= $Good->getAvailableGoodById($_POST['id_goods'])){
            if (!$newOrder->isUserOrder()){
                $newOrder->insert();

            }
            $newCorrection = $Correction->loadFromArray($_GET);
            
            $id_orders = $Order->getUserOrderId();
            $newCorrection->id_orders = $id_orders;
            \DebugPrinter::debug($newCorrection);
//        die();
            
            $newCorrection->updateGoodOrderTransaction();
            echo "(" . (new \application\models\Correction())->getUsersAllGoodsCount() . ")";
//        }
//        else echo "Недостаточно товаров на складе!";
    }
          
}

