<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class CityFieldsServiceProvider extends SageServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        add_action('commune_add_form_fields', [$this, 'addCityFields']);
        add_action('commune_edit_form_fields', [$this, 'editCityFields']);
        add_action('created_commune', [$this, 'saveCityFields']);
        add_action('edited_commune', [$this, 'saveCityFields']);
        add_filter('manage_edit-commune_columns', [$this, 'addCustomColumns']);
        add_filter('manage_commune_custom_column', [$this, 'fillCustomColumns'], 10, 3);
    }

    public function addCityFields()
    {
        ?>
        <div class="form-field term-group">
            <label for="address"><?php _e('Adresse', 'labeps-theme'); ?></label>
            <input type="text" id="address" name="address" value="">
        </div>
        <div class="form-field term-group">
            <label for="latitude"><?php _e('Latitude', 'labeps-theme'); ?></label>
            <input type="text" id="latitude" name="latitude" value="">
        </div>
        <div class="form-field term-group">
            <label for="longitude"><?php _e('Longitude', 'labeps-theme'); ?></label>
            <input type="text" id="longitude" name="longitude" value="">
        </div>
        <?php
    }

    public function editCityFields($term)
    {
        $address = get_term_meta($term->term_id, 'address', true);
        $latitude = get_term_meta($term->term_id, 'latitude', true);
        $longitude = get_term_meta($term->term_id, 'longitude', true);
        ?>
        <tr class="form-field term-group-wrap">
            <th scope="row"><label for="address"><?php _e('Adresse', 'labeps-theme'); ?></label></th>
            <td>
                <input type="text" id="address" name="address" value="<?php echo esc_attr($address); ?>">
            </td>
        </tr>
        <tr class="form-field term-group-wrap">
            <th scope="row"><label for="latitude"><?php _e('Latitude', 'labeps-theme'); ?></label></th>
            <td>
                <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr($latitude); ?>">
            </td>
        </tr>
        <tr class="form-field term-group-wrap">
            <th scope="row"><label for="longitude"><?php _e('Longitude', 'labeps-theme'); ?></label></th>
            <td>
                <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr($longitude); ?>">
            </td>
        </tr>
        <?php
    }

    public function saveCityFields($term_id)
    {
        if (isset($_POST['latitude'])) {
            update_term_meta($term_id, 'latitude', sanitize_text_field($_POST['latitude']));
        }
        if (isset($_POST['longitude'])) {
            update_term_meta($term_id, 'longitude', sanitize_text_field($_POST['longitude']));
        }
        if (isset($_POST['address'])) {
            update_term_meta($term_id, 'address', sanitize_text_field($_POST['address']));
        }
    }

    public function addCustomColumns($columns)
    {
        // Remove the description column.
        unset($columns['description']);

        // Add custom columns.
        $new_columns = [];
        $new_columns['cb'] = $columns['cb'];
        $new_columns['name'] = $columns['name'];
        $new_columns['latitude'] = __('Latitude', 'labeps-theme');
        $new_columns['longitude'] = __('Longitude', 'labeps-theme');
        $new_columns['address'] = __('Adresse', 'labeps-theme');
        $new_columns['slug'] = $columns['slug'];
        $new_columns['posts'] = $columns['posts'];

        return $new_columns;
    }

    public function fillCustomColumns($content, $column_name, $term_id)
    {
        $term_meta = get_term_meta($term_id);

        switch ($column_name) {
            case 'latitude':
                $content = isset($term_meta['latitude'][0]) ? esc_attr($term_meta['latitude'][0]) : '';
                break;
            case 'longitude':
                $content = isset($term_meta['longitude'][0]) ? esc_attr($term_meta['longitude'][0]) : '';
                break;
            case 'address':
                $content = isset($term_meta['address'][0]) ? esc_attr($term_meta['address'][0]) : '';
                break;
            default:
                break;
        }

        return $content;
    }
}