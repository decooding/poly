<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Туристическое агентство - PolyTour</title>
    <link rel="stylesheet" href="style/mainstyle.css">
    <link rel="stylesheet" type="text/css" href="style/modal.css">

</head>

<body>
    <header>
        <img src="img/logo.png" alt="LoGo" class="logo">

        <nav>
            <a id="navmain" href="" class="select">Главная</a>
            <a id="navsale" href="pages/partners.php">Скидки</a>
            <a id="navfirma" href="pages/contact.php">Тур фирмы</a>
            <a id="navabout" href="pages/vacanda.php">О нас</a>
        </nav>

        <div class="contact">
            <select id="city">
                <option class="city_open" value="ru">Ru</option>
                <option class="city_open" value="kk">Kz</option>
            </select>
        </div>

    </header>

    <div class="background">
        <form class="first_form" method="post">
            <h1 id="searchTitle">Поиск туров В Казахстане!</h1>
            <p id="tourAgency">Турфирма Алматы, Астаны, Актобе, сайт турагенства "PolyTour"</p>
            <input id="fromInput" type="text" name="from" placeholder="Откуда">
            <input id="toInput" type="text" name="to" placeholder="Куда">
            <input type="date" name="date" id="date_form" value="16">

            <select name="category">
                <option value="Эконом">Эконом</option>
                <option value="Комфорт">Комфорт</option>
                <option value="Бизнес">Бизнес</option>
                <option value="Первый класс">Первый класс</option>
            </select>

            <button class="mainbtn" type="submit" name="generatePDF" value="generate">
                <span id="mainbtn" class="mainbtn_text">Найти тур</span>
                <img src="img/airplan.svg" alt="">
            </button>
        </form>
    </div>

    <?php
    require_once('config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['generatePDF']) && $_POST['generatePDF'] === 'generate') {
            // Получение данных из формы
            $from = $_POST["from"] ?? "";
            $to = $_POST["to"] ?? "";
            $date = $_POST["date"] ?? "";
            $category = $_POST["category"] ?? "";

            require_once('tcpdf/tcpdf.php');

            // Создание нового PDF-документа
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

            // Установка метаданных документа
            $pdf->SetCreator('PolyTour');
            $pdf->SetAuthor('PolyTour');
            $pdf->SetTitle('Билет на тур');
            $pdf->SetSubject('Билет на тур');
            $pdf->SetKeywords('билет, тур, PolyTour');

            // Добавление новой страницы
            $pdf->AddPage();

            // Установка шрифта и размера текста
            $pdf->SetFont('dejavusans', '', 12); // Используем шрифт DejaVuSans

            // Добавление изображения билета поезда
            $image = 'img/ticket.jpeg';
            $pdf->Image($image, 10, 10, 190, 0, 'JPG');

            // Вывод данных из формы в PDF-файл
            $pdf->SetXY(25, 78);
            $pdf->Cell(0, 8, 'Откуда: ' . $from, 0, 1);
            $pdf->SetX(25);
            $pdf->Cell(0, 8, 'Куда: ' . $to, 0, 1);
            $pdf->SetX(25);
            $pdf->Cell(0, 8, 'Дата: ' . $date, 0, 1);
            $pdf->SetX(25);
            $pdf->Cell(0, 8, 'Категория: ' . $category, 0, 1);

            // Генерация PDF-файла
            ob_end_clean();
            $pdf->Output('ticket.pdf', 'D');
        }
    } elseif (isset($_POST['sendData']) && $_POST['sendData'] === 'send') {
        $email = $_POST['email'];
        $sql = "INSERT INTO setdata (email)
                  VALUES ('$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Данные успешно добавлены в базу данных!";
        } else {
            echo "Ошибка: " . $conn->error;
        }
    }

    echo '<content>';

// Запрос данных из базы данных
$sql = "SELECT * FROM place";
$result = $conn->query($sql);

echo '<content>';
echo    '<div class="big_card"> </div>';

echo    '<div class="title">';
echo      ' <h1 id="hottour">Горящие туры </h1>';
echo    '</div>';

