<?php
// This file is part of Moodle - https://moodle.org/
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
 * Adds admin settings for the plugin.
 *
 * @package     block_smartedu
 * @copyright   2025, Paulo Júnior <pauloa.junior@ufla.br>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $options = array(
        'google' => 'Google (Gemini)',
        'openai' => 'OpenAI (ChatGPT)',
        'local' => 'Local (Ollama)',
    );
    
    $settings->add(new admin_setting_configselect('block_smartedu/aiprovider', get_string('aiprovider', 'block_smartedu'), null, 'google', $options));
    $settings->add(new admin_setting_configtext('block_smartedu/apikey', get_string('apikey', 'block_smartedu'), null, "", PARAM_TEXT));
    $settings->add(new admin_setting_configtext('block_smartedu/localaiurl', get_string('localai:url', 'block_smartedu'), get_string('localai:urlexample', 'block_smartedu'), "", PARAM_TEXT));
    $settings->add(new admin_setting_configtext('block_smartedu/localaimodel', get_string('localai:model', 'block_smartedu'), get_string('localai:modelexample', 'block_smartedu'), "", PARAM_TEXT));
    $settings->add(new admin_setting_configcheckbox('block_smartedu/enablecache', get_string('enablecache', 'block_smartedu'), null,  1));
   
}