<?php
//Подключение автозагрузчика
require 'autoload.php';

$articles = new Articles();
$articles->create(
  'Новая запись',
  'Небольшое описание задачи',
  'Большое описание задачи',
  'John'
);

// Выыод всех значений на экран в удобочитаемом виде
echo '<pre>';
echo var_dump($articles->getAll());
echo '</pre>';
