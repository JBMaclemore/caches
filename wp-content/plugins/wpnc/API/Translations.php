<?php

namespace WPNC\CreateNFT\API;

use WP_REST_Response;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Provides translations for frontend.
 */
class Translations
{
    private $namespace = "wpnc/translations";

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    /**
     * Register all routes for this namespace.
     * @return void
     */
    public function registerRoutes()
    {
        register_rest_route($this->namespace, '/admin', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_admin_translations'],
            'permission_callback' => function ($request) {
                return current_user_can("administrator");
            },
        ));

        register_rest_route($this->namespace, '/public', array(
            'methods' => 'GET',
            'callback' => [$this, 'get_public_translations'],
            'permission_callback' => function ($request) {
                return true;
            },
        ));
    }

    /**
     * Translations for the admin panel.
     * @return WP_REST_Response
     */
    public function get_admin_translations()
    {
        return new WP_REST_Response([
            "tab_general" => esc_html__("General Settings", "wpnc"),
            "tab_api" => esc_html__("API Settings", "wpnc"),
            "tab_contract" => esc_html__("Contract Settings", "wpnc"),
            "button_save" => esc_html__("Save", "wpnc"),
            "tab_general_restrict" => esc_html__("Restrict only to users connected to metamask", "wpnc"),
            "tab_general_restrict_desc" => esc_html__("You need to purchase the metamask authentication module to use this setting.", "wpnc"),
            "tab_api_local" => esc_html__("Local Upload", "wpnc"),
            "tab_api_moralis_url" => esc_html__("Moralis Server URL", "wpnc"),
            "tab_api_moralis_id" => esc_html__("Moralis AppID", "wpnc"),
            "tab_contract_compiled" => esc_html__("Compiled NFT Contract", "wpnc"),
            "tab_contract_networks_title" => esc_html__("Networks", "wpnc"),
            "tab_contract_deploy_only" => esc_html__("Restrict to only these networks", "wpnc"),
            "tab_contract_deploy_only_button" => esc_html__("Add New Network", "wpnc"),
            "tab_contract_deploy_only_network" => esc_html__("Network", "wpnc"),
            "tab_contract_deploy_only_name" => esc_html__("Name", "wpnc"),
            "tab_contract_deploy_only_network_id" => esc_html__("Network ID", "wpnc"),
            "tab_contract_deploy_only_button_delete" => esc_html__("Delete", "wpnc"),
            "response_success" => esc_html__("Settings saved successfully!", "wpnc"),
        ]);
    }

    /**
     * Translations for frontend.
     * @return WP_REST_Response
     */
    public function get_public_translations()
    {
        $max_upload = min(ini_get('post_max_size'), ini_get('upload_max_filesize'));

        return new WP_REST_Response([
            "form_asset" => esc_html__("Upload File", "wpnc"),
            "form_asset_type_tooltip" => esc_html__("Upload a locally stored asset or provide a link containing the desired asset", "wpnc"),
            "form_asset_link" => esc_html__("Upload Link", "wpnc"),
            "form_asset_link_placeholder" => esc_html__("e.g. cdns-images.dzcdn.net/images/cover/f367/264x264.jpg", "wpnc"),
            "form_contract" => esc_html__("Contract", "wpnc"),
            "form_contract_placeholder" => esc_html__("Select a contract", "wpnc"),
            "form_asset_name" => esc_html__("Asset Name", "wpnc"),
            "form_asset_name_placeholder" => esc_html__("e.g. Redeemable T_Shirt with logo", "wpnc"),
            "form_asset_desc" => esc_html__("Asset Description", "wpnc"),
            "form_asset_desc_placeholder" => esc_html__("e.g. After purchasing, you will be able to get the real T_Shirt", "wpnc"),
            "form_marketplace" => esc_html__("Put on marketplace", "wpnc"),
            "form_marketplace_contract" => esc_html__("Marketplace contract", "wpnc"),
            "form_marketplace_contract_badge" => esc_html__("Connected", "wpnc"),
            "form_marketplace_missing_contract" => esc_html__("No matching contract found", "wpnc"),
            "form_marketplace_missing_contract_badge" => esc_html__("Disconnected", "wpnc"),
            "form_marketplace_price" => esc_html__("Price", "wpnc"),
            "form_marketplace_price_placeholder" => esc_html__("Enter price for one piece", "wpnc"),
            "form_marketplace_service_fee" => esc_html__("Service fee", "wpnc"),
            "form_marketplace_receiving" => esc_html__("You will receive", "wpnc"),
            "form_marketplace_listing_start_timestamp" => esc_html__("Start timestamp", "wpnc"),
            "form_marketplace_listing_expiration" => esc_html__("Date of listing expiration", "wpnc"),
            "form_marketplace_listing_expiration_placeholder" => esc_html__("Select date of expiration", "wpnc"),
            "form_marketplace_listing_expiration_label" => esc_html__("Expiration at", "wpnc"),
            "form_asset_unlock" => esc_html__("Unlockable Content", "wpnc"),
            "form_asset_unlock_placeholder" => esc_html__("Digital key, code to redeem or link to a file ...", "wpnc"),
            "form_asset_explicit" => esc_html__("Explicit content", "wpnc"),
            "form_contract_royalties" => esc_html__("Royalties", "wpnc"),
            "form_contract_royalties_placeholder" => esc_html__("e.g. 10%", "wpnc"),
            "form_advanced_settings_show" => esc_html__("Show advanced settings", "wpnc"),
            "form_advanced_settings_hide" => esc_html__("Hide advanced settings", "wpnc"),
            "form_asset_stats" => esc_html__("NFT’s Stats", "wpnc"),
            "form_asset_properties" => esc_html__("NFT’s Properties", "wpnc"),
            "form_asset_levels" => esc_html__("NFT’s Levels", "wpnc"),
            "form_asset_metadata_name_placeholder" => esc_html__("Key", "wpnc"),
            "form_asset_metadata_value_placeholder" => esc_html__("Value", "wpnc"),
            "form_button_add" => esc_html__("Add", "wpnc"),
            "form_button_create" => esc_html__("Create NFT", "wpnc"),
            "form_asset_upload_choose" => esc_html__("Choose File", "wpnc"),
            "form_asset_upload_desc" => esc_html__("JPG, PNG, GIF, SVG, MP4, WEBM, MP3, WAV, OGG, GLB, GLTF. Max size: ", "wpnc") . $max_upload,
            "form_asset_value_name" => esc_html__("Name", "wpnc"),
            "form_asset_value_rate" => esc_html__("Rate", "wpnc"),
            "form_asset_value" => esc_html__("Value", "wpnc"),
            "form_validation_image" => esc_html__("Please input your image.", "wpnc"),
            "form_validation_name" => esc_html__("Please input your asset name.", "wpnc"),
            "form_response_error" => esc_html__("An error has occurred.", "wpnc"),
            "form_response_deployed" => esc_html__("You can now search in your block explorer by this transaction hash: ", "wpnc"),
            "form_response_plugin_not_configured" => esc_html__("Plugin not configured correctly! Please configure your contract.", "wpnc"),
            "form_loading_waiting_for_wallet" => esc_html__("Waiting for wallet response...", "wpnc"),
            "tooltip_levels" => esc_html__("Numerical traits that show as a progress bar", "wpnc"),
            "tooltip_properties" => esc_html__("Textual traits that show up as rectangles", "wpnc"),
            "tooltip_stats" => esc_html__("Numerical traits that just show as numbers", "wpnc"),
            "tooltip_explicit" => esc_html__("Setting your asset as explicit and sensitive content, like pornography and other not safe for work (NSFW) content, will protect users with safe search while browsing.", "wpnc"),
            "tooltip_unlockable" => esc_html__("Include unlockable content that can only be revealed by the owner of the item. This field is public. You must use another service to hide this value.", "wpnc"),
            "tooltip_description" => esc_html__("The description will be included on the item's detail page underneath its image.", "wpnc"),
            "notice_cannot_upload" => esc_html__("Your user group is not allowed to upload images on this website.", "wpnc"),
            "tooltip_marketplace_disabled" => esc_html__("Marketplace listing only available for the following contract types: Edition, NFT Collection.", "wpnc"),
            "nft_preview" => esc_html__("Preview", "wpnc"),
            "nft_preview_missing_file" => esc_html__("Upload file or link to preview your brand new NFT", "wpnc"),
            "nft_preview_missing_contract" => esc_html__("No contract selected", "wpnc"),
            "nft_preview_missing_name" => esc_html__("Untitled", "wpnc"),
            "nft_preview_unlockable_content" => esc_html__("Unlockable Content", "wpnc"),
            "nft_preview_explicit_content" => esc_html__("Explicit Content", "wpnc"),
            "nft_preview_royalties" => esc_html__("Royalties", "wpnc"),
            "required_wallet_operations" => esc_html__("WALLET OPERATIONS WILL NEED AUTHORIZATION", "wpnc"),
            "dialog_missing_desc" => esc_html__("Your NFT has no description", "wpnc"),
            "dialog_view_nft_button" => esc_html__("View your NFT", "wpnc"),
            "dialog_view_on_marketplace_button" => esc_html__("View on Marketplace", "wpnc"),
            "unsupported_network_title" => esc_html__("You are on an unsupported network.", "wpnc"),
            "unsupported_network_subtitle" => esc_html__("Go inside your wallet and change your network to one of the following:", "wpnc"),
            "unsupported_network_change_button" => esc_html__("Change Network", "wpnc"),
            "unsupported_network_choose_title" => esc_html__("Choose one network", "wpnc"),
            "toast_missing_asset_title" => esc_html__("Missing asset", "wpnc"),
            "toast_missing_asset_file_desc" => esc_html__("Please ensure you have uploaded at least one image.", "wpnc"),
            "toast_missing_asset_link_desc" => esc_html__("Please ensure you have provided a link referring to an image.", "wpnc"),
            "toast_missing_marketplace_inputs_title" => esc_html__("Missing marketplace inputs", "wpnc"),
            "toast_missing_marketplace_inputs_desc" => esc_html__("Please ensure you have the marketplace listing inputs completed or deactivate the option", "wpnc"),
        ]);
    }
}
