<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatHistory;
use OpenAI\Laravel\Facades\OpenAI;
use Validator;

class ChatController extends Controller
{
    public function chat(Request $request)
    {   
        $user = auth()->user();

        $validator = Validator::make($request->all(), [ 
            'question' => 'required|string'
        ]);

        if ($validator->fails()){ 
            $message = $validator->errors()->first();
            return response()->json(['message' => $message], 401);            
        }

        $prompt = $this->generate_prompt($user->class, $request->question);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => $prompt],
            ],
        ]);

        $answer = $response['choices'][0]['message']['content'];

        ChatHistory::create([
            'user_id' => $user->id,
            'question' => $request->question,
            'answer' => $answer,
        ]);

        return response()->json(['answer' => $answer]);
    }

    private function generate_prompt($class, $question)
    {
        $levels = [
            1 => "Explain simply for a 1st grader: ",
            4 => "Answer clearly for a 4th-grade student: ",
            7 => "Provide a moderately detailed answer for a 7th grader: ",
            10 => "Provide a detailed and technical answer for a 10th-grade student: ",
        ];

        return $levels[$class] . $question;
    }
}
