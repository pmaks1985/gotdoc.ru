<?php
return array (
  'session' => array (
  'value' => 
  array (
    'mode' => 'default',
    'handlers' => 
    array (
      'general' => 
      array (
        '_fromSecurity' => true,
        'type' => 'database',
      ),
    ),
  ),
  'readonly' => true,
),

'http_client_options' =>
   array (
     'value' =>
        array (
         'redirect' => true,//делаем редиректы, если требуется
         'redirectMax' => 10,//но не более 10
         'version' => '1.1'//работаем по протоколу http 1.1
        ),
     'readonly' => false,
   ),
   
  'utf_mode' => 
  array (
    'value' => true,
    'readonly' => true,
  ),
  'cache_flags' => 
  array (
    'value' => 
    array (
      'config_options' => 3600,
      'site_domain' => 3600,
    ),
    'readonly' => false,
  ),
  'cookies' => 
  array (
    'value' => 
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
  'exception_handling' => 
  array (
    'value' => 
    array (
      'debug' => false,
      'handled_errors_types' => 4437,
      'exception_errors_types' => 4437,
      'ignore_silence' => false,
      'assertion_throws_exception' => true,
      'assertion_error_type' => 256,
      'log' => NULL,
    ),
    'readonly' => false,
  ),
  'connections' => 
  array (
    'value' => 
    array (
      'default' => 
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
        'host' => 'localhost',
        'database' => 'chernovanv_gotdo',
        'login' => 'chernovanv_gotdo',
        'password' => 'Zix6*UAjA1K6a*Yv',
        'options' => 2,
      ),
    ),
    'readonly' => true,
  ),
);
