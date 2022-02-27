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
 * Customfields radio button plugin
 *
 * @package   customfield_radio
 * @copyright  2021 Mukudu Publishing
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace customfield_radio;

defined('MOODLE_INTERNAL') || die;

/**
 * Customfield radio button plugin
 *
 * @package   customfield_radio
 * @copyright  2021 Mukudu Publishing
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_controller  extends \core_customfield\field_controller {
    
    /**
     * Plugin type
     */
    const TYPE = 'radio';
    
    /**
     * Add fields for editing a radio field in admin.
     *
     * @param \MoodleQuickForm $mform
     */
    public function config_form_definition(\MoodleQuickForm $mform) {
        $mform->addElement('header', 'header_oursettings', get_string('oursettings', 'customfield_radio'));
        $mform->setExpanded('header_oursettings', true);
        
        $mform->addElement('text', 'configdata[cfgquestion]', get_string('getquestionprompt', 'customfield_radio'));
        $mform->setType('configdata[cfgquestion]', PARAM_TEXT);
        $mform->addRule('configdata[cfgquestion]', null, 'maxlength', 150, 'client');
        $mform->addRule('configdata[cfgquestion]', null, 'required', null, 'client');
        
        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'configdata[cfgdefault]', '', get_string('yes'), 1);
        $radioarray[] = $mform->createElement('radio', 'configdata[cfgdefault]', '', get_string('no'), 0);
        $mform->addGroup($radioarray, 'cfgradioar', get_string('defaultprompt', 'customfield_radio'), array(' '), false);
        $mform->setDefault('configdata[cfgdefault]', 0);
    }
    
    /**
     * Validate the data on the field configuration form
     *
     * @param array $data from the add/edit profile field form
     * @param array $files
     * @return array associative array of error messages
     */
    public function config_form_validation(array $data, $files = array()) : array {
        $errors = parent::config_form_validation($data, $files);
        
        if ($data['configdata']['uniquevalues']) {
            $errors['configdata[uniquevalues]'] = get_string('nouniqueallowed', 'customfield_radio');
        }
        
        return $errors;
    }
    
}
