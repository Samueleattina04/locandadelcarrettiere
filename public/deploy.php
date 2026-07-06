<?php
// Chiave segreta — deve corrispondere al webhook GitHub
$secret = getenv('DEPLOY_SECRET') ?: 'locanda_deploy_2024';

$sig = 'sha256=' . hash_hmac('sha256', file_get_contents('php://input'), $secret);
if (!hash_equals($sig, $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '')) {
    http_response_code(403);
    exit('Forbidden');
}

$home    = '/home/u347149984';
$locanda = $home . '/locanda';
$pubhtml = $home . '/domains/rosybrown-boar-509699.hostingersite.com/public_html';

$commands = [
    "cd $locanda && git pull origin main 2>&1",
    "cd $locanda && composer install --no-dev --optimize-autoloader --no-interaction 2>&1",
    "cd $locanda && php artisan config:cache 2>&1",
    "cd $locanda && php artisan route:cache 2>&1",
    "cd $locanda && php artisan view:cache 2>&1",
    "cp -r $locanda/public/css $pubhtml/ 2>&1",
    "cp -r $locanda/public/js $pubhtml/ 2>&1",
    "cp -r $locanda/public/images $pubhtml/ 2>&1",
    "cp $locanda/public/favicon.ico $pubhtml/ 2>&1",
    "cp $locanda/public/sitemap.xml $pubhtml/ 2>&1",
    "cp $locanda/public/robots.txt $pubhtml/ 2>&1",
];

$log = date('Y-m-d H:i:s') . " — Deploy avviato\n";
foreach ($commands as $cmd) {
    $output = shell_exec($cmd);
    $log .= "> $cmd\n$output\n";
}

file_put_contents($locanda . '/storage/logs/deploy.log', $log, FILE_APPEND);
http_response_code(200);
echo "OK";
