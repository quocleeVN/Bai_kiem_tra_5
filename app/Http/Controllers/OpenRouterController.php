<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OpenRouterController extends Controller
{
    //
    public function chat()
    {
        $problem = "Viết một hàm PHP để tính giai thừa của một số nguyên dương n. Hàm này sẽ trả về giai thừa của n nếu n là một số nguyên dương, và trả về null nếu n không phải là một số nguyên dương.";
        $code = '<?php

function factorial($n) {
    if ($n <= 0) {
        return null;
    }

    $result = 1;
    for ($i = 1; $i <= $n; $i++) {
        $result *= $i;
    }

    return $result;
}

// Test
echo factorial(5); // 120';         
         $prompt = "
                Bạn là giảng viên chấm bài lập trình.

                Hãy chấm bài code theo thang điểm 10 dựa trên:
                - Đúng yêu cầu
                - Logic
                - Tối ưu
                - Clean code

                Trả về JSON:
                {
                \"score\": number,
                \"feedback\": \"...\",
                \"errors\": [],
                \"suggestions\": []
                }

                Đề bài:
                $problem

                Code:
                $code
                ";

            $response = Http::withToken(env('OPENAI_API_KEY'))
                ->timeout(60)
                ->post('https://api.openai.com/v1/chat/completions', [
                    "model" => "gpt-4o-mini",
                    "messages" => [
                        ["role" => "user", "content" => $prompt]
                    ],
                    "temperature" => 0.2
                ]);

            $content = $response->json()['choices'][0]['message']['content'];

            return $content;
    }
    
}
