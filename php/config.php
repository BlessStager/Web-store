<?php
function checkByRegistration(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if (isset($_POST['username']) && isset($_POST['email'])){
        $username = $_POST['username'];
        $email = $_POST['email'];

        $queryUsername = "SELECT * FROM registration WHERE `username`='$username'";
        $queryEmail = "SELECT * FROM registration WHERE `email`='$email'";
        $resultUsername = mysqli_query($connection, $queryUsername);
        $resultEmail = mysqli_query($connection, $queryEmail);
        $countUsername = mysqli_num_rows($resultUsername);
        $countEmail = mysqli_num_rows($resultEmail);

        if($countUsername != 0 || $countEmail != 0){
            if($countEmail != 0){
                ?><script>alert("Такой e-mail уже зарегистрирован!")</script><?php 
            } else if($countUsername != 0){
                ?><script>alert("Это имя пользователя уже используется!")</script><?php 
            }
            $emailСoincide = true;
        }
        else{
            $emailСoincide = false;
        }
    }
    mysqli_close($connection);
    return $emailСoincide;
}

function registration(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "INSERT INTO registration (username, email, password) VALUES ('$username',  '$email', '$password')";
        $result = mysqli_query($connection, $query);

        if(isset($result)){
            ?><script>alert("Регистрация прошла успешно!")</script><?php
        }
        else{
            ?><script>alert("Ошибка!")</script><?php
        }
    }
    mysqli_close($connection);
}

function authorization(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if (isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM `registration` WHERE `email`='$email' and `password`='$password'";
        $result = mysqli_query($connection, $query);
        $resultArray = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);

        if ($resultArray[1] == 'admin'){
            setcookie('admin', $resultArray[1], time() + 99999999999, '/');
            header('Location: admin-page.php');
        }

        else if ($count == 1){
            setcookie('user', $resultArray[1], time() + 3600, '/');
            setcookie('authMessage', "Добро пожаловать, $resultArray[1]!", time() + 1, '/');
            header('Location: main-page.php');
        }
        else{
            ?><script>alert("Неверный логин или пароль!")</script><?php
        }
    }

    mysqli_close($connection);
}

function news($currentPage){

    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $firstQuery = "SELECT * FROM `news`";
    $firstResult = mysqli_query($connection, $firstQuery);
    $num = mysqli_num_rows($firstResult);

    $countPage = ceil($num / 10);
    $countNewsOnLastPage = $num % 10;
    
    if ($countPage == $currentPage){
        $countNewsOnCurrentPage = $countNewsOnLastPage;
    } else{
        $countNewsOnCurrentPage = 10;
    }
    $minPage = $currentPage * 10 - 10;

    $secondQuery = "SELECT * FROM `news` LIMIT $minPage, $countNewsOnCurrentPage";
    $secondResult = mysqli_query($connection, $secondQuery);
    $resultArray = mysqli_fetch_all($secondResult);
    $countNewsOnPage = mysqli_num_rows($secondResult);

    mysqli_close($connection);

    return array($resultArray, $countPage, $countNewsOnPage);
}

function newPage($id){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $query = "SELECT * FROM `news` WHERE `id`='$id'";
    $result = mysqli_query($connection, $query);
    $resultArray = mysqli_fetch_array($result);

    mysqli_close($connection);

    return $resultArray;
}

function displayCatalog(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $query = "SELECT * FROM `productcategory` ORDER BY `id`";
    $result = mysqli_query($connection, $query);
    $resultArray = mysqli_fetch_all($result);
    $numberItems = mysqli_num_rows($result);

    mysqli_close($connection);

    return array($resultArray, $numberItems);
}

function displayCatalogPage($type, $page){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $query = "SELECT * FROM `product` WHERE `types`='$type'";
    $result = mysqli_query($connection, $query);
    $numberItems = mysqli_num_rows($result);

    $countPage = ceil($numberItems / 10);
    $countNewsOnLastPage = $numberItems % 10;

    if($countNewsOnLastPage == 0){
        $countNewsOnLastPage = 10;
    }
    
    if ($countPage == $page){
        $countCardsOnCurrentPage = $countNewsOnLastPage;
    } else{
        $countCardsOnCurrentPage = 10;
    }
    $minPage = $page * 10 - 10;

    $query2 = "SELECT * FROM `product` WHERE `types`='$type' LIMIT $minPage, $countCardsOnCurrentPage";
    $result2 = mysqli_query($connection, $query2);
    $resultArray = mysqli_fetch_all($result2);

    mysqli_close($connection);

    return array($resultArray, $numberItems, $countPage);
}

function displayProduct($id){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $query = "SELECT * FROM `product` WHERE `id`='$id'";
    $result = mysqli_query($connection, $query);
    $resultArray = mysqli_fetch_array($result);

    mysqli_close($connection);

    return $resultArray;
}

