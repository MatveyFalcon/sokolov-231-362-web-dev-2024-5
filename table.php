<?php
include 'db.php';

// получение данных из таблицы
$terms_result = mysqli_query($mysql, "SELECT * FROM terms");
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Список терминов</title>
    <link rel="stylesheet" href="http://localhost:8080/Веб-технологии/lab-5/styles/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&display=swap"
        rel="stylesheet" />
</head>

<body>

    <div class="white-box">
        <h1>Список терминов</h1>

        <table>
            <tr>
                <th style="width: 170px;">Термин</th>
                <th style="width: 500px;">Определение</th>
                <th>Изображение</th>
            </tr>
            <?php while ($term = mysqli_fetch_assoc($terms_result)): ?>
                <tr>
                    <td><?php echo ($term['term']); ?></td>
                    <td style="text-align: left;"><?php echo ($term['definition']); ?></td>
                    <td>
                        <?php if (!empty($term['img'])): ?>
                            <!-- Выводим изображение с title, содержащим имя файла -->
                            <img src="<?php echo ($term['img']); ?>" alt="Изображение" title="<?php echo basename($term['img']); ?>">
                        <?php else: ?>
                            Нет изображения
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <div class="button">
        <a href="index.php" class="add-button">Добавить еще</a>
    </div>
</body>

</html>