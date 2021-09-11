<?php
    session_start();
    //print_r("1");
    //$sSub = $_POST["submit"];

    if(isset($_POST["submit"])) {  //проверяем, всё ли ввел пользователь
        if(empty($_POST["login"])) {
            echo 'Вы не ввели логин';
        } else if(empty($_POST["password"])){

            echo 'Вы не ввели пароль';

        } else if(empty($_POST["password2"])){

            echo 'Вы не ввели подтверждение пароля';

        } else if($_POST["password"] != $_POST["password2"]){

            echo 'Введенные пароли не совпадают';

        } else if(empty($_POST["email"])){

            echo 'Вы не ввели E-mail';
        }
        else {
            
            //print_r("2");
            
            $sLogin = $_POST['login'];
            $sPass = $_POST['password'];
            $sPass2 = $_POST['password2'];
            $sEmail = $_POST['email'];

            /* Пароль переводим в ХЭШ, используя функцию md5(); Она переводит введённый пароль, то есть кодирует его в хэш в виде 32-символьного шестнадцатеричного числа. Как и в обработчике авторизации, в обработчике регистрации прописываем функции, которые в заполненных полях редактируют данные — удаляют экранирование символов, удаляют лишние пробелы, преобразуют символы в html-сущности */ 
            //$sPass = md5("$sPass");

            //Подключаемся к БД и задаём переменные для подключения к БД
            $link = mysqli_connect("localhost", "root", "root", "autorisation");
            mysqli_select_db($link, "SELECT DATABASE()");

            $query = "SELECT id FROM users WHERE login = '$sLogin' AND password = '$sPass'"; 
            //выбрать id из таблицы users, где логин будет равняться переданному пользователем логину, пароль = переданному пользователем паролю

            $sLogin = stripslashes($sLogin);//удаляет экранирование символов, произведенное функцией addslashes()

            $sLogin = htmlspecialchars($sLogin);//преобразует специальные символы в HTML-сущности (обрабатываем их, чтобы теги и скрипты не работали на случай спамеров)
        
            $sPass = stripslashes($sPass);
            $sPass = htmlspecialchars($sPass);
            $sLogin = trim($sLogin);//удаляет пробелы (или другие символы) из начала и конца строки
            $sPass = trim($sPass);


        /* Теперь нам осталось занести данные, введённые в поля формы регистрации в таблицу зарегистрированных пользователей users, оповестить новоиспечённого пользователя о том, что регистрация прошла успешно выводом информации в браузер и предложить войти на сайт перейдя для этого по ссылке. */

            $sql = mysqli_query($link, $query);
            if (mysqli_num_rows($sql) > 0){
                echo 'Такой логин уже существует';
            } else {
                //print_r($query);

                $query="INSERT INTO users(login, password, name, lastname) VALUES ('$sLogin', '$sPass', '$sLogin', '$sEmail')"; 

                $result = mysqli_query($link, $query); // получим результат запроса в переменную.

                if (!$result) { 
                    $feedback = 'ОШИБКА - Ошибка базы данных'; 
                    $feedback = $feedback . mysqli_error($link); 
                    return $feedback; 
                }
                echo 'Регистрация успешно прошла';
                //header('Location: /./index.php'); // редиректим на обратно на html 
            }    
        }
    }
?>