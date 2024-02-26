<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpenaiController extends Controller
{
    public function sendMessage(Request $request)
    {
        if (env("ENABLE_OPENAI_API", true)) {
            $message = $request->input('messages');
            $message[1]['content'] = "Me de uma descrição do produto " . $message[1]['content'] . 'para minha loja apenas uma breve descrição favorecer uma resposta rápida';
            $ch = curl_init('https://api.openai.com/v1/chat/completions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
                'model' => 'gpt-4-1106-preview',
                'messages' => $message,
                'temperature' => 0.7,
            )));
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }
    }
}