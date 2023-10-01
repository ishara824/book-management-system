<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $sourceConnection = 'mysql';
        $destinationConnection = 'backup_connection';

        $sourceDatabase = env('DB_DATABASE');
        $destinationDatabase = env('BACKUP_DB_DATABASE');

        $sourceDBUser = env('DB_USERNAME');
        $destinationDBUSER = env('BACKUP_DB_USERNAME');

        $storagePath = storage_path('app/backup/');
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $backupFilename = $storagePath . "backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        exec("mysqldump -u $sourceDBUser -p $sourceDatabase > $backupFilename");

        $sourceDatabase = DB::connection($sourceConnection)->getDatabaseName();
        $destinationDatabase = DB::connection($destinationConnection)->getDatabaseName();
        exec("mysql -u $destinationDBUSER -p $destinationDatabase < $backupFilename");

        $this->info("Database '$sourceDatabase' has been backed up and copied to '$destinationDatabase'");
    }
}
