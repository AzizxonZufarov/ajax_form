<?php
$email = $_POST['email'];
$name = $_POST['name'];
$phone = $_POST['phone'];
//$message = $_POST['message'];
$message = '
        <html>
        <head>
        <title>Подтвердите Email</title>
        </head>
        <body>
        <p>Что бы подтвердить Email, перейдите по <a href="http://example.com/confirmed.php?hash=' . $hash . '">ссылка</a></p>
        </body>
        </html>
        ';

$subject = "=?utf-8?B?".base64_encode("Успешная регистрация")."?=";
$from = "orangelemoncoder@gmail.com";
$headers = "From: $from" . "\r\n" .
    "Reply-To: $from ". "\r\n" .
    "X-Mailer: PHP/"  . phpversion();
$success = mail($email, $subject, $message, $headers);

// хешируем хеш, который состоит из логина и времени
$hash = md5($login . time());

        // Сообщение для Email


        // Добавление пользователя в БД
        mysqli_query($db, "INSERT INTO `user` (`login`, `email`, `password`, `hash`, `email_confirmed`) VALUES ('" . $login . "','" . $email . "','" . $pass . "', '" . $hash . "', 1)");
        // проверяет отправилась ли почта
        if (mail($email, "Подтвердите Email на сайте", $message, $headers)) {
            // Если да, то выводит сообщение
            echo 'Подтвердите на почте';
        }
    } else {
        // Если ошибка есть, то выводить её
        echo $error;
    }
echo $success;
?>
