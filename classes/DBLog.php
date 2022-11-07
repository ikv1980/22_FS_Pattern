<?php
// если пользователь работает на ОС Windows, то используйте класс DbLog для логирования ошибки;
class DBLog implements ILogs {
  public $log = '';

  function createLog($log) {
    $this->log = "<strong>Windows.ERROR:</strong> $log";
  }
}