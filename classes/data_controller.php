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
 * Customfield radio button plugin
 *
 * @package   customfield_radio
 * @copyright  2021 Mukudu Publishing
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace customfield_radio;

defined('MOODLE_INTERNAL') || die;

/**
 * Class data
 *
 * @package   customfield_radio
 * @copyright  2021 Mukudu Publishing
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class data_controller extends \core_customfield\data_controller {
    /**
     * Return the name of the field where the information is stored
     * @return string
     */
    public function datafield() : string {
        return 'intvalue';
    }
    
    /**
     * Add fields for editing a radio field.
     *
     * @param \MoodleQuickForm $mform
     */
    public function instance_form_definition(\MoodleQuickForm $mform) {
        $field = $this->get_field();
        $config = $field->get('configdata');
        $elementname = $this->get_form_element_name();
        
        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', $elementname, '', get_string('yes'), 1);
        $radioarray[] = $mform->createElement('radio', $elementname, '', get_string('no'), 0);
        $mform->addGroup($radioarray, 'cfgradioar', $config['cfgquestion'], array(' '), false);
        $mform->setDefault($elementname, $config['cfgdefault']);
        $mform->setType($elementname, PARAM_INT);
    }
    
    /**
     * Returns the default value as it would be stored in the database (not in human-readable format).
     *
     * @return mixed
     */
    public function get_default_value() {
        return 0;
    }
    
    /**
     * Returns value in a human-readable format
     *
     * @return mixed|null value or null if empty
     */
    public function export_value() {
        $value = $this->get_value();
        return $value ? get_string('yes') : get_string('no');
    }
    
}
