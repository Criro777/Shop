<?php

namespace app\controllers;


use app\models\Blog;

class BlogController extends AppController
{

    protected static $isVoted = false;

    public function indexAction($page)
    {
        if (!isset($page)) {
            $page = 1;
        }

        $blogList = Blog::getItemsInPage(false, false, $page);
        $total = Blog::Count();

        $pagination = new \Pagination($total, $page, Blog::SHOW_BY_PANEL, 'page-');
        $pager = $pagination->get();
        $this->render('index', ['blogList' => $blogList, 'pager' => $pager]);
    }

    public function viewAction($blogId)
    {
        try {
            $blog = Blog::getItemById($blogId);
            $ip = $_SERVER['REMOTE_ADDR'];
            $ip_check = Blog::check_ip($ip, $blogId);

            if ($ip_check) {
                self::$isVoted = true;
            }
            $this->render('view', ['blog' => $blog[0], 'isVoted' => self::$isVoted]);
        } catch (\Exception $e) {
            $controller = new ErrorController(['controller' => 'Error', 'action' => 'index']);
            $action = $controller->indexAction();
        }

    }

    public function addRateAction($id)
    {

        $aResponse['error'] = false;


        if (isset($_POST['action'])) {


            $ip = $_SERVER['REMOTE_ADDR'];
            $res = Blog::getItemById($id);


            $blog = new Blog();


            $aResponse['rating'] = $_POST['rate'];

            $_POST['voted'] = $res[0]->voted + 1;
            $_POST['rate'] += $res[0]->rate;

            $blog->add_ip($ip, $id);
            $blog->fillPostData($_POST);
            $result = $blog->updateItem();

            $aResponse['voted'] = $_POST['voted'];

            echo json_encode($aResponse);


        } else {

            header("Location:/blog");
        }

    }


}