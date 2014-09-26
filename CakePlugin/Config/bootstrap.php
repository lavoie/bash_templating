<?php

// Adding plugin view path to global view paths. For AssetCompress to work.
App::build(array(
    'View' => CakePlugin::path('_PluginNameHere_') . 'View'
) , App::APPEND);
