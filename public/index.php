<?php

require_once __DIR__ . '/../vendor/autoload.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizza Order</title>
    <script src="/js/jquery-3.7.1.min.js"></script>
</head>
<body>
    <select id="pizzaType">
        <option value="Пепперони">Пепперони</option>
        <option value="Деревенская">Деревенская</option>
        <option value="Гавайская">Гавайская</option>
        <option value="Грибная">Грибная</option>
    </select>

    <select id="pizzaSize">
        <option value="1">21 см</option>
        <option value="2">26 см</option>
        <option value="3">31 см</option>
        <option value="4">45 см</option>
    </select>

    <select id="sauce">
        <option value="1">Сырный</option>
        <option value="2">Кисло-сладкий</option>
        <option value="3">Чесночный</option>
        <option value="4">Барбекю</option>
    </select>

    <button id="orderBtn">Заказать</button>
    
    <div id="result"></div>

    <script src="/js/script.js"></script>
</body>
</html>
