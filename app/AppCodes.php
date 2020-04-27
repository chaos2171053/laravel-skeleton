<?php

namespace App\Codes;

abstract class AppCodes
{
    public const AUTH_FAILED = 40001001;

    public const USER_NAME_ALREADY_EXISTS = 40002001;
    public const USER_EMAIL_ALREADY_EXISTS = 40002002;

    /**
     * @var array
     */
    public const MESSAGES = [
        self::AUTH_FAILED => '邮箱地址或密码错误',
        self::USER_NAME_ALREADY_EXISTS => '用户名已存在',
        self::USER_EMAIL_ALREADY_EXISTS => '邮箱地址已存在',
    ];
}
