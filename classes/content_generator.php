<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Content generator class for the block_smartedu plugin.
 *
 * @package   block_smartedu
 * @copyright 2025, Paulo Júnior <pauloa.junior@ufla.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_smartedu;

class content_generator {
    /**
     * Generates content using Local Ollama AI.
     *
     * @param string $api_key The API key for Local Ollama AI.
     * @param string $prompt The prompt to send to the AI.
     * @return string The generated content.
     * @throws Exception If there is a CURL or HTTP error.
     */
    protected static function block_smartedu_generate_with_local( $api_key, $prompt, $ai_url, $ai_model ) {
        $api_url = $ai_url;

        $data = [
            'model' => "llama3.1:8b", // Model name for the local AI service
            'stream'   => false, // Disable streaming for local AI
            'messages' => [
                [
                    'role' => 'user',
                    'content' =>  $prompt,
                ]
            ]
        ];
        
        $headers = [
            'Content-Type: application/json',
        ];

        $options = [
            'CURLOPT_HTTPHEADER' => $headers,
            'CURLOPT_TIMEOUT' => 180,
        ];
    
        $curl = new \curl();
        $response = $curl->post($api_url, json_encode($data), $options);

        if ($curl->get_errno()) {
            error_log('CURL error: ' . $curl->error);
            throw new \Exception(get_string('internalerror', 'block_smartedu'));
        }
        
        $httpCode = $curl->info['http_code'];
        if ($httpCode != 200) {
            error_log('HTTP error: ' . $httpCode);
            throw new \Exception(get_string('aiprovidererror', 'block_smartedu'));
        }
        
        $chat_response = json_decode($response, true);
        $chat_content = $chat_response['message']['content'];


        return $chat_content;
    }

    /**
     * Generates content using Google's AI API.
     *
     * @param string $api_key The API key for Google AI.
     * @param string $prompt The prompt to send to the AI.
     * @return string The generated content.
     * @throws Exception If there is a CURL or HTTP error.
     */
    protected static function block_smartedu_generate_with_google( $api_key, $prompt, $ai_url, $ai_model ) {
        $api_url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$api_key";

        $data = [
            'contents' => 
                [
                    'parts' => [
                        'text' => $prompt,
                    ]
                ]
        ];
        
        $headers = [
            'Content-Type: application/json',
        ];

        $curl = new \curl();
        $options = [
            'CURLOPT_HTTPHEADER' => $headers,
            'CURLOPT_TIMEOUT' => 120,
        ];
    
        $response = $curl->post($api_url, json_encode($data), $options);

        if ($curl->get_errno()) {
            error_log('CURL error: ' . $curl->error);
            throw new \Exception(get_string('internalerror', 'block_smartedu'));
        }
        
        $httpCode = $curl->info['http_code'];
        if ($httpCode != 200) {
            error_log('HTTP error: ' . $httpCode);
            throw new \Exception(get_string('aiprovidererror', 'block_smartedu'));
        }
        
        $chat_response = json_decode($response, true);
        $chat_content = $chat_response['candidates'][0]['content']['parts'][0]['text'];
        return $chat_content;
    }

    /**
     * Generates content using OpenAI's API.
     *
     * @param string $api_key The API key for OpenAI.
     * @param string $prompt The prompt to send to the AI.
     * @return string The generated content.
     * @throws Exception If there is a CURL or HTTP error.
     */
    protected static function block_smartedu_generate_with_openai( $api_key, $prompt, $ai_url, $ai_model) {
        $api_url = "https://api.openai.com/v1/chat/completions";

        $data = [
            'model' => 'gpt-4o-mini', 
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ]
        ];
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key, // API Key da OpenAI
        ];
    
        $curl = new \curl();
        $options = [
            'CURLOPT_HTTPHEADER' => $headers,
            'CURLOPT_TIMEOUT' => 120,
        ];
    
        $response = $curl->post($api_url, json_encode($data), $options);

        if ($curl->get_errno()) {
            error_log('CURL error: ' . $curl->error);
            throw new \Exception(get_string('internalerror', 'block_smartedu'));
        }
        
        $httpCode = $curl->info['http_code'];
        if ($httpCode != 200) {
            error_log('HTTP error: ' . $httpCode);
            throw new \Exception(get_string('aiprovidererror', 'block_smartedu'));
        }
        
        $chat_response = json_decode($response, true);
        $chat_content = $chat_response['choices'][0]['message']['content'];
        return $chat_content;
    }

    /**
     * Retrieves the list of valid AI providers.
     *
     * @return array List of valid AI provider names.
     */
    protected static function block_smartedu_get_valid_ai_providers() {
        return [
            'openai',
            'google',
            'local',
        ];
    }

    /**
     * Generates content using the specified AI provider.
     *
     * @param string $ai_provider The name of the AI provider (e.g., 'openai', 'google').
     * @param string $api_key The API key for the AI provider.
     * @param string $prompt The prompt to send to the AI.
     * @return string The generated content.
     * @throws Exception If the AI provider is not valid or if there is an error during generation.
     */
    public static function block_smartedu_generate( $ai_provider, $api_key, $ai_url, $ai_model, $prompt ) {
        $response = '';
        
        $valid_ai_providers = self::block_smartedu_get_valid_ai_providers();
        $ai_provider = strtolower($ai_provider);

        if (in_array( $ai_provider, $valid_ai_providers )) {
            $method   = 'block_smartedu_generate_with_' . $ai_provider;
            $response = self::$method( $api_key, $prompt, $ai_url, $ai_model);
        } else {
            error_log('AI provider not allowed');
            throw new \Exception(get_string('invalidaiprovider', 'block_smartedu'));
        }


        return $response;
    }

}