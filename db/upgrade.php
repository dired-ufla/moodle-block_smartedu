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
 * Upgrade script for the block_smartedu plugin.
 *
 * @package   block_smartedu
 * @copyright 2025, Paulo Júnior <pauloa.junior@ufla.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use block_smartedu\constants;


/*
 * Upgrade function for the block_smartedu plugin.
 *
 * This function is called during the upgrade process of the plugin to apply necessary changes,
 * such as creating a tag for hiding courses if it does not already exist.
 *
 * @return void
*/
function xmldb_block_smartedu_upgrade($oldversion) {

    if ($oldversion < 2025053003) {
        $tagcollid = \core_tag_area::get_collection('core', 'course');
        $tagname = constants::TAG_HIDE;
        \core_tag_tag::create_if_missing($tagcollid, [$tagname], true);        

        upgrade_plugin_savepoint(true, 2025053003, 'block', 'smartedu');
    }

    return true;
}
