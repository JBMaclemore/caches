<?php


namespace Elliptic\Curve\ShortCurve;

use BN\BN;
class JPoint extends \Elliptic\Curve\BaseCurve\Point
{
    public $x;
    public $y;
    public $z;
    public $zOne;
    function __construct($SK, $f5, $o_, $sd)
    {
        parent::__construct($SK, "\152\x61\x63\157\x62\151\x61\156");
        if ($f5 == null && $o_ == null && $sd == null) {
            goto sz;
        }
        $this->x = new BN($f5, 16);
        $this->y = new BN($o_, 16);
        $this->z = new BN($sd, 16);
        goto Pz;
        sz:
        $this->x = $this->curve->one;
        $this->y = $this->curve->one;
        $this->z = new BN(0);
        Pz:
        if ($this->x->red) {
            goto cN;
        }
        $this->x = $this->x->toRed($this->curve->red);
        cN:
        if ($this->y->red) {
            goto xn;
        }
        $this->y = $this->y->toRed($this->curve->red);
        xn:
        if ($this->z->red) {
            goto g9;
        }
        $this->z = $this->z->toRed($this->curve->red);
        g9:
        return $this->zOne = $this->z == $this->curve->one;
    }
    public function toP()
    {
        if (!$this->isInfinity()) {
            goto MM;
        }
        return $this->curve->point(null, null);
        MM:
        $gr = $this->z->redInvm();
        $n1 = $gr->redSqr();
        $le = $this->x->redMul($n1);
        $aC = $this->y->redMul($n1)->redMul($gr);
        return $this->curve->point($le, $aC);
    }
    public function neg()
    {
        return $this->curve->jpoint($this->x, $this->y->redNeg(), $this->z);
    }
    public function add($g1)
    {
        if (!$this->isInfinity()) {
            goto dh;
        }
        return $g1;
        dh:
        if (!$g1->isInfinity()) {
            goto r4;
        }
        return $this;
        r4:
        $Cm = $g1->z->redSqr();
        $XZ = $this->z->redSqr();
        $oD = $this->x->redMul($Cm);
        $tC = $g1->x->redMul($XZ);
        $IJ = $this->y->redMul($Cm->redMul($g1->z));
        $kD = $g1->y->redMul($XZ->redMul($this->z));
        $R6 = $oD->redSub($tC);
        $G4 = $IJ->redSub($kD);
        if (!$R6->isZero()) {
            goto DU;
        }
        if (!$G4->isZero()) {
            goto iA;
        }
        return $this->dbl();
        goto cG;
        iA:
        return $this->curve->jpoint(null, null, null);
        cG:
        DU:
        $bm = $R6->redSqr();
        $Fa = $bm->redMul($R6);
        $qK = $oD->redMul($bm);
        $W5 = $G4->redSqr()->redIAdd($Fa)->redISub($qK)->redISub($qK);
        $TL = $G4->redMul($qK->redISub($W5))->redISub($IJ->redMul($Fa));
        $fi = $this->z->redMul($g1->z)->redMul($R6);
        return $this->curve->jpoint($W5, $TL, $fi);
    }
    public function mixedAdd($g1)
    {
        if (!$this->isInfinity()) {
            goto Ot;
        }
        return $g1->toJ();
        Ot:
        if (!$g1->isInfinity()) {
            goto lr;
        }
        return $this;
        lr:
        $XZ = $this->z->redSqr();
        $oD = $this->x;
        $tC = $g1->x->redMul($XZ);
        $IJ = $this->y;
        $kD = $g1->y->redMul($XZ)->redMul($this->z);
        $R6 = $oD->redSub($tC);
        $G4 = $IJ->redSub($kD);
        if (!$R6->isZero()) {
            goto cT;
        }
        if (!$G4->isZero()) {
            goto AI;
        }
        return $this->dbl();
        goto DL;
        AI:
        return $this->curve->jpoint(null, null, null);
        DL:
        cT:
        $bm = $R6->redSqr();
        $Fa = $bm->redMul($R6);
        $qK = $oD->redMul($bm);
        $W5 = $G4->redSqr()->redIAdd($Fa)->redISub($qK)->redISub($qK);
        $TL = $G4->redMul($qK->redISub($W5))->redISub($IJ->redMul($Fa));
        $fi = $this->z->redMul($R6);
        return $this->curve->jpoint($W5, $TL, $fi);
    }
    public function dblp($Ds = null)
    {
        if (!($Ds == 0 || $this->isInfinity())) {
            goto fE;
        }
        return $this;
        fE:
        if (!($Ds == null)) {
            goto PC;
        }
        return $this->dbl();
        PC:
        if (!($this->curve->zeroA || $this->curve->threeA)) {
            goto DN;
        }
        $G4 = $this;
        $m8 = 0;
        P9:
        if (!($m8 < $Ds)) {
            goto Nx;
        }
        $G4 = $G4->dbl();
        xC:
        $m8++;
        goto P9;
        Nx:
        return $G4;
        DN:
        $j_ = $this->x;
        $BK = $this->y;
        $Ja = $this->z;
        $Vi = $Ja->redSqr()->redSqr();
        $IU = $BK->redAdd($BK);
        $m8 = 0;
        XW:
        if (!($m8 < $Ds)) {
            goto Re;
        }
        $zW = $j_->redSqr();
        $JO = $IU->redSqr();
        $ap = $JO->redSqr();
        $Ux = $zW->redAdd($zW)->redIAdd($zW)->redIAdd($this->curve->a->redMul($Vi));
        $AQ = $j_->redMul($JO);
        $W5 = $Ux->redSqr()->redISub($AQ->redAdd($AQ));
        $Si = $AQ->redISub($W5);
        $F1 = $Ux->redMul($Si);
        $F1 = $F1->redIAdd($F1)->redISub($ap);
        $fi = $IU->redMul($Ja);
        if (!($m8 + 1 < $Ds)) {
            goto DT;
        }
        $Vi = $Vi->redMul($ap);
        DT:
        $j_ = $W5;
        $Ja = $fi;
        $IU = $F1;
        MT:
        $m8++;
        goto XW;
        Re:
        return $this->curve->jpoint($j_, $IU->redMul($this->curve->tinv), $Ja);
    }
    public function dbl()
    {
        if (!$this->isInfinity()) {
            goto aD;
        }
        return $this;
        aD:
        if ($this->curve->zeroA) {
            goto oD;
        }
        if ($this->curve->threeA) {
            goto G_;
        }
        goto yA;
        oD:
        return $this->_zeroDbl();
        goto yA;
        G_:
        return $this->_threeDbl();
        yA:
        return $this->_dbl();
    }
    private function _zOneDbl($oj)
    {
        $O9 = $this->x->redSqr();
        $Cu = $this->y->redSqr();
        $qB = $Cu->redSqr();
        $p8 = $this->x->redAdd($Cu)->redSqr()->redISub($O9)->redISub($qB);
        $p8 = $p8->redIAdd($p8);
        $gw = null;
        if ($oj) {
            goto db;
        }
        $gw = $O9->redAdd($O9)->redIAdd($O9);
        goto Wq;
        db:
        $gw = $O9->redAdd($O9)->redIAdd($O9)->redIAdd($this->curve->a);
        Wq:
        $mV = $gw->redSqr()->redISub($p8)->redISub($p8);
        $KU = $qB->redIAdd($qB);
        $KU = $KU->redIAdd($KU);
        $KU = $KU->redIAdd($KU);
        $TL = $gw->redMul($p8->redISub($mV))->redISub($KU);
        $fi = $this->y->redAdd($this->y);
        return $this->curve->jpoint($mV, $TL, $fi);
    }
    private function _zeroDbl()
    {
        if (!$this->zOne) {
            goto EF;
        }
        return $this->_zOneDbl(false);
        EF:
        $TA = $this->x->redSqr();
        $nC = $this->y->redSqr();
        $Ux = $nC->redSqr();
        $py = $this->x->redAdd($nC)->redSqr()->redISub($TA)->redISub($Ux);
        $py = $py->redIAdd($py);
        $uP = $TA->redAdd($TA)->redIAdd($TA);
        $GQ = $uP->redSqr();
        $tG = $Ux->redIAdd($Ux);
        $tG = $tG->redIAdd($tG);
        $tG = $tG->redIAdd($tG);
        $W5 = $GQ->redISub($py)->redISub($py);
        $TL = $uP->redMul($py->redISub($W5))->redISub($tG);
        $fi = $this->y->redMul($this->z);
        $fi = $fi->redIAdd($fi);
        return $this->curve->jpoint($W5, $TL, $fi);
    }
    private function _threeDbl()
    {
        if ($this->zOne) {
            goto U4;
        }
        $Yy = $this->z->redSqr();
        $er = $this->y->redSqr();
        $tM = $this->x->redMul($er);
        $Qr = $this->x->redSub($Yy)->redMul($this->x->redAdd($Yy));
        $Qr = $Qr->redAdd($Qr)->redIAdd($Qr);
        $tU = $tM->redIAdd($tM);
        $tU = $tU->redIAdd($tU);
        $b7 = $tU->redAdd($tU);
        $W5 = $Qr->redSqr()->redISub($b7);
        $fi = $this->y->redAdd($this->z)->redSqr()->redISub($er)->redISub($Yy);
        $OD = $er->redSqr();
        $OD = $OD->redIAdd($OD);
        $OD = $OD->redIAdd($OD);
        $OD = $OD->redIAdd($OD);
        $TL = $Qr->redMul($tU->redISub($W5))->redISub($OD);
        goto ko;
        U4:
        $O9 = $this->x->redSqr();
        $Cu = $this->y->redSqr();
        $qB = $Cu->redSqr();
        $p8 = $this->x->redAdd($Cu)->redSqr()->redISub($O9)->redISub($qB);
        $p8 = $p8->redIAdd($p8);
        $gw = $O9->redAdd($O9)->redIAdd($O9)->redIAdd($this->curve->a);
        $mV = $gw->redSqr()->redISub($p8)->redISub($p8);
        $W5 = $mV;
        $KU = $qB->redIAdd($qB);
        $KU = $KU->redIAdd($KU);
        $KU = $KU->redIAdd($KU);
        $TL = $gw->redMul($p8->redISub($mV))->redISub($KU);
        $fi = $this->y->redAdd($this->y);
        ko:
        return $this->curve->jpoint($W5, $TL, $fi);
    }
    private function _dbl()
    {
        $j_ = $this->x;
        $BK = $this->y;
        $Ja = $this->z;
        $Vi = $Ja->redSqr()->redSqr();
        $zW = $j_->redSqr();
        $R_ = $BK->redSqr();
        $Ux = $zW->redAdd($zW)->redIAdd($zW)->redIAdd($this->curve->a->redMul($Vi));
        $it = $j_->redAdd($j_);
        $it = $it->redIAdd($it);
        $AQ = $it->redMul($R_);
        $W5 = $Ux->redSqr()->redISub($AQ->redAdd($AQ));
        $Si = $AQ->redISub($W5);
        $el = $R_->redSqr();
        $el = $el->redIAdd($el);
        $el = $el->redIAdd($el);
        $el = $el->redIAdd($el);
        $TL = $Ux->redMul($Si)->redISub($el);
        $fi = $BK->redAdd($BK)->redMul($Ja);
        return $this->curve->jpoint($W5, $TL, $fi);
    }
    public function trpl()
    {
        if ($this->curve->zeroA) {
            goto yQ;
        }
        return $this->dbl()->add($this);
        yQ:
        $O9 = $this->x->redSqr();
        $Cu = $this->y->redSqr();
        $of = $this->z->redSqr();
        $qB = $Cu->redSqr();
        $gw = $O9->redAdd($O9)->redIAdd($O9);
        $zZ = $gw->redSqr();
        $uP = $this->x->redAdd($Cu)->redSqr()->redISub($O9)->redISub($qB);
        $uP = $uP->redIAdd($uP);
        $uP = $uP->redAdd($uP)->redIAdd($uP);
        $uP = $uP->redISub($zZ);
        $ks = $uP->redSqr();
        $mV = $qB->redIAdd($qB);
        $mV = $mV->redIAdd($mV);
        $mV = $mV->redIAdd($mV);
        $mV = $mV->redIAdd($mV);
        $Jc = $gw->redAdd($uP)->redSqr()->redISub($zZ)->redISub($ks)->redISub($mV);
        $ZU = $Cu->redMul($Jc);
        $ZU = $ZU->redIAdd($ZU);
        $ZU = $ZU->redIAdd($ZU);
        $W5 = $this->x->redMul($ks)->redISub($ZU);
        $W5 = $W5->redIAdd($W5);
        $W5 = $W5->redIAdd($W5);
        $TL = $this->y->redMul($Jc->redMul($mV->redISub($Jc))->redISub($uP->redMul($ks)));
        $TL = $TL->redIAdd($TL);
        $TL = $TL->redIAdd($TL);
        $TL = $TL->redIAdd($TL);
        $fi = $this->z->redAdd($uP)->redSqr()->redISub($of)->redISub($ks);
        return $this->curve->jpoint($W5, $TL, $fi);
    }
    public function mul($OZ, $hf)
    {
        return $this->curve->_wnafMul($this, new BN($OZ, $hf));
    }
    public function eq($g1)
    {
        if (!($g1->type == "\x61\x66\146\151\156\x65")) {
            goto GZ;
        }
        return $this->eq($g1->toJ());
        GZ:
        if (!($this == $g1)) {
            goto sC;
        }
        return true;
        sC:
        $XZ = $this->z->redSqr();
        $Cm = $g1->z->redSqr();
        if ($this->x->redMul($Cm)->redISub($g1->x->redMul($XZ))->isZero()) {
            goto pU;
        }
        return false;
        pU:
        $sC = $XZ->redMul($this->z);
        $vl = $Cm->redMul($g1->z);
        return $this->y->redMul($vl)->redISub($g1->y->redMul($sC))->isZero();
    }
    public function eqXToP($f5)
    {
        $w3 = $this->z->redSqr();
        $ww = $f5->toRed($this->curve->red)->redMul($w3);
        if (!($this->x->cmp($ww) == 0)) {
            goto Pf;
        }
        return true;
        Pf:
        $OM = $f5->_clone();
        $mV = $this->curve->redN->redMul($w3);
        Mi:
        if (!true) {
            goto oM;
        }
        $OM->iadd($this->curve->n);
        if (!($OM->cmp($this->curve->p) >= 0)) {
            goto Bh;
        }
        return false;
        Bh:
        $ww->redIAdd($mV);
        if (!($this->x->cmp($ww) == 0)) {
            goto gU;
        }
        return true;
        gU:
        goto Mi;
        oM:
    }
    public function inspect()
    {
        if (!$this->isInfinity()) {
            goto s4;
        }
        return "\74\x45\103\x20\x4a\x50\x6f\x69\x6e\164\40\111\156\146\151\x6e\x69\164\x79\76";
        s4:
        return "\74\105\x43\x20\112\x50\x6f\151\x6e\x74\x20\170\x3a\x20" . $this->x->toString(16, 2) . "\40\x79\x3a\40" . $this->y->toString(16, 2) . "\40\x7a\72\x20" . $this->z->toString(16, 2) . "\x3e";
    }
    public function __debugInfo()
    {
        return ["\x45\103\x20\x4a\x50\157\x69\x6e\x74" => $this->isInfinity() ? "\x49\156\146\x69\156\x69\164\x79" : ["\170" => $this->x->toString(16, 2), "\171" => $this->y->toString(16, 2), "\172" => $this->z->toString(16, 2)]];
    }
    public function isInfinity()
    {
        return $this->z->isZero();
    }
}
