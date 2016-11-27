<?php
	
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	$api->post('/uploads','App\Api\V1\Controllers\UploadController@uploads');
});
