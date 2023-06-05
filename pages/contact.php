<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Туристическое агентство - kaztour.kz </title>
    <link rel="stylesheet" href="../style/constyle.css">
</head>

<body>

<header>
        <img src="../img/logo.png" alt="LoGo" class="logo">

        <nav>
            <a id="navmain" href="../index.php" >Главная</a>
            <a id="navsale" href="partners.php">Скидки</a>
            <a class="select" id="navfirma" href="contact.php">Тур фирмы</a>
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
        <h1 id="tourfirm">Тур фирмы по всему Казахстану</h1>
    </div>

    <?php
    require_once('../config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Запрос данных из базы данных
    $sql = "SELECT * FROM map";
    $result = $conn->query($sql);

    for ($i = 0; $i < 6; $i++) {
        if ($row = $result->fetch_assoc()) {
            // Вывод данных из базы данных
            $title = $row['title'];
            $address = $row['address'];
            $number = $row['number'];
            $time = $row['time'];
            $image = $row['map'];

            // Вывод компонента
            echo '<section>';
            echo '<aside>';
            echo '<h2>' . $title . '</h2>';
            echo '<p>' . $address . '</p>';
            echo '<p>' . $number  . '</p>';
            echo '<p>' . $time  . '</p>';
            echo '</aside>';
            echo '<img src="' . $image . '" alt="">';
            echo '</section>';
        }
    }

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
    
        let tourfirm = document.getElementById("tourfirm");

        
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
        
            tourfirm.innerText = "БҮКІЛ ҚАЗАҚСТАН БОЙЫНША ТУРИСТІК ФИРМАЛАР";

            
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

            tourfirm.innerText = "ТУР ФИРМЫ ПО ВСЕМУ КАЗАХСТАНУ";

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
