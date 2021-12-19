<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="styles/main-page.css">
    <link rel="stylesheet" href="styles/product-page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <script src="js/MainScript.js"></script>
    <script src="js/Catalog.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/GetCartItems.js"></script>
    <script src="js/ProductPage.js"></script>
    <script src="js/Search.js"></script>
</head>
<body>
<?php
    require_once("php/config.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $productData = displayProduct($id);
    $productName = $productData[1];
    $productType = $productData[3];
    $productPrice = $productData[4];
    $productImage = $productData[5];
    $productDescription = $productData[6];
    ?>
    <div id="wrapper" class="wrapper hidden">
        <header>
        <div class="center-header">
            <div class="logo">LOGO</div>
            <span class="type">спортивный магазин</span>
        </div>
        <div class="left-bottom-header">
            <?php if (!isset($_COOKIE['user'])): ?>
                <div class="left-bottom-header-item">
                    <img src="images/ath.png" alt="authorization"/>
                    <a href="authorization.php">Вход</a>
                </div>  
                <div class="left-bottom-header-item">
                    <img src="images/reg.png" alt="registration"/>
                    <a href="registration.php" class="active">Регистрация</a>
                </div>  
            <?php elseif (isset($_COOKIE['user'])): 
                $username = $_COOKIE['user'];
                if (isset($_COOKIE['authMessage'])){
                    $authMessage = $_COOKIE['authMessage'];
                    echo "<script>alert('$authMessage');</script>";
                }
                ?>
                <div class="left-bottom-header-item">
                    <img src="images/ath.png" alt="authorization"/>
                    <?php echo "<a>$username</a>" ?>
                </div>  
                <div class="left-bottom-header-item">
                    <a href="php/logout.php" class="active">Выйти</a>
                </div>  
            <?php endif; ?>
            <div class="left-bottom-header-item">
                <img src="images/mail.png" alt="mail"/>
                <a href="mailto:sport@gmail.com" class="active">sport@gmail.com</a>
            </div>          
        </div>
        <div class="right-bottom-header">
            <div class="back-call">
                <img src="images/back-call.png" alt="back-call"/>
                <a href="tel:+78005553535">Звонок</a>
            </div>  
            <div class="time-work">
                <img width="22" height="22" src="images/time-work.png" alt="time-work"/>
                <div>
                    <p>Пн–Пт: 09:00–21:00</p>
                    <p>Сб–Вс: 10:00–20:00</p>
                </div>
            </div>  
            <div class="cart">
                <img class="cart-href" src="images/cart.png" alt="cart"/>
                <div class="label">
                    <span id="cartItemsCount"></span>
                </div>              
            </div>          
        </div>
    </header>
    
    <aside>
    <div class="list-of-products">
            <div class="heading">
                <div>КАТАЛОГ ТОВАРОВ</div>
                <img id="catalog-btn" onclick="wrapListProducts()" width="36" height="35" src="images/btn-roll.png" alt="button">
            </div>
            <ul id="listProducts">
                <div id="catalog-item" class="catalog-item" style="display: none;">
                    <li class="split-line"></li>
                    <li>
                        <a id="catalog-item-href"></a>
                    </li>
                </div>
            </ul>
        </div>

        <div class="news">
            <a href="news.php" class="name">НОВОСТИ</a>   
        </div>     
        
        <div class="reviews">
            <div class="rev-name">ОТЗЫВЫ</div>
        </div>
    </aside>

    <div class="search">
        <div class="left-search">
            <img src="images/search/magn.png" alt="magnifier"/>
            <span>Поиск</span>
            <img src="images/search/arrow.png" alt="arrow"/>
        </div>
        <input id="search-input" style="padding: 10px;" type="text">
        <div id="search-btn" class="right-search">
            <img src="images/search/btn-search.png" alt="button"/>
            <span>НАЙТИ</span>
        </div>
    </div>

    <div class="nav">
        <a href="main-page.php"><u>Главная</u></a>
        <img src="cart-images/arrow.png" />
        <span>Каталог товара</span>
    </div>

    <div class="container">
        <div class="product">
            <div class="product-header">
                <?php echo "<p id='product-name' class='top-header'>$productName</p>
                <p id='product-type' class='bot-header'>$productType</p>" ?>
            </div>
    
            <div class="product-image">
                <div class="image">
                    <?php echo"<img id='product-image' src=$productImage alt='image'/>"?>
                </div>
            </div>
        </div>

        <div class="product-description">

            <div class="block-2">
                <div class="price">
                    <?php echo "<span id='product-price'>$productPrice</span>
                    <img src='catalog-image/rub.png' alt='rub'/>" ?>
                </div>
                <div class="amount">              
                    <input id="product-quantity" type="number" value="1"/>
                </div>
                <div id="to-cart" class="to-cart">
                    <span>В КОРЗИНУ</span>
                </div>
            </div>

            <img width="360" src="catalog-image/split-line.png" alt="split-line"/>

            <div class="block-3">
                <span>В СТОИМОСТЬ ТОВАРА ВКЛЮЧЕНО:</span>
            </div>

            <div class="block-4">
                <div class="logo">
                    <div>
                        <img src="catalog-image/ass.png" alt="ass"/>
                    </div>        
                    <p>Бесплатная сборка</p>
                </div>
                <div class="logo">
                    <div>
                        <img src="catalog-image/del.png" alt="del"/>
                    </div>                  
                    <p>Бесплатная доставка</p>
                </div>
                <div class="logo-2">
                    <div>
                        <img src="catalog-image/quar.png" alt="quar"/>
                    </div>
                    <p>Гарантия</p>
                </div>
            </div>
        </div>
    </div>

    <div class="about-product">
        <?php echo"<div class='content'>$productDescription</div>" ?>
    </div>

    <footer>
        <div class="footer-line">
            ------------------------------------------------------------------------------
        </div>

        <div class="bottom-footer">
            <div class="left-footer">
                <div class="footer-logos">
                    <div class="left-footer-logos">
                        <div class="main-logo">
                            <p class="header">LOGO</p>
                            <p class="desc">Спортивный магазин</p>
                        </div>
    
                        <div class="numbers">
                            <img width="19" height="25" src="images/footer/phone.png" alt="phone"/>
                            <div>
                                <p>8-499-123-45-67</p>
                                <p>8-800-123-45-67</p>
                            </div>                       
                        </div>
                    </div>
    
                    <div class="right-footer-logos">
                        <p>ДОСТАВКА ТРАНСПОРТНЫМИ КОМПАНИЯМИ:</p>
    
                        <div class="t-companies">
                            <img width="130" height="19" src="images/footer/t1.png" alt="transport-company"/>
                            <img width="39" height="34" src="images/footer/t2.png" alt="transport-company"/>
                            <img width="101" height="29" src="images/footer/t3.png" alt="transport-company"/>
                        </div>
    
                        <div class="t-companies">
                            <img width="32" height="45" src="images/footer/t4.png" alt="transport-company"/>
                            <img width="51" height="38" src="images/footer/t5.png" alt="transport-company"/>
                            <img width="128" height="21" src="images/footer/t6.png" alt="transport-company"/>
                         </div>
                    </div>
                </div>
    
                <div class="footer-cards">
                    <img src="images/footer/visa.png" alt="card"/>
                    <img src="images/footer/mc.png" alt="card"/>
                    <img src="images/footer/wm.png" alt="card"/>
                    <img src="images/footer/ym.png" alt="card"/>
                    <img src="images/footer/qiwi.png" alt="card"/>
                </div>
            </div>
    
            <div class="right-footer">
                <img width="300" height="254" src="images/footer/vk-1.png" alt="vk"/>
            </div>
        </div>
        <div class="footer-split-line">
            <img src="images/footer/split-line.png" alt="split-line"/>
        </div>
        <div class="soc-block">
            <span>©2015 Все права защищены.</span>
            <div>
                <img src="images/footer/vk.png" alt="soc-icons"/>
                <img src="images/footer/fb.png" alt="soc-icons"/>
                <img src="images/footer/inst.png" alt="soc-icons"/>
                <img src="images/footer/odn.png" alt="soc-icons"/>
            </div>
        </div>
    </footer>
</div>  
<?php 
require_once("php/config.php");
$displayCatalog = displayCatalog();
$displayCatalog = json_encode($displayCatalog);
echo "<script>displayCatalog($displayCatalog)</script>";
?>
<script>
    document.getElementById("wrapper").classList.remove("hidden");
</script>
</body>