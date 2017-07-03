<?php

namespace App\Console\Components\Sentry;

use App\Events\Sentry\ErrorsFetched;
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
    protected $description = 'Fetch errors from Sentry.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();

        $response = $client->get('https://sentry.io/api/0/projects/'.config('services.sentry.organization').'/'.config('services.sentry.project').'/issues/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.config('services.sentry.token')
            ]
        ])->getBody();

        // only keep servers with summary and remap it
        $errors = collect(json_decode($response))
            ->map(function($error){
                return [
                    'class' => $error->culprit,
                    'last_message' => $error->title,
                    'occurrences' => $error->count,
                    'last_context' => $error->title,
                    'last_received' => Carbon::parse($error->lastSeen)->diffForHumans()
                ];
            })
            ->toArray();

        event(new ErrorsFetched($errors));
    }
}