$description = 'Мұнда сіз демалуға және табиғатты тамашалауға тамаша орын таба аласыз. Біздің демалыс аймағымыз қалың ормандар мен жасыл шалғындармен қоршалған көркем аймақта орналасқан.Таза ауа мен мөлдір суды мөлдір көлімізде тамашалай аласыз. Мұнда жүзуге, қайықпен серуендеуге немесе жай ғана жағажайда демалуға және көркем пейзажды тамашалауға болады.Ашық ауадағы әуесқойлар үшін бізде көптеген мүмкіндіктер бар. Демалыс аймағының айналасындағы көрікті жолдармен жаяу немесе велосипедпен жүруге болады. Экстремалды сезімдердің жанкүйерлері біздің көлде вейкбордингте немесе су шаңғысында бағын сынай алады.';
for ($i = 0; $i < 12; $i++) {
    if ($row = $result->fetch_assoc()) {
        // Вывод данных из базы данных
        $title = $row['namePlace'];
        $discount = $row['salePlace'];
        $price = $row['pricePlace'];
        $image = $row['imgPlace'];

        // Вывод компонента
        echo '<div class="card" onclick="showModal(\'' . $title . '\', \'' . $discount . '\', \'' . $price . '\', \'' . $image . '\', \'' . $description . '\')">';
        echo '<img src=' . $image . ' alt="">';
        echo '<div class="card_text">';
        echo '<h2>' . $title . '</h2>';
        echo '<p class="discount">' .$discount . '% жеңілдік</p>';
        echo '</div>';
        echo '<div class="card_btn">';
        echo '<p class="oneperson">1 адамға баға:</p>';
        echo '<h4 class="price">' . $price . 'KZT </h4>';
        echo '</div>';
        echo '</div>';
    }
}

echo   '</div>';
echo '</content>';
$conn->close();
echo '</content>';
?>

<div id="modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="row">
      <img id="modal-image" src="" alt="">
      <div class="col">
        <h2 id="modal-title"></h2>
        <div class="row">
          <p class="mt">Жеңілдік:</p>
          <p id="modal-discount"></p>
          <p class="mt">%</p>
        </div>
        <div class="row">
          <p class="mt">Бағасы:</p>
          <p id="modal-price"></p>
          <p class="mt">KZT</p>
        </div>
      </div>
    </div>
    <p id="modal-description"></p>
  </div>
</div>


    <aside>
        <div class="side_text">
            <h1 id="sub_title">Подписаться на горящие туры</h1>
            <p id="sub_text">Только новые варианты и скидки</p>
        </div>
        <form method="POST" class="control" id="emailForm">
            <img class="image-control" src="img/icon-email.svg" alt="">
            <input name="email" type="email" placeholder="Ваш E-mail" id="email">
            <input type="submit" name="sendData" value="send" id="form_btn">
        </form>
    </aside>

    <footer>
        <div class="foo_container">
            <div id="nonepub" class="fort_col">
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
                <p> <a href="">Астана</a></p>
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
        // Получение элементов
const modal = document.getElementById("modal");
const modalTitle = document.getElementById("modal-title");
const modalImage = document.getElementById("modal-image");
const modalDescription = document.getElementById("modal-description");
const modalDiscount = document.getElementById("modal-discount");
const modalPrice = document.getElementById("modal-price");
const closeButton = document.querySelector(".close");
const cards = document.querySelectorAll(".card");

// Функция для отображения модального окна с данными элемента
function showModal(title, discount, price, image, description) {
  modalTitle.textContent = title;
  modalImage.src = image;
  modalDescription.textContent = description;
  modalDiscount.textContent = discount;
  modalPrice.textContent = price;
  modal.style.display = "block";
}

// Обработчик клика по блоку "card"
cards.forEach((card) => {
  card.addEventListener("click", () => {
    const title = card.querySelector("h2").textContent;
    const discount = card.querySelector(".discount").textContent;
    const price = card.querySelector(".price").textContent;
    const image = card.querySelector("img").src;
    const description = card.querySelector(".description").textContent;
    showModal(title, discount, price, image, description);
  });
});

// Обработчик клика по кнопке закрытия модального окна
closeButton.addEventListener("click", () => {
  modal.style.display = "none";
});

