<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test exactly what the command's getBooleanColumns does
$pgsql = DB::connection('pgsql');
$table = 'projects';

$cols = $pgsql->select("
    SELECT column_name
    FROM information_schema.columns
    WHERE table_name = ?
      AND data_type = 'boolean'
", [$table]);

echo "=== Boolean cols in '$table' via command query ===\n";
var_dump($cols);
echo "\ncount: " . count($cols) . "\n";

$boolCols = array_column(array_map(fn($c) => (array)$c, $cols), 'column_name');
echo "boolCols: ";
print_r($boolCols);
