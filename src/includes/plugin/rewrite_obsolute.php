<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 07 Mar 2015 03:43:56 GMT
 */

if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

nv_add_hook($module_name, 'get_rewrite_domain', $priority, function() {
    return NV_MY_DOMAIN;
});
