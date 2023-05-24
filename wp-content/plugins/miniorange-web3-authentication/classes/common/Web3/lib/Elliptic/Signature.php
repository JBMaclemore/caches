<?php


namespace Elliptic\EC;

require_once "\125\164\151\154\163\x2e\160\150\x70";
use Elliptic\Utils;
use BN\BN;
class Signature
{
    public $r;
    public $s;
    public $recoveryParam;
    function __construct($Iq, $B1 = false)
    {
        if (!$Iq instanceof Signature) {
            goto q5;
        }
        $this->r = $Iq->r;
        $this->s = $Iq->s;
        $this->recoveryParam = $Iq->recoveryParam;
        return;
        q5:
        if (!isset($Iq["\162"])) {
            goto lH;
        }
        assert(isset($Iq["\162"]) && isset($Iq["\163"]));
        $this->r = new BN($Iq["\162"], 16);
        $this->s = new BN($Iq["\163"], 16);
        if (isset($Iq["\x72\145\x63\157\x76\145\162\171\120\141\x72\x61\x6d"])) {
            goto dV;
        }
        $this->recoveryParam = null;
        goto yN;
        dV:
        $this->recoveryParam = $Iq["\162\145\143\157\x76\145\162\171\x50\141\162\x61\155"];
        yN:
        return;
        lH:
        if ($this->_importDER($Iq, $B1)) {
            goto zQ;
        }
        throw new \Exception("\x55\x6e\153\x6e\x6f\167\x6e\x20\163\x69\147\156\141\x74\x75\x72\x65\40\146\157\162\x6d\x61\164");
        zQ:
    }
    private static function getLength($K2, &$ev)
    {
        $JI = $K2[$ev++];
        if ($JI & 0x80) {
            goto KR;
        }
        return $JI;
        KR:
        $pQ = $JI & 0xf;
        $HZ = 0;
        $m8 = 0;
        CQ:
        if (!($m8 < $pQ)) {
            goto hK;
        }
        $HZ = $HZ << 8;
        $HZ = $HZ | $K2[$ev];
        $ev++;
        nP:
        $m8++;
        goto CQ;
        hK:
        return $HZ;
    }
    private static function rmPadding(&$K2)
    {
        $m8 = 0;
        $oO = count($K2) - 1;
        Qp:
        if (!($m8 < $oO && !$K2[$m8] && !($K2[$m8 + 1] & 0x80))) {
            goto ZQ;
        }
        $m8++;
        goto Qp;
        ZQ:
        if (!($m8 === 0)) {
            goto Qc;
        }
        return $K2;
        Qc:
        return array_slice($K2, $m8);
    }
    private function _importDER($Td, $B1)
    {
        $Td = Utils::toArray($Td, $B1);
        $BE = count($Td);
        $k8 = 0;
        if (!($Td[$k8++] !== 0x30)) {
            goto bE;
        }
        return false;
        bE:
        $oO = self::getLength($Td, $k8);
        if (!($oO + $k8 !== $BE)) {
            goto P6;
        }
        return false;
        P6:
        if (!($Td[$k8++] !== 0x2)) {
            goto JB;
        }
        return false;
        JB:
        $EB = self::getLength($Td, $k8);
        $G4 = array_slice($Td, $k8, $EB);
        $k8 += $EB;
        if (!($Td[$k8++] !== 0x2)) {
            goto A9;
        }
        return false;
        A9:
        $ZV = self::getLength($Td, $k8);
        if (!($BE !== $ZV + $k8)) {
            goto Jl;
        }
        return false;
        Jl:
        $p8 = array_slice($Td, $k8, $ZV);
        if (!($G4[0] === 0 && $G4[1] & 0x80)) {
            goto dq;
        }
        $G4 = array_slice($G4, 1);
        dq:
        if (!($p8[0] === 0 && $p8[1] & 0x80)) {
            goto pJ;
        }
        $p8 = array_slice($p8, 1);
        pJ:
        $this->r = new BN($G4);
        $this->s = new BN($p8);
        $this->recoveryParam = null;
        return true;
    }
    private static function constructLength(&$oi, $oO)
    {
        if (!($oO < 0x80)) {
            goto Nq;
        }
        array_push($oi, $oO);
        return;
        Nq:
        $lS = 1 + (log($oO) / M_LN2 >> 3);
        array_push($oi, $lS | 0x80);
        ew:
        if (!--$lS) {
            goto hx;
        }
        array_push($oi, $oO >> ($lS << 3) & 0xff);
        goto ew;
        hx:
        array_push($oi, $oO);
    }
    public function toDER($B1 = false)
    {
        $G4 = $this->r->toArray();
        $p8 = $this->s->toArray();
        if (!($G4[0] & 0x80)) {
            goto aO;
        }
        array_unshift($G4, 0);
        aO:
        if (!($p8[0] & 0x80)) {
            goto JN;
        }
        array_unshift($p8, 0);
        JN:
        $G4 = self::rmPadding($G4);
        $p8 = self::rmPadding($p8);
        EI:
        if (!(!$p8[0] && !($p8[1] & 0x80))) {
            goto Du;
        }
        array_slice($p8, 1);
        goto EI;
        Du:
        $oi = array(0x2);
        self::constructLength($oi, count($G4));
        $oi = array_merge($oi, $G4, array(0x2));
        self::constructLength($oi, count($p8));
        $Rz = array_merge($oi, $p8);
        $cT = array(0x30);
        self::constructLength($cT, count($Rz));
        $cT = array_merge($cT, $Rz);
        return Utils::encode($cT, $B1);
    }
}
