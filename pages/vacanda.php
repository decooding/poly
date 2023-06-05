<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Туристическое агентство - kaztour.kz </title>
    <link rel="stylesheet" href="../style/vacstyle.css">
</head>

<body>

<header>
        <img src="../img/logo.png" alt="LoGo" class="logo">

        <nav>
        <a id="navmain" href="../index.php" >Главная</a>
            <a id="navsale" href="partners.php">Скидки</a>
            <a id="navfirma" href="contact.php">Тур фирмы</a>
            <a class="select" id="navabout" href="vacanda.php">О нас</a>
        </nav>

        <div class="contact">
            <select id="city">
                <option class="city_open" value="ru">Ru</option>
                <option class="city_open" value="kk">Kz</option>
            </select>
        </div>

    </header>

    <div class="background">
        <h1 id="about">О компании</h1>
    </div>
    <content>

    <h2 id="one">Одна из ведущих туристских компаний Центральной Азии, имеющая филиалы на всей территории Казахстана</h2>

        <div class="table">
            <ul>
                <li id="li1">Компания активно развивает диджитал-продуты</li>
                <li id="li2">омпания предлагает пляжный, экскурсионный  отдых</li>
                <li id="li3">Втуры на базе чартерной и регулярной перевозок.</li>

            </ul>
        </div>
        <h2 id="two">Отели</h2>
        <p id="p1" >Мы помогаем путешественникам собрать идеальную поездку. Для этого постоянно создаются и внедряются новые инструменты, которые помогают нам влиять на качество сервиса на всех этапах отдыха наших гостей. Одним из главных инструментов являются наши уникальные концепции отдыха в тщательно отобранных отелях</p>
            <h2 id="three" >Миссия и слоган</h2>
            <p id="p2">Наша миссия - создавать отдых, который делает людей счастливее.  </p>
            <p id="p3">Наш слоган -  Больше, чем путешествия!</p>
            <p id="p4">Мы стремимся к превосходному качеству сервиса на всём пути клиента: от поиска тура до возвращения домой. Нам важно не просто доставить клиента из точки А в точку Б, нам важно, какие впечатления он получит.</p>
            <p id="p5">Ваша задача – мечтать и наслаждаться, наша – продумать всё до мелочей.</p>
            <p id="p6">Забудьте об организации отдыха, доверьте это нам!</p>
    
        <h2 id="four" >ЕСЛИ У ВАС ЕСТЬ КАКИЕ НИБУДЬ ПОЖЕЛАНИЕ ВЫ МОЖЕТЕ СВЯЗАТЬСЯ С НАМИ:</h2>
        <?php 

        require_once('../config.php');

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];
        
            // Вставка данных в базу данных
            $insertSql = "INSERT INTO setdata (name, email, comment)
                          VALUES ('$name', '$email', '$comment')";
            if (!$conn->query($insertSql) === TRUE) {
                echo "Ошибка: " . $conn->error;
            }
        }
        
        ?>
        <form action="vacanda.php" method="POST">
    <input type="text" name="name" placeholder="Ваше имя">
    <input type="email" name="email" placeholder="Электронный адрес">
    <textarea name="comment" cols="30" rows="10" placeholder="Ваше сообщение"></textarea>
    <button type="submit">Отправить сообщение</button>
</form>

    </content>

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

        let one = document.getElementById("one");
        let two = document.getElementById("two");
        let three = document.getElementById("three");
        let four = document.getElementById("four");

        let p1 = document.getElementById("p1");
        let p2 = document.getElementById("p2");
        let p3 = document.getElementById("p3");
        let p4 = document.getElementById("p4");
        let p5 = document.getElementById("p5");
        let p6 = document.getElementById("p6");

        let li1 = document.getElementById("li1");
        let li2 = document.getElementById("li2");
        let li3 = document.getElementById("li3");

        let about = document.getElementById("about");


        
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
            
            about.innerText = "КОМПАНИЯ ТУРАЛЫ";
            one.innerText = "Қазақстанның барлық аумағында филиалдары бар Орталық Азияның жетекші туристік компанияларының бірі";
            two.innerText = "Қонақ үйлер";
            three.innerText = "Миссия және ұран";
            four.innerText = "ЕГЕР СІЗДЕ ҚАНДАЙ ДА БІР ТІЛЕК БОЛСА БІЗБЕН БАЙЛАНЫСА АЛАСЫЗ:";

            li1.innerText = "Компания диджитал-продуттарды белсенді дамытуда";
            li2.innerText = "Компания жағажай, экскурсиялық демалыс ұсынады";
            li3.innerText = "Турлар чартерлік және тұрақты тасымалдау негізінде.";

            p1.innerText = "Біз саяхатшыларға тамаша сапарды жинауға көмектесеміз. Ол үшін қонақтарымыздың демалысының барлық кезеңдерінде қызмет көрсету сапасына әсер етуге көмектесетін жаңа құралдар үнемі жасалып, енгізіліп отырады. Негізгі құралдардың бірі мұқият таңдалған қонақүйлердегі бірегей демалыс тұжырымдамалары";
            p2.innerText ="Біздің миссиямыз - адамдарды бақытты ететін демалыс жасау.";
            p3.innerText ="Біздің ұранымыз саяхаттан да көп!";
            p4.innerText ="Біз тур іздеуден бастап үйге оралуға дейін клиенттің бүкіл жолында қызметтің жоғары сапасына ұмтыламыз. Біз үшін клиентті А нүктесінен В нүктесіне жеткізу ғана емес, оның қандай әсер алатыны маңызды.";
            p5.innerText ="Сіздің міндетіңіз – армандау және ләззат алу, біздікі – бәрін ұсақ-түйекке дейін ойластыру.";
            p6.innerText ="Демалысты ұйымдастыруды ұмытыңыз, бізге сеніңіз!";

            
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

            about.innerText = "О КОМПАНИИ";
            one.innerText = "Одна из ведущих туристских компаний Центральной Азии, имеющая филиалы на всей территории Казахстана";
            two.innerText = "Отели";
            three.innerText = "Миссия и слоган";
            four.innerText = "ЕСЛИ У ВАС ЕСТЬ КАКИЕ НИБУДЬ ПОЖЕЛАНИЕ ВЫ МОЖЕТЕ СВЯЗАТЬСЯ С НАМИ:";

            li1.innerText = "Компания активно развивает диджитал-продуты";
            li2.innerText = "Компания предлагает пляжный, экскурсионный отдых";
            li3.innerText = "В туры на базе чартерной и регулярной перевозок.";

            p1.innerText = "Мы помогаем путешественникам собрать идеальную поездку. Для этого постоянно создаются и внедряются новые инструменты, которые помогают нам влиять на качество сервиса на всех этапах отдыха наших гостей. Одним из главных инструментов являются наши уникальные концепции отдыха в тщательно отобранных отелях";
            p2.innerText ="Наша миссия - создавать отдых, который делает людей счастливее.";
            p3.innerText ="Наш слоган - Больше, чем путешествия!";
            p4.innerText ="Мы стремимся к превосходному качеству сервиса на всём пути клиента: от поиска тура до возвращения домой. Нам важно не просто доставить клиента из точки А в точку Б, нам важно, какие впечатления он получит.";
            p5.innerText ="Ваша задача – мечтать и наслаждаться, наша – продумать всё до мелочей.";
            p6.innerText ="Забудьте об организации отдыха, доверьте это нам!";

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
