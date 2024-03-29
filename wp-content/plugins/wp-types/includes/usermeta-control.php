<?php
/*
 * Custom Fields Control Screen
 *
 * $HeadURL: https://www.onthegosystems.com/misc_svn/cck/tags/1.6.4/includes/usermeta-control.php $
 * $LastChangedDate: 2014-06-26 10:57:18 +0000 (Thu, 26 Jun 2014) $
 * $LastChangedRevision: 24376 $
 * $LastChangedBy: marcin $
 *
 */
/**
 * Table class.
 */
class WPCF_User_Fields_Control_Table extends WP_List_Table
{

    function prepare_items() {
        global $wpdb;
        $wpcf_per_page = 15;

        // Get ours and enabled
        $cf_types = wpcf_admin_fields_get_fields( true, true, false, 'wpcf-usermeta' );
        $__groups = wpcf_admin_fields_get_groups( 'wp-types-user-group' );
        foreach ( $__groups as $__group_id => $__group ) {
            $__groups[$__group_id]['fields'] = wpcf_admin_fields_get_fields_by_group( $__group['id'], 'slug', false, true, false, 'wp-types-user-group', 'wpcf-usermeta' );
        }

        foreach ( $cf_types as $cf_id => $cf ) {
            foreach ( $__groups as $__group ) {
                if ( isset( $__group['fields'][$cf_id] ) ) {
                    $cf_types[$cf_id]['groups'][$__group['id']] = $__group['name'];
                }
            }
            $cf_types[$cf_id]['groups_txt'] = empty( $cf_types[$cf_id]['groups'] ) ? __( 'None', 'wpcf' ) : implode(', ', $cf_types[$cf_id]['groups'] );
        }

        // Get others (cache this result?)
        $cf_other = $wpdb->get_results("
        SELECT umeta_id, meta_key
        FROM $wpdb->usermeta
        GROUP BY meta_key
        HAVING meta_key NOT LIKE '\_%'
        ORDER BY meta_key");

        $output = '';

        // Clean from ours
        foreach ($cf_other as $type_id => $type_data) {
            if (strpos($type_data->meta_key, WPCF_META_PREFIX) !== false) {
                $field_temp = wpcf_admin_fields_get_field(str_replace(WPCF_META_PREFIX,
                                '', $type_data->meta_key), false, false, 'wpcf-usermeta');
                if (!empty($field_temp)) {
                    if (!empty($field_temp['data']['disabled'])) {
                        $cf_types[$field_temp['id']] = array(
                            'id' => $field_temp['id'],
                            'slug' => $type_data->meta_key,
                            'name' => $type_data->meta_key,
                            'type' => 0,
                            'groups_txt' => __('None', 'wpcf'),
                        );
                    } else {
                        unset($cf_other[$type_id]);
                    }
                } else if (wpcf_types_cf_under_control('check_exists',
                                $type_data->meta_key, 'wp-types-user-group', 'wpcf-usermeta')) {
                    unset($cf_other[$type_id]);
                } else {
                    $cf_types[$type_data->meta_key] = array(
                        'id' => $type_data->meta_key,
                        'slug' => $type_data->meta_key,
                        'name' => $type_data->meta_key,
                        'type' => 0,
                        'groups_txt' => __('None', 'wpcf'),
                    );
                }
            } else {
                if (wpcf_types_cf_under_control('check_exists',
                                $type_data->meta_key, 'wp-types-user-group', 'wpcf-usermeta')) {
                    unset($cf_other[$type_id]);
                } else {
                    $cf_types[$type_data->meta_key] = array(
                        'id' => $type_data->meta_key,
                        'slug' => $type_data->meta_key,
                        'name' => $type_data->meta_key,
                        'type' => 0,
                        'groups_txt' => __('None', 'wpcf'),
                    );
                }
            }
        }

        // Set some values
        foreach ($cf_types as $cf_id_temp => $cf_temp) {
            if (empty($cf_temp['type']) || !empty($cf_temp['data']['controlled'])) {
                $cf_types[$cf_id_temp]['slug'] = $cf_temp['name'];
            } else {
                $cf_types[$cf_id_temp]['slug'] = wpcf_types_get_meta_prefix($cf_temp) . $cf_temp['slug'];
            }
        }

        // Order
        if (!empty($_REQUEST['orderby'])) {
            $sort_matches = array(
                'c' => 'name',
                'g' => 'groups_txt',
                't' => 'slug',
                'f' => 'type'
            );
            $sorted_keys = array();
            $new_array = array();
            foreach ($cf_types as $cf_id_temp => $cf_temp) {
                $sorted_keys[$cf_temp['id']] = strtolower( $cf_temp[$sort_matches[$_REQUEST['orderby']]] );
            }
            asort($sorted_keys, SORT_STRING);
            if ($_REQUEST['order'] == 'desc') {
                $sorted_keys = array_reverse($sorted_keys, true);
            }
            foreach ($sorted_keys as $cf_id_temp => $groups_txt) {
                $new_array[$cf_id_temp] = $cf_types[$cf_id_temp];
            }
            $cf_types = $new_array;
        }

        // Search
        if (!empty($_REQUEST['s'])) {
            $search_results = array();
            foreach ($cf_types as $search_id => $search_field) {
                if (strpos(strval($search_field['name']),
                                strval(trim(stripslashes($_REQUEST['s'])))) !== false) {
                    $search_results[$search_id] = $cf_types[$search_id];
                }
            }
            $cf_types = $search_results;
        }

        if (empty($_GET['display_all'])) {

            $total_items = count($cf_types);

            if ($total_items < $wpcf_per_page) {
                $wpcf_per_page = $total_items;
            }
            if ($this->get_pagenum() == 1) {
                $offset = 0;
            } else {
                $offset = ($this->get_pagenum() - 1) * $wpcf_per_page;
            }
            // Display required number of entries on page
            $this->items = array_slice($cf_types, $offset, $wpcf_per_page);

            $this->set_pagination_args(array(
                'total_items' => $total_items,
                'per_page' => $wpcf_per_page,
            ));
        } else {
            $this->items = $cf_types;
        }

        $this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );
    }

