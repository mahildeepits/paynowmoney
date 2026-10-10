<?php
require __DIR__.'/vendor/autoload.php';
\ = require_once __DIR__.'/bootstrap/app.php';
\ = \->make(Illuminate\Contracts\Http\Kernel::class);
\ = \->handle(
    \ = Illuminate\Http\Request::capture()
);
\ = new \Illuminate\Http\Request();
\->setUserResolver(function() { return \App\Models\User::where('member_id', '5586235009')->first(); });
\ = new \App\Http\Controllers\Api\DashboardController();
\ = \->dashboardSummary(\);
echo json_encode(\->getData());

