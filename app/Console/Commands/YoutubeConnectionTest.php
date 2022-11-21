<?php

namespace App\Console\Commands;


use App\Repositories\YoutubeRepository;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class YoutubeConnectionTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'YoutubeConnectionTest';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the connection to hubspot.';
    /**
     * @var YoutubeRepository
     */
    private $youtubeRepo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->youtubeRepo = new YoutubeRepository();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
         $activities = $this->youtubeRepo->get_activities('UCIRYBXDze5krPDzAEOxFGVA');
         dd($activities);
    }

}