    function has_items() {
        return !empty($this->items);
    }

    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'cf_name' => __('User Field Name', 'wpcf'),
            'group' => __('Group', 'wpcf'),
            'types_name' => __('Types Name', 'wpcf'),
            'field_type' => __('Type', 'wpcf'),
        );
        return $columns;
    }

    function get_sortable_columns() {
        return array(
            'cf_name' => 'cf_name',
            'group' => 'group',
            'types_name' => 'types_name',
            'field_type' => 'field_type',
        );
    }

    function column_cb($item) {
        if (!wpcf_types_cf_under_control('check_exists', $item['id'], 'wp-types-user-group', 'wpcf-usermeta')) {
            $item['id'] = $item['id'] . '_' . md5('wpcf_not_controlled');
        }
        return '<input type="checkbox" name="fields[]" value="' . $item['id'] . '" />';
    }

    function column_cf_name($item) {
        return stripcslashes($item['name']);
    }

    function column_group($item) {
        return empty( $item['groups'] ) ? __( 'None', 'wpcf' ) : implode(', ', $item['groups'] );
    }

    function column_types_name($item) {
        return $item['slug'];
    }

    function column_field_type($item) {
        if (empty($item['type'])) {
            return __('Not under Types control', 'wpcf');
        }
        $add = '';
        if (!empty($item['data']['disabled'])) {
            $add = '&nbsp;<span style="color:red;">(' . __("disabled", 'wpcf') . ')</span>';
        }
        if (!empty($item['data']['disabled_by_type'])) {
            $add = '<br /><span style="color:red;">(' . __("This field was disabled during conversion. You need to set some further settings in the group editor.",
                            'wpcf') . ')</span>';
            if (isset($item['groups']) && sizeof($item['groups'])) {
                $add .= ' <a href="' . admin_url('admin.php?page=wpcf-edit-usermeta&group_id='
                        . key( $item['groups'] ) ) . '">' . __('Edit', 'wpcf') . '</a>';
            }
        }
        return $item['type'] . $add;
    }

    function get_bulk_actions() {
        $actions = array();
        $output = array();
        $actions['wpcf-add-to-group-bulk'] = __('Add to group', 'wpcf');
        $actions['wpcf-remove-from-group-bulk'] = __('Remove from group', 'wpcf');
        $actions['wpcf-change-type-bulk'] = __('Change type', 'wpcf');
        $actions['wpcf-activate-bulk'] = __("Add to Types control", 'wpcf');
        $actions['wpcf-deactivate-bulk'] = __("Stop controlling with Types", 'wpcf');
        $actions['wpcf-delete-bulk'] = __("Delete", 'wpcf');
        return $actions;
    }

    function view_switcher($current_mode = '') {
        echo '<div style="clear:both; margin: 20px 0 10px 0; float: right;"><a class="button button-secondary" href="';
        if (empty($_GET['display_all'])) {
            echo esc_url($_SERVER['REQUEST_URI']) . '&amp;display_all=1">' . __('Display all items', 'wpcf');
        } else {
            echo esc_url($_SERVER['REQUEST_URI']) . '&amp;display_all=0">' . __('Show pagination', 'wpcf');
        }
        echo '</a></div>';
    }

}


