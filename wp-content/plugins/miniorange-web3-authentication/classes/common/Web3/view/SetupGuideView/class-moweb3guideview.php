<?php


namespace MoWeb3\view\SetupGuideView;

class MoWeb3GuideView
{
    public function __construct()
    {
        $this->util = new \MoWeb3\MoWeb3Utils();
    }
    public function view()
    {
        echo "\40\40\x20\x20\x20\x20\x20\x20\x3c\x64\x69\166\x20\143\x6c\x61\163\x73\x3d\x22\x6d\157\x5f\x73\165\160\160\x6f\162\164\137\154\x61\171\157\x75\164\x20\x22\x3e\xd\xa\x20\40\40\x20\40\40\x20\40\x20\40\40\x20\x3c\x64\x69\166\40\x3e\15\12\40\40\x20\x20\x20\x20\x20\x20\x20\x20\x20\40\40\40\x20\40\x3c\x70\x20\x73\164\171\154\145\x3d\x22\146\157\x6e\164\55\163\151\x7a\x65\x3a\x31\65\160\x78\73\x22\x3e\15\12\40\x20\x20\40\40\x20\40\x20\40\x20\x20\x20\x20\40\x20\40\x20\40\x20\x20\x3c\163\x74\x72\x6f\156\147\x3e\x31\56\40\x3c\57\x73\164\x72\157\x6e\147\x3e\x47\157\40\164\157\x20\74\163\x74\x72\157\x6e\x67\76\x20\103\x6f\156\146\x69\x67\x75\162\x65\x20\x53\145\164\x74\151\x6e\x67\x73\56\40\x3c\57\163\164\x72\x6f\156\147\76\xd\xa\x20\40\x20\x20\40\40\x20\40\40\40\40\40\40\x20\40\40\x3c\57\160\76\xd\xa\15\12\x20\40\40\40\x20\40\40\40\x20\x20\40\x20\x20\x20\x20\x20\x3c\160\x20\x73\x74\171\154\x65\75\42\x66\x6f\156\x74\x2d\163\x69\x7a\145\72\x31\x35\160\170\x3b\42\76\xd\12\40\x20\40\40\40\40\x20\x20\40\x20\40\40\x20\40\40\40\x20\40\40\x20\74\163\x74\x72\157\156\147\76\x32\56\x20\x3c\57\x73\x74\x72\x6f\156\147\76\x43\150\x65\143\x6b\x20\164\x68\145\40\x3c\x73\x74\162\x6f\156\147\x3e\x45\156\x61\142\154\x65\40\x57\145\x62\63\40\165\x73\145\x72\x20\114\x6f\x67\151\x6e\x3c\57\x73\164\162\157\156\x67\x3e\x20\157\x70\164\x69\x6f\156\x20\x74\x6f\40\144\x69\x73\x70\154\x61\x79\40\x74\x68\145\40\x3c\163\164\162\157\x6e\x67\x3e\x4c\x6f\147\151\156\40\x77\x69\164\150\x20\103\162\x79\160\x74\x6f\127\141\154\154\x65\x74\74\57\163\x74\162\157\156\147\76\40\x62\x75\164\x74\x6f\x6e\x20\157\156\40\164\150\x65\x20\x57\157\162\x64\x50\x72\x65\x73\x73\40\163\x74\141\156\144\141\162\144\x20\x4c\x6f\147\151\x6e\40\x50\141\x67\145\56\xd\12\x20\40\x20\40\40\x20\40\40\40\40\40\40\40\x20\x20\40\74\x2f\x70\x3e\xd\xa\15\12\40\x20\40\40\40\x20\40\40\x20\x20\x20\40\x20\40\40\x20\74\x64\151\166\76\15\xa\x20\x20\40\40\40\x20\40\x20\40\x20\40\x20\x20\40\x20\x20\x20\x20\40\40\x3c\151\155\147\40\x63\154\x61\x73\163\x20\x3d\42\x6d\x2d\x32\x22\x20\167\x69\x64\x74\150\x3d\x22\67\x30\x25\x22\x20\150\x65\151\x67\x68\x74\75\42\67\60\45\42\40\x73\x72\143\x3d\x22";
        echo esc_attr(MOWEB3_URL) . "\57\143\x6c\141\163\163\x65\x73\x2f\x63\x6f\155\155\157\x6e\x2f\x57\x65\x62\x33\x2f\x72\x65\x73\x6f\x75\x72\143\145\x73\x2f\x69\155\x61\147\145\163\57\147\165\x69\144\145\x5f\151\155\x61\147\x65\x73\x2f\x4c\157\x67\151\156\x42\x75\x74\x74\x6f\x6e\124\x6f\147\x67\x6c\145\104\151\x73\160\x6c\141\x79\x2e\160\156\147";
        echo "\x22\40\x2f\76\15\xa\x20\40\x20\x20\40\40\40\40\x20\40\40\40\40\40\40\40\74\x2f\144\151\166\x3e\xd\12\15\xa\15\12\40\40\x20\40\x20\40\40\40\x20\40\40\40\xd\12\x20\40\x20\x20\40\40\40\40\x20\x20\40\x20\x20\x20\40\x20\x3c\x70\x20\x73\164\171\154\145\75\x22\x66\x6f\156\164\x2d\163\151\172\x65\x3a\x31\x35\160\x78\73\x22\x3e\xd\xa\40\x20\x20\x20\x20\x20\40\x20\x20\x20\40\x20\x20\x20\x20\40\40\x20\x20\40\x3c\163\164\x72\157\156\x67\x3e\63\56\40\74\x2f\x73\164\162\157\156\x67\x3e\x43\x6c\x69\x63\153\40\157\x6e\x20\x74\150\145\40\74\163\x74\x72\x6f\156\x67\x3e\x54\x65\163\x74\40\x57\145\x62\x33\40\103\157\x6e\156\x65\x63\x74\x69\166\x69\164\171\74\57\163\164\x72\157\x6e\147\x3e\x20\x74\157\x20\164\145\x73\x74\40\164\x68\x65\40\x63\157\155\160\154\x65\x74\145\40\x66\154\157\167\x20\x6f\x66\40\167\145\x62\x33\x20\x61\x75\164\150\x65\x6e\164\151\x63\141\164\x69\x6f\x6e\56\x20\101\x73\40\x61\40\x73\165\x63\x63\x65\x73\x73\x66\x75\x6c\x20\162\145\163\165\154\164\x20\167\141\154\x6c\x65\x74\40\x61\x64\144\162\x65\x73\163\40\x77\x69\154\x6c\40\x62\145\40\163\150\157\x77\156\x20\151\156\40\164\x68\145\40\x70\x6f\x70\165\x70\x2e\x20\x20\15\xa\40\40\40\40\x20\x20\40\x20\40\x20\x20\x20\40\40\40\x20\x3c\x2f\160\76\xd\xa\xd\12\x20\40\40\x20\40\40\40\40\x20\40\x20\x20\x20\x20\x20\x20\xd\12\x20\40\x20\40\40\40\40\40\x20\40\40\x20\40\40\40\40\74\151\155\147\x20\143\154\x61\163\x73\40\75\42\155\55\62\x22\x20\x77\x69\144\164\150\x3d\42\67\x30\x25\x22\40\150\145\151\x67\x68\x74\x3d\42\x37\60\45\42\40\163\162\143\x3d\42";
        echo esc_attr(MOWEB3_URL) . "\57\143\x6c\141\x73\x73\x65\163\x2f\x63\x6f\x6d\155\157\156\x2f\127\145\142\63\57\162\145\163\157\x75\162\x63\x65\163\57\151\155\141\x67\x65\x73\57\x67\165\151\144\145\x5f\151\155\141\147\145\163\57\167\x65\142\x33\124\x65\x73\x74\x43\157\156\156\x65\143\x74\x69\166\151\x74\x79\56\x70\x6e\x67";
        echo "\x22\x20\x2f\76\xd\xa\x20\40\x20\40\40\40\40\40\x20\40\40\40\xd\12\40\40\40\40\x20\x20\x20\40\x20\x20\x20\40\74\x2f\x64\151\166\x3e\15\12\x20\40\x20\x20\x20\40\x20\x20\74\57\x64\151\166\76\xd\xa\xd\12\40\40\x20\x20\40\x20\40\x20";
    }
}
