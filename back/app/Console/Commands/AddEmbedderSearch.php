<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;

class AddEmbedderSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-embedder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add BAAI/bge-base-en-v1.5 to make embeddings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        try {
            $response = $client->request('PATCH', 'meilisearch:7700/indexes/books/settings', [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'embedders' => [
                        'default' => [
                            'source' => 'huggingFace',
                            'model' => 'BAAI/bge-base-en-v1.5',
                            'documentTemplate' => "A book titled '{{doc.title}}' whose description starts with {{doc.description|truncatewords: 20}}"
                        ]
                    ]
                ]
            ]);
            echo $response->getBody();
        } catch (RequestException $e) {
            echo $e->getMessage();
        }
    }
}
