<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-2-2010 12:55
 */

if (!defined('NV_IS_FILE_THEMES')) {
    die('Stop!!!');
}

$page_title = $nv_Lang->getModule('package_theme_module');

$tpl = new \NukeViet\Template\Smarty();
$tpl->setTemplateDir(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$tpl->assign('LANG', $nv_Lang);
$tpl->assign('FORM_ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op);
$tpl->assign('NV_CHECK_SESSION', NV_CHECK_SESSION);

if ($nv_Request->isset_request('op', 'post')) {
    $contents = $nv_Lang->getModule('package_noselect_module_theme');
    $themename = $nv_Request->get_string('themename', 'post');

    if (preg_match($global_config['check_theme'], $themename) or preg_match($global_config['check_theme_mobile'], $themename)) {
        $allowfolder = [];
        $modulearray = [];
        $all_module_file = $nv_Request->get_title('module_file', 'post');
        $module_file_array = explode(',', $all_module_file);
        array_unique($module_file_array);
        foreach ($module_file_array as $_module_file) {
            $_module_file = nv_unhtmlspecialchars($_module_file);
            if (preg_match($global_config['check_module'], $_module_file)) {
                $modulearray[] = $_module_file;
                $allowfolder[] = NV_ROOTDIR . '/themes/' . $themename . '/modules/' . $_module_file . '/';

                if (file_exists(NV_ROOTDIR . '/themes/' . $themename . '/css/' . $_module_file . '.css')) {
                    $allowfolder[] = NV_ROOTDIR . '/themes/' . $themename . '/css/' . $_module_file . '.css';
                }

                $_files = glob(NV_ROOTDIR . '/themes/' . $themename . '/js/' . $_module_file . '*.js');
                foreach ($_files as $_file) {
                    $allowfolder[] = $_file;
                }

                if (file_exists(NV_ROOTDIR . '/themes/' . $themename . '/images/' . $_module_file . '/')) {
                    $allowfolder[] = NV_ROOTDIR . '/themes/' . $themename . '/images/' . $_module_file . '/';
                }
            }
        }
        if (!empty($allowfolder)) {
            $all_module_file = implode('_', $modulearray);
            $file_src = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . NV_TEMPNAM_PREFIX . 'theme_' . $themename . '_' . $all_module_file . '_' . md5(nv_genpass(10) . NV_CHECK_SESSION) . '.zip';

            $zip = new PclZip($file_src);
            $zip->create($allowfolder, PCLZIP_OPT_REMOVE_PATH, NV_ROOTDIR . '/themes');

            $filesize = filesize($file_src);
            $file_name = basename($file_src);

            nv_insert_logs(NV_LANG_DATA, $module_name, $nv_Lang->getModule('package_theme_module'), 'file name : ' . $themename . '_' . $all_module_file . '.zip', $admin_info['userid']);

            $linkgetfile = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=getfile&amp;mod=nv4_theme_' . $themename . '_' . $all_module_file . '.zip&amp;checkss=' . md5($file_name . NV_CHECK_SESSION) . '&amp;filename=' . $file_name;

            $tpl->assign('LINKGETFILE', $linkgetfile);
            $tpl->assign('THEMENAME', $themename);
            $tpl->assign('MODULENAME', nv_strtolower($all_module_file));
            $tpl->assign('FILESIZE', nv_convertfromBytes($filesize));

            $contents = $tpl->fetch('package_theme_module_complete.tpl');
        }
    }
    include NV_ROOTDIR . '/includes/header.php';
    echo $contents;
    include NV_ROOTDIR . '/includes/footer.php';
}

$theme_list = nv_scandir(NV_ROOTDIR . '/themes', [
    $global_config['check_theme'],
    $global_config['check_theme_mobile']
]);
$theme_list_pack = [];
foreach ($theme_list as $themes_i) {
    if (file_exists(NV_ROOTDIR . '/themes/' . $themes_i . '/config.ini')) {
        $theme_list_pack[] = $themes_i;
    }
}

$tpl->assign('THEME_LIST', $theme_list_pack);

$result = $db->query('SELECT title, module_file, custom_title FROM ' . NV_MODULES_TABLE . ' ORDER BY weight ASC');
$array_module_seup = [];
$array_module = [];
while ($row = $result->fetch()) {
    if ($row['module_file'] == $row['module_file']) {
        $array_module[] = [
            'module_file' => $row['module_file'],
            'custom_title' => $row['custom_title']
        ];
        $array_module_seup[] = $row['module_file'];
    }
}
$modules_list = nv_scandir(NV_ROOTDIR . '/modules', $global_config['check_module']);

$tpl->assign('ARRAY_MODULE', $array_module);
$tpl->assign('MODULES_LIST', $modules_list);
$tpl->assign('ARRAY_MODULE_SEUP', $array_module_seup);

$contents = $tpl->fetch('package_theme_module.tpl');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
