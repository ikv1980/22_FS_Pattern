<?php
// если пользователь на ОС Мак, то используйте класс FileLog для логирования.
class FileLog implements ILogs {
  public $log = '';

  function createLog($log) {
    $this->log = "<strong>OtherOS.ERROR:</strong> $log";
    echo 'class FileLog: '.$this->log;
  }
}