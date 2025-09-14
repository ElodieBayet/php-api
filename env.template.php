<?php

declare(strict_types=1);

/** @var string APP_ENV :: Environment context */
const APP_ENV = 'development';

/** @var bool APP_DEBUG :: Debugging mode */
const APP_DEBUG = true;

/** @var array DATABASE :: Connection logins */
const DATABASE = [
    'dsn'   => 'mysql:host=0.0.0.0;port=0000;dbname=DATABASE_NAME;charset=utf8mb4',
    'user'  => 'USER_NAME',
    'word'  => 'USER_PWD'
];