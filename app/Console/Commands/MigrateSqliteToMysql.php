<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateSqliteToMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:migrate-sqlite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from SQLite to MySQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting data migration from SQLite to MySQL...');

        // Define the tables order (respecting foreign key relationships)
        $tables = [
            'users',
            'categories',
            'posts', // Depends on users and categories
            'services',
            'projects',
            'team_members',
            'alumnis',
            'testimonials',
            'partners',
            'settings',
            'media', // Copy media references last
        ];

        // Ensure sqlite connection uses the old database file
        config(['database.connections.sqlite.database' => database_path('database.sqlite')]);

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($tables as $table) {
            $this->info("Migrating table: {$table}");
            
            // Clear existing data in MySQL (Optional, assuming fresh db)
            \Illuminate\Support\Facades\DB::connection('mysql')->table($table)->truncate();

            // Fetch data from SQLite
            $records = \Illuminate\Support\Facades\DB::connection('sqlite')->table($table)->get()->map(function ($item) {
                return (array) $item;
            })->toArray();

            if (empty($records)) {
                $this->warn("No records found in {$table}");
                continue;
            }

            // Insert in chunks to avoid memory limit issues
            $chunks = array_chunk($records, 500);
            foreach ($chunks as $chunk) {
                \Illuminate\Support\Facades\DB::connection('mysql')->table($table)->insert($chunk);
            }

            $this->info("Successfully migrated " . count($records) . " records to {$table}");
        }

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Migration completed successfully!');
    }
}
