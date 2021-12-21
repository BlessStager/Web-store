<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="styles/main-page.css">
    <link rel="stylesheet" href="styles/cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <script src="js/MainScript.js"></script>
    <script src="js/Catalog.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/Cart.js"></script>
    <script src="js/GetCartItems.js"></script>
    <script src="js/Order.js"></script>
    <script src="js/Search.js"></script>
</head>
<body>
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
            <a href="reviews.php" class="rev-name">ОТЗЫВЫ</a>  
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
        <span>Корзина</span>
    </div>

    <div class="order">
        <div class="order-header">
            <span>ОФОРМЛЕНИЕ ЗАКАЗА</span>
        </div>

        <div class="order-content">
            <div class="order-menu">
                <div id="content-fast-order-btn" class="content-order-btn-active">БЫСТРЫЙ ЗАКАЗ</div>
                <div id="content-delivery-btn" class="content-order-btn">ДОСТАВКА В РЕГИОНЫ</div>
            </div>
            <div id="content-fast-order" class="content">
                <div class="data"> 
                    <div>
                        <span>Имя: <span class="ml">*</span></span>
                        <input id="fastName" type="text" required/>
                    </div>                
    
                    <div>
                        <span>Моб. телефон: <span class="ml">*</span></span>
                        <input id="fastNumber" type="number" required/>
                    </div>
    
                    <div>
                        <span>Ваш E-mail: <span class="ml">*</span></span>
                        <input id="fastEmail" type="email" required/>
                    </div>
                </div>
    
                <div class="explanation">
                    <p><span class="ml">*</span> Поля, обязательные для заполнения</p>
                    <br>
                    <p>Отправка товара производится только после 100% оплаты
                        товара. Стоимость доставки возможно оплатить при 
                       получении заказа.  
                    </p>
                    <br>
                    <p><span class="ml">*</span> Интернет-магазин не несет ответственности за задержку 
                        доставки заказа, связанную с работой курьерских служб DPD 
                        и EMS Почты России.
                    </p>
                </div>
            </div>      


            <div id="content-delivery" class="content" style="display: none;">
                <div class="data">
                    <div>
                        <span>Фамилия: <span class="ml">*</span></span>
                        <input id="surname" type="text" required/>
                    </div>
    
                    <div>
                        <span>Имя: <span class="ml">*</span></span>
                        <input id="name" type="text" required/>
                    </div>
    
                    <div>
                        <span>Отчество: <span class="ml">*</span></span>
                        <input id="secondname" type="text" required/>
                    </div>
    
                    <div>
                        <span>Моб. телефон: <span class="ml">*</span></span>
                        <input id="number" type="number" required/>
                    </div>
    
                    <div>
                        <span>Ваш E-mail: <span class="ml">*</span></span>
                        <input id="email" type="email" required/>
                    </div>
    
                    <div>
                        <span>Способ оплаты:</span>
                        <select type=>
                            <option>Через Сбербанк</option>
                        </select>
                    </div>
    
                    <div>
                        <span>Индекс <span class="ml">*</span></span>
                        <input id="index" type="number" required/>
                    </div>
    
                    <div>
                        <span>Город <span class="ml">*</span></span>
                        <input id="city" type="text" required/>
                    </div>
    
                    <div>
                        <span>Адрес доставки: <span class="ml">*</span></span>
                        <input id="address" type="text" required/>
                    </div>
    
                    <div class="last">
                        <span>Комментарии:</span>
                        <textarea id="comment"></textarea>
                    </div>
                </div>
    
                <div class="explanation">
                    <p><span class="ml">*</span> Поля, обязательные для заполнения</p>
                    <br>
                    <p>Отправка товара производится только после 100% оплаты
                        товара. Стоимость доставки возможно оплатить при 
                       получении заказа.  
                    </p>
                    <br>
                    <p>Доставка в регионы осуществляется EMS Почтой России 
                        (в течение 5-14 дней) и курьерской службой DPD (в течение 
                        3-5 дней) с момента передачи заказа в службу доставки. 
                        Стоимость зависит от веса заказа и расстояния. В некоторые 
                        регионы доставка возможна только посредством EMS Почты 
                        России, способ доставки уточняйте у оператора при 
                        оформлении заказа*.
                    </p>
                    <br>
                    <p><span class="ml">*</span> Интернет-магазин не несет ответственности за задержку 
                        доставки заказа, связанную с работой курьерских служб DPD 
                        и EMS Почты России.
                    </p>
                </div>
            </div>      
        </div>
    </div>

    <div class="confirm-order">
        <div class="confirm-order-header">
            <span>ВАШ ЗАКАЗ</span>
        </div>

        <div id="confirm-cards" class="confirm-cards">
            <div id="confirm-card" class="confirm-card" style="display: none;">
                <div class="confirm-card-content">
                    <img id="confirm-card-image" class="image" src="cart-images/image.png" alt="image"/>

                    <div>
                        <span id="confirm-card-name" class="name">BH Fitness F1 G6414V</span>
                        <span id="confirm-card-type" class="light-name">Беговая дорожка</span>
                        <div class="amount-block">
                            <span id="confirm-card-price" class="amount"></span>
                            <img src="cart-images/rub.png" alt="rub"/>
                        </div>
                    </div>

                    <div class="images">
                        <input id="confirm-card-input" class="field" type="number" />
                    </div>

                    <div>
                        <span class="total">Всего: </span>
                        <div class="amount-block">
                            <span id="confirm-card-amount" class="amount"></span>
                            <img src="cart-images/rub.png" alt="rub"/>
                        </div>
                    </div>
                </div>
                <img class="card-close" src="cart-images/close.png" alt="close"/>
            </div>
            
        </div>  
        
        <div class="confirm-order-total">
            <span class="p1">Итого:&nbsp;</span>
            <span id="confirm-order-total-amount" class="p2"></span> 
            <img src="cart-images/rub-orange.png" alt="rub"/>
        </div>
        <div class="btn-confirm">
            <img class="btns-confirm" src="cart-images/btn-confirm.png" alt="btn-confirm"/>
            <span class="btns-confirm">ОФОРМИТЬ ЗАКАЗ</span>
        </div>
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