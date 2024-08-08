<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\HistoryAi;
use App\Models\Pengaturan;
use App\Models\Produk;
use App\Models\TrBahan;
use App\Models\TrProduk;
use Illuminate\Support\Carbon;
use Orhanerday\OpenAi\OpenAi;

class AiController extends Controller
{
    public function generate()
    {
        $data['bahan'] = Bahan::all()->toArray();
        $data['produk'] = Produk::all()->toArray();

        $data['trBahan'] = TrBahan::all()
            ->groupBy(function ($date) {
                $created_at = Carbon::parse($date->tgl_transaksi);
                $start = $created_at->startOfWeek()->format('d-m-Y');
                $end = $created_at->endOfWeek()->format('d-m-Y');

                return "{$start} - {$end}";
            })->map(function ($item) {
                return $item->groupBy('id_bahan')->map(function($bahan){
                    return $bahan->sum('qty');
                })->toJson();
            })->toArray();
            $data['trProduk'] = TrProduk::all()->groupBy(function ($date) {
                $created_at = Carbon::parse($date->tgl_transaksi);
                $start = $created_at->startOfWeek()->format('d-m-Y');
                $end = $created_at->endOfWeek()->format('d-m-Y');

            return "{$start} - {$end}";
        })->map(function ($item) {
            return $item->groupBy('id_produk')->map(function($produk){
                return $produk->sum('qty');
            })->toJson();
        })->toArray();
        


        try {
            $response = $this->ask(json_encode($data));
            HistoryAi::create([
                'response' => $response['chat'],
                'model' => $response['model'],
                'total_token' => $response['total_token']
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect('dashboard')->with('success', 'Success');
    }

    public function ask($prompt, $temp = 0.7)
    {
        $base_prompt = Pengaturan::where('key', 'gpt-prompt')->first()->value;
        if ($base_prompt == '') {
            $base_prompt = 'Kamu adalah asisten toko yang cerdas. Tugasmu adalah menganalisis data transaksi toko dalam format JSON, kemudian memberikan analisis serta saran untuk meningkatkan penjualan dan efisiensi operasional. Selain itu, kamu akan merekomendasikan bahan yang perlu dibeli, jumlahnya, dan produksi yang perlu ditingkatkan. Jawabanmu harus disampaikan dalam satu paragraf yang tidak lebih dari 100 kata, dengan nada deskriptif dan ilmiah. Pastikan jawaban singkat, padat, dan jelas. jawaban kamu akan disertai dengan tabel tabel yang telah ditentukan seperti berikut: 
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Bahan/Produk</th>
                        <th>Rekomendasi</th>
                    </tr>
                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                </table>
            .';

        }

        $model = 'gpt-3.5-turbo';
        if (Pengaturan::where('key', 'gpt-version')->first()->value != null) {
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
            'max_tokens' => 3000,
        ]);
        $resp = json_decode($chat);
        return [
            'chat' => $resp->choices[0]->message->content,
            'model' => $resp->model,
            'total_token' => $resp->usage->total_tokens
        ];
    }
}
