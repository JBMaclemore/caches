<?php


namespace Elliptic;

use Exception;
use BN\BN;
class Utils
{
    public static function toArray($U2, $B1 = false)
    {
        if (!is_array($U2)) {
            goto Xw;
        }
        return array_slice($U2, 0);
        Xw:
        if ($U2) {
            goto Xq;
        }
        return array();
        Xq:
        if (is_string($U2)) {
            goto S6;
        }
        throw new Exception("\116\x6f\164\40\x69\155\x70\x6c\145\155\x65\x6e\164\145\x64");
        S6:
        if ($B1) {
            goto YQ;
        }
        return array_slice(unpack("\103\x2a", $U2), 0);
        YQ:
        if (!($B1 === "\x68\x65\170")) {
            goto A6;
        }
        return array_slice(unpack("\103\52", hex2bin($U2)), 0);
        A6:
        return $U2;
    }
    public static function toHex($U2)
    {
        if (!is_string($U2)) {
            goto NP;
        }
        return bin2hex($U2);
        NP:
        if (is_array($U2)) {
            goto cm;
        }
        throw new Exception("\x4e\x6f\x74\40\151\x6d\x70\x6c\145\155\145\x6e\164\145\144");
        cm:
        $LD = call_user_func_array("\x70\x61\143\153", array_merge(["\x43\x2a"], $U2));
        return bin2hex($LD);
    }
    public static function toBin($U2, $B1 = false)
    {
        if (!is_array($U2)) {
            goto jZ;
        }
        return call_user_func_array("\160\x61\143\x6b", array_merge(["\x43\52"], $U2));
        jZ:
        if (!($B1 === "\150\x65\170")) {
            goto ex;
        }
        return hex2bin($U2);
        ex:
        return $U2;
    }
    public static function encode($oi, $B1)
    {
        if (!($B1 === "\x68\145\x78")) {
            goto pl;
        }
        return self::toHex($oi);
        pl:
        return $oi;
    }
    public static function getNAF($xI, $ey)
    {
        $SS = array();
        $b6 = 1 << $ey + 1;
        $OZ = clone $xI;
        l2:
        if (!($OZ->cmpn(1) >= 0)) {
            goto Cq;
        }
        if (!$OZ->isOdd()) {
            goto b5;
        }
        $VJ = $OZ->andln($b6 - 1);
        $sd = $VJ;
        if (!($VJ > ($b6 >> 1) - 1)) {
            goto B8;
        }
        $sd = ($b6 >> 1) - $VJ;
        B8:
        $OZ->isubn($sd);
        array_push($SS, $sd);
        goto I8;
        b5:
        array_push($SS, 0);
        I8:
        $h7 = !$OZ->isZero() && $OZ->andln($b6 - 1) === 0 ? $ey + 1 : 1;
        $m8 = 1;
        U9:
        if (!($m8 < $h7)) {
            goto dA;
        }
        array_push($SS, 0);
        vt:
        $m8++;
        goto U9;
        dA:
        $OZ->iushrn($h7);
        goto l2;
        Cq:
        return $SS;
    }
    public static function getJSF($mA, $O4)
    {
        $gl = array(array(), array());
        $mA = $mA->_clone();
        $O4 = $O4->_clone();
        $gO = 0;
        $fo = 0;
        Az:
        if (!($mA->cmpn(-$gO) > 0 || $O4->cmpn(-$fo) > 0)) {
            goto WX;
        }
        $MV = $mA->andln(3) + $gO & 3;
        $tK = $O4->andln(3) + $fo & 3;
        if (!($MV === 3)) {
            goto Yz;
        }
        $MV = -1;
        Yz:
        if (!($tK === 3)) {
            goto x5;
        }
        $tK = -1;
        x5:
        $oD = 0;
        if (!(($MV & 1) !== 0)) {
            goto o2;
        }
        $gR = $mA->andln(7) + $gO & 7;
        $oD = ($gR === 3 || $gR === 5) && $tK === 2 ? -$MV : $MV;
        o2:
        array_push($gl[0], $oD);
        $tC = 0;
        if (!(($tK & 1) !== 0)) {
            goto GD;
        }
        $gR = $O4->andln(7) + $fo & 7;
        $tC = ($gR === 3 || $gR === 5) && $MV === 2 ? -$tK : $tK;
        GD:
        array_push($gl[1], $tC);
        if (!(2 * $gO === $oD + 1)) {
            goto u1;
        }
        $gO = 1 - $gO;
        u1:
        if (!(2 * $fo === $tC + 1)) {
            goto vq;
        }
        $fo = 1 - $fo;
        vq:
        $mA->iushrn(1);
        $O4->iushrn(1);
        goto Az;
        WX:
        return $gl;
    }
    public static function intFromLE($C3)
    {
        return new BN($C3, "\x68\x65\x78", "\154\x65");
    }
    public static function parseBytes($C3)
    {
        if (!is_string($C3)) {
            goto SU;
        }
        return self::toArray($C3, "\x68\x65\x78");
        SU:
        return $C3;
    }
    public static function randBytes($aP)
    {
        $cT = '';
        $m8 = 0;
        sE:
        if (!($m8 < $aP)) {
            goto Qo;
        }
        $cT .= chr(rand(0, 255));
        I1:
        $m8++;
        goto sE;
        Qo:
        return $cT;
    }
    public static function optionAssert(&$xw, $ai, $K_ = false, $ew = false)
    {
        if (!isset($xw[$ai])) {
            goto II;
        }
        return;
        II:
        if (!$ew) {
            goto Qs;
        }
        throw new Exception("\115\x69\163\x73\151\x6e\147\40\157\x70\164\151\x6f\156\x20" . $ai);
        Qs:
        $xw[$ai] = $K_;
    }
}
