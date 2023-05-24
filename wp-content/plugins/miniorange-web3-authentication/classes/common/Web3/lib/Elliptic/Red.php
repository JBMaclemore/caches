<?php


namespace BN;

use Exception;
use BI\BigInteger;
class Red
{
    public $m;
    function __construct($gw)
    {
        if (is_string($gw)) {
            goto Vq;
        }
        $this->m = $gw;
        goto RF;
        Vq:
        $this->m = Red::primeByName($gw);
        RF:
        if ($this->m->gtn(1)) {
            goto F2;
        }
        throw new Exception("\115\x6f\144\x75\x6c\165\163\x20\155\165\163\164\x20\142\145\40\x67\x72\x65\141\x74\145\x72\40\x74\150\141\x6e\x20\x31");
        F2:
    }
    public static function primeByName($RN)
    {
        switch ($RN) {
            case "\153\x32\65\66":
                return new BN("\146\x66\x66\x66\146\146\x66\x66\x20\x66\x66\146\x66\146\146\146\x66\40\x66\x66\146\x66\x66\x66\146\146\40\x66\x66\146\146\146\146\x66\146\40\x66\146\146\146\x66\x66\146\146\x20\146\146\146\146\x66\x66\x66\x66\40\x66\146\146\x66\x66\x66\x66\145\x20\146\x66\x66\146\146\x63\x32\146", 16);
            case "\x70\62\x32\64":
                return new BN("\146\146\x66\x66\x66\x66\146\x66\x20\x66\x66\x66\x66\x66\x66\x66\x66\x20\x66\146\x66\x66\146\x66\146\146\x20\146\x66\x66\x66\146\146\146\146\40\x30\60\60\x30\x30\60\x30\x30\40\60\60\x30\x30\60\60\60\60\x20\60\60\x30\x30\x30\x30\60\61", 16);
            case "\160\x31\71\62":
                return new BN("\x66\x66\146\146\146\146\146\x66\x20\146\146\146\146\146\x66\x66\146\x20\x66\146\x66\x66\x66\x66\146\146\x20\x66\146\x66\146\146\146\146\x65\40\x66\146\146\146\146\146\x66\146\x20\x66\x66\146\146\146\146\x66\x66", 16);
            case "\160\62\x35\x35\61\x39":
                return new BN("\67\146\146\x66\x66\146\x66\x66\146\x66\x66\146\x66\146\x66\x66\x20\146\146\146\x66\146\146\x66\x66\146\146\x66\x66\x66\x66\x66\146\x20\146\146\146\146\x66\146\146\146\146\x66\146\146\146\x66\x66\x66\40\x66\x66\146\x66\146\x66\x66\x66\146\146\146\x66\146\x66\145\x64", 16);
            default:
                throw new Exception("\125\156\x6b\156\157\167\x6e\40\x70\162\x69\155\x65\x20\156\141\155\x65\40" . $RN);
        }
        lZ:
        Ea:
    }
    public function verify1(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto U_;
        }
        assert(!$xI->negative());
        U_:
        assert($xI->red);
    }
    public function verify2(BN $TA, BN $nC)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto TK;
        }
        assert(!$TA->negative() && !$nC->negative());
        TK:
        assert($TA->red && $TA->red == $nC->red);
    }
    public function imod(BN &$TA)
    {
        return $TA->umod($this->m)->_forceRed($this);
    }
    public function neg(BN $TA)
    {
        if (!$TA->isZero()) {
            goto rf;
        }
        return $TA->_clone();
        rf:
        return $this->m->sub($TA)->_forceRed($this);
    }
    public function add(BN $TA, BN $nC)
    {
        $this->verify2($TA, $nC);
        $cT = $TA->add($nC);
        if (!($cT->cmp($this->m) >= 0)) {
            goto Ou;
        }
        $cT->isub($this->m);
        Ou:
        return $cT->_forceRed($this);
    }
    public function iadd(BN &$TA, BN $nC)
    {
        $this->verify2($TA, $nC);
        $TA->iadd($nC);
        if (!($TA->cmp($this->m) >= 0)) {
            goto jF;
        }
        $TA->isub($this->m);
        jF:
        return $TA;
    }
    public function sub(BN $TA, BN $nC)
    {
        $this->verify2($TA, $nC);
        $cT = $TA->sub($nC);
        if (!$cT->negative()) {
            goto Mt;
        }
        $cT->iadd($this->m);
        Mt:
        return $cT->_forceRed($this);
    }
    public function isub(BN &$TA, $nC)
    {
        $this->verify2($TA, $nC);
        $TA->isub($nC);
        if (!$TA->negative()) {
            goto E5;
        }
        $TA->iadd($this->m);
        E5:
        return $TA;
    }
    public function shl(BN $TA, $xI)
    {
        $this->verify1($TA);
        return $this->imod($TA->ushln($xI));
    }
    public function imul(BN &$TA, BN $nC)
    {
        $this->verify2($TA, $nC);
        $cT = $TA->imul($nC);
        return $this->imod($cT);
    }
    public function mul(BN $TA, BN $nC)
    {
        $this->verify2($TA, $nC);
        $cT = $TA->mul($nC);
        return $this->imod($cT);
    }
    public function sqr(BN $TA)
    {
        $cT = $TA->_clone();
        return $this->imul($cT, $TA);
    }
    public function isqr(BN &$TA)
    {
        return $this->imul($TA, $TA);
    }
    public function sqrt(BN $TA)
    {
        if (!$TA->isZero()) {
            goto je;
        }
        return $TA->_clone();
        je:
        $Ug = $this->m->andln(3);
        assert($Ug % 2 == 1);
        if (!($Ug == 3)) {
            goto Qk;
        }
        $Ds = $this->m->add(new BN(1))->iushrn(2);
        return $this->pow($TA, $Ds);
        Qk:
        $Ps = $this->m->subn(1);
        $p8 = 0;
        S7:
        if (!(!$Ps->isZero() && $Ps->andln(1) == 0)) {
            goto Yy;
        }
        $p8++;
        $Ps->iushrn(1);
        goto S7;
        Yy:
        if (!assert_options(ASSERT_ACTIVE)) {
            goto Kc;
        }
        assert(!$Ps->isZero());
        Kc:
        $yg = (new BN(1))->toRed($this);
        $y2 = $yg->redNeg();
        $R1 = $this->m->subn(1)->iushrn(1);
        $sd = $this->m->bitLength();
        $sd = (new BN(2 * $sd * $sd))->toRed($this);
        cx:
        if (!($this->pow($sd, $R1)->cmp($y2) != 0)) {
            goto wZ;
        }
        $sd->redIAdd($y2);
        goto cx;
        wZ:
        $Ux = $this->pow($sd, $Ps);
        $G4 = $this->pow($TA, $Ps->addn(1)->iushrn(1));
        $mV = $this->pow($TA, $Ps);
        $gw = $p8;
        ZW:
        if (!($mV->cmp($yg) != 0)) {
            goto Vv;
        }
        $Sp = $mV;
        $m8 = 0;
        QB:
        if (!($Sp->cmp($yg) != 0)) {
            goto Xf;
        }
        $Sp = $Sp->redSqr();
        fo:
        $m8++;
        goto QB;
        Xf:
        if (!($m8 >= $gw)) {
            goto AQ;
        }
        throw new \Exception("\x41\x73\163\x65\x72\x74\151\157\x6e\40\x66\x61\x69\154\x65\x64");
        AQ:
        if ($gw - $m8 - 1 > 54) {
            goto LH;
        }
        $nC = clone $Ux;
        $nC->bi = $Ux->bi->powMod(1 << $gw - $m8 - 1, $this->m->bi);
        goto OX;
        LH:
        $nC = $this->pow($Ux, (new BN(1))->iushln($gw - $m8 - 1));
        OX:
        $G4 = $G4->redMul($nC);
        $Ux = $nC->redSqr();
        $mV = $mV->redMul($Ux);
        $gw = $m8;
        goto ZW;
        Vv:
        return $G4;
    }
    public function invm(BN &$TA)
    {
        $cT = $TA->invm($this->m);
        return $this->imod($cT);
    }
    public function pow(BN $TA, BN $xI)
    {
        $G4 = clone $TA;
        $G4->bi = $TA->bi->powMod($xI->bi, $this->m->bi);
        return $G4;
    }
    public function convertTo(BN $xI)
    {
        $G4 = $xI->umod($this->m);
        return $G4 === $xI ? $G4->_clone() : $G4;
    }
    public function convertFrom(BN $xI)
    {
        $cT = $xI->_clone();
        $cT->red = null;
        return $cT;
    }
}
