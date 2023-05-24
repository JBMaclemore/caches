<?php


namespace BN;

require_once "\x42\151\x67\111\x6e\x74\x65\147\x65\x72\56\x70\x68\x70";
require_once "\x52\x65\x64\x2e\160\150\x70";
use JsonSerializable;
use Exception;
use BI\BigInteger;
class BN implements JsonSerializable
{
    public $bi;
    public $red;
    function __construct($sP, $RR = 10, $Ww = null)
    {
        if (!$sP instanceof BN) {
            goto ct;
        }
        $this->bi = $sP->bi;
        $this->red = $sP->red;
        return;
        ct:
        $this->red = null;
        if (!$sP instanceof BigInteger) {
            goto m4;
        }
        $this->bi = $sP;
        return;
        m4:
        if (!is_array($sP)) {
            goto Cy;
        }
        $sP = call_user_func_array("\x70\x61\143\153", array_merge(array("\103\52"), $sP));
        $sP = bin2hex($sP);
        $RR = 16;
        Cy:
        if (!($RR == "\x68\145\x78")) {
            goto kv;
        }
        $RR = 16;
        kv:
        if (!($Ww == "\154\x65")) {
            goto BM;
        }
        if (!($RR != 16)) {
            goto UJ;
        }
        throw new \Exception("\x4e\x6f\164\40\151\155\x70\x6c\145\x6d\145\x6e\x74\x65\x64");
        UJ:
        $sP = bin2hex(strrev(hex2bin($sP)));
        BM:
        $this->bi = new BigInteger($sP, $RR);
    }
    public function negative()
    {
        return $this->bi->sign() < 0 ? 1 : 0;
    }
    public static function isBN($xI)
    {
        return $xI instanceof BN;
    }
    public static function max($w8, $bw)
    {
        return $w8->cmp($bw) > 0 ? $w8 : $bw;
    }
    public static function min($w8, $bw)
    {
        return $w8->cmp($bw) < 0 ? $w8 : $bw;
    }
    public function copy($qj)
    {
        $qj->bi = $this->bi;
        $qj->red = $this->red;
    }
    public function _clone()
    {
        return clone $this;
    }
    public function toString($RR = 10, $Zm = 0)
    {
        if (!($RR == "\150\145\170")) {
            goto kt;
        }
        $RR = 16;
        kt:
        $Il = $this->bi->abs()->toString($RR);
        if (!($Zm > 0)) {
            goto pB;
        }
        $oO = strlen($Il);
        $VJ = $oO % $Zm;
        if (!($VJ > 0)) {
            goto Hj;
        }
        $oO = $oO + $Zm - $VJ;
        Hj:
        $Il = str_pad($Il, $oO, "\x30", STR_PAD_LEFT);
        pB:
        if (!$this->negative()) {
            goto Pg;
        }
        return "\x2d" . $Il;
        Pg:
        return $Il;
    }
    public function toNumber()
    {
        return $this->bi->toNumber();
    }
    public function jsonSerialize() : mixed
    {
        return $this->toString(16);
    }
    public function toArray($Ww = "\142\145", $fX = -1)
    {
        $YI = $this->toString(16);
        if (!($YI[0] === "\x2d")) {
            goto iJ;
        }
        $YI = substr($YI, 1);
        iJ:
        if (!(strlen($YI) % 2)) {
            goto j1;
        }
        $YI = "\60" . $YI;
        j1:
        $C3 = array_map(function ($qK) {
            return hexdec($qK);
        }, str_split($YI, 2));
        if (!($fX > 0)) {
            goto GM;
        }
        $aP = count($C3);
        if (!($aP > $fX)) {
            goto dI;
        }
        throw new Exception("\102\171\164\x65\40\141\162\162\x61\x79\40\154\x6f\x6e\x67\145\x72\x20\x74\x68\141\156\40\x64\x65\x73\151\x72\145\x64\40\x6c\145\156\x67\x74\x68");
        dI:
        $m8 = $aP;
        cU:
        if (!($m8 < $fX)) {
            goto Gv;
        }
        array_unshift($C3, 0);
        Jt:
        $m8++;
        goto cU;
        Gv:
        GM:
        if (!($Ww === "\x6c\x65")) {
            goto Wt;
        }
        $C3 = array_reverse($C3);
        Wt:
        return $C3;
    }
    public function bitLength()
    {
        $dH = $this->toString(2);
        return strlen($dH) - ($dH[0] === "\55" ? 1 : 0);
    }
    public function zeroBits()
    {
        return $this->bi->scan1(0);
    }
    public function byteLength()
    {
        return ceil($this->bitLength() / 8);
    }
    public function isNeg()
    {
        return $this->negative() !== 0;
    }
    public function neg()
    {
        return $this->_clone()->ineg();
    }
    public function ineg()
    {
        $this->bi = $this->bi->neg();
        return $this;
    }
    public function iuor(BN $xI)
    {
        $this->bi = $this->bi->binaryOr($xI->bi);
        return $this;
    }
    public function ior(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto Se;
        }
        assert(!$this->negative() && !$xI->negative());
        Se:
        return $this->iuor($xI);
    }
    public function _or(BN $xI)
    {
        if (!($this->ucmp($xI) > 0)) {
            goto PF;
        }
        return $this->_clone()->ior($xI);
        PF:
        return $xI->_clone()->ior($this);
    }
    public function uor(BN $xI)
    {
        if (!($this->ucmp($xI) > 0)) {
            goto bY;
        }
        return $this->_clone()->iuor($xI);
        bY:
        return $xI->_clone()->ior($this);
    }
    public function iuand(BN $xI)
    {
        $this->bi = $this->bi->binaryAnd($xI->bi);
        return $this;
    }
    public function iand(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto vk;
        }
        assert(!$this->negative() && !$xI->negative());
        vk:
        return $this->iuand($xI);
    }
    public function _and(BN $xI)
    {
        if (!($this->ucmp($xI) > 0)) {
            goto rH;
        }
        return $this->_clone()->iand($xI);
        rH:
        return $xI->_clone()->iand($this);
    }
    public function uand(BN $xI)
    {
        if (!($this->ucmp($xI) > 0)) {
            goto F1;
        }
        return $this->_clone()->iuand($xI);
        F1:
        return $xI->_clone()->iuand($this);
    }
    public function iuxor(BN $xI)
    {
        $this->bi = $this->bi->binaryXor($xI->bi);
        return $this;
    }
    public function ixor(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto k6;
        }
        assert(!$this->negative() && !$xI->negative());
        k6:
        return $this->iuxor($xI);
    }
    public function _xor(BN $xI)
    {
        if (!($this->ucmp($xI) > 0)) {
            goto lu;
        }
        return $this->_clone()->ixor($xI);
        lu:
        return $xI->_clone()->ixor($this);
    }
    public function uxor(BN $xI)
    {
        if (!($this->ucmp($xI) > 0)) {
            goto dv;
        }
        return $this->_clone()->iuxor($xI);
        dv:
        return $xI->_clone()->iuxor($this);
    }
    public function inotn($pK)
    {
        assert(is_integer($pK) && $pK >= 0);
        $NM = false;
        if (!$this->isNeg()) {
            goto S_;
        }
        $this->negi();
        $NM = true;
        S_:
        $m8 = 0;
        z8:
        if (!($m8 < $pK)) {
            goto VN;
        }
        $this->bi = $this->bi->setbit($m8, !$this->bi->testbit($m8));
        rY:
        $m8++;
        goto z8;
        VN:
        return $NM ? $this->negi() : $this;
    }
    public function notn($pK)
    {
        return $this->_clone()->inotn($pK);
    }
    public function setn($FO, $HZ)
    {
        assert(is_integer($FO) && $FO > 0);
        $this->bi = $this->bi->setbit($FO, !!$HZ);
        return $this;
    }
    public function iadd(BN $xI)
    {
        $this->bi = $this->bi->add($xI->bi);
        return $this;
    }
    public function add(BN $xI)
    {
        return $this->_clone()->iadd($xI);
    }
    public function isub(BN $xI)
    {
        $this->bi = $this->bi->sub($xI->bi);
        return $this;
    }
    public function sub(BN $xI)
    {
        return $this->_clone()->isub($xI);
    }
    public function mul(BN $xI)
    {
        return $this->_clone()->imul($xI);
    }
    public function imul(BN $xI)
    {
        $this->bi = $this->bi->mul($xI->bi);
        return $this;
    }
    public function imuln($xI)
    {
        assert(is_numeric($xI));
        $wY = intval($xI);
        $cT = $this->bi->mul($wY);
        if (!($xI - $wY > 0)) {
            goto Vh;
        }
        $hn = 10;
        $eo = ($xI - $wY) * $hn;
        $wY = intval($eo);
        xk:
        if (!($eo - $wY > 0)) {
            goto o_;
        }
        $hn *= 10;
        $eo *= 10;
        $wY = intval($eo);
        goto xk;
        o_:
        $Sp = $this->bi->mul($wY);
        $Sp = $Sp->div($hn);
        $cT = $cT->add($Sp);
        Vh:
        $this->bi = $cT;
        return $this;
    }
    public function muln($xI)
    {
        return $this->_clone()->imuln($xI);
    }
    public function sqr()
    {
        return $this->mul($this);
    }
    public function isqr()
    {
        return $this->imul($this);
    }
    public function pow(BN $xI)
    {
        $cT = clone $this;
        $cT->bi = $cT->bi->pow($xI->bi);
        return $cT;
    }
    public function iushln($ED)
    {
        assert(is_integer($ED) && $ED >= 0);
        if ($ED < 54) {
            goto C2;
        }
        $this->bi = $this->bi->mul((new BigInteger(2))->pow($ED));
        goto XS;
        C2:
        $this->bi = $this->bi->mul(1 << $ED);
        XS:
        return $this;
    }
    public function ishln($ED)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto sW;
        }
        assert(!$this->negative());
        sW:
        return $this->iushln($ED);
    }
    public function iushrn($ED, $DM = 0, &$pg = null)
    {
        if (!($DM != 0)) {
            goto UD;
        }
        throw new Exception("\116\157\x74\x20\x69\155\x70\154\x65\155\x65\x6e\164\x65\x64");
        UD:
        assert(is_integer($ED) && $ED >= 0);
        if (!($pg != null)) {
            goto sp;
        }
        $pg = $this->maskn($ED);
        sp:
        if ($ED < 54) {
            goto eJ;
        }
        $this->bi = $this->bi->div((new BigInteger(2))->pow($ED));
        goto hc;
        eJ:
        $this->bi = $this->bi->div(1 << $ED);
        hc:
        return $this;
    }
    public function ishrn($ED, $DM = null, $pg = null)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto M5;
        }
        assert(!$this->negative());
        M5:
        return $this->iushrn($ED, $DM, $pg);
    }
    public function shln($ED)
    {
        return $this->_clone()->ishln($ED);
    }
    public function ushln($ED)
    {
        return $this->_clone()->iushln($ED);
    }
    public function shrn($ED)
    {
        return $this->_clone()->ishrn($ED);
    }
    public function ushrn($ED)
    {
        return $this->_clone()->iushrn($ED);
    }
    public function testn($FO)
    {
        assert(is_integer($FO) && $FO >= 0);
        return $this->bi->testbit($FO);
    }
    public function imaskn($ED)
    {
        assert(is_integer($ED) && $ED >= 0);
        if (!assert_options(ASSERT_ACTIVE)) {
            goto Gd;
        }
        assert(!$this->negative());
        Gd:
        $Bi = '';
        $m8 = 0;
        a6:
        if (!($m8 < $ED)) {
            goto AW;
        }
        $Bi .= "\x31";
        Fr:
        $m8++;
        goto a6;
        AW:
        return $this->iand(new BN($Bi, 2));
    }
    public function maskn($ED)
    {
        return $this->_clone()->imaskn($ED);
    }
    public function iaddn($xI)
    {
        assert(is_numeric($xI));
        $this->bi = $this->bi->add(intval($xI));
        return $this;
    }
    public function isubn($xI)
    {
        assert(is_numeric($xI));
        $this->bi = $this->bi->sub(intval($xI));
        return $this;
    }
    public function addn($xI)
    {
        return $this->_clone()->iaddn($xI);
    }
    public function subn($xI)
    {
        return $this->_clone()->isubn($xI);
    }
    public function iabs()
    {
        if (!($this->bi->sign() < 0)) {
            goto vE;
        }
        $this->bi = $this->bi->abs();
        vE:
        return $this;
    }
    public function abs()
    {
        $cT = clone $this;
        if (!($cT->bi->sign() < 0)) {
            goto eZ;
        }
        $cT->bi = $cT->bi->abs();
        eZ:
        return $cT;
    }
    public function div(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto Ry;
        }
        assert(!$xI->isZero());
        Ry:
        $cT = clone $this;
        $cT->bi = $cT->bi->div($xI->bi);
        return $cT;
    }
    public function mod(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto L0;
        }
        assert(!$xI->isZero());
        L0:
        $cT = clone $this;
        $cT->bi = $cT->bi->divR($xI->bi);
        return $cT;
    }
    public function umod(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto YR;
        }
        assert(!$xI->isZero());
        YR:
        $Sp = $xI->bi->sign() < 0 ? $xI->bi->abs() : $xI->bi;
        $cT = clone $this;
        $cT->bi = $this->bi->mod($Sp);
        return $cT;
    }
    public function divRound(BN $xI)
    {
        if (!assert_options(ASSERT_ACTIVE)) {
            goto IY;
        }
        assert(!$xI->isZero());
        IY:
        $Xh = $this->negative() !== $xI->negative();
        $cT = $this->_clone()->abs();
        $oi = $cT->bi->divQR($xI->bi->abs());
        $cT->bi = $oi[0];
        $Sp = $xI->bi->sub($oi[1]->mul(2));
        if (!($Sp->cmp(0) <= 0 && (!$Xh || $this->negative() === 0))) {
            goto C8;
        }
        $cT->iaddn(1);
        C8:
        return $Xh ? $cT->negi() : $cT;
    }
    public function modn($xI)
    {
        assert(is_numeric($xI) && $xI != 0);
        return $this->bi->divR(intval($xI))->toNumber();
    }
    public function idivn($xI)
    {
        assert(is_numeric($xI) && $xI != 0);
        $this->bi = $this->bi->div(intval($xI));
        return $this;
    }
    public function divn($xI)
    {
        return $this->_clone()->idivn($xI);
    }
    public function gcd(BN $xI)
    {
        $cT = clone $this;
        $cT->bi = $this->bi->gcd($xI->bi);
        return $cT;
    }
    public function invm(BN $xI)
    {
        $cT = clone $this;
        $cT->bi = $cT->bi->modInverse($xI->bi);
        return $cT;
    }
    public function isEven()
    {
        return !$this->bi->testbit(0);
    }
    public function isOdd()
    {
        return $this->bi->testbit(0);
    }
    public function andln($xI)
    {
        assert(is_numeric($xI));
        return $this->bi->binaryAnd($xI)->toNumber();
    }
    public function bincn($xI)
    {
        $Sp = (new BN(1))->iushln($xI);
        return $this->add($Sp);
    }
    public function isZero()
    {
        return $this->bi->sign() == 0;
    }
    public function cmpn($xI)
    {
        assert(is_numeric($xI));
        return $this->bi->cmp($xI);
    }
    public function cmp(BN $xI)
    {
        return $this->bi->cmp($xI->bi);
    }
    public function ucmp(BN $xI)
    {
        return $this->bi->abs()->cmp($xI->bi->abs());
    }
    public function gtn($xI)
    {
        return $this->cmpn($xI) > 0;
    }
    public function gt(BN $xI)
    {
        return $this->cmp($xI) > 0;
    }
    public function gten($xI)
    {
        return $this->cmpn($xI) >= 0;
    }
    public function gte(BN $xI)
    {
        return $this->cmp($xI) >= 0;
    }
    public function ltn($xI)
    {
        return $this->cmpn($xI) < 0;
    }
    public function lt(BN $xI)
    {
        return $this->cmp($xI) < 0;
    }
    public function lten($xI)
    {
        return $this->cmpn($xI) <= 0;
    }
    public function lte(BN $xI)
    {
        return $this->cmp($xI) <= 0;
    }
    public function eqn($xI)
    {
        return $this->cmpn($xI) === 0;
    }
    public function eq(BN $xI)
    {
        return $this->cmp($xI) === 0;
    }
    public function toRed(Red &$B8)
    {
        if (!($this->red !== null)) {
            goto uk;
        }
        throw new Exception("\101\154\162\x65\x61\x64\x79\x20\141\40\x6e\165\155\142\145\162\x20\151\156\40\x72\145\x64\x75\143\164\151\157\156\x20\143\157\156\164\145\170\164");
        uk:
        if (!($this->negative() !== 0)) {
            goto w6;
        }
        throw new Exception("\x72\x65\144\40\167\x6f\162\153\163\40\157\156\154\x79\40\x77\x69\164\150\40\160\x6f\x73\151\164\x69\x76\145\x73");
        w6:
        return $B8->convertTo($this)->_forceRed($B8);
    }
    public function fromRed()
    {
        if (!($this->red === null)) {
            goto ng;
        }
        throw new Exception("\x66\162\x6f\155\x52\x65\144\40\167\x6f\x72\153\163\40\157\x6e\154\171\x20\x77\x69\x74\150\40\x6e\165\x6d\142\x65\x72\x73\x20\151\156\40\162\x65\x64\165\x63\x74\x69\157\156\x20\x63\x6f\x6e\164\x65\x78\164");
        ng:
        return $this->red->convertFrom($this);
    }
    public function _forceRed(Red &$B8)
    {
        $this->red = $B8;
        return $this;
    }
    public function forceRed(Red &$B8)
    {
        if (!($this->red !== null)) {
            goto MA;
        }
        throw new Exception("\101\154\162\145\x61\144\171\x20\141\40\x6e\165\x6d\x62\x65\x72\40\x69\156\x20\162\x65\144\x75\x63\164\151\x6f\x6e\x20\x63\157\x6e\x74\145\x78\164");
        MA:
        return $this->_forceRed($B8);
    }
    public function redAdd(BN $xI)
    {
        if (!($this->red === null)) {
            goto ve;
        }
        throw new Exception("\x72\x65\x64\x41\x64\x64\x20\167\x6f\x72\x6b\163\x20\x6f\x6e\154\x79\x20\167\x69\x74\x68\40\x72\145\x64\40\156\165\x6d\x62\x65\162\163");
        ve:
        $cT = clone $this;
        $cT->bi = $cT->bi->add($xI->bi);
        if (!($cT->bi->cmp($this->red->m->bi) >= 0)) {
            goto dc;
        }
        $cT->bi = $cT->bi->sub($this->red->m->bi);
        dc:
        return $cT;
    }
    public function redIAdd(BN $xI)
    {
        if (!($this->red === null)) {
            goto XK;
        }
        throw new Exception("\x72\x65\144\111\x41\144\x64\x20\167\157\162\x6b\x73\40\x6f\156\154\x79\40\167\151\164\x68\40\162\145\x64\x20\156\165\x6d\142\x65\162\163");
        XK:
        $cT = $this;
        $cT->bi = $cT->bi->add($xI->bi);
        if (!($cT->bi->cmp($this->red->m->bi) >= 0)) {
            goto EK;
        }
        $cT->bi = $cT->bi->sub($this->red->m->bi);
        EK:
        return $cT;
    }
    public function redSub(BN $xI)
    {
        if (!($this->red === null)) {
            goto Lu;
        }
        throw new Exception("\162\145\x64\123\x75\142\x20\x77\x6f\162\x6b\163\x20\157\x6e\154\171\40\167\151\x74\150\x20\162\x65\x64\40\x6e\x75\x6d\142\145\162\163");
        Lu:
        $cT = clone $this;
        $cT->bi = $this->bi->sub($xI->bi);
        if (!($cT->bi->sign() < 0)) {
            goto YZ;
        }
        $cT->bi = $cT->bi->add($this->red->m->bi);
        YZ:
        return $cT;
    }
    public function redISub(BN $xI)
    {
        if (!($this->red === null)) {
            goto iI;
        }
        throw new Exception("\162\x65\x64\111\123\x75\x62\40\x77\x6f\162\153\x73\40\157\156\x6c\171\x20\167\151\164\150\40\162\x65\144\40\156\x75\155\x62\x65\162\x73");
        iI:
        $this->bi = $this->bi->sub($xI->bi);
        if (!($this->bi->sign() < 0)) {
            goto sD;
        }
        $this->bi = $this->bi->add($this->red->m->bi);
        sD:
        return $this;
    }
    public function redShl(BN $xI)
    {
        if (!($this->red === null)) {
            goto LM;
        }
        throw new Exception("\162\145\144\x53\x68\x6c\40\x77\157\162\153\x73\40\157\x6e\x6c\171\40\167\x69\x74\x68\40\162\x65\144\40\x6e\x75\x6d\142\x65\162\x73");
        LM:
        return $this->red->shl($this, $xI);
    }
    public function redMul(BN $xI)
    {
        if (!($this->red === null)) {
            goto bu;
        }
        throw new Exception("\x72\145\144\115\165\x6c\x20\x77\x6f\162\153\163\x20\157\156\154\171\x20\167\151\x74\x68\x20\x72\x65\x64\x20\156\x75\x6d\142\x65\162\163");
        bu:
        $cT = clone $this;
        $cT->bi = $this->bi->mul($xI->bi)->mod($this->red->m->bi);
        return $cT;
    }
    public function redIMul(BN $xI)
    {
        if (!($this->red === null)) {
            goto jg;
        }
        throw new Exception("\162\145\144\x49\115\x75\154\x20\167\x6f\162\153\x73\40\157\156\x6c\x79\x20\167\x69\164\150\x20\x72\145\x64\40\x6e\x75\x6d\142\x65\162\163");
        jg:
        $this->bi = $this->bi->mul($xI->bi)->mod($this->red->m->bi);
        return $this;
    }
    public function redSqr()
    {
        if (!($this->red === null)) {
            goto We;
        }
        throw new Exception("\x72\x65\144\123\161\x72\40\167\157\x72\x6b\163\40\x6f\x6e\154\x79\x20\x77\x69\x74\x68\x20\x72\145\144\x20\x6e\x75\x6d\142\x65\162\x73");
        We:
        $cT = clone $this;
        $cT->bi = $this->bi->mul($this->bi)->mod($this->red->m->bi);
        return $cT;
    }
    public function redISqr()
    {
        if (!($this->red === null)) {
            goto o1;
        }
        throw new Exception("\x72\145\144\x49\123\x71\162\x20\167\x6f\x72\x6b\x73\x20\x6f\156\x6c\171\40\167\x69\164\150\40\162\x65\144\x20\156\165\155\142\x65\x72\x73");
        o1:
        $cT = $this;
        $cT->bi = $this->bi->mul($this->bi)->mod($this->red->m->bi);
        return $cT;
    }
    public function redSqrt()
    {
        if (!($this->red === null)) {
            goto G5;
        }
        throw new Exception("\162\145\144\123\161\x72\x74\40\x77\157\162\x6b\163\40\x6f\x6e\154\x79\40\x77\151\x74\150\x20\x72\145\x64\x20\156\x75\155\142\x65\162\x73");
        G5:
        $this->red->verify1($this);
        return $this->red->sqrt($this);
    }
    public function redInvm()
    {
        if (!($this->red === null)) {
            goto b3;
        }
        throw new Exception("\x72\145\144\111\156\166\155\x20\167\x6f\162\x6b\163\40\157\x6e\x6c\171\40\167\x69\164\x68\x20\162\x65\x64\x20\156\x75\x6d\x62\145\162\x73");
        b3:
        $this->red->verify1($this);
        return $this->red->invm($this);
    }
    public function redNeg()
    {
        if (!($this->red === null)) {
            goto UE;
        }
        throw new Exception("\162\x65\144\x4e\145\147\x20\167\x6f\x72\x6b\163\x20\x6f\x6e\154\x79\x20\167\151\x74\x68\40\162\145\144\x20\x6e\x75\155\x62\145\x72\x73");
        UE:
        $this->red->verify1($this);
        return $this->red->neg($this);
    }
    public function redPow(BN $xI)
    {
        $this->red->verify2($this, $xI);
        return $this->red->pow($this, $xI);
    }
    public static function red($xI)
    {
        return new Red($xI);
    }
    public static function mont($xI)
    {
        return new Red($xI);
    }
    public function inspect()
    {
        return ($this->red == null ? "\74\x42\116\x3a\x20" : "\x3c\x42\x4e\55\x52\72\x20") . $this->toString(16) . "\x3e";
    }
    public function __debugInfo()
    {
        if ($this->red != null) {
            goto fH;
        }
        return ["\x42\116" => $this->toString(16)];
        goto W0;
        fH:
        return ["\x42\116\x2d\122" => $this->toString(16)];
        W0:
    }
}
