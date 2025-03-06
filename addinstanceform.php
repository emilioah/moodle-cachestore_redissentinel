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
 * Form for adding instance of Redis Cache Store.
 *
 * @copyright   2013 Adam Durana
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class cachestore_redissentinel_addinstance_form extends cachestore_addinstance_form {
    /**
     * Builds the form for creating an instance.
     */
    protected function configuration_definition() {
        $form = $this->_form;

        $haoptions = cachestore_redissentinel::config_get_ha_options();
        $form->addElement('select', 'ha', get_string('ha', 'cachestore_redissentinel'), $haoptions);
        $form->addHelpButton('ha', 'ha', 'cachestore_redissentinel');
        $form->setDefault('ha', cachestore_redissentinel::HA_NONE);
        $form->setType('ha', PARAM_INT);

        $form->addElement('textarea', 'server', get_string('server', 'cachestore_redissentinel'), ['cols' => 6, 'rows' => 10]);
        $form->setType('server', PARAM_TEXT);
        $form->addHelpButton('server', 'server', 'cachestore_redissentinel');
        $form->addRule('server', get_string('required'), 'required');

        $form->addElement('text', 'master_group', get_string('master_group', 'cachestore_redissentinel'), array('size' => 24));
        $form->setType('master_group', PARAM_TEXT);
        $form->addRule('master_group', get_string('required'), 'required');
        $form->setDefault('master_group', 'mymaster');

        $form->addElement('advcheckbox', 'encryption', get_string('encrypt_connection', 'cachestore_redissentinel'));
        $form->setType('encryption', PARAM_BOOL);
        $form->addHelpButton('encryption', 'encrypt_connection', 'cachestore_redissentinel');

        $form->addElement('text', 'cafile', get_string('ca_file', 'cachestore_redissentinel'));
        $form->setType('cafile', PARAM_TEXT);
        $form->addHelpButton('cafile', 'ca_file', 'cachestore_redissentinel');



        $form->addElement('passwordunmask', 'password', get_string('password', 'cachestore_redissentinel'));
        $form->setType('password', PARAM_RAW);
        $form->addHelpButton('password', 'password', 'cachestore_redissentinel');

        $form->addElement('text', 'prefix', get_string('prefix', 'cachestore_redissentinel'), array('size' => 16));
        $form->setType('prefix', PARAM_TEXT); // We set to text but we have a rule to limit to alphanumext.
        $form->addHelpButton('prefix', 'prefix', 'cachestore_redissentinel');
        $form->addRule('prefix', get_string('prefixinvalid', 'cachestore_redissentinel'), 'regex', '#^[a-zA-Z0-9\-_]+$#');

        $serializeroptions = cachestore_redissentinel::config_get_serializer_options();
        $form->addElement('select', 'serializer', get_string('useserializer', 'cachestore_redissentinel'), $serializeroptions);
        $form->addHelpButton('serializer', 'useserializer', 'cachestore_redissentinel');
        $form->setDefault('serializer', Redis::SERIALIZER_PHP);
        $form->setType('serializer', PARAM_INT);

        $compressoroptions = cachestore_redissentinel::config_get_compressor_options();
        $form->addElement('select', 'compressor', get_string('usecompressor', 'cachestore_redissentinel'), $compressoroptions);
        $form->addHelpButton('compressor', 'usecompressor', 'cachestore_redissentinel');
        $form->setDefault('compressor', cachestore_redissentinel::COMPRESSOR_NONE);
        $form->setType('compressor', PARAM_INT);

        $form->addElement('text', 'connectiontimeout', get_string('connectiontimeout', 'cachestore_redissentinel'));
        $form->addHelpButton('connectiontimeout', 'connectiontimeout', 'cachestore_redissentinel');
        $form->setDefault('connectiontimeout', cachestore_redissentinel::CONNECTION_TIMEOUT);
        $form->setType('connectiontimeout', PARAM_INT);
    }
}
