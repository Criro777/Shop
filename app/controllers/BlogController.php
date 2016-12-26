<?php

namespace app\controllers;


use app\models\Blog;

class BlogController extends AppController
{
    public function indexAction($page)
    {
        if (!isset($page)) {
            $page = 1;
        }
        
        $blogList = Blog::getItemsInPage(false,false,$page);
        $total = Blog::Count();

        $pagination = new \Pagination($total, $page, Blog::SHOW_BY_PANEL, 'page-');
        $pager = $pagination->get();
        $this->render('index',['blogList' => $blogList,'pager' => $pager]);
    }

    public function viewAction($blogId)
    {
        try {
            $blog = Blog::getItemById($blogId);
            $this->render('view', ['blog' => $blog[0]]);
        }catch (\Exception $e){
            $controller = new ErrorController(['controller' =>'Error', 'action' =>'index']);
            $action = $controller->indexAction();
        }
        
    }

    

}