/**
 * Submitted Bulk actions.
 */
function wpcf_admin_user_fields_control_bulk_actions($action = '') {

    if ($action == 'wpcf-deactivate-bulk') {

        $fields = wpcf_admin_fields_get_fields(false, true, false, 'wpcf-usermeta');
        foreach ($_POST['fields'] as $field_id) {
            if (isset($fields[$field_id])) {
                $fields[$field_id]['data']['disabled'] = 1;
                wpcf_admin_message_store(sprintf(__('Removed from Types control: %s',
                                        'wpcf'), $fields[$field_id]['name']));
            }
        }
        wpcf_admin_fields_save_fields($fields, false, 'wpcf-usermeta');
    } else if ($action == 'wpcf-activate-bulk') {

        $fields = wpcf_admin_fields_get_fields(false, true, false, 'wpcf-usermeta');
        $fields_bulk = wpcf_types_cf_under_control('add',
                array('fields' => $_POST['fields']), 'wp-types-user-group', 'wpcf-usermeta');
        foreach ($fields_bulk as $field_id) {
            if (isset($fields[$field_id])) {
                $fields[$field_id]['data']['disabled'] = 0;
            }
            wpcf_admin_message_store(sprintf(__('Added to Types control: %s',
                                    'wpcf'), $field_id));
        }
        wpcf_admin_fields_save_fields($fields, false, 'wpcf-usermeta');
    } else if ($action == 'wpcf-delete-bulk') {
        require_once WPCF_INC_ABSPATH . '/fields.php';
        $failed = array();
        $success = array();
        foreach ($_POST['fields'] as $field_id) {
            $response = wpcf_admin_fields_delete_field($field_id, 'wp-types-user-group', 'wpcf-usermeta');
            if (!$response) {
                $failed[] = str_replace('_' . md5('wpcf_not_controlled'), '',
                        $field_id);
            } else {
                $success[] = $field_id;
            }
        }
        if (!empty($success)) {
            wpcf_admin_message_store(sprintf(__('Fields %s have been deleted.',
                                    'wpcf'), implode(', ', $success)));
        }
        if (!empty($failed)) {
            wpcf_admin_message_store(sprintf(__('Fields %s are not Types fields. Types wont delete these fields.',
                                    'wpcf'), implode(', ', $failed)));
        }
    }
    wp_redirect($_SERVER['REQUEST_URI']);
    die();
}

/**
 * JS.
 */
function wpcf_admin_user_fields_control_js() {

    ?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#wpcf-custom-fields-control-form #doaction, #wpcf-custom-fields-control-form #doaction2').click(function(){
                return wpcfAdminCustomFieldsControlSubmit(jQuery(this).prev());
            });
        });

        function wpcfAdminCustomFieldsControlSubmit(action_field) {
            var action = action_field.val();
            var open_popup = false;
            if (action == 'wpcf-add-to-group-bulk') {
                open_popup = true;
            } else if (action == 'wpcf-remove-from-group-bulk') {
                open_popup = true;
            } else if (action == 'wpcf-change-type-bulk') {
                open_popup = true;
            }
            if (open_popup == true) {
                var data = jQuery('#wpcf-custom-fields-control-form').serialize();
                var url = "<?php echo admin_url('admin-ajax.php'); ?>?"+data+"&action=wpcf_ajax&wpcf_action=user_fields_control_bulk&wpcf_bulk_action="+action+"&keepThis=true&TB_iframe=true&width=400&height=400";
                var title = jQuery('select[name="'+action_field.attr('name')+'"] option:checked').text();
                tb_show(title, url);
                return false;
            }
            if (action == 'wpcf-delete-bulk') {
                var answer = confirm('<?php
    _e('Deleting fields will remove fields from groups and delete post meta. Continue?',
            'wpcf')

    ?>');
                if (answer){
                    jQuery('#wpcf-custom-fields-control-form').submit();
                } else{
                    return false;
                }
            }
            return true;
        }
    </script>
    <?php
}

