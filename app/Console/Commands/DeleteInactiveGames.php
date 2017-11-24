<?php

namespace App\Console\Commands;

use App\Models\Game;
use Illuminate\Console\Command;

class DeleteInactiveGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteInactiveGames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete inactive games';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $games = Game::inactive()->get();
        $bar = $this->output->createProgressBar($games->count());
        $this->info("Start deleting");

        foreach ($games as $game) {
            $game->delete();
            $bar->advance();
        }

        $this->info(PHP_EOL . 'Finish deleting');
    }
}
