<?php


namespace Elliptic;

require_once "\113\x65\x79\x50\141\151\x72\56\160\x68\x70";
require_once "\123\151\x67\156\141\164\165\162\145\x2e\x70\150\160";
require_once "\x42\x4e\x2e\x70\x68\x70";
use Elliptic\Curve\PresetCurve;
use Elliptic\EC\KeyPair;
use Elliptic\EC\Signature;
use BN\BN;
class EC
{
    public $curve;
    public $n;
    public $nh;
    public $g;
    public $hash;
    function __construct($Iq)
    {
        if (!is_string($Iq)) {
            goto Xv;
        }
        $Iq = Curves::getCurve($Iq);
        Xv:
        if (!$Iq instanceof PresetCurve) {
            goto ah;
        }
        $Iq = array("\x63\x75\x72\166\145" => $Iq);
        ah:
        $this->curve = $Iq["\x63\x75\162\x76\x65"]->curve;
        $this->n = $this->curve->n;
        $this->nh = $this->n->ushrn(1);
        $this->g = $Iq["\x63\x75\162\166\x65"]->g;
        $this->g->precompute($Iq["\143\x75\x72\x76\x65"]->n->bitLength() + 1);
        if (isset($Iq["\x68\x61\163\x68"])) {
            goto GJ;
        }
        $this->hash = $Iq["\x63\x75\x72\x76\145"]->hash;
        goto FV;
        GJ:
        $this->hash = $Iq["\150\141\163\150"];
        FV:
    }
    public function keyPair($Iq)
    {
        return new KeyPair($this, $Iq);
    }
    public function keyFromPrivate($cs, $B1 = false)
    {
        return KeyPair::fromPrivate($this, $cs, $B1);
    }
    public function keyFromPublic($OW, $B1 = false)
    {
        return KeyPair::fromPublic($this, $OW, $B1);
    }
    public function genKeyPair($Iq = null)
    {
        $fl = new HmacDRBG(array("\150\141\163\150" => $this->hash, "\160\145\162\163" => isset($Iq["\x70\145\x72\163"]) ? $Iq["\x70\145\162\163"] : '', "\x65\156\x74\x72\x6f\x70\x79" => isset($Iq["\145\156\164\x72\157\160\171"]) ? $Iq["\x65\156\x74\162\x6f\160\171"] : Utils::randBytes($this->hash["\150\x6d\141\x63\123\164\x72\x65\156\147\x74\x68"]), "\156\157\156\x63\145" => $this->n->toArray()));
        $C3 = $this->n->byteLength();
        $UG = $this->n->sub(new BN(2));
        nE:
        if (!true) {
            goto HP;
        }
        $cs = new BN($fl->generate($C3));
        if (!($cs->cmp($UG) > 0)) {
            goto y_;
        }
        goto nE;
        y_:
        $cs->iaddn(1);
        return $this->keyFromPrivate($cs);
        goto nE;
        HP:
    }
    private function _truncateToN($U2, $qu = false)
    {
        $Yy = intval($U2->byteLength() * 8 - $this->n->bitLength());
        if (!($Yy > 0)) {
            goto ig;
        }
        $U2 = $U2->ushrn($Yy);
        ig:
        if (!($qu || $U2->cmp($this->n) < 0)) {
            goto Bu;
        }
        return $U2;
        Bu:
        return $U2->sub($this->n);
    }
    public function sign($U2, $ai, $B1 = null, $Iq = null)
    {
        if (is_string($B1)) {
            goto dT;
        }
        $Iq = $B1;
        $B1 = null;
        dT:
        $ai = $this->keyFromPrivate($ai, $B1);
        $U2 = $this->_truncateToN(new BN($U2, 16));
        $C3 = $this->n->byteLength();
        $a9 = $ai->getPrivate()->toArray("\x62\x65", $C3);
        $Jr = $U2->toArray("\142\x65", $C3);
        $EW = null;
        if (isset($Iq["\153"])) {
            goto w9;
        }
        $fl = new HmacDRBG(array("\150\141\x73\x68" => $this->hash, "\145\156\x74\162\x6f\x70\x79" => $a9, "\x6e\x6f\156\x63\x65" => $Jr, "\160\x65\x72\x73" => isset($Iq["\x70\x65\162\163"]) ? $Iq["\x70\x65\x72\x73"] : '', "\x70\145\162\x73\105\x6e\x63" => isset($Iq["\x70\145\162\163\x45\156\x63"]) ? $Iq["\160\x65\162\x73\x45\156\x63"] : false));
        $EW = function ($Gy) use($fl, $C3) {
            return new BN($fl->generate($C3));
        };
        goto mq;
        w9:
        $EW = $Iq["\153"];
        mq:
        $EH = $this->n->sub(new BN(1));
        $Ej = isset($Iq["\x63\141\x6e\x6f\x6e\x69\143\141\154"]) ? $Iq["\143\141\x6e\x6f\156\x69\x63\141\154"] : false;
        $Gy = 0;
        aR:
        if (!true) {
            goto rU;
        }
        $OZ = $EW($Gy);
        $OZ = $this->_truncateToN($OZ, true);
        if (!($OZ->cmpn(1) <= 0 || $OZ->cmp($EH) >= 0)) {
            goto bN;
        }
        goto tE;
        bN:
        $eb = $this->g->mul($OZ);
        if (!$eb->isInfinity()) {
            goto aK;
        }
        goto tE;
        aK:
        $Dt = $eb->getX();
        $G4 = $Dt->umod($this->n);
        if (!$G4->isZero()) {
            goto jD;
        }
        goto tE;
        jD:
        $p8 = $OZ->invm($this->n)->mul($G4->mul($ai->getPrivate())->iadd($U2));
        $p8 = $p8->umod($this->n);
        if (!$p8->isZero()) {
            goto id;
        }
        goto tE;
        id:
        $aa = ($eb->getY()->isOdd() ? 1 : 0) | ($Dt->cmp($G4) !== 0 ? 2 : 0);
        if (!($Ej && $p8->cmp($this->nh) > 0)) {
            goto Hq;
        }
        $p8 = $this->n->sub($p8);
        $aa ^= 1;
        Hq:
        return new Signature(array("\x72" => $G4, "\x73" => $p8, "\x72\x65\x63\x6f\166\145\x72\x79\120\x61\162\141\x6d" => $aa));
        tE:
        $Gy++;
        goto aR;
        rU:
    }
    public function verify($U2, $t0, $ai, $B1 = false)
    {
        $U2 = $this->_truncateToN(new BN($U2, 16));
        $ai = $this->keyFromPublic($ai, $B1);
        $t0 = new Signature($t0, "\150\145\x78");
        $G4 = $t0->r;
        $p8 = $t0->s;
        if (!($G4->cmpn(1) < 0 || $G4->cmp($this->n) >= 0)) {
            goto bj;
        }
        return false;
        bj:
        if (!($p8->cmpn(1) < 0 || $p8->cmp($this->n) >= 0)) {
            goto gi;
        }
        return false;
        gi:
        $lz = $p8->invm($this->n);
        $oD = $lz->mul($U2)->umod($this->n);
        $tC = $lz->mul($G4)->umod($this->n);
        if ($this->curve->_maxwellTrick) {
            goto oF;
        }
        $g1 = $this->g->mulAdd($oD, $ai->getPublic(), $tC);
        if (!$g1->isInfinity()) {
            goto lB;
        }
        return false;
        lB:
        return $g1->getX()->umod($this->n)->cmp($G4) === 0;
        oF:
        $g1 = $this->g->jmulAdd($oD, $ai->getPublic(), $tC);
        if (!$g1->isInfinity()) {
            goto Wl;
        }
        return false;
        Wl:
        return $g1->eqXToP($G4);
    }
    public function recoverPubKey($U2, $t0, $Dd, $B1 = false)
    {
        assert((3 & $Dd) === $Dd);
        $t0 = new Signature($t0, $B1);
        $uP = new BN($U2, 16);
        $G4 = $t0->r;
        $p8 = $t0->s;
        $Ab = ($Dd & 1) == 1;
        $M1 = $Dd >> 1;
        if (!($G4->cmp($this->curve->p->umod($this->curve->n)) >= 0 && $M1)) {
            goto Yr;
        }
        throw new \Exception("\x55\156\141\142\154\x65\x20\x74\157\40\x66\151\x6e\x64\x20\x73\145\143\x6f\156\144\40\153\x65\x79\x20\x63\x61\x6e\x64\151\x6e\x61\x74\145");
        Yr:
        if ($M1) {
            goto Nr;
        }
        $G4 = $this->curve->pointFromX($G4, $Ab);
        goto kP;
        Nr:
        $G4 = $this->curve->pointFromX($G4->add($this->curve->n), $Ab);
        kP:
        $m0 = $this->n->sub($uP);
        $Wt = $t0->r->invm($this->n);
        return $this->g->mulAdd($m0, $G4, $p8)->mul($Wt);
    }
    public function getKeyRecoveryParam($uP, $t0, $F7, $B1 = false)
    {
        $t0 = new Signature($t0, $B1);
        if (!($t0->recoveryParam != null)) {
            goto q4;
        }
        return $t0->recoveryParam;
        q4:
        $m8 = 0;
        Rk:
        if (!($m8 < 4)) {
            goto OU;
        }
        $iM = null;
        try {
            $iM = $this->recoverPubKey($uP, $t0, $m8);
        } catch (\Exception $uP) {
            goto ft;
        }
        if (!$iM->eq($F7)) {
            goto fC;
        }
        return $m8;
        fC:
        ft:
        $m8++;
        goto Rk;
        OU:
        throw new \Exception("\125\x6e\x61\142\x6c\145\40\164\157\40\146\x69\x6e\x64\x20\x76\141\154\151\144\x20\x72\x65\143\x6f\x76\145\162\171\40\146\x61\x63\x74\157\x72");
    }
}
