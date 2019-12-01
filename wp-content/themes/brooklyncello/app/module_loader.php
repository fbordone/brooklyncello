<?php
/**
 * Defines a trait that can be used to call, store, and output module data
 *
 * IMPORTANT: you should not modify any trait properties, instead use the built-in methods
 */

namespace App\Controllers;

trait ModuleLoader {
    /**
     * List of all modules used on the site
     *
     * @var         {Array}         $modules        List of modules
     *   @param     {Array}         fields          all fields contained within the ACF module
     *   @param     {Number|String} post_id         Can define as 'options' (defaults to current post ID)
     *   @param     {Array}         extras          any additional, module-specific information that should be passed to the controller/view
     *
     * @see get_module()
     */
    private $modules = [
        'content' => [
            'fields' => ['content__img', 'content__pretitle', 'content__title', 'content__desc', 'content__flip'],
        ],
        'cta' => [
            'fields' => ['cta__editor', 'cta__button'],
        ],
        'featured' => [
            'fields' => ['featured__title', 'featured__recipes'],
        ],
        'hero' => [
            'fields' => ['hero__title', 'hero__title_size', 'hero__subtitle', 'hero__subtitle_size', 'hero__mobile_img', 'hero__desktop_img'],
        ],
    ];

    /**
     * Stores all the module data in a standardized format
     *
     * This is returned to the controller file and can be passed directly to the 'view' for output
     *
     * @var     {Array}     $module_data        output array
     *   @param {String}    id                  ID of the outermost HTML tag of the module
     *   @param {String}    classes             space-separated list of classes for the outermost HTML tag of the module
     *   @param {Array}     fields              associative array of field names and values
     *   @param {Array}     extras              associative array of any extra, module-specific information
     */
    private $module_data = [
        'id'        => '',
        'classes'   => '',
        'fields'    => [],
        'extras'    => [],
    ];

    /**
     * Gets all module data from the database, based on input fields
     *
     * This can be passed directly to the 'view' for output
     *
     * @var     {Array}         $_args              input arguments
     *   @param {String}        module              key of the module to call (checks if this key exists within `$modules` array)
     *   @param {Number|String} post_id             manual override to define a custom post ID or the 'options' page when instantiating module
     *   @param {String}        prefix              ACF prefix for this particular instance of the module (optionally can be suffixed with an underscore)
     *   @param {String}        id                  ID of the module container
     *   @param {String|Array}  classes             space-separated list of classes, or an array of class names for the module container
     *   @param {Array}         extras              associative array of any extra, module-specific information that will be passed into the 'view' file
     *
     * @see $modules
     */
    protected function get_module( $_args = [] ) {
        $_defaults = [
            'module'    => '',
            'post_id'   => '',
            'prefix'    => '',
            'id'        => '',
            'classes'   => '',
            'extras'    => [],
        ];
        // move all keys into symbol table
        extract( wp_parse_args($_args, $_defaults) );

        // check if module exists within the `$modules` array
        if ( !$module || !array_key_exists($module, $this->modules) )
            return false;

        // set module ID and classes
        $this->set_id($id);
        $this->set_classes($classes);

        // get relevant module from `$modules` array
        $module = $this->modules[$module];

        // set extras (if it exists)
        if ( array_key_exists('extras', $this->module_data) && is_array($extras) && !empty($extras) ){
            $this->module_data['extras'] = $extras;
        }
        // fallback to 'extras' defined in `$modules` array
        elseif ( array_key_exists('extras', $module) && is_array($module['extras']) && !empty($module['extras']) ) {
            $this->module_data['extras'] = $module['extras'];
        }
        else {
            $this->module_data['extras'] = [];
        }

        // makes sure prefix ends with an underscore (if it exists)
        if ( $prefix ){
            $prefix = substr($prefix, -1) == '_' ? $prefix : $prefix . '_';
        }

        // normalize post ID (based on whether it was passed into this function, or exists within `$modules` array)
        if ( $post_id ) {
            $post_id = $post_id;
        }
        elseif ( !$post_id && array_key_exists('post_id', $module) ) {
            $post_id = $module['post_id'];
        }
        else {
            $post_id = '';
        }

        // determine if post ID is a number or within 'options' table
        if ( strpos($post_id, 'option') !== false ) {
            $post_id = 'options';
        }
        elseif ( is_numeric($post_id) && (int) $post_id > 0 ) {
            $post_id = (int) $post_id;
        }
        else {
            $post_id = get_the_ID();
        }

        // get fields from DB (based on prefix and module information)
        $this->module_data['fields'] = [];
        foreach ( $module['fields'] as $key => $field ) :
            // this checks if the array is associative (by checking for string values in the key)
            if ( is_string($key) ) {
                $this->module_data['fields'][$key] = get_field("${prefix}${field}", $post_id);
            }
            // this assumes an index-based array, which then inputs the field name as the key value for output array
            else {
                $this->module_data['fields'][$field] = get_field("${prefix}${field}", $post_id);
            }
        endforeach;

        return $this->module_data;
    }

    /**
     * Sets ID of the module container
     *
     * @var {String} $_id       ID of the HTML tag
     * @see $module_data
     */
    private function set_id($_id = ''){
        if ( !array_key_exists('id', $this->module_data) || !$_id ){
            $this->module_data['id'] = '';
            return false;
        }

        // set ID
        $this->module_data['id'] = esc_attr($_id);
        return true;
    }

    /**
     * Sets classes for the module container
     *
     * @var {String|Array} $_classes    space-separated list of classes, or an array of class names
     * @see $module_data
     */
    private function set_classes($_classes = ''){
        if ( !array_key_exists('classes', $this->module_data) ){
            $this->module_data['classes'] = '';
            return false;
        }

        // filter input data to create a space-separated string of classnames
        if ( is_array($_classes) && !empty($_classes) ) {
            $_classes = implode(' ', $_classes );
        }
        elseif ( is_string($_classes) && !empty($_classes) ) {
            $_classes = '' . $_classes;
        }
        else {
            $_classes = '';
        }

        // store class names
        $this->module_data['classes'] = esc_attr($_classes);
        return true;
    }
}
