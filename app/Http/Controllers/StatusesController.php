<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class StatusesController extends BaseController
{
    protected $jwtGuard;
    protected $guardName = 'weibo';
    public function __construct()
    {
        $this->jwtGuard = auth($this->guardName);
        $this->middleware('auth:weibo');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140',
        ]);
        $user = $this->jwtGuard->user();
        $user->statuses()->create([
            'content' => $request['content'],
        ]);
        return http_success('发表成功');
    }
}
