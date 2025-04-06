<?php

class Content_Generator
{
    protected static function generate_with_google( $api_key, $prompt )
    {
        $api_url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$api_key";

        $data = [
            'contents' => 
                [
                    'parts' => [
                        'text' => $prompt
                    ]
                ]
        ];
        
        $headers = [
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            error_log('CURL error: ' . curl_error($ch));
            throw new \Exception(get_string('internalerror', 'block_smartedu'));
        }
        
        curl_close($ch);
        
        if ($httpCode != 200) {
            error_log('HTTP error: ' . $httpCode);
            throw new \Exception(get_string('internalerror', 'block_smartedu'));
        }
        
        $chat_response = json_decode($response, true);
        $chat_content = $chat_response['candidates'][0]['content']['parts'][0]['text'];
        return $chat_content;
    }

    protected static function generate_with_openai( $api_key, $prompt )
    {
        $api_url = "https://api.openai.com/v1/chat/completions";

        $data = [
            'model' => 'gpt-4o-mini', 
            'messages' => [
                ['role' => 'system', 'content' => 'Você é um gerador de resumos acadêmicos para o ensino superior.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7
        ];
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key, // API Key da OpenAI
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            error_log('CURL error: ' . curl_error($ch));
            throw new \Exception(get_string('internalerror', 'block_smartedu'));
        }
        
        curl_close($ch);
        
        if ($httpCode != 200) {
            error_log('HTTP error: ' . $httpCode);
            throw new \Exception(get_string('internalerror', 'block_smartedu'));
        }
        
        $chat_response = json_decode($response, true);
        $chat_content = $chat_response['choices'][0]['message']['content'];
        return $chat_content;
    }

    public static function get_valid_ai_providers()
    {
        return [
            'openai',
            'google',
        ];
    }

    /**
     * @param $path_to_file
     * @return bool|mixed|string
     * @throws Exception
     */
    public static function generate( $ai_provider, $api_key, $prompt )
    {
        $response = '';
        
        if (isset($ai_provider) && isset($api_key) && isset($prompt)) {

            $valid_ai_providers = self::get_valid_ai_providers();
            $ai_provider = strtolower($ai_provider);

            if (in_array( $ai_provider, $valid_ai_providers )) {
                $method   = 'generate_with_' . $ai_provider;
                $response = self::$method( $api_key, $prompt );
            } else {
                error_log('AI provider not allowed');
                throw new \Exception(get_string('internalerror', 'block_smartedu'));
            }

        }        

        return $response;
    }

}