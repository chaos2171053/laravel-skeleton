<?php

namespace App\Codes;

abstract class AppCodes
{
    public const UPDATE_FAILED = 1000001;
    public const UPDATE_SUCCESS = 1000002;
    public const DELETE_FAILED = 1000003;
    public const DELETE_SUCCESS = 1000004;

    public const AUTH_FAILED = 40001001;

    public const USER_NAME_ALREADY_EXISTS = 40002001;
    public const USER_EMAIL_ALREADY_EXISTS = 40002002;
    public const USER_EMAIL_NO_MATCH = 40002003;

    /**
     * @var array
     */
    public const MESSAGES = [
        self::UPDATE_FAILED => '更新失败',
        self::DELETE_FAILED => '删除失败',
        self::DELETE_SUCCESS => '删除成功',
        self::AUTH_FAILED => '邮箱地址或密码错误',
        self::USER_NAME_ALREADY_EXISTS => '用户名已存在',
        self::USER_EMAIL_ALREADY_EXISTS => '邮箱地址已存在',
        self::USER_EMAIL_NO_MATCH => '邮箱地址不匹配',
    ];
}
