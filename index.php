<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // получение данных из формы
    $term = $mysql->real_escape_string($_POST['term']); // real -  экранирует специальные символы, чтобы предотвратить SQL-инъекции
    $definition = $mysql->real_escape_string($_POST['definition']);

    // обработка загрузки изображения
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = basename($_FILES['image']['name']);
        $image_path = 'uploads/' . $image_name;

        // перемещение загруженного файла в папку uploads
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $query = "INSERT INTO terms (term, definition, img) VALUES ('$term', '$definition', '$image_path')";
        } else {
            echo "Ошибка при загрузке изображения.";
            exit;
        }
    } else {
        // если изображение не загружено, добавляем запись без изображения
        $query = "INSERT INTO terms (term, definition) VALUES ('$term', '$definition')";
    }

    // выполнение запроса
    if ($mysql->query($query) === TRUE) {
        header("Location: http://localhost:8080/Веб-технологии/lab-5/table.php");
        exit;
    } else {
        echo "Ошибка: " . $mysql->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Добавить новый термин</title>
    <link rel="stylesheet" href="http://localhost:8080/Веб-технологии/lab-5/styles/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="white-box">
        <h2 class="h2">Добавить новый термин</h2>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <label for="term">Термин:</label><br>
            <input type="text" name="term" id="term" required><br><br>
    
            <label for="definition">Определение:</label><br>
            <textarea name="definition" id="definition" rows="4" required></textarea><br><br>
    
            <label for="image">Изображение:</label><br>
            <input type="file" name="image" id="image"><br><br>
    
            <input type="submit" value="Добавить">
            <a href="table.php">Список терминов</a>
        </form>
    </div>
</body>

</html>