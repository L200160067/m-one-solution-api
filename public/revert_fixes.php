<?php
// ⚠️ HAPUS FILE INI SETELAH DIGUNAKAN
// Script untuk ME-REVERT semua fix proxy/HTTP yang sebelumnya diaplikasikan

$basePath = dirname(__DIR__);
$bootstrapAppPath = $basePath . '/bootstrap/app.php';
$envPath  = $basePath . '/.env';

echo "<pre style='font-family:monospace;background:#111;color:#0f0;padding:20px'>";
echo "=== REVERT PROXY & HTTP FIXES ===\n\n";

// 1. REVERT bootstrap/app.php
if (file_exists($bootstrapAppPath)) {
    $content = file_get_contents($bootstrapAppPath);
    $customProxyFix = <<<'EOT'
    ->withMiddleware(function (Middleware $middleware): void {
        // Fix for Cloudflare Flexible SSL / CWP Proxy
        $middleware->append(function ($request, $next) {
            $request->server->set('HTTPS', 'on');
            $request->headers->set('X-Forwarded-Proto', 'https');
            $request->headers->set('X-Forwarded-Port', '443');
            return $next($request);
        });

        // Trust all proxies (Koyeb load balancers)
EOT;

    $original = <<<'EOT'
    ->withMiddleware(function (Middleware $middleware): void {
        // Trust all proxies (Koyeb load balancers)
EOT;

    if (strpos($content, '// Fix for Cloudflare Flexible SSL / CWP Proxy') !== false) {
        $content = str_replace($customProxyFix, $original, $content);
        file_put_contents($bootstrapAppPath, $content);
        echo "✅ Custom proxy middleware telah DIHAPUS dari bootstrap/app.php\n";
    } else {
        echo "ℹ️ Custom proxy middleware tidak ditemukan di bootstrap/app.php\n";
    }
}

// 2. REVERT .env
if (file_exists($envPath)) {
    $env = file_get_contents($envPath);
    
    // Kembalikan APP_URL ke https jika sempat diubah ke http
    if (preg_match('/^APP_URL=http:\/\//m', $env)) {
        $env = preg_replace('/^APP_URL=http:\/\//m', 'APP_URL=https://', $env);
        echo "✅ APP_URL dikembalikan ke https://\n";
    }

    // Hapus SESSION_SECURE_COOKIE jika ada
    if (preg_match('/^SESSION_SECURE_COOKIE=.*\n/m', $env)) {
        $env = trim(preg_replace('/^SESSION_SECURE_COOKIE=.*\n/m', '', $env . "\n"));
        echo "✅ SESSION_SECURE_COOKIE dihapus dari .env\n";
    }

    // Hapus SESSION_SAME_SITE jika ada
    if (preg_match('/^SESSION_SAME_SITE=.*\n/m', $env)) {
        $env = trim(preg_replace('/^SESSION_SAME_SITE=.*\n/m', '', $env . "\n"));
        echo "✅ SESSION_SAME_SITE dihapus dari .env\n";
    }

    file_put_contents($envPath, $env);
}

// 3. HAPUS CACHE
echo "\n--- Menghapus Cache ---\n";
$cacheFiles = glob($basePath . '/bootstrap/cache/*.php');
if ($cacheFiles) {
    foreach ($cacheFiles as $f) {
        unlink($f);
        echo "🗑️  " . basename($f) . "\n";
    }
}
echo "✅ Config cache dibersihkan\n";

echo "\n🎉 SELESAI! Semua fix proxy HTTP/HTTPS telah di-revert ke kondisi semula.\n";
echo "</pre>";
echo "<b style='color:red'>⚠️ HAPUS file ini setelah selesai!</b>";
