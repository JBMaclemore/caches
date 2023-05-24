<?php


namespace Elliptic\Curve;

require_once "\x4d\157\156\x74\103\165\162\x76\x65\57\x50\157\x69\x6e\x74\x2e\x70\150\160";
use Elliptic\Curve\MontCurve\Point;
use Elliptic\Utils;
use BN\BN;
class MontCurve extends BaseCurve
{
    public $a;
    public $b;
    public $i4;
    public $a24;
    function __construct($IG)
    {
        parent::__construct("\155\157\x6e\164", $IG);
        $this->a = (new BN($IG["\141"], 16))->toRed($this->red);
        $this->b = (new BN($IG["\142"], 16))->toRed($this->red);
        $this->i4 = (new BN(4))->toRed($this->red)->redInvm();
        $this->a24 = $this->i4->redMul($this->a->redAdd($this->two));
    }
    public function validate($bh)
    {
        $f5 = $bh->normalize()->x;
        $hy = $f5->redSqr();
        $jp = $hy->redMul($f5)->redAdd($hy->redMul($this->a))->redAdd($f5);
        $o_ = $jp->redSqr();
        return $o_->redSqr()->cmp($jp) === 0;
    }
    public function decodePoint($C3, $B1 = false)
    {
        return $this->point(Utils::toArray($C3, $B1), 1);
    }
    public function point($f5, $sd)
    {
        return new Point($this, $f5, $sd);
    }
    public function pointFromJSON($x0)
    {
        return Point::fromJSON($this, $x0);
    }
}
