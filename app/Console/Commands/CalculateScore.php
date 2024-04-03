<?php

namespace App\Console\Commands;

use App\Http\Controllers\GameController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class CalculateScore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'score:calculate {word}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate score for the given word';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $word = strtolower($this->argument('word'));
        $request = Request::create('/word', 'POST', ['word' => $word]);
        $gameController = new GameController();
        $response = $gameController->score($request);

        $this->info($response->getContent());
    }
}
