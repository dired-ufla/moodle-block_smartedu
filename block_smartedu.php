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
 * Block definition class for the block_smartedu plugin.
 *
 * @package   block_smartedu
 * @copyright 2025, Paulo Júnior <pauloa.junior@ufla.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('text_extraction.php');

class block_smartedu extends block_base {

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_smartedu');
    }

    /**
     * Gets the block contents.
     *
     * @return string The block HTML.
     */
    public function get_content() {
        global $OUTPUT, $COURSE;
        
        if ($this->content !== null) {
            return $this->content;
        }

        $termsofuse = get_string('termsofuse', 'block_smartedu');
        $noresources = get_string('noresources', 'block_smartedu');

        $this->content = new stdClass();
        $this->content->footer = <<<HTML
            <footer class="bg-light text-center text-muted mt-2">
                <p>$termsofuse</p>
            </footer>
            HTML;
        

        $resources = $this->get_resources_list();
        $resources_content = '';

        if (empty($resources)) {
            $this->content->text = <<<HTML
                <div class="alert alert-primary" role="alert">
                    $noresources
                </div>
                HTML;

            return $this->content;
        }


        foreach ($resources as $key => $item) {
            $url = new moodle_url('/blocks/smartedu/results.php', ['resourceid' => $item->id, 'summarytype' => $this->config->summarytype]);

            $resources_content = $resources_content . <<<HTML
                    <li class="list-group-item d-flex align-items-center">
                        <img title="teste" class="activityicon mr-2" src="$item->icon_url" alt="teste" />
                        <a href="$url" target="_blank" class="text-decoration-none">$item->name</a>
                    </li>
                    HTML;
        }     

        $this->content->text = <<<HTML
            <div>
                <ul class="list-group">
                    $resources_content     
               </ul>
            </div>   
        HTML;

        return $this->content;
    }

    private function get_resources_list() {
        global $COURSE;
        
        $allowed_extensions = Text_Extraction::get_valid_file_types();
        $course_info = get_fast_modinfo($COURSE->id);
        $resourses = array();

        print_r($allowed_extensions);
        print_r($course_info);
        die();



        foreach ($course_info->cms as $key => $item) {
            // Exclude resources invisible for users 
            if ($item->modname != 'resource') {
                continue;
            }

            if (!$item->uservisible) {
                continue;
            }

            // Exclude resources not allowed
            $resource_details = unserialize($item->customdata["displayoptions"]);


            $file_extension = $resource_details['filedetails']['extension'];
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                continue;
            }

            $res = new stdClass();
            $res->id = $item->id;
            $res->name = $item->name;
            
            if (!$item->visible) {
                $res->name .= get_string('studentinvisible', 'block_smartedu'); 
            }
            
            $res->icon_url = $item->get_icon_url();

            $resourses[] = $res;
        }


        return $resourses;
    }

    /**
     * Defines in which pages this block can be added.
     *
     * @return array of the pages where the block can be added.
     */
    public function applicable_formats() {
        return [
            'course-view' => true,
        ];
    }

    function has_config() {
        return true;
    }
}