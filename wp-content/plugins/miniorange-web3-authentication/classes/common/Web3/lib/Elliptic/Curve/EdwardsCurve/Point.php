<?php


namespace Elliptic\Curve\EdwardsCurve;

use BN\BN;
class Point extends \Elliptic\Curve\BaseCurve\Point
{
    public $x;
    public $y;
    public $z;
    public $t;
    public $zOne;
    function __construct($SK, $f5 = null, $o_ = null, $sd = null, $mV = null)
    {
        parent::__construct($SK, "\160\x72\x6f\152\x65\x63\x74\x69\x76\145");
        if ($f5 == null && $o_ == null && $sd == null) {
            goto V6;
        }
        $this->x = new BN($f5, 16);
        $this->y = new BN($o_, 16);
        $this->z = $sd ? new BN($sd, 16) : $this->curve->one;
        $this->t = $mV ? new BN($mV, 16) : null;
        if ($this->x->red) {
            goto ee;
        }
        $this->x = $this->x->toRed($this->curve->red);
        ee:
        if ($this->y->red) {
            goto K1;
        }
        $this->y = $this->y->toRed($this->curve->red);
        K1:
        if ($this->z->red) {
            goto Y3;
        }
        $this->z = $this->z->toRed($this->curve->red);
        Y3:
        if (!($this->t && !$this->t->red)) {
            goto Rp;
        }
        $this->t = $this->t->toRed($this->curve->red);
        Rp:
        $this->zOne = $this->z == $this->curve->one;
        if (!($this->curve->extended && !$this->t)) {
            goto DG;
        }
        $this->t = $this->x->redMul($this->y);
        if ($this->zOne) {
            goto iw;
        }
        $this->t = $this->t->redMul($this->z->redInvm());
        iw:
        DG:
        goto d3;
        V6:
        $this->x = $this->curve->zero;
        $this->y = $this->curve->one;
        $this->z = $this->curve->one;
        $this->t = $this->curve->zero;
        $this->zOne = true;
        d3:
    }
    public static function fromJSON($SK, $x0)
    {
        return new Point($SK, isset($x0[0]) ? $x0[0] : null, isset($x0[1]) ? $x0[1] : null, isset($x0[2]) ? $x0[2] : null);
    }
    public function inspect()
    {
        if (!$this->isInfinity()) {
            goto xD;
        }
        return "\x3c\105\x43\40\120\x6f\x69\156\164\x20\111\156\x66\x69\156\x69\164\171\76";
        xD:
        return "\x3c\x45\x43\x20\x50\x6f\x69\156\x74\40\170\x3a\x20" . $this->x->fromRed()->toString(16, 2) . "\x20\x79\x3a\40" . $this->y->fromRed()->toString(16, 2) . "\40\172\x3a\40" . $this->z->fromRed()->toString(16, 2) . "\x3e";
    }
    public function isInfinity()
    {
        return $this->x->cmpn(0) == 0 && $this->y->cmp($this->z) == 0;
    }
    public function _extDbl()
    {
        $TA = $this->x->redSqr();
        $nC = $this->y->redSqr();
        $Ux = $this->z->redSqr();
        $Ux = $Ux->redIAdd($Ux);
        $py = $this->curve->_mulA($TA);
        $uP = $this->x->redAdd($this->y)->redSqr()->redISub($TA)->redISub($nC);
        $Gf = $py->redAdd($nC);
        $GQ = $Gf->redSub($Ux);
        $R6 = $py->redSub($nC);
        $W5 = $uP->redMul($GQ);
        $TL = $Gf->redMul($R6);
        $dk = $uP->redMul($R6);
        $fi = $GQ->redMul($Gf);
        return $this->curve->point($W5, $TL, $fi, $dk);
    }
    public function _projDbl()
    {
        $nC = $this->x->redAdd($this->y)->redSqr();
        $Ux = $this->x->redSqr();
        $py = $this->y->redSqr();
        if ($this->curve->twisted) {
            goto m3;
        }
        $uP = $Ux->redAdd($py);
        $R6 = $this->curve->_mulC($this->c->redMul($this->z))->redSqr();
        $Dd = $uP->redSub($R6)->redSub($R6);
        $W5 = $this->curve->_mulC($nC->redISub($uP))->redMul($Dd);
        $TL = $this->curve->_mulC($uP)->redMul($Ux->redISub($py));
        $fi = $uP->redMul($Dd);
        goto Cn;
        m3:
        $uP = $this->curve->_mulA($Ux);
        $GQ = $uP->redAdd($py);
        if ($this->zOne) {
            goto M3;
        }
        $R6 = $this->z->redSqr();
        $Dd = $GQ->redSub($R6)->redISub($R6);
        $W5 = $nC->redSub($Ux)->redISub($py)->redMul($Dd);
        $TL = $GQ->redMul($uP->redSub($py));
        $fi = $GQ->redMul($Dd);
        goto Fj;
        M3:
        $W5 = $nC->redSub($Ux)->redSub($py)->redMul($GQ->redSub($this->curve->two));
        $TL = $GQ->redMul($uP->redSub($py));
        $fi = $GQ->redSqr()->redSub($GQ)->redSub($GQ);
        Fj:
        Cn:
        return $this->curve->point($W5, $TL, $fi);
    }
    public function dbl()
    {
        if (!$this->isInfinity()) {
            goto TJ;
        }
        return $this;
        TJ:
        if ($this->curve->extended) {
            goto HD;
        }
        return $this->_projDbl();
        goto Lw;
        HD:
        return $this->_extDbl();
        Lw:
    }
    public function _extAdd($g1)
    {
        $TA = $this->y->redSub($this->x)->redMul($g1->y->redSub($g1->x));
        $nC = $this->y->redAdd($this->x)->redMul($g1->y->redAdd($g1->x));
        $Ux = $this->t->redMul($this->curve->dd)->redMul($g1->t);
        $py = $this->z->redMul($g1->z->redAdd($g1->z));
        $uP = $nC->redSub($TA);
        $GQ = $py->redSub($Ux);
        $Gf = $py->redAdd($Ux);
        $R6 = $nC->redAdd($TA);
        $W5 = $uP->redMul($GQ);
        $TL = $Gf->redMul($R6);
        $dk = $uP->redMul($R6);
        $fi = $GQ->redMul($Gf);
        return $this->curve->point($W5, $TL, $fi, $dk);
    }
    public function _projAdd($g1)
    {
        $TA = $this->z->redMul($g1->z);
        $nC = $TA->redSqr();
        $Ux = $this->x->redMul($g1->x);
        $py = $this->y->redMul($g1->y);
        $uP = $this->curve->d->redMul($Ux)->redMul($py);
        $GQ = $nC->redSub($uP);
        $Gf = $nC->redAdd($uP);
        $Sp = $this->x->redAdd($this->y)->redMul($g1->x->redAdd($g1->y))->redISub($Ux)->redISub($py);
        $W5 = $TA->redMul($GQ)->redMul($Sp);
        if ($this->curve->twisted) {
            goto mA;
        }
        $TL = $TA->redMul($Gf)->redMul($py->redSub($Ux));
        $fi = $this->curve->_mulC($GQ)->redMul($Gf);
        goto YA;
        mA:
        $TL = $TA->redMul($Gf)->redMul($py->redSub($this->curve->_mulA($Ux)));
        $fi = $GQ->redMul($Gf);
        YA:
        return $this->curve->point($W5, $TL, $fi);
    }
    public function add($g1)
    {
        if (!$this->isInfinity()) {
            goto CI;
        }
        return $g1;
        CI:
        if (!$g1->isInfinity()) {
            goto CD;
        }
        return $this;
        CD:
        if ($this->curve->extended) {
            goto oc;
        }
        return $this->_projAdd($g1);
        goto WC;
        oc:
        return $this->_extAdd($g1);
        WC:
    }
    public function mul($OZ)
    {
        if ($this->_hasDoubles($OZ)) {
            goto xR;
        }
        return $this->curve->_wnafMul($this, $OZ);
        goto Ja;
        xR:
        return $this->curve->_fixedNafMul($this, $OZ);
        Ja:
    }
    public function mulAdd($mA, $g1, $O4)
    {
        return $this->curve->_wnafMulAdd(1, [$this, $g1], [$mA, $O4], 2, false);
    }
    public function jmulAdd($mA, $g1, $O4)
    {
        return $this->curve->_wnafMulAdd(1, [$this, $g1], [$mA, $O4], 2, true);
    }
    public function normalize()
    {
        if (!$this->zOne) {
            goto wk;
        }
        return $this;
        wk:
        $Sk = $this->z->redInvm();
        $this->x = $this->x->redMul($Sk);
        $this->y = $this->y->redMul($Sk);
        if (!$this->t) {
            goto N4;
        }
        $this->t = $this->t->redMul($Sk);
        N4:
        $this->z = $this->curve->one;
        $this->zOne = true;
        return $this;
    }
    public function neg()
    {
        return $this->curve->point($this->x->redNeg(), $this->y, $this->z, $this->t != null ? $this->t->redNeg() : null);
    }
    public function getX()
    {
        $this->normalize();
        return $this->x->fromRed();
    }
    public function getY()
    {
        $this->normalize();
        return $this->y->fromRed();
    }
    public function eq($QB)
    {
        return $this == $QB || $this->getX()->cmp($QB->getX()) == 0 && $this->getY()->cmp($QB->getY()) == 0;
    }
    public function eqXToP($f5)
    {
        $ww = $f5->toRed($this->curve->red)->redMul($this->z);
        if (!($this->x->cmp($ww) == 0)) {
            goto Q3;
        }
        return true;
        Q3:
        $OM = $f5->_clone();
        $mV = $this->curve->redN->redMul($this->z);
        Jb:
        $OM->iadd($this->curve->n);
        if (!($OM->cmp($this->curve->p) >= 0)) {
            goto qV;
        }
        return false;
        qV:
        $ww->redIAdd($mV);
        if (!($this->x->cmp($ww) == 0)) {
            goto hd;
        }
        return true;
        hd:
        XX:
        goto Jb;
        sj:
        return false;
    }
    public function toP()
    {
        return $this->normalize();
    }
    public function mixedAdd($g1)
    {
        return $this->add($g1);
    }
}