/**
 * AJAX call from Bulk actions.
 */
function wpcf_admin_user_fields_control_bulk_ajax() {
    if (empty($_REQUEST['fields'])) {
        die(__('Please select fields', 'wpcf'));
    }
    if (!empty($_POST)) {
        if (!empty($_POST['groups']) && !empty($_POST['fields'])) {
            $action = isset($_POST['wpcf_action_control']) ? $_POST['wpcf_action_control'] : 'wpcf-add-to-group-bulk';
            foreach ($_POST['groups'] as $group_id) {
                switch ($action) {
                    case 'wpcf-add-to-group-bulk':
                        wpcf_admin_fields_save_group_fields($group_id,
                                array_values((array) $_POST['fields']), true, 'wp-types-user-group');
                        break;

                    case 'wpcf-remove-from-group-bulk':
                        wpcf_admin_fields_remove_field_from_group_bulk($group_id,
                                array_values((array) $_POST['fields']));
                        break;

                    default:
                        break;
                }
            }
        } else if (!empty($_POST['type']) && !empty($_POST['fields'])) {
            wpcf_admin_custom_fields_change_type($_POST['fields'],
                    $_POST['type'], 'wp-types-user-group', 'wpcf-usermeta');
        }
        echo '<script type="text/javascript">
            window.parent.jQuery("#TB_closeWindowButton").click();
            window.parent.location.href=window.parent.location.href;
</script>';
        die();
    }
    $groups = wpcf_admin_fields_get_groups('wp-types-user-group');

    $output = array();
    if (in_array($_GET['wpcf_bulk_action'],
                    array('wpcf-add-to-group-bulk', 'wpcf-remove-from-group-bulk'))) {

        foreach ($groups as $group_id => $group) {
            $output[$group['id']] = array(
                '#type' => 'checkbox',
                '#name' => 'groups[]',
                '#title' => $group['name'],
                '#value' => $group['id'],
                '#default_value' => false,
                '#inline' => true,
            );
        }

    } else if ($_GET['wpcf_bulk_action'] == 'wpcf-change-type-bulk') {
        $output['types'] = wpcf_admin_user_fields_control_change_type_dropdown();
    } else {
        die('Not valid action');
    }

    foreach ($_GET['fields'] as $field_id) {
        $output[$field_id] = array(
            '#type' => 'hidden',
            '#name' => 'fields[]',
            '#value' => $field_id,
        );
    }
    $output['submit'] = array(
        '#type' => 'submit',
        '#name' => 'submit',
        '#value' => __('Save Changes'),
        '#attributes' => array('class' => 'button-primary'),
    );
    echo '<form method="post" action="">';
    echo wpcf_form_simple($output);
    wp_nonce_field('user_fields_control_bulk');
    echo '<input type="hidden" name="action" value="wpcf_ajax" />';
    echo '<input type="hidden" name="wpcf_action" value="user_fields_control_bulk" />';
    echo '<input type="hidden" name="wpcf_action_control" value="' . esc_attr($_GET['wpcf_bulk_action']) . '" />';
    echo '</form>';
}

/**
 * Change type dropdown.
 *
 * @return array Form array
 */
function wpcf_admin_user_fields_control_change_type_dropdown() {
    $options = array();
    $types = wpcf_admin_fields_get_available_types();
    foreach ($types as $type => $type_data) {
        $options[$type_data['title']] = $type;
    }
    return array(
        '#type' => 'radios',
        '#name' => 'type',
        '#options' => $options,
        '#default_value' => 'none',
        '#inline' => true,
    );
}
