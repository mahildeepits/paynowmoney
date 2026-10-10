<?php
require 'c:\laragon\www\paynowmoney_backend\vendor\autoload.php';
\ = require_once 'c:\laragon\www\paynowmoney_backend\bootstrap\app.php';
\ = \->make(Illuminate\Contracts\Http\Kernel::class);
\ = \->handle(
    \ = Illuminate\Http\Request::capture()
);
\ = new \Illuminate\Http\Request();
\->setUserResolver(function() { return \App\Models\User::where('member_id', '5586235009')->first(); });
\ = new \App\Http\Controllers\Api\DashboardController();
\ = \->wallet(\);
echo json_encode(\->getData());

