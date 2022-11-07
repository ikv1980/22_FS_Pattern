<?php

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