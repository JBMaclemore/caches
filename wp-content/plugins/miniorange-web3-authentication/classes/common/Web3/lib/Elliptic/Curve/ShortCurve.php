<?php


namespace Elliptic\Curve;

require_once "\102\141\163\x65\103\165\162\x76\145\56\160\x68\160";
require_once "\x42\x61\163\x65\103\165\x72\166\145\57\111\x6e\x74\145\x72\x66\x61\x63\x65\x2d\x50\x6f\151\x6e\164\x2e\x70\x68\160";
require_once "\x53\x68\x6f\x72\164\103\165\x72\166\145\x2f\120\157\151\156\164\56\x70\150\160";
require_once "\x53\150\x6f\x72\164\x43\165\162\166\145\57\x4a\120\157\x69\156\x74\56\160\150\x70";
use Elliptic\Curve\ShortCurve\Point;
use Elliptic\Curve\ShortCurve\JPoint;
use BN\BN;
use Exception;
class ShortCurve extends BaseCurve
{
    public $a;
    public $b;
    public $tinv;
    public $zeroA;
    public $threeA;
    public $endo;
    private $_endoWnafT1;
    private $_endoWnafT2;
    function __construct($IG)
    {
        parent::__construct("\163\x68\x6f\x72\x74", $IG);
        $this->a = (new BN($IG["\141"], 16))->toRed($this->red);
        $this->b = (new BN($IG["\142"], 16))->toRed($this->red);
        $this->tinv = $this->two->redInvm();
        $this->zeroA = $this->a->fromRed()->isZero();
        $this->threeA = $this->a->fromRed()->sub($this->p)->cmpn(-3) === 0;
        $this->endo = $this->_getEndomorphism($IG);
        $this->_endoWnafT1 = array(0, 0, 0, 0);
        $this->_endoWnafT2 = array(0, 0, 0, 0);
    }
    private function _getEndomorphism($IG)
    {
        if (!(!$this->zeroA || !isset($this->g) || !isset($this->n) || $this->p->modn(3) != 1)) {
            goto mU;
        }
        return null;
        mU:
        $tM = null;
        $SX = null;
        if (isset($IG["\142\145\164\x61"])) {
            goto L_;
        }
        $Wy = $this->_getEndoRoots($this->p);
        $tM = $Wy[0]->cmp($Wy[1]) < 0 ? $Wy[0] : $Wy[1];
        $tM = $tM->toRed($this->red);
        goto i6;
        L_:
        $tM = (new BN($IG["\142\x65\x74\141"], 16))->toRed($this->red);
        i6:
        if (isset($IG["\x6c\x61\x6d\142\144\x61"])) {
            goto kA;
        }
        $q_ = $this->_getEndoRoots($this->n);
        if ($this->g->mul($q_[0])->x->cmp($this->g->x->redMul($tM)) == 0) {
            goto ME;
        }
        $SX = $q_[1];
        if (!assert_options(ASSERT_ACTIVE)) {
            goto TE;
        }
        assert($this->g->mul($SX)->x->cmp($this->g->x->redMul($tM)) === 0);
        TE:
        goto EW;
        ME:
        $SX = $q_[0];
        EW:
        goto wJ;
        kA:
        $SX = new BN($IG["\x6c\x61\x6d\142\x64\x61"], 16);
        wJ:
        $Mi = null;
        if (!isset($IG["\x62\141\163\151\163"])) {
            goto bW;
        }
        $EM = function ($cn) {
            return array("\x61" => new BN($cn["\141"], 16), "\x62" => new BN($cn["\142"], 16));
        };
        $Mi = array_map($EM, $IG["\142\141\x73\x69\x73"]);
        goto KF;
        bW:
        $Mi = $this->_getEndoBasis($SX);
        KF:
        return array("\142\x65\x74\x61" => $tM, "\x6c\x61\x6d\142\x64\141" => $SX, "\x62\x61\x73\x69\x73" => $Mi);
    }
    private function _getEndoRoots($xI)
    {
        $xO = $xI === $this->p ? $this->red : BN::mont($xI);
        $Mw = (new BN(2))->toRed($xO)->redInvm();
        $jT = $Mw->redNeg();
        $p8 = (new BN(3))->toRed($xO)->redNeg()->redSqrt()->redMul($Mw);
        return array($jT->redAdd($p8)->fromRed(), $jT->redSub($p8)->fromRed());
    }
    private function _getEndoBasis($SX)
    {
        $s3 = $this->n->ushrn(intval($this->n->bitLength() / 2));
        $Jc = $SX;
        $qK = $this->n->_clone();
        $iV = new BN(1);
        $Al = new BN(0);
        $hy = new BN(0);
        $xQ = new BN(1);
        $NG = 0;
        $Ey = 0;
        $M0 = 0;
        $IX = 0;
        $aT = 0;
        $XH = 0;
        $Do = 0;
        $m8 = 0;
        $G4 = 0;
        $f5 = 0;
        G2:
        if ($Jc->isZero()) {
            goto K7;
        }
        $Ps = $qK->div($Jc);
        $G4 = $qK->sub($Ps->mul($Jc));
        $f5 = $hy->sub($Ps->mul($iV));
        $o_ = $xQ->sub($Ps->mul($xQ));
        if (!$M0 && $G4->cmp($s3) < 0) {
            goto Rc;
        }
        if ($M0 && ++$m8 === 2) {
            goto Ug;
        }
        goto uc;
        Rc:
        $NG = $Do->neg();
        $Ey = $iV;
        $M0 = $G4->neg();
        $IX = $f5;
        goto uc;
        Ug:
        goto K7;
        uc:
        $Do = $G4;
        $qK = $Jc;
        $Jc = $G4;
        $hy = $iV;
        $iV = $f5;
        $xQ = $Al;
        $Al = $o_;
        goto G2;
        K7:
        $aT = $G4->neg();
        $XH = $f5;
        $J0 = $M0->sqr()->add($IX->sqr());
        $M3 = $aT->sqr()->add($XH->sqr());
        if (!($M3->cmp($J0) >= 0)) {
            goto yt;
        }
        $aT = $NG;
        $XH = $Ey;
        yt:
        if (!$M0->negative()) {
            goto bA;
        }
        $M0 = $M0->neg();
        $IX = $IX->neg();
        bA:
        if (!$aT->negative()) {
            goto zz;
        }
        $aT = $aT->neg();
        $XH = $XH->neg();
        zz:
        return array(array("\141" => $M0, "\142" => $IX), array("\141" => $aT, "\142" => $XH));
    }
    public function _endoSplit($OZ)
    {
        $Mi = $this->endo["\x62\x61\163\x69\163"];
        $eK = $Mi[0];
        $fc = $Mi[1];
        $e3 = $fc["\142"]->mul($OZ)->divRound($this->n);
        $K1 = $eK["\x62"]->neg()->mul($OZ)->divRound($this->n);
        $nV = $e3->mul($eK["\x61"]);
        $BV = $K1->mul($fc["\141"]);
        $nN = $e3->mul($eK["\x62"]);
        $Nx = $K1->mul($fc["\142"]);
        $mA = $OZ->sub($nV)->sub($BV);
        $O4 = $nN->add($Nx)->neg();
        return array("\153\x31" => $mA, "\x6b\62" => $O4);
    }
    public function pointFromX($f5, $V8)
    {
        $f5 = new BN($f5, 16);
        if ($f5->red) {
            goto v6;
        }
        $f5 = $f5->toRed($this->red);
        v6:
        $xQ = $f5->redSqr()->redMul($f5)->redIAdd($f5->redMul($this->a))->redIAdd($this->b);
        $o_ = $xQ->redSqrt();
        if (!($o_->redSqr()->redSub($xQ)->cmp($this->zero) !== 0)) {
            goto tg;
        }
        throw new Exception("\x49\x6e\166\x61\154\151\144\x20\x70\157\151\x6e\164");
        tg:
        $dQ = $o_->fromRed()->isOdd();
        if (!($V8 != $dQ)) {
            goto oW;
        }
        $o_ = $o_->redNeg();
        oW:
        return $this->point($f5, $o_);
    }
    public function validate($bh)
    {
        if (!$bh->inf) {
            goto Mk;
        }
        return true;
        Mk:
        $f5 = $bh->x;
        $o_ = $bh->y;
        $le = $this->a->redMul($f5);
        $jp = $f5->redSqr()->redMul($f5)->redIAdd($le)->redIAdd($this->b);
        return $o_->redSqr()->redISub($jp)->isZero();
    }
    public function _endoWnafMulAdd($aM, $lc, $E2 = false)
    {
        $q2 =& $this->_endoWnafT1;
        $dp =& $this->_endoWnafT2;
        $m8 = 0;
        lx:
        if (!($m8 < count($aM))) {
            goto IX;
        }
        $to = $this->_endoSplit($lc[$m8]);
        $g1 = $aM[$m8];
        $tM = $g1->_getBeta();
        if (!$to["\153\61"]->negative()) {
            goto d5;
        }
        $to["\x6b\x31"]->ineg();
        $g1 = $g1->neg(true);
        d5:
        if (!$to["\153\62"]->negative()) {
            goto jJ;
        }
        $to["\153\x32"]->ineg();
        $tM = $tM->neg(true);
        jJ:
        $q2[$m8 * 2] = $g1;
        $q2[$m8 * 2 + 1] = $tM;
        $dp[$m8 * 2] = $to["\x6b\61"];
        $dp[$m8 * 2 + 1] = $to["\x6b\62"];
        uu:
        $m8++;
        goto lx;
        IX:
        $cT = $this->_wnafMulAdd(1, $q2, $dp, $m8 * 2, $E2);
        $Dd = 0;
        tF:
        if (!($Dd < 2 * $m8)) {
            goto aA;
        }
        $q2[$Dd] = null;
        $dp[$Dd] = null;
        N0:
        $Dd++;
        goto tF;
        aA:
        return $cT;
    }
    public function point($f5, $o_, $Eo = false)
    {
        return new Point($this, $f5, $o_, $Eo);
    }
    public function pointFromJSON($x0, $xO)
    {
        return Point::fromJSON($this, $x0, $xO);
    }
    public function jpoint($f5, $o_, $sd)
    {
        return new JPoint($this, $f5, $o_, $sd);
    }
}
