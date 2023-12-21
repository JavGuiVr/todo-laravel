<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/JavGuiVr/todo-laravel.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('34.229.124.216')
    ->set('remote_user', 'prod-ud4-deployer')
    ->set('deploy_path', '/var/www/prod-ud4-a4/html');

// Hooks

after('deploy:failed', 'deploy:unlock');

task('build', function () {
    run('cd {{release_path}} && build');
});

task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php8.1-fpm restart');
});

after('deploy', 'reload:php-fpm');