<?php


namespace MoWeb3\Base;

use MoWeb3\MoWeb3Support;
require_once "\x63\154\x61\x73\x73\55\x6d\157\x77\x65\142\63\154\x6f\141\144\145\x72\56\160\150\x70";
class MoWeb3BaseStructure
{
    private $loader;
    public function __construct()
    {
        add_action("\141\144\x6d\151\x6e\x5f\155\145\x6e\165", array($this, "\x61\144\155\151\x6e\x5f\155\145\x6e\x75"));
        $this->loader = new MoWeb3Loader();
    }
    public function admin_menu()
    {
        $Bg = add_menu_page("\127\105\x42\x20\x33\56\60\x20" . __("\x43\x6f\156\x66\151\x67\165\162\x65\40\x57\x45\x42\63", "\155\x6f\137\167\x65\142\x33\137\163\x65\164\x74\151\156\147\x73"), "\155\151\x6e\151\117\x72\141\x6e\147\145\40\127\x45\x42\x33\40\114\x6f\x67\x69\x6e", "\141\144\x6d\151\156\151\x73\x74\162\x61\x74\157\x72", "\x6d\157\137\x77\145\142\63\x5f\x73\145\x74\164\x69\x6e\x67\163", array($this, "\x6d\145\156\165\x5f\157\160\164\x69\157\156\163"), MOWEB3_URL . "\162\x65\163\x6f\165\162\x63\x65\x73\57\x69\x6d\x61\x67\x65\163\x2f\x6d\x69\156\x69\x6f\x72\141\x6e\147\x65\56\160\x6e\147");
        global $WU;
        if (!(is_array($WU) && isset($WU["\155\x6f\x5f\167\x65\142\x33\x5f\x73\145\164\x74\151\x6e\x67\163"]))) {
            goto TO;
        }
        $WU["\155\157\x5f\167\x65\x62\63\x5f\163\145\164\164\x69\x6e\147\163"][0][0] = __("\103\x6f\156\146\151\x67\x75\162\x65\40\127\105\102\63", "\155\157\137\167\x65\142\x33\x5f\163\145\x74\x74\x69\x6e\x67\163");
        TO:
    }
    public function menu_options()
    {
        global $LN;
        $bR = isset($_GET["\164\x61\142"]) ? sanitize_text_field(wp_unslash($_GET["\164\141\x62"])) : '';
        echo "\11\x9\74\144\151\x76\40\x69\144\x3d\x22\155\x6f\x5f\x61\x70\151\x5f\141\x75\164\150\x65\156\x74\151\143\x61\164\151\157\156\x5f\163\145\164\164\151\156\147\x73\x22\x3e\xd\12\x9\x9\x9\74\x64\151\166\40\151\x64\x3d\47\x6d\162\141\142\154\157\x63\153\x27\x20\143\154\x61\163\x73\x3d\x27\x6d\167\x65\142\x33\x2d\x6f\166\145\x72\154\x61\171\x20\x64\141\163\150\x62\x6f\x61\162\x64\47\76\74\x2f\144\x69\x76\76\xd\12\x9\11\11\x3c\x64\x69\166\x20\x63\154\141\163\163\75\x22\155\151\156\151\x6f\x72\141\156\147\x65\137\143\157\156\x74\141\151\156\145\162\42\76\xd\12\x9\x9\x9\11";
        $this->content_navbar($bR);
        echo "\11\11\x9\x9\x3c\164\x61\x62\x6c\x65\x20\163\164\x79\154\145\75\42\x77\151\144\x74\x68\x3a\x31\60\x30\45\x3b\x22\x3e\15\xa\x9\x9\x9\11\x9\x3c\164\x72\76\15\12\x9\x9\11\x9\x9\x9\74\164\144\40\163\x74\171\154\x65\x3d\x22\x76\x65\162\164\x69\x63\141\154\55\141\154\x69\x67\156\72\x74\x6f\x70\73\167\151\144\164\150\x3a\66\x35\x25\x3b\x22\76\15\12\x9\11\x9\x9\x9\11\11";
        $this->loader->load_current_tab($bR);
        echo "\x9\11\11\x9\x9\x9\74\x2f\x74\x64\x3e\15\12\11\11\11\x9\11\x9\15\xa\x9\x9\x9\x9\x9\11\x3c\164\144\40\163\x74\x79\154\x65\75\42\166\145\162\164\151\x63\141\x6c\x2d\x61\x6c\x69\147\x6e\x3a\x74\157\160\73\x70\141\144\144\151\x6e\x67\55\154\x65\x66\x74\72\x31\45\73\42\x3e\xd\12\11\11\x9\11\x9\x9";
        $Nn = new MoWeb3Support();
        $Nn->support();
        echo "\11\x9\11\11\11\11\74\57\164\144\x3e\xd\12\x9\x9\11\x9\11\11\15\xa\x9\11\x9\x9\x9\x3c\57\164\x72\76\15\12\11\x9\11\x9\74\57\164\141\142\x6c\x65\x3e\15\xa\x9\x9\11\74\57\144\x69\x76\x3e\xd\xa\15\xa\11\x9\x3c\x2f\144\151\166\76\xd\xa\x9\11";
    }
    public function content_navbar($bR)
    {
        global $dg;
        echo "\x9\11\x3c\x64\151\166\x20\143\x6c\x61\x73\163\x3d\42\167\x72\x61\x70\42\76\15\12\11\x9\x9\74\144\151\166\x20\143\x6c\141\163\163\75\42\x68\x65\x61\144\x65\x72\55\x77\141\x72\x70\x22\x3e\15\12\11\x9\11\x9\x3c\x68\61\76\x6d\x69\156\x69\x4f\x72\141\156\x67\x65\x20\127\x65\x62\40\x33\56\x30\40\114\x6f\147\x69\x6e\x3c\57\150\x31\76\15\12\xd\12\11\11\x9\x9\x3c\x64\x69\166\76\74\x69\x6d\x67\40\x73\164\x79\154\145\x3d\x22\146\x6c\x6f\x61\x74\72\x6c\x65\x66\x74\73\x22\x20\x73\x72\x63\x3d\42";
        echo esc_attr(MOWEB3_URL) . "\x2f\162\145\x73\x6f\165\162\x63\x65\x73\x2f\x69\x6d\141\147\145\x73\57\154\x6f\147\157\x2e\160\x6e\147";
        echo "\x22\x3e\x3c\x2f\144\x69\166\x3e\15\12\11\x9\x3c\57\x64\x69\x76\76\xd\12\11\11\x3c\144\x69\166\x20\x69\x64\x3d\x22\164\x61\142\x22\76\xd\12\11\x9\74\150\x32\40\143\x6c\x61\x73\x73\x3d\x22\x6e\x61\166\55\x74\x61\x62\55\167\162\x61\160\x70\145\x72\42\76\15\12\x9\x9\11\x3c\x61\x20\x69\144\75\x22\164\141\x62\x2d\143\x6f\156\x66\x69\147\x22\40\x63\x6c\141\163\x73\75\x22\x6e\x61\166\x2d\x74\141\x62\40";
        echo "\143\x6f\x6e\x66\x69\x67" === esc_attr($bR) || '' === esc_attr($bR) ? "\x6d\157\55\x77\x65\x62\x33\x2d\x6e\x61\x76\x2d\x74\141\x62\55\x61\143\164\151\166\145" : '';
        echo "\x22\40\150\x72\145\x66\x3d\x22\x61\144\155\151\156\56\160\x68\x70\77\x70\141\x67\x65\75\155\157\x5f\x77\x65\142\63\x5f\163\x65\164\x74\x69\x6e\x67\163\46\164\141\x62\75\x63\x6f\x6e\146\151\147\x22\76\103\157\x6e\146\151\147\165\162\x65\40\x53\x65\164\x74\151\x6e\x67\163\74\57\141\76\15\xa\11\x9\x9\74\141\40\40\143\154\x61\x73\163\75\42\156\x61\166\55\164\141\142\x20";
        echo "\x69\x6e\x6c\x69\156\x65\x5f\146\x6f\x72\155\x5f\x63\x6f\x6e\x66\x69\x67" === esc_attr($bR) ? "\155\157\55\167\x65\x62\63\55\156\x61\x76\x2d\164\x61\x62\x2d\x61\143\x74\x69\166\145" : '';
        echo "\x22\x20\x68\x72\145\x66\x3d\x22\x61\144\x6d\151\156\x2e\x70\x68\160\x3f\160\x61\x67\145\x3d\155\157\137\x77\145\x62\63\x5f\x73\145\x74\164\x69\x6e\x67\x73\46\x74\x61\142\75\151\x6e\154\151\156\145\137\146\x6f\x72\155\x5f\x63\x6f\156\x66\151\x67\42\x3e\111\156\154\x69\156\145\x20\120\x72\157\x66\x69\x6c\x65\74\x2f\x61\x3e\15\xa\x9\x9\11\x3c\x61\x20\x20\143\x6c\x61\163\x73\x3d\x22\156\x61\166\55\164\141\142\x20";
        echo "\143\x6f\156\x74\x65\156\164\137\x72\x65\163\164\x72\x69\x63\x74\x69\157\x6e" === esc_attr($bR) ? "\155\x6f\x2d\167\x65\142\x33\x2d\156\141\166\x2d\x74\x61\x62\55\141\x63\164\151\x76\145" : '';
        echo "\x22\x20\150\x72\x65\146\x3d\42\x61\x64\155\x69\156\x2e\x70\x68\160\x3f\160\x61\x67\145\x3d\x6d\x6f\x5f\167\145\142\x33\x5f\x73\145\x74\164\151\156\x67\163\x26\x74\141\x62\75\143\x6f\x6e\x74\x65\x6e\x74\x5f\x72\145\163\x74\162\x69\x63\x74\x69\x6f\156\42\76\x4e\106\x54\x20\x43\x6f\156\164\145\x6e\164\40\122\145\163\164\x72\x69\143\164\x69\157\x6e\x3c\57\x61\76\xd\xa\11\11\11\74\141\x20\x20\143\x6c\x61\163\x73\75\x22\x6e\x61\166\55\x74\x61\x62\40";
        echo "\x72\x6f\154\x65\x5f\155\141\x70\x70\x69\x6e\x67" === esc_attr($bR) ? "\155\x6f\55\167\145\142\63\55\x6e\x61\x76\55\x74\x61\142\55\x61\x63\x74\151\x76\x65" : '';
        echo "\42\40\150\162\x65\x66\75\42\141\144\155\151\156\x2e\x70\150\x70\77\x70\141\147\145\75\x6d\157\137\x77\x65\142\x33\x5f\x73\x65\x74\164\x69\x6e\147\163\x26\164\x61\x62\75\x72\x6f\154\x65\x5f\x6d\x61\x70\160\151\x6e\x67\x22\x3e\x52\157\x6c\x65\x20\115\x61\160\x70\x69\x6e\x67\x3c\57\x61\76\15\xa\x9\x9\x9\74\141\x20\40\143\x6c\141\x73\163\x3d\42\156\141\166\x2d\164\141\x62\40";
        echo "\x73\x68\x6f\162\x74\x63\x6f\144\x65\x5f\151\x6e\146\x6f" === esc_attr($bR) ? "\155\157\55\167\145\142\x33\x2d\156\x61\166\55\164\141\x62\55\141\x63\x74\151\x76\x65" : '';
        echo "\42\x20\x68\162\x65\x66\x3d\x22\x61\144\155\x69\156\56\160\x68\160\x3f\x70\x61\x67\145\75\x6d\x6f\137\167\145\142\63\x5f\163\145\164\x74\151\x6e\147\163\x26\x74\x61\142\75\x73\150\x6f\162\x74\143\x6f\144\x65\137\x69\x6e\x66\157\42\76\123\150\157\x72\x74\x63\157\144\145\x20\x49\x6e\x66\x6f\74\57\x61\x3e\15\12\x9\x9\11\x3c\x61\40\151\x64\75\x22\x73\x65\x74\x75\x70\137\x67\x75\x69\x64\145\x22\40\x63\x6c\x61\x73\x73\75\42\156\x61\166\x2d\x74\141\x62\x20";
        echo "\163\x65\x74\x75\x70\x5f\x67\165\151\144\x65" === esc_attr($bR) ? "\155\157\x2d\167\x65\x62\x33\x2d\x6e\141\166\55\164\x61\x62\55\x61\x63\x74\x69\166\x65" : '';
        echo "\x22\40\150\162\145\146\x3d\x22\x61\x64\x6d\x69\156\x2e\x70\x68\160\77\160\141\x67\x65\75\x6d\x6f\x5f\x77\x65\142\63\x5f\x73\x65\164\x74\x69\156\147\163\x26\x74\x61\x62\x3d\163\145\x74\x75\x70\137\147\165\151\x64\145\x22\x3e\123\145\164\165\160\40\107\x75\151\144\145\x3c\57\x61\76\xd\12\x9\x9\11\74\141\40\151\x64\75\x22\141\x63\143\x5f\x73\x65\x74\165\x70\x5f\x62\x75\x74\x74\157\156\x5f\x69\144\x22\x20\143\x6c\141\163\x73\75\x22\156\141\166\x2d\x74\141\142\40";
        echo "\x61\x63\x63\x6f\x75\x6e\164" === esc_attr($bR) ? "\x6d\x6f\55\167\145\142\x33\x2d\x6e\141\x76\x2d\x74\141\x62\55\141\x63\x74\151\166\145" : '';
        echo "\42\x20\150\162\145\146\x3d\42\141\x64\x6d\151\156\56\160\150\160\77\x70\141\147\x65\75\155\157\x5f\x77\145\x62\x33\x5f\x73\x65\164\164\x69\x6e\x67\x73\46\164\x61\142\x3d\x61\x63\143\x6f\165\x6e\x74\42\76\x41\143\143\x6f\165\156\164\40\x53\145\164\x75\x70\74\x2f\x61\x3e\15\12\x9\x9\74\x2f\150\62\x3e\15\12\x9\x9\x3c\x2f\x64\151\166\76\15\xa\11\x9";
    }
    public function get_ui()
    {
        echo "\40\x20\x20\x20\x20\x20\x20\x20\74\41\x64\157\x63\164\x79\x70\145\40\150\x74\x6d\x6c\x3e\xd\12\40\40\x20\x20\x20\x20\40\x20\40\x20\40\40\74\150\x74\155\154\40\154\x61\156\x67\x3d\x22\145\x6e\x22\x3e\xd\12\40\x20\x20\x20\40\x20\40\40\x20\x20\40\40\74\150\145\141\144\x3e\xd\xa\40\x20\40\x20\40\40\40\40\x20\x20\40\x20\x20\40\x20\x20\x3c\41\x2d\x2d\40\122\145\x71\x75\x69\162\145\144\x20\x6d\145\164\141\40\x74\x61\147\163\40\55\x2d\x3e\15\12\40\40\x20\40\x20\40\x20\x20\40\x20\x20\40\40\40\40\40\x3c\x6d\145\164\x61\x20\x63\x68\x61\162\163\145\164\75\42\165\x74\146\x2d\70\42\x3e\xd\12\x20\40\40\x20\x20\x20\40\x20\40\x20\x20\40\40\40\x20\40\x3c\x6d\x65\164\x61\40\156\x61\155\145\x3d\42\166\x69\x65\167\160\x6f\x72\164\42\x20\143\157\156\x74\145\x6e\164\x3d\42\167\x69\144\x74\x68\x3d\x64\x65\x76\151\x63\x65\55\x77\x69\144\164\x68\54\40\151\156\151\x74\151\141\154\x2d\x73\143\141\154\x65\x3d\61\54\40\163\150\x72\x69\156\153\55\164\157\x2d\x66\x69\164\x3d\156\157\42\x3e\xd\xa\xd\12\x20\x20\40\x20\x20\40\40\x20\40\x20\40\40\40\40\15\xa\xd\xa\x20\40\40\x20\x20\40\40\40\40\40\x20\x20\x3c\57\150\145\141\144\76\xd\xa\x20\40\x20\40\x20\40\x20\40\40\40\40\40\40\40\x20\x20\x3c\142\157\x64\171\x20\163\x74\171\x6c\x65\x3d\x22\x62\x61\x63\x6b\x67\162\x6f\x75\156\x64\55\143\157\x6c\x6f\162\72\x66\154\x6f\x72\141\x6c\167\150\x69\x74\x65\73\42\x3e\xd\12\xd\xa\xd\12\x20\x20\40\40\40\x20\40\40\40\40\40\x20\x20\40\x20\40\x20\40\x20\40\74\144\151\x76\x20\x63\x6c\x61\163\163\75\42\x63\157\156\164\141\151\x6e\145\x72\x20\x6d\x74\x2d\65\x22\x20\163\x74\171\154\145\x3d\x22\142\141\x63\153\x67\x72\157\165\x6e\x64\x2d\143\157\154\x6f\x72\72\x66\x6c\157\x72\141\x6c\x77\150\151\164\145\x3b\42\x3e\xd\12\x20\x20\40\40\x20\40\x20\x20\40\x20\x20\x20\40\40\40\40\x20\40\40\x20\40\x20\x20\x20\74\150\61\x3e\x55\163\x65\x72\40\x46\x6f\162\x6d\74\x2f\150\61\x3e\15\12\x20\x20\40\40\40\x20\x20\x20\x20\40\40\40\x20\x20\40\x20\x20\40\40\40\x20\40\x20\40\74\x66\x6f\x72\x6d\x20\40\x61\x63\x74\x69\x6f\156\x3d\x22\42\40\x6d\145\164\x68\x6f\x64\x3d\x22\x70\157\163\164\x22\76\xd\12\40\x20\40\40\x20\40\x20\x20\40\x20\x20\x20\x20\40\x20\x20\x20\x20\x20\40\x20\40\x20\40\x20\40\40\40\74\151\x6e\x70\x75\x74\x20\x74\x79\160\x65\x3d\x22\x68\151\x64\144\x65\x6e\x22\x20\x6e\141\x6d\x65\x3d\x22\x6f\x70\164\151\157\x6e\x22\x20\166\141\x6c\x75\x65\75\x22\162\x65\x67\151\163\x74\145\162\137\143\x75\x73\164\157\155\x65\162\42\x20\x2f\76\xd\xa\40\40\40\40\40\x20\40\x20\40\x20\40\x20\40\x20\x20\x20\40\40\x20\x20\x20\x20\x20\x20\x20\40\40\40";
        wp_nonce_field("\x72\145\x67\151\x73\164\145\162\x5f\143\x75\x73\x74\x6f\155\145\162", "\x72\x65\147\x69\x73\x74\x65\162\137\x63\x75\163\x74\x6f\155\145\x72\x5f\x6e\x6f\x6e\x63\145");
        echo "\40\40\40\40\x20\40\40\40\40\x20\40\40\40\x20\x20\x20\x20\40\40\x20\x20\x20\x20\40\40\40\40\40\74\144\x69\166\x20\x63\154\141\163\163\75\x22\x72\157\x77\40\x66\157\162\x6d\55\147\162\157\165\x70\42\40\76\15\xa\40\40\x20\40\40\x20\x20\x20\x20\x20\40\40\x20\40\x20\40\x20\40\x20\40\x20\40\40\40\40\x20\40\x20\x20\40\40\40\74\144\151\166\x20\143\154\141\x73\163\x3d\42\x63\157\154\x2d\x31\62\x20\143\157\154\x2d\x73\x6d\x2d\63\42\76\15\xa\x20\x20\40\40\40\x20\40\40\40\x20\40\40\x20\40\40\40\x20\40\x20\x20\40\x20\x20\x20\40\x20\40\40\x20\40\40\x20\x20\40\x20\40\74\154\x61\142\145\154\x20\76\x46\x69\162\163\x74\x20\116\x61\155\x65\40\72\74\x2f\154\141\142\x65\154\76\15\xa\40\40\x20\40\40\40\40\x20\x20\x20\x20\x20\40\x20\x20\40\40\40\40\40\x20\40\40\x20\x20\40\x20\x20\40\x20\x20\x20\74\57\144\151\x76\76\xd\12\xd\12\x20\x20\40\x20\40\x20\40\x20\40\x20\x20\x20\x20\40\40\40\40\40\40\x20\40\40\x20\x20\x20\x20\x20\x20\x20\40\x20\x20\x3c\x64\x69\166\x20\143\154\141\x73\163\x3d\x22\143\x6f\x6c\x2d\x31\x32\x20\x63\x6f\x6c\x2d\x73\x6d\x2d\71\42\x3e\15\xa\40\40\40\40\40\x20\40\x20\40\40\x20\40\40\x20\40\x20\x20\40\40\40\40\40\x20\40\x20\40\x20\x20\40\x20\40\40\40\x20\40\40\74\151\156\x70\x75\164\x20\164\x79\160\145\75\x22\164\145\170\x74\42\40\x63\x6c\141\x73\x73\x3d\42\x66\157\162\155\55\143\157\x6e\x74\162\x6f\154\x22\40\x6e\141\x6d\x65\75\x22\146\x6e\141\155\145\42\x20\162\x65\x71\165\x69\162\x65\144\76\xd\12\40\40\40\x20\40\x20\40\40\x20\x20\x20\40\40\x20\40\40\40\x20\x20\40\x20\40\40\x20\x20\40\x20\40\40\x20\x20\40\x3c\x2f\x64\151\x76\76\15\12\x20\40\x20\x20\40\x20\x20\40\x20\40\40\40\x20\x20\x20\x20\40\40\x20\x20\x20\40\x20\40\x20\40\x20\40\x20\40\x20\40\xd\xa\x20\40\40\40\x20\x20\40\x20\40\40\x20\40\40\x20\x20\40\x20\40\x20\x20\40\40\40\x20\40\x20\x20\x20\x3c\57\144\x69\166\x3e\15\12\15\12\40\40\40\40\40\40\x20\x20\40\40\x20\x20\40\x20\x20\40\x20\x20\x20\x20\40\40\x20\40\40\40\40\40\x3c\144\151\166\40\143\x6c\141\x73\163\75\42\x20\162\x6f\167\x20\x66\157\162\155\x2d\147\x72\x6f\x75\160\40\42\76\xd\12\40\40\40\40\x20\x20\x20\40\40\40\x20\40\40\40\40\x20\x20\40\x20\40\40\x20\x20\40\x20\x20\40\x20\40\x20\x20\x20\x3c\144\151\x76\40\x63\154\x61\163\163\75\x22\x63\x6f\154\55\x31\62\40\143\157\154\55\x73\155\x2d\63\x22\x3e\15\xa\x20\x20\40\x20\x20\x20\x20\40\40\40\40\40\40\x20\x20\x20\x20\x20\40\40\x20\40\40\40\40\40\x20\40\x20\40\40\40\x20\40\x20\40\74\154\x61\142\x65\154\x3e\x4c\x61\x73\x74\x20\x4e\141\x6d\x65\40\x3a\74\x2f\154\141\x62\145\x6c\x3e\15\xa\40\40\40\40\x20\x20\x20\40\40\40\40\x20\40\x20\40\x20\x20\x20\x20\x20\x20\40\40\x20\x20\x20\x20\x20\40\40\40\x20\74\x2f\x64\151\166\76\15\12\40\40\40\x20\40\x20\x20\40\40\40\40\x20\x20\x20\40\x20\x20\40\x20\x20\x20\40\x20\40\40\40\40\x20\40\x20\40\x20\74\144\151\166\x20\x63\154\x61\x73\163\75\x22\143\x6f\154\x2d\x31\x32\40\143\157\x6c\55\163\155\x2d\x39\42\x3e\15\xa\x20\40\40\40\x20\x20\x20\x20\40\x20\x20\40\x20\x20\40\40\40\40\40\40\40\40\x20\40\x20\x20\40\x20\40\x20\x20\40\x20\40\x20\x20\74\151\x6e\x70\165\164\40\x74\171\x70\145\75\42\x74\x65\170\164\42\x20\x20\x63\154\141\x73\163\75\42\146\157\162\x6d\x2d\x63\157\x6e\x74\162\x6f\154\x22\x20\156\x61\x6d\145\x3d\x22\154\x6e\141\155\145\x22\40\x72\145\x71\165\151\162\x65\144\x3e\74\x2f\164\145\x78\x74\141\x72\x65\x61\x3e\xd\xa\40\x20\x20\x20\40\40\x20\40\40\x20\x20\x20\x20\40\40\40\40\40\x20\x20\40\40\40\40\x20\40\40\40\x20\x20\x20\x20\x3c\x2f\144\x69\166\76\xd\12\x20\40\40\x20\40\x20\x20\40\x20\40\x20\40\40\x20\40\40\40\40\40\40\x20\40\40\x20\40\40\x20\x20\74\x2f\x64\151\x76\x3e\15\12\x20\40\40\x20\x20\40\40\40\x20\x20\40\x20\40\x20\40\x20\x20\x20\x20\x20\40\x20\40\40\x20\x20\40\40\74\x64\x69\x76\x20\143\x6c\x61\163\163\x3d\x22\146\157\x72\155\55\147\x72\x6f\x75\x70\x20\x6f\x66\146\163\145\x74\x2d\x33\40\x6d\162\55\x31\42\x3e\15\xa\40\40\40\40\x20\x20\40\40\x20\x20\x20\40\x20\x20\x20\x20\x20\40\40\x20\x20\x20\x20\x20\40\x20\40\40\x20\40\x20\x20\46\x6e\x62\163\160\x3b\x3c\142\x75\x74\164\157\x6e\x20\164\x79\x70\x65\75\42\163\165\142\155\151\x74\x22\40\143\x6c\x61\x73\x73\75\42\x62\164\x6e\55\x6c\147\40\x62\164\x6e\x2d\160\x72\151\x6d\x61\162\171\x22\x3e\46\x6e\x62\163\x70\73\46\x6e\142\x73\x70\x3b\123\x75\x62\x6d\x69\164\46\156\142\x73\160\73\x26\x6e\142\x73\160\x3b\x3c\x2f\x62\165\164\164\157\156\76\15\12\x20\x20\x20\x20\40\x20\40\x20\40\40\x20\x20\40\40\40\x20\x20\40\x20\40\40\40\x20\40\40\40\x20\x20\74\x2f\x64\x69\166\x3e\15\12\40\x20\40\40\x20\40\x20\x20\40\40\40\x20\40\x20\x20\x20\40\40\40\40\40\x20\x20\x20\40\x20\xd\xa\15\12\x20\x20\x20\40\40\40\40\x20\x20\x20\40\40\x20\40\40\x20\x20\40\x20\40\40\x20\40\x20\74\x2f\x66\x6f\162\x6d\x3e\15\12\xd\xa\xd\xa\40\x20\x20\x20\x20\40\40\40\x20\40\40\x20\40\x20\40\40\40\40\40\x20\74\x2f\144\x69\x76\76\xd\xa\15\xa\40\x20\x20\40\40\40\40\40\40\40\x20\40\40\40\40\40\x20\x20\x20\x20\15\xa\xd\xa\40\40\x20\x20\40\x20\x20\40\40\40\x20\40\x20\40\40\40\40\x20\x20\x20\74\x66\157\157\164\x65\x72\x3e\15\12\x20\40\40\x20\x20\40\x20\x20\40\40\x20\x20\40\40\40\40\40\40\x20\x20\40\40\x20\x20\74\144\151\166\x20\143\x6c\x61\x73\x73\x3d\42\143\157\156\164\x61\x69\156\x65\x72\42\x3e\15\xa\x20\40\40\40\40\40\x20\x20\x20\40\x20\x20\40\40\x20\x20\40\40\x20\x20\40\x20\x20\x20\40\40\x20\40\74\144\x69\x76\x20\143\x6c\141\x73\163\75\x22\x72\157\167\x20\x6a\165\163\164\x69\146\171\55\x63\x6f\156\x74\x65\156\164\x2d\143\145\156\x74\145\x72\42\76\15\xa\x20\40\40\40\40\x20\x20\40\x20\40\40\x20\40\40\40\40\40\40\40\40\x20\40\40\x20\40\x20\40\40\x20\x20\x20\40\x3c\144\x69\166\40\143\154\141\x73\x73\75\42\x63\x6f\x6c\55\141\165\164\157\x22\76\15\xa\40\40\40\40\40\x20\40\x20\40\40\40\x20\x20\40\x20\x20\x20\x20\40\x20\40\40\40\x20\40\40\40\x20\40\x20\40\x20\40\x20\40\x20\74\x70\76\302\xa9\103\x6f\160\x79\x72\151\x67\150\x74\40\62\60\62\x32\40\127\x65\x62\63\x2e\60\74\57\160\76\xd\xa\x20\x20\40\40\x20\x20\x20\x20\40\40\40\x20\x20\40\40\40\40\40\x20\x20\40\x20\40\x20\40\40\40\40\x20\x20\x20\40\x3c\57\144\x69\166\x3e\xd\12\40\x20\40\x20\40\40\x20\40\x20\x20\40\x20\x20\x20\40\x20\40\40\x20\40\x20\40\40\x20\x20\x20\x20\40\x3c\x2f\x64\x69\166\x3e\xd\12\x20\40\40\x20\40\x20\40\x20\x20\x20\x20\40\x20\x20\40\x20\40\40\x20\x20\40\x20\40\40\74\x2f\x64\x69\166\x3e\15\xa\x20\x20\x20\40\40\x20\40\x20\x20\40\40\40\x20\40\x20\40\40\x20\40\40\74\57\x66\x6f\157\x74\145\162\x3e\15\xa\40\40\40\40\40\x20\x20\40\x20\40\40\40\15\xa\11\11\x9\x9\x3c\x2f\142\157\x64\x79\76\15\xa\40\40\40\x20\x20\x20\x20\x20\x20\40\40\x20\x3c\57\150\x74\155\x6c\76\15\xa";
    }
}
