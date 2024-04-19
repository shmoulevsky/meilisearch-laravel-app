<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;

class EnableVectorSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:enable-vector-search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable vector search';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        try {
            $response = $client->request('PATCH', 'meilisearch:7700/indexes/movies/settings', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "vectorStore" => true
                ]
            ]);
            echo $response->getBody();
        } catch (RequestException $e) {
            echo $e->getMessage();
        }
    }
}
