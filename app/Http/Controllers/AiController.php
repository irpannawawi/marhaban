<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Pengaturan;
use App\Models\Produk;
use App\Models\TrBahan;
use App\Models\TrProduk;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class AiController extends Controller
{
    public function generate(){
        $data['trBahan'] = TrBahan::all()->toArray(); 
        $data['bahan'] = Bahan::all()->toArray(); 
        $data['produk'] = Produk::all()->toArray();
        $data['trProduk'] = TrProduk::all()->toArray();
        try {
            $response = $this->ask(json_encode($data));
            file_put_contents(storage_path('./gpt-response.txt'), $response);
        } catch (\Exception $e) {
        }

        return redirect('dashboard')->with('success', 'Success');
    }

    public function ask($prompt, $temp = 0.8)
    {
        $base_prompt = Pengaturan::where('key', 'gpt-prompt')->first()->value;
        if($base_prompt == ''){
            $base_prompt = 'Saya adalah asisten toko yang cerdas dan saya di sini untuk membantu Anda menganalisis data transaksi toko Anda. Kirimkan data transaksi Anda dalam format JSON, dan saya akan memberikan analisis serta saran untuk meningkatkan penjualan dan efisiensi operasional toko Anda. Saya akan memberikan anda saran dalam 1 paragraf berisi teks tidak lebih dari 100 kata. 
';
        }
        
        $model = 'gpt-3.5-turbo';
        if(Pengaturan::where('key', 'gpt-version')->first()->value != null){
            $model = Pengaturan::where('key', 'gpt-version')->first()->value;
        }

        $ai = new OpenAi(Pengaturan::where('key', 'gpt-key')->first()->value);
        $chat = $ai->chat([
            'model' => $model,
            'messages' => [
                [
                    'role' => 'assistant',
                    'content' => $base_prompt
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                    
                ],

            ],
            'temperature' => $temp,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);
        return json_decode($chat)->choices[0]->message->content;
    }
}
