<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="styles/main-page.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <script src="js/MainScript.js"></script>
    <script src="js/Catalog.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/GetCartItems.js"></script>
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
                <img onclick="wrapListProducts()" width="36" height="35" src="images/btn-roll.png" alt="button">
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
        <input style="padding: 10px;" type="text">
        <div class="right-search">
            <img src="images/search/btn-search.png" alt="button"/>
            <span>НАЙТИ</span>
        </div>
    </div>

    <div class="cards">
        <div class="cards-header">
            <span class="header">ПОПУЛЯРНЫЕ ТОВАРЫ</span>
            <div class="content">
                <img src="images/brends/left-arrow.png" alt="left-arrow"/>
                <div><span class="p1">3 </span><span class="p2"> / 15</span></div>
                <img src="images/brends/right-arrow.png" alt="right-arrow"/>
            </div>
        </div>

        <div class="card">
            <img src="images/card/card.png" alt="card"/>
            <p>BH Fitness F1 G6414V</p>
            <p class="p1">Беговая дорожка</p>
            <div class="bottom">
                <img class="cart" src="images/card/btn-cart.png" alt="btn-cart"/>
                <div class="price">
                    <span>64 990</span>
                    <img src="images/card/rub.png" alt="rub"/>
                </div>     
            </div>
        </div>

        <div class="card">
            <img src="images/card/card.png" alt="card"/>
            <p>BH Fitness F1 G6414V</p>
            <p class="p1">Беговая дорожка</p>
            <div class="bottom">
                <img class="cart" src="images/card/btn-cart.png" alt="btn-cart"/>
                <div class="price">
                    <span>64 990</span>
                    <img src="images/card/rub.png" alt="rub"/>
                </div>     
            </div>
        </div>

        <div class="card">
            <img src="images/card/card.png" alt="card"/>
            <p>BH Fitness F1 G6414V</p>
            <p class="p1">Беговая дорожка</p>
            <div class="bottom">
                <img class="cart" src="images/card/btn-cart.png" alt="btn-cart"/>
                <div class="price">
                    <span>64 990</span>
                    <img src="images/card/rub.png" alt="rub"/>
                </div>     
            </div>
        </div>    
        
        <div class="card">
            <img src="images/card/card.png" alt="card"/>
            <p>BH Fitness F1 G6414V</p>
            <p class="p1">Беговая дорожка</p>
            <div class="bottom">
                <img class="cart" src="images/card/btn-cart.png" alt="btn-cart"/>
                <div class="price">
                    <span>64 990</span>
                    <img src="images/card/rub.png" alt="rub"/>
                </div>     
            </div>
        </div>    

        <div class="card">
            <img src="images/card/card.png" alt="card"/>
            <p>BH Fitness F1 G6414V</p>
            <p class="p1">Беговая дорожка</p>
            <div class="bottom">
                <img class="cart" src="images/card/btn-cart.png" alt="btn-cart"/>
                <div class="price">
                    <span>64 990</span>
                    <img src="images/card/rub.png" alt="rub"/>
                </div>     
            </div>
        </div>    

        <div class="card">
            <img src="images/card/card.png" alt="card"/>
            <p>BH Fitness F1 G6414V</p>
            <p class="p1">Беговая дорожка</p>
            <div class="bottom">
                <img class="cart" src="images/card/btn-cart.png" alt="btn-cart"/>
                <div class="price">
                    <span>64 990</span>
                    <img src="images/card/rub.png" alt="rub"/>
                </div>     
            </div>
        </div>    
    </div>

    <div class="about-company">
        <div class="header">О КОМПАНИИ</div>
        <div class="info">
            <div class="info-left">
                Компания «CLEAR FIT» была организована для создания и реализации 
                качественного и надежного спортивного оборудования для домашнего и легкого 
                коммерческого использования. Дефицит качественных тренажеров в среднем 
                ценовом сегменте повлек за собой не мотивированный рост цен на надежное 
                оборудование, создав дополнительный сегмент "полукоммерческих" тренажеров, 
                что приблизило их стоимость к профессиональному оборудованию. А заполнение 
                среднего ценового сегмента сложилось из роста количества брендов и 
                производителей недорогих тренажеров с невысокими техническими 
                характеристиками, за счет увеличения количества дополнительных опций.  
                Главными критериями для выпуска продукции с маркой «CLEAR FIT» являются: 
                высокое качество, разумная цена и комфорт тренировок. Осуществить эту 
                непростую задачу позволил тандем европейских разработок и размещение 
                основного производства на Тайване. Узкая специализация на кардио-тренажеры 
                для дома позволяет поддерживать высокий контроль качества на всех ступенях 
                производства.
                <br>
                <br>
                Разумный показатель «цена/качество» среди предлагаемых разными компаниями 
                спортивных тренажеров в последние годы – довольно редкое явление. Мы 
                достаточно кропотливо потрудились над тренажерами CLEAR FIT, чтобы 
                продемонстрировать новый подход к выпуску доступной, красивой и  надежной 
                продукции. Современные технологии обеспечивают комфорт и легкость управления 
                тренажерами CLEAR FIT.Многочисленные отзывы от наших покупателей  поступили 
                и продолжают поступать feedbacks от конечных потребителей. И теперь мы с 
                гордостью можем заявить, что учли многие Ваши пожелания предложения в 
                обновленных версиях тренажеров CLEAR FIT. Мы рады представить Вам новое 
                поколение наших тренажеров. Теперь оборудование стало не только «умнее», 
                удобнее, комфортнее, но и сохранило прежние показатели цены, оставаясь 
                доступным спортивным оборудованием для тех, кто ценит качество.
            </div>

            <div class="info-right">
                <strong>КОНЦЕПЦИЯ CLEAR FIT СТРОИТСЯ НА СЛЕДУЮЩИХ ТЕЗИСАХ:</strong>
	            <div>
                    <img src="images/block-arrow.png" alt="block-arrow"/>
                    Спортивное оборудование для дома не отличается по эффективности и 
                безопасности от профессионального оборудования - от пользователя не 
                требуется специальная подготовка и  первичные навыки, наличие 
                индивидуального профессионального тренера, соответственно требует более 
                тщательного контроля.
                 </div>
	            <div>
                    <img src="images/block-arrow.png" alt="block-arrow"/>
                    Тренажеры CLEAR FIT просты в управлении, легко адаптируются под 
                индивидуальные особенности пользователя, эффективны и безопасны, 
                рассчитаны на самостоятельные тренировки.
                Основное требование к тренажерам под маркой «CLEAR FIT» высокое 
                качество по разумной стоимости - сохранить это равновесие основная задача 
                профессионалов из всех областей производства CLEAR FIT.
                </div>
	            <div>
                    <img src="images/block-arrow.png" alt="block-arrow"/>
                    Мир не стоит на месте - каждое поколение оборудования соответствует 
                современным технологиям. Продукция CLEAR FIT производится с учетом 
                новейших разработок по современной технологии, совершенствуя и улучшая 
                популярные серии оборудования и создавая принципиально новые актуальные 
                модели.
                </div>
	            <div>
                    <img src="images/block-arrow.png" alt="block-arrow"/>
                    Прежде всего оборудование CLEAR FIT ориентировано на конечного 
                пользователя - компания открыта для диалога, мы рады всем вашим отзывам 
                и замечаниям, это основной фактор создания комфортной и удобной 
                продукции.
                </div>
	            <div>
                    <img src="images/block-arrow.png" alt="block-arrow"/>
                    Качественный продукт не мыслим без качественного 
                сервисного обслуживания - официальный сервисный 
                центр CLEAR FIT обеспечивает техническую поддержку 
                в течение всего времени эксплуатации тренажера, 
                качественные услуги сервисного обслуживания 
                как в течение гарантийного срока, так и в 
                постгарантийный период.
                </div>
            </div>           
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