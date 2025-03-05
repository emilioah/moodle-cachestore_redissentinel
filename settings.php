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
 * Redis Cache Store - Settings
 *
 * @package   cachestore_redissentinel
 * @copyright 2013 Adam Durana
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(
    new admin_setting_configcheckbox(
        name: 'cachestore_redissentinel/test_clustermode',
        visiblename: get_string('clustermode', 'cachestore_redissentinel'),
        description: cache_helper::is_cluster_available() ?
            get_string('clustermode_help', 'cachestore_redissentinel') :
            get_string('clustermodeunavailable', 'cachestore_redissentinel'),
        defaultsetting: 0,
    )
);

$settings->add(
    new admin_setting_configcheckbox(
        name: 'cachestore_redissentinel/test_sentinelmode',
        visiblename: get_string('sentinelmode', 'cachestore_redissentinel'),
        description: get_string('sentinelmode_desc', 'cachestore_redissentinel'),
        defaultsetting: 0,
    )
);

$settings->add(
    new admin_setting_configtextarea(
        name: 'cachestore_redissentinel/test_server',
        visiblename: get_string('test_server', 'cachestore_redissentinel'),
        description: get_string('test_server_desc', 'cachestore_redissentinel'),
        defaultsetting: '',
        paramtype: PARAM_TEXT,
    )
);

$settings->add(new admin_setting_configcheckbox(
        'cachestore_redis/test_encryption',
        get_string('encrypt_connection', 'cachestore_redissentinel'),
        get_string('encrypt_connection', 'cachestore_redissentinel'),
        false));
$settings->add(
    new admin_setting_configtext(
        'cachestore_redissentinel/test_cafile',
        get_string('ca_file', 'cachestore_redissentinel'),
        get_string('ca_file', 'cachestore_redissentinel'),
        '',
        PARAM_TEXT,
        16
    )
);
$settings->add(
    new admin_setting_configpasswordunmask(
        'cachestore_redissentinel/test_password',
        get_string('test_password', 'cachestore_redissentinel'),
        get_string('test_password_desc', 'cachestore_redissentinel'),
        ''
    )
);
$settings->add(
    new admin_setting_configtext(
        'cachestore_redissentinel/test_master_group',
        get_string('test_master_group', 'cachestore_redissentinel'),
        get_string('test_master_group_desc', 'cachestore_redissentinel'),
        '',
        PARAM_TEXT,
        16
    )
);


if (class_exists('Redis')) { // Only if Redis is available.

    $options = array(Redis::SERIALIZER_PHP => get_string('serializer_php', 'cachestore_redissentinel'));

    if (defined('Redis::SERIALIZER_IGBINARY')) {
        $options[Redis::SERIALIZER_IGBINARY] = get_string('serializer_igbinary', 'cachestore_redissentinel');
    }

    $settings->add(new admin_setting_configselect(
            'cachestore_redissentinel/test_serializer',
            get_string('test_serializer', 'cachestore_redissentinel'),
            get_string('test_serializer_desc', 'cachestore_redissentinel'),
            Redis::SERIALIZER_PHP,
            $options
        )
    );
}

$settings->add(new admin_setting_configcheckbox(
        'cachestore_redissentinel/test_ttl',
        get_string('test_ttl', 'cachestore_redissentinel'),
        get_string('test_ttl_desc', 'cachestore_redissentinel'),
        false));
