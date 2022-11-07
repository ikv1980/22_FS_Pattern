<?php
  // создаем класс для получения к БД и получения из нее данных. В частности статей

  class Articles {
    private $_db = null;

    // при создании класса вызывается метод класса DB
    public function __construct() {
      $this->_db = DB::getInstanse();
    }

    // функция получения всех записей из БД
    public function getAll() {
      $result = $this->_db->query("SELECT * FROM `articles`");
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // функция внесения данных в БД
    public function create($title, $anons, $full_text, $avtor) {
      try {
        // throw new Exception('Ошибка доступа к БД');
        $sql = "INSERT INTO `articles`(title, anons, full_text, avtor) VALUES (?, ?, ?, ?)"; //sql-запрос
        $query = $this->_db->prepare($sql); //Подготовка запроса к отправке
        $query->execute([$title, $anons, $full_text, $avtor]); //Отправка запроса
      } catch (Exception $e) {
        // Отслеживание ошибки и запись в лог
        if(strstr($_SERVER["HTTP_USER_AGENT"], "Win")) {
          $obj = new ContextLog(new DbLog());}
        else
          $obj = new ContextLog(new FileLog());
        
        $obj->log('Ошибка при добавлении данных в БД');  
        $obj->showLog();
      }
    }
  }
?>
