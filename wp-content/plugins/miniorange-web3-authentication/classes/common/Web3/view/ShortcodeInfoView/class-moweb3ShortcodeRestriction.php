<?php


namespace MoWeb3\view\ShortcodeInfoView;

class MoWeb3ShortcodeInfo
{
    public $util;
    public function __construct()
    {
        $this->util = new \MoWeb3\MoWeb3Utils();
    }
    public function view()
    {
        echo "\x20\x20\x20\x20\x20\40\40\x20\15\12\x20\40\x20\x20\40\x20\40\x20\40\40\40\x20\xd\xa\xd\xa\x20\x20\x20\40\x20\40\40\x20\x20\40\x20\40\74\x64\x69\x76\x20\x63\x6c\141\x73\x73\75\x22\155\x6f\x5f\163\x75\160\160\157\x72\164\x5f\154\141\171\157\x75\164\x20\x63\x6f\156\164\x61\151\156\145\x72\42\40\x73\164\171\154\145\75\x22\x66\x6f\x6e\164\x2d\163\x69\x7a\145\x3a\60\56\x39\x72\x65\155\42\76\15\12\x9\11\x9\11\74\150\x33\40\76\123\x69\147\156\40\x69\156\x20\157\160\164\x69\x6f\156\163\74\57\x68\63\76\x3c\142\x72\76\15\12\11\11\x9\11\74\x73\x74\x72\x6f\156\147\40\76\xd\12\x9\x9\11\x9\117\160\164\x69\x6f\156\40\61\x3a\40\125\x73\145\x20\x61\40\114\157\x67\x69\156\x20\x62\165\x74\164\157\x6e\40\157\156\40\127\157\162\144\x50\x72\145\163\x73\x20\x64\145\x66\141\165\x6c\164\40\x4c\157\147\x69\x6e\40\x46\x6f\x72\155\x20\x66\157\162\40\144\151\146\x66\145\x72\145\156\164\40\160\x72\157\166\x69\x64\145\x72\163\40\x6c\x6f\x67\x69\156\x20\x6d\145\x74\x68\x6f\144\x2e\74\57\163\x74\162\157\156\147\x3e\xd\xa\x9\x9\11\x9\74\157\x6c\76\xd\12\11\11\11\11\x9\x3c\x6c\151\x3e\107\157\x20\x74\157\40\103\157\x6e\x66\x69\x67\x75\x72\x65\x20\x53\145\x74\x74\x69\156\147\x73\x20\164\x61\142\56\74\57\154\151\x3e\15\12\x20\x20\x20\x20\40\40\x20\40\x20\x20\40\x20\40\x20\40\x20\40\40\40\40\x3c\x6c\x69\76\103\150\145\x63\x6b\x20\x3c\x62\76\42\x45\156\x61\142\x6c\145\x20\127\145\142\63\40\x75\163\x65\162\x20\114\x6f\x67\x69\x6e\x22\x3c\57\142\76\56\74\x2f\x6c\151\x3e\xd\xa\11\11\11\11\x3c\57\157\154\76\xd\12\11\11\11\x9\x3c\163\164\162\x6f\156\147\76\x4f\x70\x74\151\157\x6e\40\62\72\x20\x55\163\145\x20\141\x20\123\150\157\x72\x74\x63\x6f\x64\x65\74\57\x73\164\x72\x6f\x6e\147\76\xd\12\11\11\11\x9\74\x6f\x6c\x20\163\x74\171\154\145\75\42\x6c\x69\163\x74\x2d\163\x74\171\x6c\145\x3a\156\157\156\145\42\76\15\xa\x9\x9\11\x9\11\15\xa\11\x9\11\x9\11\x3c\154\151\x3e\x50\x6c\x61\143\x65\x20\163\150\157\162\x74\143\x6f\x64\x65\40\x3c\142\x3e\133\x6d\x6f\137\167\x65\x62\63\x5f\x6c\157\147\x69\156\x5f\x62\165\164\x74\x6f\156\x5f\163\150\x6f\162\x74\x63\x6f\x64\x65\40\74\x69\x3e\x72\x65\144\x69\162\145\x63\164\151\x6f\x6e\x5f\x75\x72\154\x3c\57\151\76\75\42\x68\x74\164\x70\x73\x3a\57\x2f\145\x78\x61\155\160\x6c\x65\x2e\143\x6f\155\x22\40\74\151\x3e\164\x65\x78\164\137\143\157\x6c\157\x72\x3c\x2f\151\76\x3d\x22\x62\154\141\143\x6b\42\135\x3c\57\142\76\x20\164\157\x20\141\x64\144\x20\127\145\142\63\x20\x4c\157\147\x69\x6e\40\142\165\164\164\x6f\156\x20\157\156\x20\127\157\162\144\x50\x72\145\x73\163\x20\x70\x61\x67\x65\x73\x2e\x3c\x62\x72\x3e\74\142\162\x3e\xd\12\x20\x20\40\40\40\x20\40\40\40\x20\x20\40\x20\x20\40\40\x20\x20\40\40\40\x20\x20\40\74\157\154\x20\163\164\171\154\x65\75\42\154\x69\163\164\55\163\164\171\154\145\72\144\151\163\x63\x22\40\76\xd\xa\40\x20\40\40\x20\40\x20\40\x20\40\40\x20\40\40\40\40\x20\x20\x20\40\40\x20\x20\40\40\x20\x20\40\74\154\151\76\x3c\142\76\x72\x65\x64\151\162\x65\x63\x74\x69\x6f\156\137\x75\x72\154\x3c\x2f\x62\x3e\x2c\x77\151\x6c\x6c\x20\x64\151\x72\x65\x63\x74\40\x74\150\x65\x20\x75\163\x65\162\40\157\156\40\164\x68\145\40\x67\x69\x76\145\156\x20\165\x72\x6c\74\57\154\151\x3e\15\12\40\40\40\40\40\40\x20\40\40\40\x20\40\x20\40\x20\x20\x20\40\x20\x20\x20\40\40\x20\40\40\40\x20\74\154\151\76\x41\146\x74\145\x72\40\x6c\157\x67\x69\156\x20\164\x68\162\157\x75\x67\150\40\164\150\145\40\x77\x65\x62\63\x20\x6c\157\x67\x69\156\40\142\x75\164\x74\x6f\x6e\54\40\142\x75\164\164\x6f\x6e\40\167\151\x6c\x6c\x20\x72\x65\160\154\141\x63\x65\144\40\142\171\x20\x74\x68\x65\x20\x77\141\154\x6c\x65\x74\40\x61\144\144\x72\x65\x73\163\40\x3c\x62\x3e\x74\145\170\164\x5f\143\x6f\x6c\157\x72\x3c\57\x62\x3e\x20\x64\x65\146\x69\156\x65\163\40\x74\x68\145\40\x63\157\x6c\x6f\x72\40\x6f\x66\40\x74\150\145\40\167\141\154\154\x65\x74\x20\141\144\144\x72\145\163\163\74\57\154\151\x3e\15\12\40\40\x20\x20\40\x20\40\40\40\40\x20\40\40\x20\40\x20\40\x20\40\40\40\40\40\40\74\57\x6f\154\x3e\15\12\x9\x9\11\11\x9\74\57\154\151\76\xd\12\x20\40\40\40\x20\x20\40\40\40\x20\40\40\40\x20\x20\40\x3c\57\157\154\x3e\xd\xa\xd\xa\x20\40\x20\x20\40\40\40\40\x20\40\40\40\x3c\x2f\144\x69\x76\x3e\xd\xa\40\x20\x20\x20\74\57\x62\162\x3e\15\12\x20\40\40\40\x20\40\x20\40\40\40\40\x20\x3c\x64\x69\166\40\143\x6c\x61\163\x73\75\42\155\157\x5f\163\165\x70\x70\157\162\164\137\x6c\141\171\x6f\x75\164\40\x63\157\156\164\x61\151\156\145\x72\x22\x20\163\x74\171\x6c\145\x3d\x22\146\157\156\x74\55\163\151\172\145\72\x30\x2e\x39\162\145\155\42\76\xd\12\x20\x20\x20\40\40\x20\40\x20\40\40\x20\40\40\x20\x20\x20\x3c\x68\x33\x3e\120\x6f\163\x74\40\122\145\163\164\162\x69\x63\164\x69\157\156\74\57\x68\63\76\x3c\142\x72\76\xd\12\x20\40\x20\x20\40\x20\x20\x20\x20\40\x20\x20\x20\x20\40\x20\74\x73\x74\x72\157\156\147\x3e\x55\163\145\40\141\x20\123\x68\157\162\164\x63\157\x64\x65\x3a\x20\x3c\57\163\164\x72\157\x6e\x67\76\74\163\x70\141\156\x3e\x50\154\141\x63\145\x20\171\157\x75\x72\40\x63\157\x6e\164\145\x6e\164\x20\142\x65\x74\167\x65\145\x6e\x20\164\x68\145\40\x73\x68\x6f\x72\x74\143\157\x64\x65\56\74\x2f\163\x70\x61\156\x3e\x3c\142\162\76\15\xa\x9\x9\x9\x9\x3c\x6f\x6c\40\163\x74\x79\154\145\x3d\42\154\151\x73\x74\55\x73\x74\171\154\x65\72\x6e\x6f\x6e\x65\42\x3e\xd\xa\x9\x9\11\11\11\15\12\15\xa\x20\x20\40\x20\x20\40\x20\40\x20\40\40\x20\40\40\x20\40\x20\40\40\x20\74\x62\76\133\x6d\x6f\x5f\167\x65\142\x33\137\160\157\163\x74\137\x72\x65\163\164\x72\x69\x63\164\151\x6f\156\x5f\x73\150\157\x72\x74\143\x6f\x64\145\x5d\x3c\x2f\x62\x3e\15\12\x20\40\40\x20\x20\x20\40\40\x20\x20\40\40\x20\x20\x20\x20\40\x20\x20\40\x3c\x70\40\x73\164\171\x6c\145\x3d\42\x6d\141\162\147\151\x6e\72\x33\x70\170\73\155\x61\162\147\151\156\55\x6c\145\x66\164\72\63\x30\160\170\73\42\x20\76\46\x6c\164\x3b\x20\120\x6f\163\164\x20\143\x6f\156\164\x65\156\x74\x20\164\150\141\x74\x20\171\x6f\x75\x20\167\x61\156\164\x20\x74\x6f\40\150\151\144\x65\40\46\147\164\x3b\x3c\57\x70\76\15\12\x20\x20\40\x20\x20\x20\40\40\40\40\40\40\40\x20\40\x20\x20\x20\40\x20\x3c\x62\x3e\x5b\x2f\x6d\x6f\x5f\x77\145\142\63\137\160\x6f\163\164\137\x72\145\163\x74\x72\x69\x63\164\x69\x6f\156\137\x73\x68\x6f\x72\x74\143\x6f\x64\x65\135\x3c\x2f\142\76\xd\12\11\x9\x9\x9\11\15\12\40\x20\x20\x20\x20\x20\x20\40\x20\40\40\x20\x20\40\40\40\x3c\x2f\x6f\x6c\76\xd\12\40\40\x20\x20\x20\x20\40\40\40\x20\x20\40\x20\x20\x20\x20\15\xa\x20\40\x20\x20\x20\40\x20\x20\40\x20\x20\x20\74\x2f\x64\151\x76\76\15\12\40\40\x20\40\40\x20\x20\x20";
    }
}
