<?php


namespace Elliptic\Curve\MontCurve;

use BN\BN;
class Point extends \Elliptic\Curve\BaseCurve\Point
{
    public $x;
    public $z;
    function __construct($SK, $f5, $sd)
    {
        parent::__construct($SK, "\x70\162\x6f\152\x65\143\x74\151\x76\x65");
        if ($f5 == null && $sd == null) {
            goto g1;
        }
        $this->x = new BN($f5, 16);
        $this->z = new BN($sd, 16);
        if ($this->x->red) {
            goto hq;
        }
        $this->x = $this->x->toRed($this->curve->red);
        hq:
        if ($this->z->red) {
            goto Dn;
        }
        $this->z = $this->z->toRed($this->curve->red);
        Dn:
        goto Er;
        g1:
        $this->x = $this->curve->one;
        $this->z = $this->curve->zero;
        Er:
    }
    public function precompute($F3 = null)
    {
    }
    protected function _encode($ZX)
    {
        return $this->getX()->toArray("\142\x65", $this->curve->p->byteLength());
    }
    public static function fromJSON($SK, $x0)
    {
        return new Point($SK, $x0[0], isset($x0[1]) ? $x0[1] : $SK->one);
    }
    public function inspect()
    {
        if (!$this->isInfinity()) {
            goto Yk;
        }
        return "\x3c\x45\x43\40\120\x6f\x69\x6e\164\x20\x49\156\146\151\156\x69\x74\x79\x3e";
        Yk:
        return "\74\x45\103\x20\120\157\x69\x6e\x74\x20\x78\72\40" . $this->x->fromRed()->toString(16, 2) . "\x20\172\x3a\x20" . $this->z->fromRed()->toString(16, 2) . "\76";
    }
    public function isInfinity()
    {
        return $this->z->isZero();
    }
    public function dbl()
    {
        $TA = $this->x->redAdd($this->z);
        $FX = $TA->redSqr();
        $nC = $this->x->redSub($this->z);
        $Rn = $nC->redSqr();
        $Ux = $FX->redSub($Rn);
        $W5 = $FX->redMul($Rn);
        $fi = $Ux->redMul($Rn->redAdd($this->curve->a24->redMul($Ux)));
        return $this->curve->point($W5, $fi);
    }
    public function add($g1)
    {
        throw new \Exception("\116\157\164\x20\163\165\160\160\157\162\x74\x65\144\x20\x6f\156\x20\115\157\156\x74\x67\157\155\145\x72\x79\x20\x63\x75\162\166\145");
    }
    public function diffAdd($g1, $u2)
    {
        $TA = $this->x->redAdd($this->z);
        $nC = $this->x->redSub($this->z);
        $Ux = $g1->x->redAdd($g1->z);
        $py = $g1->x->redSub($g1->z);
        $eM = $py->redMul($TA);
        $Zo = $Ux->redMul($nC);
        $W5 = $u2->z->redMul($eM->redAdd($Zo)->redSqr());
        $fi = $u2->x->redMul($eM->redSub($Zo)->redSqr());
        return $this->curve->point($W5, $fi);
    }
    public function mul($OZ)
    {
        $mV = $OZ->_clone();
        $TA = $this;
        $nC = $this->curve->point(null, null);
        $Ux = $this;
        $ED = array();
        PU:
        if ($mV->isZero()) {
            goto gX;
        }
        array_push($ED, $mV->andln(1));
        $mV->iushrn(1);
        goto PU;
        gX:
        $m8 = count($ED) - 1;
        zv:
        if (!($m8 >= 0)) {
            goto h5;
        }
        if ($ED[$m8] === 0) {
            goto pa;
        }
        $nC = $TA->diffAdd($nC, $Ux);
        $TA = $TA->dbl();
        goto Bq;
        pa:
        $TA = $TA->diffAdd($nC, $Ux);
        $nC = $nC->dbl();
        Bq:
        cY:
        $m8--;
        goto zv;
        h5:
        return $nC;
    }
    public function eq($QB)
    {
        return $this->getX()->cmp($QB->getX()) === 0;
    }
    public function normalize()
    {
        $this->x = $this->x->redMul($this->z->redInvm());
        $this->z = $this->curve->one;
        return $this;
    }
    public function getX()
    {
        $this->normalize();
        return $this->x->fromRed();
    }
}
