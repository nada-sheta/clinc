<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class AskController extends Controller
{
    public function show()
    {
        return view("site.pages.show_chat");
    }

public function sendMessage(Request $request)
{
    $userMessage = $request->input('message');

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'x-goog-api-key' => env('GEMINI_API_KEY'), 
    ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [
        'contents' => [[
        'parts' => [[ 'text' => 
                "أنت طبيب افتراضي متخصص في تقديم معلومات طبية عامة فقط.
                تحدث بلغة المستخدم (سواء عربية فصحى أو عامية أو انجليزية ) وبأسلوب بسيط وواضح.
                لا تستخدم مصطلحات معقدة، وتجنب إعطاء أسماء أدوية أو تشخيصات محددة.
                إذا كان السؤال خارج نطاق المعلومات العامة، أو يحتاج تدخل طبي مباشر،
                انصح المستخدم بلطف بمراجعة طبيب حقيقي.
                تأكد أن يكون الرد صحيحًا ومفهومًا، وخاليًا من الأخطاء أو الكلمات الغريبة.\n\n".
                "سؤال المستخدم: ".$userMessage
            ]]
        ]]
    ]);

    if ($response->successful()) {
        $aiReply = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response from AI.';

        return response()->json([
            ['message' => $aiReply, 'is_from_user' => false]
        ]);
    } else {
        return response()->json([
            ['message' => 'Sorry, something went wrong with Gemini AI service.', 'is_from_user' => false]
        ]);
    }
}
}
