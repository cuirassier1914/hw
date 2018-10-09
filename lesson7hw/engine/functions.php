<?php

function getCatalog(){
    global $db;
    $result = mysqli_query($db, 'SELECT * FROM goods' );
    $goodsList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $goodsList[] = $row;
    };

    $ids = [];
    $urls = [];
    $names = [];
    $descriptions = [];
    foreach($goodsList as $good => $item) {
        $ids[] = $item['id'];
    };
    foreach($goodsList as $good => $item) {
        $urls[] = $item['imageUrl'];
    };
    foreach($goodsList as $good => $item) {
        $names[] = $item['name'];
    };
    foreach($goodsList as $good => $item) {
        $descriptions[] = $item['description'];
    };

    for ($i = 0; $i < count($ids); $i++) {
        echo '<div class="item">
            <a href="#">
                <h4 class="itemName">' . $names[$i] . '</h4>
                <img class="prev" src="' . $urls[$i] . '">
                <p class="discr">' . $descriptions[$i] . '</p>
                <form method="post" action="index.php">
                    <input type="hidden" name="id" value="' . $ids[$i] .'">
                    <button type="submit">Положить в корзину</button>
</form>
            </a>
        </div>';
    };
};

const PASS_SALT = 'vdafg12332vsdfvseafwes34';

$usersList = [];
$itemsnumber = 0;

if (isset ($_SESSION['items'])) {
    $itemsnumber = count($_SESSION['items']);
};

$guest = '
        <h3>
            Здравствуйте, Гость !
        </h3>
        <a href="user.php">Войти</a>
        <a href="registration.php">Зарегистрироваться</a>
    ';

function getUsers () {
    global $dbUsers;
    global $usersList;
    $result = mysqli_query($dbUsers, 'SELECT * FROM users');
    while ($row = mysqli_fetch_assoc($result)) {
        $usersList[] = $row;
    };
    return $usersList;
};

function Auth(){

    global  $dbUsers;
    global $itemsnumber;

    $userContent = '
        <h3>
            Неверное имя пользователя или пароль
        </h3>
        <a href="user.php">Войти</Войти></a>
        <a href="registration.php">Зарегистрироваться</a>
        ';

    if(isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $usersList = getUsers();

        foreach($usersList as $users => $user) {


            $isName = in_array($username, $user);
            $truePass = $user['password'];
            $userId = $user['id'];

            if ($isName && crypt($password, PASS_SALT) === $truePass) {

                $userContent = '
        <h3>
            Здравствуйте ' . $username . ' !
        </h3>
        <p>Товаров в вашей корзине: ' . $itemsnumber . '</p>
        <a href="afterExit.php">Выйти</Войти></a>
        <a href="profile.php">Личный кабинет</a>
        ';

                $_SESSION['name'] = $username;
                $_SESSION['userId'] = $userId;

                //"Запомнить меня"
                if (array_key_exists('checkbox', $_POST)) {

                    $key = random_int(100, 999);
                    $_SESSION[$key] = $username;
                    setcookie('user', $key, time() + (3600*24*30), 'localhost');
                    $sql = "UPDATE `users` SET `key` = '$key' WHERE `users`.`id` = $userId";
                    mysqli_query($dbUsers, $sql);
                }
                //
                break;
            };
        };
    }
    echo $userContent;
};

function isAuth(){

    global $dbUsers;
    global $itemsnumber;
    global $guest;

    $userContent = $guest;

    $user = isset($_SESSION['userId']);
    $userCookie = isset($_COOKIE['user']);

    $username = '';

    //Проверка на "запомненного"
    if ($user) {
        $username = $_SESSION['name'];
    } elseif ($userCookie) {
        $key = $_COOKIE['user'];
        $result = mysqli_query($dbUsers, "SELECT * FROM `users` WHERE `key` = $key");
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $userId = $row['id'];
        $_SESSION['name'] = $username;
        $_SESSION['userId'] = $userId;
    }
    //

    if ($user || $userCookie) {
        $userContent = '
        <h3>
            Здравствуйте ' . $username . ' !
        </h3>
        <p>Товаров в вашей корзине: ' . $itemsnumber . '</p>
        <a href="afterExit.php">Выйти</Войти></a>
        <a href="profile.php">Личный кабинет</a>
        ';
    }

    echo $userContent;
}

function registration(){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passHash = crypt($password, PASS_SALT);

    global $dbUsers;
    $sql = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '$username', '$passHash')";
    mysqli_query($dbUsers, $sql);

    echo '
        <h3>
            Вы успешно зарегистрированы !
        </h3>
        <a href="user.php">Войти</Войти></a>
        <a href="registration.php">Зарегистрироваться под другим именем</a>
    ';
}

function userExit() {
    if (isset($_COOKIE['user'])) {
        $key = $_COOKIE['user'];
        setcookie('user', $key, time() + 0);
    }

    unset($_SESSION['userId']);
    unset($_SESSION['name']);

    if (isset($_SESSION['items'])) {
        unset($_SESSION['items']);
    }


    echo '
        <h3>
            До встречи !
        </h3>
        <a href="user.php">Войти</a>
        <a href="registration.php">Зарегистрироваться</a>
    ';
}

function putInCart() {
    $item = '';
    if (isset($_POST['id'])) {
        $item = $_POST['id'];
        $_SESSION['items'][] = $item;
    };
}

function getCart()
{
    global $db;
    $items = $_SESSION['items'];
    foreach ($items as $good => $itemsId) {
        $result = mysqli_query($db, "SELECT * FROM goods WHERE `id` = $itemsId");
        $goodsList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $goodsList[] = $row;
        };

        $names = [];
        $ids = [];

        foreach($goodsList as $good => $item) {
            $ids[] = $item['id'];
        };

        foreach ($goodsList as $good => $item) {
            $names[] = $item['name'];
        };


        for ($i = 0; $i < count($names); $i++) {
            echo '<tr>
                <td>' . $i . '</td>
                <td>' . $names[$i] . '</td>
                <td>
                <form method="post" action="profile.php">
                    <input type="hidden" name="id" value="' . $ids[$i] .'">
                    <button type="submit">Удалить из корзины</button>
                </form>
                </td>
            </tr>';
        };
    }
}

function delete() {
    if (isset($_POST['id'])) {
        $item = $_POST['id'];
        $items = $_SESSION['items'];

        foreach ($items as $number => $id) {
            if ($id === $item) {
                unset($_SESSION['items'][$number]);
            }
        }
    };
}