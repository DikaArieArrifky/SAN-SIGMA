<?php


function getDatabaseConfig(): array
{
    return [
        "server_name" => "Helios16",
        "database" => "san_sigma1",
        "username" => "",
        "password" => "",
    ];
}

define('FILEDATABASE', '../file_database/');
define('FILEDATABASE_URL', (getDatabaseConfig()['server_name'] != gethostname()
    ? 'http://192.168.193.77/pbl' : BASE) . '/file_database/');
define ('FILEDATABASE_POST', 'http://192.168.193.77/pbl/public/api/upload_file/post');