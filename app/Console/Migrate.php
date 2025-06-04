<?php

namespace App\Console;

use app\Libraries\Core\Console\AbstractCommand;
use App\Libraries\Core\Database\Schema;
use App\Libraries\Core\Facades\DB;
use App\Models\Migration;
use RuntimeException;

class Migrate extends AbstractCommand
{
    public string $signature = 'migrate {-d} {-h}';
    public string $description = 'Run database migrations';

    public function handle(): int
    {
        $this->handleHelp();
        $this->handleDrop();

        Migration::createIfNotExists();

        $executedMigrations = $this->getDoneMigrations();

        $migrationDir = __DIR__ . '/../../database/migrations';
        $migrationFiles = glob($migrationDir . '/*.php');
        foreach ($migrationFiles as $file) {
            $fileName = basename($file, '.php');

            $migrationClass = include $file;
            /**  @var \App\Libraries\Core\Database\Migration $migration */
            $migration = new $migrationClass();
            if (! $migration instanceof \App\Libraries\Core\Database\Migration) {
                throw new RuntimeException("Migration in file $file is not a valid Migration class.");
            }

            if (in_array($file, array_column($executedMigrations, 'name'), true)) {
                continue;
            }

            $migration->up();
            Migration::create([
                'name' => $fileName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return 0;
    }

    /**
     * @return array<Migration>
     */
    public function getDoneMigrations(): array
    {
        return Migration::all();
    }

    protected function handleHelp(): void
    {
        if (! $this->arguments()['h']) {
            return;
        }
        echo "Usage: {$this->signature}\n" .
            "Options:\n" .
            "  -d    Drop the database before running migrations\n" .
            "  -h    Show this help message\n";
        exit(0);
    }

    protected function handleDrop(): void
    {
        if (! $this->arguments()['d']) {
            return;
        }

        echo 'Dropping all tables in the database...' . PHP_EOL;
        Schema::dropAllTables();
    }
}
