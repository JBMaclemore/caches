<?php


namespace Elliptic\Curve\BaseCurve;

use Elliptic\Utils;
abstract class Point
{
    public $curve;
    public $type;
    public $precomputed;
    function __construct($SK, $bs)
    {
        $this->curve = $SK;
        $this->type = $bs;
        $this->precomputed = null;
    }
    public abstract function eq($QB);
    public function validate()
    {
        return $this->curve->validate($this);
    }
    public function encodeCompressed($B1)
    {
        return $this->encode($B1, true);
    }
    public function encode($B1, $ZX = false)
    {
        return Utils::encode($this->_encode($ZX), $B1);
    }
    protected function _encode($ZX)
    {
        $oO = $this->curve->p->byteLength();
        $f5 = $this->getX()->toArray("\x62\145", $oO);
        if (!$ZX) {
            goto k_;
        }
        array_unshift($f5, $this->getY()->isEven() ? 0x2 : 0x3);
        return $f5;
        k_:
        return array_merge(array(0x4), $f5, $this->getY()->toArray("\x62\145", $oO));
    }
    public function precompute($F3 = null)
    {
        if (!isset($this->precomputed)) {
            goto gk;
        }
        return $this;
        gk:
        $this->precomputed = array("\156\x61\x66" => $this->_getNAFPoints(8), "\144\157\165\142\154\145\163" => $this->_getDoubles(4, $F3), "\x62\145\164\141" => $this->_getBeta());
        return $this;
    }
    protected function _hasDoubles($OZ)
    {
        if (!(!isset($this->precomputed) || !isset($this->precomputed["\144\157\165\x62\x6c\x65\163"]))) {
            goto Qd;
        }
        return false;
        Qd:
        return count($this->precomputed["\144\x6f\165\142\x6c\x65\163"]["\x70\157\x69\x6e\x74\x73"]) >= ceil(($OZ->bitLength() + 1) / $this->precomputed["\144\157\165\142\154\x65\x73"]["\163\x74\145\x70"]);
    }
    public function _getDoubles($N1 = null, $F3 = null)
    {
        if (!(isset($this->precomputed) && isset($this->precomputed["\x64\157\x75\142\154\145\x73"]))) {
            goto AG;
        }
        return $this->precomputed["\x64\157\x75\x62\x6c\x65\x73"];
        AG:
        $ji = array($this);
        $ro = $this;
        $m8 = 0;
        Bw:
        if (!($m8 < $F3)) {
            goto OJ;
        }
        $Dd = 0;
        Oi:
        if (!($Dd < $N1)) {
            goto sl;
        }
        $ro = $ro->dbl();
        JH:
        $Dd++;
        goto Oi;
        sl:
        array_push($ji, $ro);
        Kw:
        $m8 += $N1;
        goto Bw;
        OJ:
        return array("\x73\164\x65\160" => $N1, "\160\x6f\x69\x6e\x74\163" => $ji);
    }
    public function _getNAFPoints($R7)
    {
        if (!(isset($this->precomputed) && isset($this->precomputed["\156\x61\146"]))) {
            goto c_;
        }
        return $this->precomputed["\156\x61\146"];
        c_:
        $cT = array($this);
        $ax = (1 << $R7) - 1;
        $D8 = $ax === 1 ? null : $this->dbl();
        $m8 = 1;
        sk:
        if (!($m8 < $ax)) {
            goto ae;
        }
        array_push($cT, $cT[$m8 - 1]->add($D8));
        YC:
        $m8++;
        goto sk;
        ae:
        return array("\167\x6e\x64" => $R7, "\x70\157\x69\156\164\163" => $cT);
    }
    public function _getBeta()
    {
        return null;
    }
    public function dblp($OZ)
    {
        $G4 = $this;
        $m8 = 0;
        Gt:
        if (!($m8 < $OZ)) {
            goto cr;
        }
        $G4 = $G4->dbl();
        Mj:
        $m8++;
        goto Gt;
        cr:
        return $G4;
    }
}
