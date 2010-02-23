<?php
/**
 * Locale
 */
    Configure::write('Config.language', 'eng');

/**
 * Admin theme
 */
    //Configure::write('Site.admin_theme', 'sample');

/**
 * Cache configuration
 */
    $cacheConfig = array(
        'duration' => '+1 hour',
        'path' => 'queries',
    );

    // models
    Cache::config('setting_write_configuration', $cacheConfig);

    // components
    Cache::config('croogo_blocks', $cacheConfig);
    Cache::config('croogo_menus', $cacheConfig);
    Cache::config('croogo_nodes', $cacheConfig);
    Cache::config('croogo_types', $cacheConfig);
    Cache::config('croogo_vocabularies', $cacheConfig);

    // themes (xml)
    Cache::config('theme_xml', $cacheConfig);

    // controllers
    Cache::config('nodes_view', $cacheConfig);
    Cache::config('nodes_promoted', $cacheConfig);
    Cache::config('nodes_term', $cacheConfig);
    Cache::config('nodes_index', $cacheConfig);
    Cache::config('contacts_view', $cacheConfig);
    
/**
 * Settings
 */
    require_once APP.'vendors'.DS.'spyc'.DS.'spyc.php';
    $settings = Spyc::YAMLLoad(file_get_contents(APP.'config'.DS.'settings.yml'));
    foreach ($settings AS $settingKey => $settingValue) {
        Configure::write($settingKey, $settingValue);
    }

/**
 * Plugins
 */
    $pluginBootstraps = Configure::read('Hook.bootstraps');
    if ($pluginBootstraps) {
        $plugins = explode(',', $pluginBootstraps);
        foreach ($plugins AS $plugin) {
            if (file_exists(APP.'plugins'.DS.$plugin.DS.'config'.DS.'bootstrap.php')) {
                require_once APP.'plugins'.DS.$plugin.DS.'config'.DS.'bootstrap.php';
            }
        }
    }
?>