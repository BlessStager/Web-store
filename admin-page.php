<?php 
    require_once('php/config.php');
    addCategory();
    changeCategory();
    deleteCategory();
    addProduct();
    changeProduct();
    deleteProduct();
    addNews();
    changeNews();
    deleteNews();
?>

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
    <script src="js/AdminPage.js"></script>
</head>
<body>
    <div id="wrapper" class="wrapper hidden">
        <header>
        <div class="center-header">
            <div class="logo">LOGO</div>
            <span class="type">спортивный магазин</span>
        </div>
        <div class="left-bottom-header">
                <div class="left-bottom-header-item">
                    <img src="images/ath.png" alt="authorization"/>
                    <a>admin</a>
                </div>  
                <div class="left-bottom-header-item">
                    <a href="php/logout.php" class="active">Выйти</a>
                </div>  
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

    <div id="form-btns" style="display: flex;">
        <button id="btn-form-category">Отредактировать категории</button>
        <button id="btn-form-product">Отредактировать товары</button>
        <button id="btn-form-news">Отредактировать новости</button>
    </div>

    <div class="forms">
        <div id="form-category" style="display: none;">
            <form action="" method="post">
                <input name="nameAdd" placeholder="Название категории" required/>
                <button>Добавить</button>
            </form>

            <form action="" method="post">
                <input name="nameChange" placeholder="Название категории" required/>
                <input name="newName" placeholder="Новое название категории" required/>
                <button>Изменить</button>
            </form>

            <form action="" method="post">
                <input name="nameDel" placeholder="Название категории" required/>
                <button>Удалить</button>
            </form>
        </div>

        <div id="form-product" style="display: none;">
            <form action="" method="post">
                <input name="nameProdAdd" placeholder="Название товара" required/>
                <input name="typesProd" placeholder="Категория товара" required/>
                <input name="typeProd" placeholder="Тип товара" required/>
                <input name="priceProd" placeholder="Цена товара" required/>
                <input name="imageProd" placeholder="Путь к изображению товара" required/>
                <button>Добавить</button>
            </form>

            <form action="" method="post">
                <input name="nameProdChange" placeholder="Товар для редактирования" required/>
                <input name="newNameProd" placeholder="Название товара" required/>
                <input name="typesNewProd" placeholder="Категория товара" required/>
                <input name="typeNewProd" placeholder="Тип товара" required/>
                <input name="priceNewProd" placeholder="Цена товара" required/>
                <input name="imageNewProd" placeholder="Путь к изображению товара" required/>
                <button>Изменить</button>
            </form>

            <form action="" method="post">
                <input name="nameProdDel" placeholder="Название товара" required/>
                <button>Удалить</button>
            </form>
        </div>

        <div id="form-news" style="display: none;">
            <form action="" method="post">
                <input name="titleNewsAdd" placeholder="Заголовок новости" required/>
                <input type="date" name="dateNewsAdd" placeholder="Дата новости" required/>
                <input name="textNewsAdd" placeholder="Текст новости" required/>
                <button>Добавить</button>
            </form>

            <form action="" method="post">
                <input name="idNewsChange" placeholder="ID новости" required/>
                <input name="titleNewsChange" placeholder="Новый заголовок новости" required/>
                <input type="date" name="dateNewsChange" placeholder="Новая дата новости" required/>
                <input name="textNewsChange" placeholder="Новый текст новости" required/>
                <button>Изменить</button>
            </form>

            <form action="" method="post">
                <input name="idNewsDel" placeholder="ID новости" required/>
                <button>Удалить</button>
            </form>
        </div>
    </div>
    
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