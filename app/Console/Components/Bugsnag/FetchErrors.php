<?php

namespace App\Console\Components\Bugsnag;

use App\Events\Bugsnag\ErrorsFetched;
use Carbon\Carbon;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class FetchErrors extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:fetch-errors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch errors from Bugsnag.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();

        $response = $client->get('https://api.bugsnag.com/projects/'.config("services.bugsnag.project_id").'/errors?status=in-progress&auth_token='.config("services.bugsnag.token"), [
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ])->getBody();

        // only keep servers with summary and remap it
        $errors = collect(json_decode($response))
            ->map(function($error){
                return [
                    'class' => $error->class,
                    'last_message' => $error->last_message,
                    'occurrences' => $error->occurrences,
                    'last_context' => $error->last_context,
                    'last_received' => Carbon::parse($error->last_received)->diffForHumans()
                ];
            })
            ->toArray();

        event(new ErrorsFetched($errors));
    }
}
