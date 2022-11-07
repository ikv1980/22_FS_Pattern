  <?php
    // Интерфейс для создания логов
    interface ILogs {
      function createLog($log);
    }

    // если пользователь работает на ОС Windows, то используйте класс DbLog для логирования ошибки;
    class DBLog implements ILogs {
      public $log = '';

      function createLog($log) {
        $this->log = "<strong>Windows.ERROR:</strong> $log";
      }
    }

    class FileLog implements ILogs {
      public $log = '';
  
      function createLog($log) {
        $this->log = "<strong>OtherOS.ERROR:</strong> $log";
        echo 'class FileLog: '.$this->log;
      }
    }

    class ContextLog {
      private $strategy;
  
      function __construct(ILogs $strategy) {
        $this->strategy = $strategy;
      }
  
      function log($log) {
        $this->strategy->createLog($log);
      }
  
      function showLog() {
        echo $this->strategy->log;
      }
    }


    function create($title, $anons, $full_text, $avtor) {
      try {
        // throw new Exception(); // Исскуственно созданное исключение
        $pdo = new PDO('mysql:host=localhost;dbname=itproger', 'root', 'root');
        $sql = "INSERT INTO `articles`(title, anons, full_text, avtor) VALUES (?, ?, ?, ?)"; //sql-запрос
        $query =$pdo->prepare($sql); //Подготовка запроса к отправке
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

    create(
      'Запись',
      'Небольшое описание задачи',
      'Большое описание задачи',
      'John'
    );
?>
