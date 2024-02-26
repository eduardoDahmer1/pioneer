<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessOpenAiJson implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 160;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct(private string $message, private int $id)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->message = 'Forneça informações sobre o produto em detalhes' . $this->message . 'em JSON. Evite as frases iniciais e finais no content, remova a tag json no inicio remova caracteres como / e mande tudo em português';
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json'
        ];

        $url = 'https://api.openai.com/v1/chat/completions';
        $bodyText = [
            "model" => "gpt-4-1106-preview",
            "temperature" => 0.7,
            "messages" => [
                [
                    "role" => "user",
                    "content" => $this->message,
                ]
            ]
        ];

        $response = $client->request('POST', $url, ['headers' => $headers, 'body' => json_encode($bodyText)]);
        $body = $response->getBody();
        $data = json_decode($body, true);
        DB::table('products')->where('id', $this->id)->update(['description_gpt' => $data['choices'][0]['message']['content']]);
    }
}