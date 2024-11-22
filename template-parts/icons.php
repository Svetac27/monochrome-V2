<?php
if (isset($args['icon']) && !empty($args['icon'])) {
    $icon = file_get_contents(get_template_directory() . '/assets/icons/' . $args['icon'] . '.svg');
    if (isset($args['class']) && !empty($args['class'])) {
        $icon = str_replace('<svg ', '<svg class="'.$args['class'].'"', $icon);
    }
    echo $icon;
}