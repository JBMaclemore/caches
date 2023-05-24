<?php


namespace Elliptic\Curve;

require_once "\x45\144\x77\x61\162\x64\x73\x43\165\x72\166\x65\57\x50\157\151\x6e\164\x2e\160\150\160";
use Elliptic\Curve\EdwardsCurve\Point;
use BN\BN;
class EdwardsCurve extends BaseCurve
{
    public $twisted;
    public $mOneA;
    public $extended;
    public $a;
    public $c;
    public $c2;
    public $d;
    public $d2;
    public $dd;
    public $oneC;
    function __construct($IG)
    {
        $this->twisted = ($IG["\141"] | 0) != 1;
        $this->mOneA = $this->twisted && ($IG["\141"] | 0) == -1;
        $this->extended = $this->mOneA;
        parent::__construct("\x65\x64\167\x61\x72\x64", $IG);
        $this->a = (new BN($IG["\x61"], 16))->umod($this->red->m);
        $this->a = $this->a->toRed($this->red);
        $this->c = (new BN($IG["\x63"], 16))->toRed($this->red);
        $this->c2 = $this->c->redSqr();
        $this->d = (new BN($IG["\x64"], 16))->toRed($this->red);
        $this->dd = $this->d->redAdd($this->d);
        if (!assert_options(ASSERT_ACTIVE)) {
            goto nu;
        }
        assert(!$this->twisted || $this->c->fromRed()->cmpn(1) == 0);
        nu:
        $this->oneC = ($IG["\x63"] | 0) == 1;
    }
    public function _mulA($xI)
    {
        if ($this->mOneA) {
            goto n1;
        }
        return $this->a->redMul($xI);
        goto KY;
        n1:
        return $xI->redNeg();
        KY:
    }
    public function _mulC($xI)
    {
        if ($this->oneC) {
            goto cL;
        }
        return $this->c->redMul($xI);
        goto Ew;
        cL:
        return $xI;
        Ew:
    }
    public function jpoint($f5, $o_, $sd, $mV = null)
    {
        return $this->point($f5, $o_, $sd, $mV);
    }
    public function pointFromX($f5, $V8 = false)
    {
        $f5 = new BN($f5, 16);
        if ($f5->red) {
            goto hT;
        }
        $f5 = $f5->toRed($this->red);
        hT:
        $hy = $f5->redSqr();
        $jp = $this->c2->redSub($this->a->redMul($hy));
        $on = $this->one->redSub($this->c2->redMul($this->d)->redMul($hy));
        $xQ = $jp->redMul($on->redInvm());
        $o_ = $xQ->redSqrt();
        if (!($o_->redSqr()->redSub($xQ)->cmp($this->zero) != 0)) {
            goto Yt;
        }
        throw new \Exception("\x69\156\166\141\154\151\144\40\x70\x6f\x69\156\164");
        Yt:
        $dQ = $o_->fromRed()->isOdd();
        if (!($V8 && !$dQ || !$V8 && $dQ)) {
            goto A5;
        }
        $o_ = $o_->redNeg();
        A5:
        return $this->point($f5, $o_);
    }
    public function pointFromY($o_, $V8 = false)
    {
        $o_ = new BN($o_, 16);
        if ($o_->red) {
            goto pN;
        }
        $o_ = $o_->toRed($this->red);
        pN:
        $xQ = $o_->redSqr();
        $on = $xQ->redSub($this->one);
        $jp = $xQ->redMul($this->d)->redAdd($this->one);
        $hy = $on->redMul($jp->redInvm());
        if (!($hy->cmp($this->zero) == 0)) {
            goto dt;
        }
        if ($V8) {
            goto kH;
        }
        return $this->point($this->zero, $o_);
        goto JW;
        kH:
        throw new \Exception("\x69\x6e\166\x61\154\x69\x64\x20\x70\x6f\151\x6e\x74");
        JW:
        dt:
        $f5 = $hy->redSqrt();
        if (!($f5->redSqr()->redSub($hy)->cmp($this->zero) != 0)) {
            goto il;
        }
        throw new \Exception("\x69\156\166\141\154\x69\x64\40\160\x6f\151\156\164");
        il:
        if (!($f5->isOdd() != $V8)) {
            goto ii;
        }
        $f5 = $f5->redNeg();
        ii:
        return $this->point($f5, $o_);
    }
    public function validate($bh)
    {
        if (!$bh->isInfinity()) {
            goto rO;
        }
        return true;
        rO:
        $bh->normalize();
        $hy = $bh->x->redSqr();
        $xQ = $bh->y->redSqr();
        $on = $hy->redMul($this->a)->redAdd($xQ);
        $jp = $this->c2->redMul($this->one->redAdd($this->d->redMul($hy)->redMul($xQ)));
        return $on->cmp($jp) == 0;
    }
    public function pointFromJSON($x0)
    {
        return Point::fromJSON($this, $x0);
    }
    public function point($f5 = null, $o_ = null, $sd = null, $mV = null)
    {
        return new Point($this, $f5, $o_, $sd, $mV);
    }
}
