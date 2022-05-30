<?php

namespace App\Console\Commands;

use App\Actions\Post\ImportPost;
use Illuminate\Console\Command;

class PostImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import external posts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ImportPost $importPost)
    {
        $importPost->execute();
    }
}