// Закрытие модального окна при клике вне его области
window.addEventListener("click", (event) => {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});

        // Проверяем, есть ли уже сохраненный выбранный язык
        let selectedLanguage = localStorage.getItem("selectedLanguage");

        // Если выбранный язык уже сохранен, применяем его
        if (selectedLanguage) {
            applyLanguage(selectedLanguage);
        }

        // Функция для применения выбранного языка
        function applyLanguage(language) {
            let selectElement = document.getElementById("city");
            let searchTitleElement = document.getElementById("searchTitle");
            let tourAgencyElement = document.getElementById("tourAgency");
            let fromInputElement = document.getElementById("fromInput");
            let toInputElement = document.getElementById("toInput");

            let NavMain = document.getElementById("navmain");
            let NavSale = document.getElementById("navsale");
            let NavFirma = document.getElementById("navfirma");
            let NavAbout = document.getElementById("navabout");

            let MainBtn = document.getElementById("mainbtn");
            let HotTour = document.getElementById("hottour");

            let SubTitle = document.getElementById("sub_title");
            let SubText = document.getElementById("sub_text");
            let SubForm = document.getElementById("email");
            let FormBtn = document.getElementById("form_btn");


            let nonepub = document.getElementById("nonepub");
            let pokupatel = document.getElementById("pokupatel");
            let booking = document.getElementById("booking");
            let Payment = document.getElementById("Payment");
            let mover = document.getElementById("mover");
            let faq = document.getElementById("faq");
            let call = document.getElementById("call");
            let auter = document.getElementById("auter");


            selectElement.value = language;

            if (language === "kk") {
                searchTitleElement.innerText = "Казақстанда тур іздеу!";
                tourAgencyElement.innerText = "Алматы, Астана, Ақтөбе \"PolyTour\" тур агенттігінің веб-сайты";
                fromInputElement.placeholder = "Қайдан";
                toInputElement.placeholder = "Қайда";

                NavMain.innerText = "Басты бет";
                NavSale.innerText = "Жеңілдіктер";
                NavFirma.innerText = "Тур фирмалар";
                NavAbout.innerText = "Біз жайлы";

                MainBtn.innerText = "Тур іздеу";
                HotTour.innerText = "Жаңа турлар";

                SubTitle.innerText = "Жаңа турларға жазылу";
                SubText.innerText = "Тек жаңа ұсыныстармен жеңілдіктер";
                SubForm.placeholder = "E-mail поштаңыз";
                FormBtn.value = "Алу";

                nonepub.innerText = "Оқу жұмысына арналған PolyTour сайты Сайт көпшілікке жария етілмейді";
                pokupatel.innerText = "Сатып алушыларға";
                booking.innerText = "Брондау ережелері";
                Payment.innerText = "Онлайн төлем";
                faq.innerText = "Сұрақтар мен жауаптар";
                mover.innerText = "Бағыттар";
                call.innerText = "Бірыңғай call center";
                auter.innerText = "Ресурстарға Барлық құқықтар Интернеттен алынды";


            } else {
                searchTitleElement.innerText = "Поиск туров В Казахстане!";
                tourAgencyElement.innerText = "Турфирма Алматы, Астаны, Актобе, сайт турагенства \"PolyTour\"";
                fromInputElement.placeholder = "Откуда";
                toInputElement.placeholder = "Куда";

                NavMain.innerText = "Главная";
                NavSale.innerText = "Скидки";
                NavFirma.innerText = "Тур фирмы";
                NavAbout.innerText = "О нас";

                MainBtn.innerText = "Найти тур";
                HotTour.innerText = "Горящие туры";

                SubTitle.innerText = "Подписаться на горящие туры";
                SubText.innerText = "Только новые варианты и скидки";
                SubForm.placeholder = "Ваш E-mail";
                FormBtn.value = "Получать";

                nonepub.innerText = "Сайт PolyTour для учебной работы Сайт не является публичной";
                pokupatel.innerText = "Покупателям";
                booking.innerText = "Правила бронирования";
                Payment.innerText = "Онлайн оплата";
                faq.innerText = "Вопросы и ответы";
                mover.innerText = "Направления";
                call.innerText = "Единый Call center";
                auter.innerText = "Все права на ресурсы были взяты из Интернета";

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