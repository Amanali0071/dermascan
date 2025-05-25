<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateDiseaseReportsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:disease-reports-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the disease reports table migration and run it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating disease reports migration...');
        Artisan::call('make:migration create_disease_reports_table');
        
        $this->info('Running migration...');
        Artisan::call('migrate');
        
        $this->info('Disease reports table created successfully!');
    }
}