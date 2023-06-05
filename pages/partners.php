<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Туристическое агентство - kaztour.kz </title>
    <link rel="stylesheet" href="../style/partstyle.css">
</head>

<body>

<header>
        <img src="../img/logo.png" alt="LoGo" class="logo">

        <nav>
        <a id="navmain" href="../index.php" >Главная</a>
            <a class="select" id="navsale" href="partners.php">Скидки</a>
            <a id="navfirma" href="contact.php">Тур фирмы</a>
            <a id="navabout" href="vacanda.php">О нас</a>
        </nav>

        <div class="contact">
            <select id="city">
                <option class="city_open" value="ru">Ru</option>
                <option class="city_open" value="kk">Kz</option>
            </select>
        </div>

    </header>

    <div class="background">
    <h1 id="prvilege">Привилегии для всех: Система специальных скидок и предложений</h1>
    </div>
    <div class="row">

    <?php
    require_once('../config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Запрос данных из базы данных
    $sql = "SELECT * FROM sale";
    $result = $conn->query($sql);

    $data = array(); // Массив для хранения данных из базы данных

    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Сохранение данных в массив
    }

    for ($i = 0; $i < 5; $i++) {
        if (isset($data[$i])) {
            $image = $data[$i]['imageUrl'];

            // Вывод компонента
            echo '<div class="partner">';
            echo '<img src="' . $image . '" alt="">';
            echo '</div>';
        }
    }
    echo '</div>';

    echo '<div class="wrapper">';
    echo '<div class="first_col">';
    for ($i = 0; $i < 3; $i++) {
        if (isset($data[$i])) {
            $title = $data[$i]['title'];
            $text = $data[$i]['text'];
            $image = $data[$i]['imageUrl'];

            // Вывод компонента
            echo '<div class="block">';
            echo '<img src="' . $image . '" alt="">';
            echo '<h3>' . $title . '</h3>';
            echo '<p>' . $text . '</p>';
            echo '</div>';
        }
    }
    echo '</div>';

    echo '<div class="two_col">';
    for ($i = 3; $i < 6; $i++) {
        if (isset($data[$i])) {
            $title = $data[$i]['title'];
            $text = $data[$i]['text'];
            $image = $data[$i]['imageUrl'];

            // Вывод компонента
            echo '<div class="block">';
            echo '<img src="' . $image . '" alt="">';
            echo '<h3>' . $title . '</h3>';
            echo '<p>' . $text . '</p>';
            echo '</div>';
        }
    }
    echo '</div>';
    echo '</div>';

    $conn->close();
    ?>

<footer>
        <div class="foo_container">
            <div id="nonepub"  class="fort_col">
                Сайт PolyTour для учебной работы
                Сайт не является публичной
            </div>
            <div class="fort_col">
                <p id="pokupatel"> <b>Покупателям</b></p>
                <p id="booking"><a href="">Правила бронирования</a></p>
                <p id="Payment"><a href="">Онлайн оплата</a></p>
                <p id="faq"><a href="">Вопросы и ответы</a></p>
            </div>
            <div class="fort_col">
                <p id="mover"> <b>Направления</b></p>
                <p > <a href="">Астана</a></p>
                <p> <a href="">Алматы</a></p>
            </div>
            <div class="foo_contact">
                <a href="tel:87472326302" id="tell"> +7 747 232 6302</a>
                <p id="call">Единый Call center</p><br><br>
                <p id="auter">Все права на ресурсы были взяты из Интернета</p>
            </div>
        </div>
        </footer>

    <script>
    // Проверяем, есть ли уже сохраненный выбранный язык
    let selectedLanguage = localStorage.getItem("selectedLanguage");

    // Если выбранный язык уже сохранен, применяем его
    if (selectedLanguage) {
        applyLanguage(selectedLanguage);
    }

    // Функция для применения выбранного языка
    function applyLanguage(language) {
        let selectElement = document.getElementById("city");

        let NavMain = document.getElementById("navmain");
        let NavSale = document.getElementById("navsale");
        let NavFirma = document.getElementById("navfirma");
        let NavAbout = document.getElementById("navabout");

        let nonepub = document.getElementById("nonepub");
        let pokupatel = document.getElementById("pokupatel");
        let booking = document.getElementById("booking");
        let Payment = document.getElementById("Payment");
        let mover = document.getElementById("mover");
        let faq = document.getElementById("faq");
        let call = document.getElementById("call");
        let auter = document.getElementById("auter");

        let prvilege = document.getElementById("prvilege");

        
        selectElement.value = language;

        if (language === "kk") {
            NavMain.innerText = "Басты бет";
            NavSale.innerText = "Жеңілдіктер";
            NavFirma.innerText = "Тур фирмалар";
            NavAbout.innerText = "Біз жайлы";

            nonepub.innerText = "Оқу жұмысына арналған PolyTour сайты Сайт көпшілікке жария етілмейді";
            pokupatel.innerText = "Сатып алушыларға";
            booking.innerText = "Брондау ережелері";
            Payment.innerText = "Онлайн төлем";
            faq.innerText = "Сұрақтар мен жауаптар";
            mover.innerText = "Бағыттар";
            call.innerText = "Бірыңғай call center";
            auter.innerText = "Ресурстарға Барлық құқықтар Интернеттен алынды";

            prvilege.innerText = "БАРЛЫҒЫНА АРНАЛҒАН АРТЫҚШЫЛЫҚТАР: АРНАЙЫ ЖЕҢІЛДІКТЕР МЕН ҰСЫНЫСТАР ЖҮЙЕСІ";

            
        } else {

            NavMain.innerText = "Главная";
            NavSale.innerText = "Скидки";
            NavFirma.innerText = "Тур фирмы";
            NavAbout.innerText = "О нас";

            nonepub.innerText = "Сайт PolyTour для учебной работы Сайт не является публичной";
            pokupatel.innerText = "Покупателям";
            booking.innerText = "Правила бронирования";
            Payment.innerText = "Онлайн оплата";
            faq.innerText = "Вопросы и ответы";
            mover.innerText = "Направления";
            call.innerText = "Единый Call center";
            auter.innerText = "Все права на ресурсы были взяты из Интернета";

            prvilege.innerText = "ПРИВИЛЕГИИ ДЛЯ ВСЕХ: СИСТЕМА СПЕЦИАЛЬНЫХ СКИДОК И ПРЕДЛОЖЕНИЙ";

        }
    }

    // Обработчик события изменения значения поля выбора языка
    document.getElementById("city").addEventListener("change", function(event) {
        let selectedValue = event.target.value;
        applyLanguage(selectedValue);

        // Сохраняем выбранный язык в localStorage
        localStorage.setItem("selectedLanguage", selectedValue);
    });
</script>

</body>

</html>
