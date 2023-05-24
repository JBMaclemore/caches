<?php

namespace WPNC\CreateNFT\API;

use WP_REST_Response;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Provides endpoints to Save and Fetch settings for both frontend and backend
 */
class Settings
{
    private $namespace = "wpnc/settings";

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {
        register_rest_route($this->namespace, '/public/general-settings', array(
            'methods' => 'POST',
            'callback' => [$this, 'save_settings_general'],
            'permission_callback' => function ($request) {
                return current_user_can("administrator");
            },
        ));

        register_rest_route($this->namespace, '/public/contract-settings', array(
            'methods' => 'POST',
            'callback' => [$this, 'save_settings_contract'],
            'permission_callback' => function ($request) {
                return current_user_can("administrator");
            },
        ));

        register_rest_route($this->namespace, '/public/api-settings', array(
            'methods' => 'POST',
            'callback' => [$this, 'save_settings_api'],
            'permission_callback' => function ($request) {
                return current_user_can("administrator");
            },
        ));

        register_rest_route($this->namespace, '/public/api-settings', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_settings_api'],
            'permission_callback' => function ($request) {
                return current_user_can("administrator");
            },
        ));

        register_rest_route($this->namespace, '/public/general-settings', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_settings_general'],
            'permission_callback' => function ($request) {
                return current_user_can("administrator");
            },
        ));

        register_rest_route($this->namespace, '/public/contract-settings', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_settings_contract'],
            'permission_callback' => function ($request) {
                return current_user_can("administrator");
            },
        ));

        register_rest_route($this->namespace, '/public/all-settings', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_all_settings'],
            'permission_callback' => function ($request) {
                return true;
            },
        ));
    }

    /**
     * Retrieve Moralis API settings.
     * @return WP_REST_Response
     */
    public function get_settings_api(){
        return new WP_REST_Response(get_option("wpnc_api"));
    }

    /**
     * Saves Moralis API settings. (Admin)
     * @param $request
     * @return WP_REST_Response
     */
    public function save_settings_api($request){
        if($request->get_param("payload") === null) {
            return new WP_REST_Response([
                "success" => false
            ],401);
        }

        update_option("wpnc_api", $request->get_param("payload"));

        return new WP_REST_Response([
            "success" => true
        ]);
    }

    /**
     * Retrieves general settings.
     * @return WP_REST_Response
     */
    public function get_settings_general(){
        return new WP_REST_Response(get_option("wpnc"));
    }

    /**
     * Saves general settings. (Admin)
     * @param $request
     * @return WP_REST_Response
     */
    public function save_settings_general($request){
        if($request->get_param("payload") === null) {
            return new WP_REST_Response([
                "success" => false
            ],401);
        }

        update_option("wpnc", $request->get_param("payload"));

        return new WP_REST_Response([
            "success" => true
        ]);
    }

    /**
     * Retrieves contract settings.
     * @return WP_REST_Response
     */
    public function get_settings_contract(){
        return new WP_REST_Response(get_option("wpnc_contracts"));
    }

    /**
     * Saves contract settings. (Admin)
     * @param $request
     * @return WP_REST_Response
     */
    public function save_settings_contract($request){
        if($request->get_param("payload") === null) {
            return new WP_REST_Response([
                "success" => false
            ],401);
        }

        update_option("wpnc_contracts", $request->get_param("payload"));

        return new WP_REST_Response([
            "success" => true
        ]);
    }

    /**
     * Shortcut to retrieve all public settings in one request.
     * @param $request
     * @return WP_REST_Response
     */
    public function get_all_settings($request){

        $contracts =  get_option("wpnc_contracts");

        if(defined('NFT_MARKETPLACE_CORE_VERSION')) {
            $terms = get_terms( array(
                'taxonomy' => 'nft_listing_blockchains',
                'hide_empty' => false,
            ) );

            $newArray = [];

            foreach ($terms as $term) {
                $iArray = [];
                $iArray["name"] = $term->name;
                $iArray["networkid"] = hexdec(get_term_meta($term->term_id,"nft_marketplace_core_taxonomy_blockchain_currency_chainid")[0]);
                $newArray[] = $iArray;
            }

            $contracts["networks"] = $newArray;
        }
        $api = get_option("wpnc_api");
        $api["moralisApiKey"] = "";
        $api["appid"] = "";
        $api["server"] = "";

        return new WP_REST_Response([
            "contracts" =>$contracts,
            "api" => $api,
            "general" => get_option("wpnc"),
        ]);
    }
}