function addToCart($cardArray){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    list($name, $type, $price, $image, $quantity) = $cardArray;

    $query = "INSERT INTO `cart`(`name`, `type`, `price`, `image`, `quantity`) VALUES ('$name', '$type', '$price', '$image', '$quantity')";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function deleteFromCart($name){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $query = "DELETE FROM `cart` WHERE `name`='$name'";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function getNumItemsOfCart(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $query = "SELECT * FROM `cart";
    $result = mysqli_query($connection, $query);
    $resultArray = mysqli_fetch_all($result);
    $resultNum = mysqli_num_rows($result);

    mysqli_close($connection);
    return array($resultArray, $resultNum);
}

function addCategory(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if(isset($_POST['nameAdd'])){
        $name = $_POST['nameAdd'];

        $query = "INSERT INTO `productcategory`(`name`) VALUES ('$name')";
        $result = mysqli_query($connection, $query);
    }   

    mysqli_close($connection);
}

function deleteCategory(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $name = $_POST['nameDel'];

    $query = "DELETE FROM `productcategory` WHERE `name`='$name'";;
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function changeCategory(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $name = $_POST['nameChange'];
    $newName = $_POST['newName'];

    $query = "UPDATE `productcategory` SET `name`='$newName' WHERE `name`='$name'";;
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function addProduct(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if(isset($_POST['nameProdAdd'])){
        $name = $_POST['nameProdAdd'];
        $types = $_POST['typesProd'];
        $type = $_POST['typeProd'];
        $price = $_POST['priceProd'];
        $image = $_POST['imageProd'];

        $query = "INSERT INTO `product`(`name`,`types`,`type`,`price`,`image`) VALUES ('$name', '$types', '$type', '$price', '$image')";
        $result = mysqli_query($connection, $query);
    }   

    mysqli_close($connection);
}

function deleteProduct(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $name = $_POST['nameProdDel'];

    $query = "DELETE FROM `product` WHERE `name`='$name'";;
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function changeProduct(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $name = $_POST['nameProdChange'];
    $newName = $_POST['newNameProd'];
    $newTypes = $_POST['typesNewProd'];
    $newType = $_POST['typeNewProd'];
    $newPrice = $_POST['priceNewProd'];
    $newImage = $_POST['imageNewProd'];

    $query = "UPDATE `product` SET `name`='$newName',`types`='$newTypes',`type`='$newType',`price`='$newPrice',`image`='$newImage' WHERE `name`='$name'";;
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function addNews(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if(isset($_POST['titleNewsAdd'])){
        $title = $_POST['titleNewsAdd'];
        $date = $_POST['dateNewsAdd'];
        $text = $_POST['textNewsAdd'];

        $query = "INSERT INTO `news`(`title`,`date`,`text`) VALUES ('$title', '$date', '$text')";
        $result = mysqli_query($connection, $query);
    }   

    mysqli_close($connection);
}

function deleteNews(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $id = $_POST['idNewsDel'];

    $query = "DELETE FROM `news` WHERE `id`='$id'";;
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function changeNews(){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    $id = $_POST['idNewsChange'];
    $title = $_POST['titleNewsChange'];
    $date = $_POST['dateNewsChange'];
    $text = $_POST['textNewsChange'];

    $query = "UPDATE `news` SET `title`='$title',`date`='$date',`text`='$text' WHERE `id`='$id'";;
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

function addFastOrder($order){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if(isset($order)){
        if (isset($_COOKIE['user'])){
            $user = $_COOKIE['user'];
        } else{
            return false;
        }

        $name = $order["uName"];
        $number = $order["number"];
        $email = $order["email"];

        $query = "INSERT INTO `fastorder`(`user`,`name`,`number`,`email`) VALUES ('$user', '$name', '$number', '$email')";
        $result = mysqli_query($connection, $query);
    }   

    mysqli_close($connection);
    return true;
}

function addDeliveryOrder($order){
    $connection = mysqli_connect('localhost', 'root', '', 'web-store');

    if(isset($order)){
        if (isset($_COOKIE['user'])){
            $user = $_COOKIE['user'];
        } else{
            return false;
        }

        $surname = $order["surname"];
        $name = $order["uName"];
        $secondName = $order["secondName"];
        $number = $order["number"];
        $email = $order["email"];
        $index = $order["index"];
        $city = $order["city"];
        $address = $order["address"];
        $comment = $order["comment"];

        $query = "INSERT INTO `deliveryorder`(`user`,`surname`,`name`,`secondname`,`number`,`email`,`index`,`city`,`address`,`comment`) VALUES ('$user', '$surname', '$name', '$secondName', '$number', '$email', '$index', '$city', '$address', '$comment')";
        $result = mysqli_query($connection, $query);
    }   

    mysqli_close($connection);
    return true;
}
?>