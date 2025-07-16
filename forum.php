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
* Quizz page for the block_smartedu plugin.
*
* @package   block_smartedu
* @copyright 2025, Paulo Júnior <pauloa.junior@ufla.br>
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/


use block_smartedu\content_generator;
use block_smartedu\ai_cache;
use block_smartedu\forum_reader;
use block_smartedu\prompt_generator;

require_once(__DIR__ . '/../../config.php');

\require_login();

$forumid = required_param('forumid', PARAM_INT);
$forumtype = required_param('forumtype', PARAM_TEXT);
$summary_type = required_param('summarytype', PARAM_TEXT);

try {

    // Retrieve the course module for the given resource ID.
    if (!$cm = get_coursemodule_from_id('forum', $forumid)) {
        throw new \Exception(get_string('resourcenotfound', 'block_smartedu'));
    } 
        
    $context = context_module::instance($cm->id);
    $course = get_course($cm->course);
    require_login($course, true, $cm);

    $PAGE->set_context($context); 
    $PAGE->set_url(new moodle_url('/blocks/smartedu/forum.php', [
        'forumid' => $forumid, 
        'forumtype' => $forumtype,
        'summarytype' => $summary_type,
    ]));
    
    $PAGE->set_title(get_string('pluginname', 'block_smartedu'));
    $PAGE->set_heading($course->fullname); 

    $discussions = forum_reader::block_smartedu_read($forumid, $forumtype);
    $json_discussions = json_encode($discussions->discussions, JSON_UNESCAPED_UNICODE);

    // Retrieve API key and AI provider configuration.
    $api_key = get_config('block_smartedu', 'apikey');
    $ai_provider = get_config('block_smartedu', 'aiprovider');
    $ai_url = get_config('block_smartedu', 'localaiurl');
    $ai_model = get_config('block_smartedu', 'localaimodel');
    $enablecache = get_config('block_smartedu', 'enablecache');

    // Generate the prompt for the AI based on the summary type and number of questions.
    $config = [
        'summary_type' => $summary_type,
    ];

    $prompt = prompt_generator::block_smartedu_generate('forum', $config, $json_discussions);

    // Check if caching is enabled and if the response is already cached.
    $cached = $enablecache == 1 ? ai_cache::block_smartedu_get_cached_response($prompt) : null;

    if ($cached !== null and $cached !== '') {
        $response = $cached;
    } else {
        // Generate the response using the AI provider.
        $response = content_generator::block_smartedu_generate($ai_provider, $api_key, $ai_url, $ai_model, $prompt);

        // Parse the AI response.
        $response = preg_replace('/```json\s*(.*?)\s*```/s', '$1', $response);
        
        if (!mb_check_encoding($response, 'UTF-8')) {
            $response = utf8_encode($response);
        }
        
        $response = preg_replace('/[[:cntrl:]]/', '', $response);
        
        ai_cache::block_smartedu_store_response_in_cache($prompt, $response);
    }

    $data = json_decode($response);

    $data_template['has_error'] = false;

    foreach ($data as $item) {
        $data_template['discussions'][] = $item;
    }

} catch (Exception $e) {
    $has_error = true;
    $error_message = $e->getMessage();
    $data_template['has_error'] = true;
    $data_template['error_message'] = $error_message;
}

// Output the page.
echo $OUTPUT->header();
echo $OUTPUT->render_from_template('block_smartedu/forum', $data_template);
echo $OUTPUT->footer();