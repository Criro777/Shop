<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop | E-Shopper</title>
    <link href="/../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/../public/css/font-awesome.min.css" rel="stylesheet">
    <link href="/../public/css/prettyPhoto.css" rel="stylesheet">
    <link href="/../public/css/price-range.css" rel="stylesheet">
    <link href="/../public/css/animate.css" rel="stylesheet">
    <link href="/../public/css/main.css" rel="stylesheet">
    <link href="/../public/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/public/js/html5shiv.js"></script>
    <script src="/public/js/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/"><img src="/public/images/home/logo.png" alt=""/></a>
                    </div>
                    <div class="btn-group pull-right">

                           <form style="margin-top: 12px;" name="formMoney" id = "formMoney" method="post" action="/site/change-money">
                            <select  class="form-control" id = "selectMoney"  name = "selectMoney" onchange="fireSubmit(event)" >
                                <option selected ="selected">Валюта сайта</option>
                                <option name ="dollar" value = "dollar" >DOLLAR</option>
                                <option name = "euro" value = "euro">EURO</option>
                            </select>
                           </form>

                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="/cart">
                                    <i class="fa fa-shopping-cart"></i> Корзина
                                    <span id="cart-count"><?php echo \app\models\Cart::countItems(); ?></span>

                                </a>
                            </li>

                            <?php if (\app\models\User::isGuest()): ?>
                                <li><a href="/user/login"><i class="fa fa-lock"></i> Вход</a></li>
                            <?php else: ?>
                                <li><a href="/profile/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                <li><a href="/user/logout"><i class="fa fa-unlock"></i> Выход
                                    </a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">Главная</a></li>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/catalog/">Products</a></li>
                                    <li><a href="/cart/">Корзина</a></li>
                                </ul>
                            </li>

                            <li><a href="/blog">Блог</a>
                            </li>

                            <li><a href="/site/contact">Контакты</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form id="search_form" method="post" action="/site/search">


                                <input class="form-control" type="text" placeholder="Поиск..." name="search_query" value="<?php echo $_POST['search_query'] ?>">
                                <span class="icon"><i class="fa fa-search"></i></span>



                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>

<section>
    <?= $content ?>
</section>

<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>e</span>-shopper</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/../public/images/home/iframe1.png" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/../public/images/home/iframe2.png" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/../public/images/home/iframe3.png" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="video-gallery text-center">
                            <a href="#">
                                <div class="iframe-img">
                                    <img src="/../public/images/home/iframe4.png" alt=""/>
                                </div>
                                <div class="overlay-icon">
                                    <i class="fa fa-play-circle-o"></i>
                                </div>
                            </a>
                            <p>Circle of Hands</p>
                            <h2>24 DEC 2014</h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="/../public/images/home/map.png" alt=""/>
                        <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank"
                                                           href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<script src="/../public/js/jquery.js"></script>
<script type="text/javascript" src="/../public/js/validator.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&;sensor=false"></script>
<script src="/../public/js/bootstrap.min.js"></script>
<script src="/../public/js/jquery.accordion.js"></script>
<script src="/../public/js/jquery.cookie.js"></script>
<script src="/../public/js/jquery.cycle2.min.js"></script>
<script src="/../public/js/jquery.cycle2.carousel.js"></script>
<script src="/../public/js/jquery.scrollUp.min.js"></script>
<script src="/../public/js/price-range.js"></script>
<script src="/../public/js/jquery.light.js"></script>
<script src="/../public/js/jquery.prettyPhoto.js"></script>
<script src="/../public/js/main.js"></script>

</body>
</html>
