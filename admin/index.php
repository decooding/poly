<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Туристическое агентство - kaztour.kz</title>
    <link rel="stylesheet" href="style/mainstyle.css">
    <link rel="stylesheet" href="style/partstyle.css">

    <style>
        /* Стили для формы */
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            padding: 5px 10px;
        }

        /* Стили для таблицы */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kaztour";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    // Обработка отправленной формы
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namePlace = $_POST['namePlace'];
            $salePlace = $_POST['salePlace'];
            $pricePlace = $_POST['pricePlace'];
            $imgPlace = $_POST['imgPlace'];

            // Вставка данных в таблицу place
            $insertSql = "INSERT INTO place (namePlace, salePlace, pricePlace, imgPlace)
                          VALUES ('$namePlace', '$salePlace', '$pricePlace', '$imgPlace')";
            if ($conn->query($insertSql) === TRUE) {
                echo "Данные успешно добавлены!";
            } else {
                echo "Ошибка: " . $conn->error;
            }
    }
    ?>

    <!-- Форма для добавления данных в таблицу place -->
    <form action="index.php" method="POST">
        <label for="namePlace">Название места:</label>
        <input type="text" name="namePlace" id="namePlace" required>

        <label for="salePlace">Скидка:</label>
        <input type="text" name="salePlace" id="salePlace">

        <label for="pricePlace">Цена:</label>
        <input type="text" name="pricePlace" id="pricePlace" required>

        <label for="imgPlace">Ссылка на изображение:</label>
        <input type="text" name="imgPlace" id="imgPlace" required>

        <button type="submit">Добавить Тур</button>
    </form>

    <!-- Вывод данных из таблицы place -->
    <h2>Данные из таблицы data:</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Text</th>
        </tr>
        <?php
        $selectSql = "SELECT * FROM setdata";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['comment'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Нет данных</td></tr>";
        }
        ?>
    </table>

    <h2>Данные из страницы Туры:</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Название места</th>
            <th>Скидка</th>
            <th>Цена</th>
            <th>Изображение</th>
        </tr>
        <?php
        $selectSql = "SELECT * FROM place";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['namePlace'] . "</td>";
                echo "<td>" . $row['salePlace'] . "</td>";
                echo "<td>" . $row['pricePlace'] . "</td>";
                echo "<td>" . $row['imgPlace'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Нет данных</td></tr>";
        }
        ?>
    </table>

    <h2>Данные из страницы Скидки:</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>iamgeURL</th>
            <th>Название</th>
            <th>Текст</th>
        </tr>
        <?php
        $selectSql = "SELECT * FROM sale";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['imageUrl'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['text'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Нет данных</td></tr>";
        }
        ?>
    </table>

    <!-- Ваш остальной код здесь -->
</body>

</html>