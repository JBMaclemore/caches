<?php


if (defined("\x41\102\123\120\x41\124\110")) {
    goto r1;
}
exit;
r1:
define("\x4d\117\127\x45\x42\63\137\x44\111\122", plugin_dir_path(__FILE__));
define("\x4d\117\x57\x45\x42\63\x5f\x55\122\x4c", plugin_dir_url(__FILE__));
define("\x4d\x4f\x57\105\x42\63\x5f\x56\x45\122\x53\111\x4f\116", "\155\157\137\167\x65\x62\63\x5f\154\157\x67\x69\156\x5f\x66\162\145\145");
mo_web3_include_file(MOWEB3_DIR . DIRECTORY_SEPARATOR . "\x63\x6c\x61\163\x73\x65\163" . DIRECTORY_SEPARATOR . "\x63\157\x6d\x6d\157\156");
function mo_web3_get_dir_contents($l9, &$oe = array())
{
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($l9, RecursiveDirectoryIterator::KEY_AS_PATHNAME), RecursiveIteratorIterator::CHILD_FIRST) as $rd => $wZ) {
        if (!($wZ->isFile() && $wZ->isReadable())) {
            goto Eb;
        }
        $oe[$rd] = realpath($wZ->getPathname());
        Eb:
        JQ:
    }
    fx:
    return $oe;
}
function mo_web3_get_sorted_files($l9)
{
    $fC = mo_web3_get_dir_contents($l9);
    $jL = array();
    $QQ = array();
    foreach ($fC as $rd => $m2) {
        if (!(strpos($m2, "\x2e\x70\x68\160") !== false)) {
            goto dH;
        }
        if (strpos($m2, "\x49\156\x74\145\x72\x66\x61\143\145") !== false) {
            goto SK;
        }
        $QQ[$rd] = $m2;
        goto Eu;
        SK:
        $jL[$rd] = $m2;
        Eu:
        dH:
        wR:
    }
    Xe:
    return array("\151\x6e\x74\145\162\x66\x61\143\145\163" => $jL, "\x63\154\x61\163\x73\x65\163" => $QQ);
}
function mo_web3_include_file($l9)
{
    if (is_dir($l9)) {
        goto co;
    }
    return;
    co:
    $l9 = mo_web3_sane_dir_path($l9);
    $Za = realpath($l9);
    if (!(false !== $Za && !is_dir($l9))) {
        goto Vj;
    }
    return;
    Vj:
    $aS = mo_web3_get_sorted_files($l9);
    mo_web3_require_all($aS["\x69\156\164\145\162\146\x61\x63\x65\x73"]);
    mo_web3_require_all($aS["\143\x6c\141\163\163\145\x73"]);
}
function mo_web3_require_all($fC)
{
    foreach ($fC as $rd => $m2) {
        require_once $m2;
        Dv:
    }
    Ky:
}
function mo_web3_is_valid_file($IN)
{
    return '' !== $IN && "\x2e" !== $IN && "\56\x2e" !== $IN;
}
function mo_web3_get_valid_html($Xu = array())
{
    $Km = array("\163\x74\x72\157\x6e\x67" => array(), "\145\155" => array(), "\142" => array(), "\151" => array(), "\x61" => array("\150\162\145\146" => array(), "\164\141\x72\x67\145\164" => array()));
    if (empty($Xu)) {
        goto VC;
    }
    return array_merge($Xu, $Km);
    VC:
    return $Km;
}
function mo_web3_get_version_number()
{
    $kd = get_file_data(MOWEB3_DIR . DIRECTORY_SEPARATOR . "\x6d\x69\156\x69\x6f\x72\141\156\147\145\x2d\x77\x65\142\x33\x2d\x6c\157\x67\151\156\55\163\x65\x74\164\151\x6e\147\163\56\160\x68\160", ["\126\x65\162\163\151\x6f\x6e"], "\160\154\x75\147\151\x6e");
    $Kw = isset($kd[0]) ? $kd[0] : '';
    return $Kw;
}
function mo_web3_sane_dir_path($l9)
{
    return str_replace("\57", DIRECTORY_SEPARATOR, $l9);
}
function mo_web3_load_all_methods($ye)
{
    foreach ($ye as $QC) {
        new $QC();
        fh:
    }
    Bf:
}
