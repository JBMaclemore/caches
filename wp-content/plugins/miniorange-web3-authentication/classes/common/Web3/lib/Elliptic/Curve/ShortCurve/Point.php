<?php


namespace Elliptic\Curve\ShortCurve;

use JsonSerializable;
use BN\BN;
class Point extends \Elliptic\Curve\BaseCurve\Point implements JsonSerializable
{
    public $x;
    public $y;
    public $inf;
    function __construct($SK, $f5, $o_, $Eo)
    {
        parent::__construct($SK, "\141\x66\x66\151\x6e\x65");
        if ($f5 == null && $o_ == null) {
            goto CZ;
        }
        $this->x = new BN($f5, 16);
        $this->y = new BN($o_, 16);
        if (!$Eo) {
            goto O7;
        }
        $this->x->forceRed($this->curve->red);
        $this->y->forceRed($this->curve->red);
        O7:
        if ($this->x->red) {
            goto Qx;
        }
        $this->x = $this->x->toRed($this->curve->red);
        Qx:
        if ($this->y->red) {
            goto hF;
        }
        $this->y = $this->y->toRed($this->curve->red);
        hF:
        $this->inf = false;
        goto fO;
        CZ:
        $this->x = null;
        $this->y = null;
        $this->inf = true;
        fO:
    }
    public function _getBeta()
    {
        if (isset($this->curve->endo)) {
            goto Wi;
        }
        return null;
        Wi:
        if (!(isset($this->precomputed) && isset($this->precomputed["\x62\x65\164\141"]))) {
            goto kY;
        }
        return $this->precomputed["\142\145\x74\x61"];
        kY:
        $tM = $this->curve->point($this->x->redMul($this->curve->endo["\x62\x65\x74\x61"]), $this->y);
        if (!isset($this->precomputed)) {
            goto Bp;
        }
        $gb = function ($g1) {
            return $this->curve->point($g1->x->redMul($this->curve->endo["\142\145\x74\141"]), $g1->y);
        };
        $tM->precomputed = array("\x62\x65\164\x61" => null, "\x6e\141\146" => null, "\144\157\x75\x62\x6c\145\163" => null);
        if (!isset($this->precomputed["\156\x61\x66"])) {
            goto OZ;
        }
        $tM->precomputed["\156\x61\x66"] = array("\x77\156\x64" => $this->precomputed["\156\141\x66"]["\167\156\144"], "\160\157\x69\156\x74\x73" => array_map($gb, $this->precomputed["\156\141\x66"]["\160\157\151\x6e\164\163"]));
        OZ:
        if (!isset($this->precomputed["\x64\x6f\x75\142\154\x65\163"])) {
            goto T4;
        }
        $tM->precomputed["\x64\x6f\165\142\x6c\145\163"] = array("\163\x74\145\x70" => $this->precomputed["\x64\157\165\142\154\145\x73"]["\163\164\145\x70"], "\160\157\x69\156\164\x73" => array_map($gb, $this->precomputed["\x64\x6f\165\x62\x6c\145\163"]["\160\157\151\156\164\x73"]));
        T4:
        $this->precomputed["\142\145\x74\x61"] = $tM;
        Bp:
        return $tM;
    }
    public function jsonSerialize() : mixed
    {
        $cT = array($this->x, $this->y);
        if (isset($this->precomputed)) {
            goto a2;
        }
        return $cT;
        a2:
        $PI = array();
        $W4 = false;
        if (!isset($this->precomputed["\144\x6f\x75\142\x6c\145\163"])) {
            goto Zp;
        }
        $PI["\144\x6f\165\142\154\145\x73"] = array("\x73\x74\x65\160" => $this->precomputed["\144\157\x75\x62\154\x65\x73"]["\163\x74\145\x70"], "\x70\x6f\151\x6e\164\163" => array_slice($this->precomputed["\144\157\x75\x62\154\145\x73"]["\160\x6f\x69\x6e\x74\x73"], 1));
        $W4 = true;
        Zp:
        if (!isset($this->precomputed["\156\x61\x66"])) {
            goto gN;
        }
        $PI["\x6e\x61\x66"] = array("\x6e\x61\146" => $this->precomputed["\156\x61\x66"]["\x77\156\x64"], "\x70\x6f\151\156\164\163" => array_slice($this->precomputed["\156\x61\x66"]["\160\x6f\x69\156\x74\163"], 1));
        $W4 = true;
        gN:
        if (!$W4) {
            goto mr;
        }
        array_push($cT, $PI);
        mr:
        return $cT;
    }
    public static function fromJSON($SK, $x0, $xO)
    {
        if (!is_string($x0)) {
            goto Mr;
        }
        $x0 = json_decode($x0);
        Mr:
        $bh = $SK->point($x0[0], $x0[1], $xO);
        if (!(count($x0) === 2)) {
            goto RV;
        }
        return $bh;
        RV:
        $PI = $x0[2];
        $bh->precomputed = array("\x62\x65\164\x61" => null);
        $Bb = function ($x0) use($SK, $xO) {
            return $SK->point($x0[0], $x0[1], $xO);
        };
        if (!isset($PI["\x64\x6f\165\142\x6c\145\x73"])) {
            goto YJ;
        }
        $Sp = array_map($Bb, $PI["\x64\157\165\x62\x6c\x65\x73"]["\x70\x6f\x69\156\164\x73"]);
        array_unshift($Sp, $bh);
        $bh->precomputed["\x64\x6f\165\142\x6c\x65\x73"] = array("\163\164\x65\160" => $PI["\x64\157\165\x62\154\145\163"]["\163\164\145\160"], "\160\x6f\x69\156\x74\x73" => $Sp);
        YJ:
        if (!isset($PI["\x6e\141\x66"])) {
            goto sV;
        }
        $Sp = array_map($Bb, $PI["\x6e\141\146"]["\x70\157\151\x6e\x74\x73"]);
        array_unshift($Sp, $bh);
        $bh->precomputed["\156\141\146"] = array("\167\156\x64" => $PI["\x6e\x61\x66"]["\x77\156\144"], "\x70\x6f\x69\156\164\163" => $Sp);
        sV:
        return $bh;
    }
    public function inspect()
    {
        if (!$this->isInfinity()) {
            goto sa;
        }
        return "\x3c\105\x43\40\120\x6f\151\x6e\164\40\111\156\x66\151\x6e\x69\164\x79\76";
        sa:
        return "\x3c\x45\x43\x20\x50\x6f\x69\x6e\x74\40\x78\x3a\x20" . $this->x->fromRed()->toString(16, 2) . "\x20\171\72\x20" . $this->y->fromRed()->toString(16, 2) . "\76";
    }
    public function __debugInfo()
    {
        return ["\105\x43\40\x50\157\151\x6e\x74" => $this->isInfinity() ? "\x49\156\146\x69\156\x69\164\171" : ["\170" => $this->x->fromRed()->toString(16, 2), "\x79" => $this->y->fromRed()->toString(16, 2)]];
    }
    public function isInfinity()
    {
        return $this->inf;
    }
    public function add($bh)
    {
        if (!$this->inf) {
            goto P7;
        }
        return $bh;
        P7:
        if (!$bh->inf) {
            goto Vm;
        }
        return $this;
        Vm:
        if (!$this->eq($bh)) {
            goto aU;
        }
        return $this->dbl();
        aU:
        if (!$this->neg()->eq($bh)) {
            goto Ae;
        }
        return $this->curve->point(null, null);
        Ae:
        if (!($this->x->cmp($bh->x) === 0)) {
            goto KB;
        }
        return $this->curve->point(null, null);
        KB:
        $Ux = $this->y->redSub($bh->y);
        if ($Ux->isZero()) {
            goto zU;
        }
        $Ux = $Ux->redMul($this->x->redSub($bh->x)->redInvm());
        zU:
        $W5 = $Ux->redSqr()->redISub($this->x)->redISub($bh->x);
        $TL = $Ux->redMul($this->x->redSub($W5))->redISub($this->y);
        return $this->curve->point($W5, $TL);
    }
    public function dbl()
    {
        if (!$this->inf) {
            goto li;
        }
        return $this;
        li:
        $Mx = $this->y->redAdd($this->y);
        if (!$Mx->isZero()) {
            goto zt;
        }
        return $this->curve->point(null, null);
        zt:
        $hy = $this->x->redSqr();
        $Mg = $Mx->redInvm();
        $Ux = $hy->redAdd($hy)->redIAdd($hy)->redIAdd($this->curve->a)->redMul($Mg);
        $W5 = $Ux->redSqr()->redISub($this->x->redAdd($this->x));
        $TL = $Ux->redMul($this->x->redSub($W5))->redISub($this->y);
        return $this->curve->point($W5, $TL);
    }
    public function getX()
    {
        return $this->x->fromRed();
    }
    public function getY()
    {
        return $this->y->fromRed();
    }
    public function mul($OZ)
    {
        $OZ = new BN($OZ, 16);
        if ($this->_hasDoubles($OZ)) {
            goto VO;
        }
        if (isset($this->curve->endo)) {
            goto AH;
        }
        goto Jc;
        VO:
        return $this->curve->_fixedNafMul($this, $OZ);
        goto Jc;
        AH:
        return $this->curve->_endoWnafMulAdd(array($this), array($OZ));
        Jc:
        return $this->curve->_wnafMul($this, $OZ);
    }
    public function mulAdd($mA, $BV, $O4, $Dd = false)
    {
        $aM = array($this, $BV);
        $lc = array($mA, $O4);
        if (!isset($this->curve->endo)) {
            goto g8;
        }
        return $this->curve->_endoWnafMulAdd($aM, $lc, $Dd);
        g8:
        return $this->curve->_wnafMulAdd(1, $aM, $lc, 2, $Dd);
    }
    public function jmulAdd($mA, $BV, $O4)
    {
        return $this->mulAdd($mA, $BV, $O4, true);
    }
    public function eq($bh)
    {
        return $this === $bh || $this->inf === $bh->inf && ($this->inf || $this->x->cmp($bh->x) === 0 && $this->y->cmp($bh->y) === 0);
    }
    public function neg($LW = false)
    {
        if (!$this->inf) {
            goto j_;
        }
        return $this;
        j_:
        $cT = $this->curve->point($this->x, $this->y->redNeg());
        if (!($LW && isset($this->precomputed))) {
            goto fl;
        }
        $cT->precomputed = array();
        $PI = $this->precomputed;
        $by = function ($bh) {
            return $bh->neg();
        };
        if (!isset($PI["\156\141\146"])) {
            goto DC;
        }
        $cT->precomputed["\x6e\141\146"] = array("\167\156\144" => $PI["\x6e\141\x66"]["\167\156\144"], "\160\x6f\151\x6e\x74\163" => array_map($by, $PI["\156\x61\146"]["\160\157\151\156\x74\x73"]));
        DC:
        if (!isset($PI["\x64\157\165\142\x6c\x65\x73"])) {
            goto Xm;
        }
        $cT->precomputed["\x64\x6f\165\x62\154\145\163"] = array("\163\x74\x65\x70" => $PI["\144\157\x75\142\154\x65\x73"]["\163\x74\x65\x70"], "\x70\157\151\156\x74\x73" => array_map($by, $PI["\x64\157\165\x62\154\x65\x73"]["\160\157\x69\x6e\x74\x73"]));
        Xm:
        fl:
        return $cT;
    }
    public function toJ()
    {
        if (!$this->inf) {
            goto C3;
        }
        return $this->curve->jpoint(null, null, null);
        C3:
        return $this->curve->jpoint($this->x, $this->y, $this->curve->one);
    }
}
