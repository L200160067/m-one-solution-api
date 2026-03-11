<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

class MigrateSqliteToPostgres extends Command
{
    protected $signature = 'db:sqlite-to-pgsql {--force : Skip confirmation}';
    protected $description = 'Migrate data from SQLite to PostgreSQL (Supabase)';

    /**
     * Tables to migrate (in dependency order to respect foreign keys).
     * Skips system/transient tables (cache, jobs, sessions, etc.)
     */
    protected array $tables = [
        'users',
        'roles',
        'permissions',
        'model_has_roles',
        'model_has_permissions',
        'role_has_permissions',
        'categories',
        'services',
        'projects',
        'partners',
        'team_members',
        'testimonials',
        'posts',
        'alumnis',
        'settings',
        'media',
    ];

    public function handle(): int
    {
        if (! $this->option('force') && ! $this->confirm('This will copy data from SQLite to PostgreSQL. Are you sure?')) {
            $this->info('Aborted.');
            return self::FAILURE;
        }

        $sqlitePath = database_path('database.sqlite');

        if (! file_exists($sqlitePath)) {
            $this->error("SQLite file not found: $sqlitePath");
            return self::FAILURE;
        }

        $this->info("SQLite source: $sqlitePath");
        $this->info('Starting SQLite → PostgreSQL migration...');
        $this->newLine();

        // Use PDO directly for SQLite to avoid config conflicts
        $sqlite = new PDO('sqlite:' . $sqlitePath);
        $sqlite->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $pgsql = DB::connection('pgsql');

        $errors = [];

        foreach ($this->tables as $table) {
            $this->process($sqlite, $pgsql, $table, $errors);
        }

        $this->newLine();

        if (empty($errors)) {
            $this->info('✅ All tables migrated successfully!');
            return self::SUCCESS;
        }

        $this->warn('⚠️  Migration completed with errors:');
        foreach ($errors as $err) {
            $this->error("  - $err");
        }

        return self::FAILURE;
    }

    /**
     * Get list of boolean columns in a PostgreSQL table.
     */
    protected function getBooleanColumns($pgsql, string $table): array
    {
        $cols = $pgsql->select("
            SELECT column_name
            FROM information_schema.columns
            WHERE table_name = ?
              AND data_type = 'boolean'
        ", [$table]);

        return array_column(array_map(fn($c) => (array) $c, $cols), 'column_name');
    }

    protected function process(PDO $sqlite, $pgsql, string $table, array &$errors): void
    {
        try {
            // Check if table exists in SQLite
            $check = $sqlite->query("SELECT name FROM sqlite_master WHERE type='table' AND name=" . $sqlite->quote($table));
            if (! $check || ! $check->fetch()) {
                $this->line("  <fg=gray>SKIP</> $table (not found in SQLite)");
                return;
            }

            $stmt = $sqlite->query("SELECT * FROM \"$table\"");
            $rows = $stmt->fetchAll();

            if (empty($rows)) {
                $this->line("  <fg=gray>SKIP</> $table (0 rows)");
                return;
            }

            // Detect boolean columns in PostgreSQL schema
            $boolCols = $this->getBooleanColumns($pgsql, $table);

            // Cast SQLite 0/1 integers to PHP bool for PostgreSQL boolean columns
            if (! empty($boolCols)) {
                $rows = array_map(function (array $row) use ($boolCols) {
                    foreach ($boolCols as $col) {
                        if (array_key_exists($col, $row)) {
                            // Cast SQLite 0/1 to PostgreSQL-compatible boolean string
                            $row[$col] = $row[$col] ? 'true' : 'false';
                        }
                    }
                    return $row;
                }, $rows);
            }

            // Truncate target table
            $pgsql->statement("TRUNCATE TABLE \"$table\" RESTART IDENTITY CASCADE");

            // Insert in chunks of 100
            foreach (array_chunk($rows, 100) as $chunk) {
                $pgsql->table($table)->insert($chunk);
            }

            $boolInfo = ! empty($boolCols) ? " (cast: " . implode(', ', $boolCols) . ")" : '';
            $this->line("  <fg=green>OK</>   $table — " . count($rows) . " rows migrated$boolInfo");

        } catch (\Throwable $e) {
            $errors[] = "$table: " . $e->getMessage();
            $this->line("  <fg=red>FAIL</> $table — " . $e->getMessage());
        }
    }
}
