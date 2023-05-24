<?php


namespace Elliptic\Curve;

require_once __DIR__ . "\x2f\56\x2e\57\102\116\56\x70\x68\160";
use Elliptic\Utils;
use Exception;
use BN\BN;
abstract class BaseCurve
{
    public $type;
    public $p;
    public $red;
    public $zero;
    public $one;
    public $two;
    public $n;
    public $g;
    protected $_wnafT1;
    protected $_wnafT2;
    protected $_wnafT3;
    protected $_wnafT4;
    public $redN;
    public $_maxwellTrick;
    function __construct($bs, $IG)
    {
        $this->type = $bs;
        $this->p = new BN($IG["\160"], 16);
        $this->red = isset($IG["\x70\162\151\x6d\x65"]) ? BN::red($IG["\x70\x72\x69\155\x65"]) : BN::mont($this->p);
        $this->zero = (new BN(0))->toRed($this->red);
        $this->one = (new BN(1))->toRed($this->red);
        $this->two = (new BN(2))->toRed($this->red);
        $this->n = isset($IG["\156"]) ? new BN($IG["\x6e"], 16) : null;
        $this->g = isset($IG["\147"]) ? $this->pointFromJSON($IG["\x67"], isset($IG["\x67\122\145\144"]) ? $IG["\147\122\x65\x64"] : null) : null;
        $this->_wnafT1 = array(0, 0, 0, 0);
        $this->_wnafT2 = array(0, 0, 0, 0);
        $this->_wnafT3 = array(0, 0, 0, 0);
        $this->_wnafT4 = array(0, 0, 0, 0);
        $PU = $this->n != null ? $this->p->div($this->n) : null;
        if ($PU == null || $PU->cmpn(100) > 0) {
            goto qI;
        }
        $this->redN = $this->n->toRed($this->red);
        $this->_maxwellTrick = true;
        goto IO;
        qI:
        $this->redN = null;
        $this->_maxwellTrick = false;
        IO:
    }
    public abstract function point($f5, $sd);
    public abstract function validate($bh);
    public function _fixedNafMul($g1, $OZ)
    {
        assert(isset($g1->precomputed));
        $ji = $g1->_getDoubles();
        $SS = Utils::getNAF($OZ, 1);
        $ph = (1 << $ji["\x73\x74\x65\x70"] + 1) - ($ji["\163\x74\145\160"] % 2 == 0 ? 2 : 1);
        $ph = $ph / 3;
        $u4 = array();
        $Dd = 0;
        ZX:
        if (!($Dd < count($SS))) {
            goto bx;
        }
        $Zr = 0;
        $OZ = $Dd + $ji["\x73\x74\x65\160"] - 1;
        sB:
        if (!($OZ >= $Dd)) {
            goto hP;
        }
        $Zr = ($Zr << 1) + (isset($SS[$OZ]) ? $SS[$OZ] : 0);
        oz:
        $OZ--;
        goto sB;
        hP:
        array_push($u4, $Zr);
        ux:
        $Dd += $ji["\x73\164\145\x70"];
        goto ZX;
        bx:
        $TA = $this->jpoint(null, null, null);
        $nC = $this->jpoint(null, null, null);
        $m8 = $ph;
        GY:
        if (!($m8 > 0)) {
            goto hZ;
        }
        $Dd = 0;
        Av:
        if (!($Dd < count($u4))) {
            goto Ch;
        }
        $Zr = $u4[$Dd];
        if ($Zr == $m8) {
            goto Mh;
        }
        if (!($Zr == -$m8)) {
            goto w8;
        }
        $nC = $nC->mixedAdd($ji["\x70\157\151\156\x74\163"][$Dd]->neg());
        w8:
        goto nT;
        Mh:
        $nC = $nC->mixedAdd($ji["\x70\157\151\x6e\x74\x73"][$Dd]);
        nT:
        lg:
        $Dd++;
        goto Av;
        Ch:
        $TA = $TA->add($nC);
        aG:
        $m8--;
        goto GY;
        hZ:
        return $TA->toP();
    }
    public function _wnafMul($g1, $OZ)
    {
        $ey = 4;
        $Iy = $g1->_getNAFPoints($ey);
        $ey = $Iy["\x77\x6e\x64"];
        $R7 = $Iy["\160\x6f\x69\156\x74\163"];
        $SS = Utils::getNAF($OZ, $ey);
        $ro = $this->jpoint(null, null, null);
        $m8 = count($SS) - 1;
        j3:
        if (!($m8 >= 0)) {
            goto SZ;
        }
        $OZ = 0;
        zJ:
        if (!($m8 >= 0 && $SS[$m8] == 0)) {
            goto Os;
        }
        $OZ++;
        Ki:
        $m8--;
        goto zJ;
        Os:
        if (!($m8 >= 0)) {
            goto rZ;
        }
        $OZ++;
        rZ:
        $ro = $ro->dblp($OZ);
        if (!($m8 < 0)) {
            goto pT;
        }
        goto SZ;
        pT:
        $sd = $SS[$m8];
        assert($sd != 0);
        if ($g1->type == "\x61\146\x66\x69\156\x65") {
            goto i4;
        }
        if ($sd > 0) {
            goto Hg;
        }
        $ro = $ro->add($R7[-$sd - 1 >> 1]->neg());
        goto B9;
        Hg:
        $ro = $ro->add($R7[$sd - 1 >> 1]);
        B9:
        goto c9;
        i4:
        if ($sd > 0) {
            goto P3;
        }
        $ro = $ro->mixedAdd($R7[-$sd - 1 >> 1]->neg());
        goto iR;
        P3:
        $ro = $ro->mixedAdd($R7[$sd - 1 >> 1]);
        iR:
        c9:
        of:
        $m8--;
        goto j3;
        SZ:
        return $g1->type == "\141\x66\x66\151\x6e\x65" ? $ro->toP() : $ro;
    }
    public function _wnafMulAdd($r3, $aM, $lc, $oO, $E2 = false)
    {
        $us =& $this->_wnafT1;
        $R7 =& $this->_wnafT2;
        $SS =& $this->_wnafT3;
        $ax = 0;
        $m8 = 0;
        Q5:
        if (!($m8 < $oO)) {
            goto El;
        }
        $g1 = $aM[$m8];
        $Iy = $g1->_getNAFPoints($r3);
        $us[$m8] = $Iy["\167\156\x64"];
        $R7[$m8] = $Iy["\160\x6f\151\x6e\x74\x73"];
        vU:
        $m8++;
        goto Q5;
        El:
        $m8 = $oO - 1;
        ZS:
        if (!($m8 >= 1)) {
            goto Y1;
        }
        $TA = $m8 - 1;
        $nC = $m8;
        if (!($us[$TA] != 1 || $us[$nC] != 1)) {
            goto h1;
        }
        $SS[$TA] = Utils::getNAF($lc[$TA], $us[$TA]);
        $SS[$nC] = Utils::getNAF($lc[$nC], $us[$nC]);
        $ax = max(count($SS[$TA]), $ax);
        $ax = max(count($SS[$nC]), $ax);
        goto jI;
        h1:
        $iQ = array($aM[$TA], null, null, $aM[$nC]);
        if ($aM[$TA]->y->cmp($aM[$nC]->y) == 0) {
            goto U2;
        }
        if ($aM[$TA]->y->cmp($aM[$nC]->y->redNeg()) == 0) {
            goto ye;
        }
        $iQ[1] = $aM[$TA]->toJ()->mixedAdd($aM[$nC]);
        $iQ[2] = $aM[$TA]->toJ()->mixedAdd($aM[$nC]->neg());
        goto A2;
        U2:
        $iQ[1] = $aM[$TA]->add($aM[$nC]);
        $iQ[2] = $aM[$TA]->toJ()->mixedAdd($aM[$nC]->neg());
        goto A2;
        ye:
        $iQ[1] = $aM[$TA]->toJ()->mixedAdd($aM[$nC]);
        $iQ[2] = $aM[$TA]->add($aM[$nC]->neg());
        A2:
        $ra = array(-3, -1, -5, -7, 0, 7, 5, 1, 3);
        $gl = Utils::getJSF($lc[$TA], $lc[$nC]);
        $ax = max(count($gl[0]), $ax);
        if ($ax > 0) {
            goto Cr;
        }
        $SS[$TA] = [];
        $SS[$nC] = [];
        goto q_;
        Cr:
        $SS[$TA] = array_fill(0, $ax, 0);
        $SS[$nC] = array_fill(0, $ax, 0);
        q_:
        $Dd = 0;
        Pt:
        if (!($Dd < $ax)) {
            goto cv;
        }
        $Hl = isset($gl[0][$Dd]) ? $gl[0][$Dd] : 0;
        $hK = isset($gl[1][$Dd]) ? $gl[1][$Dd] : 0;
        $SS[$TA][$Dd] = $ra[($Hl + 1) * 3 + ($hK + 1)];
        $SS[$nC][$Dd] = 0;
        $R7[$TA] = $iQ;
        At:
        $Dd++;
        goto Pt;
        cv:
        jI:
        $m8 -= 2;
        goto ZS;
        Y1:
        $ro = $this->jpoint(null, null, null);
        $Sp =& $this->_wnafT4;
        $m8 = $ax;
        f2:
        if (!($m8 >= 0)) {
            goto Jr;
        }
        $OZ = 0;
        Mu:
        if (!($m8 >= 0)) {
            goto lz;
        }
        $sa = true;
        $Dd = 0;
        zW:
        if (!($Dd < $oO)) {
            goto vs;
        }
        $Sp[$Dd] = isset($SS[$Dd][$m8]) ? $SS[$Dd][$m8] : 0;
        if (!($Sp[$Dd] != 0)) {
            goto Dq;
        }
        $sa = false;
        Dq:
        Aa:
        $Dd++;
        goto zW;
        vs:
        if ($sa) {
            goto me;
        }
        goto lz;
        me:
        $OZ++;
        $m8--;
        goto Mu;
        lz:
        if (!($m8 >= 0)) {
            goto GV;
        }
        $OZ++;
        GV:
        $ro = $ro->dblp($OZ);
        if (!($m8 < 0)) {
            goto qJ;
        }
        goto Jr;
        qJ:
        $Dd = 0;
        Hw:
        if (!($Dd < $oO)) {
            goto SI;
        }
        $sd = $Sp[$Dd];
        $g1 = null;
        if ($sd == 0) {
            goto vB;
        }
        if ($sd > 0) {
            goto Hb;
        }
        if ($sd < 0) {
            goto PL;
        }
        goto Py;
        vB:
        goto fP;
        goto Py;
        Hb:
        $g1 = $R7[$Dd][$sd - 1 >> 1];
        goto Py;
        PL:
        $g1 = $R7[$Dd][-$sd - 1 >> 1]->neg();
        Py:
        if ($g1->type == "\141\x66\146\151\x6e\145") {
            goto lY;
        }
        $ro = $ro->add($g1);
        goto B4;
        lY:
        $ro = $ro->mixedAdd($g1);
        B4:
        fP:
        $Dd++;
        goto Hw;
        SI:
        eC:
        $m8--;
        goto f2;
        Jr:
        $m8 = 0;
        Cg:
        if (!($m8 < $oO)) {
            goto VU;
        }
        $R7[$m8] = null;
        ln:
        $m8++;
        goto Cg;
        VU:
        if ($E2) {
            goto Z7;
        }
        return $ro->toP();
        goto du;
        Z7:
        return $ro;
        du:
    }
    public function decodePoint($C3, $B1 = false)
    {
        $C3 = Utils::toArray($C3, $B1);
        $oO = $this->p->byteLength();
        $aP = count($C3);
        if (!(($C3[0] == 0x4 || $C3[0] == 0x6 || $C3[0] == 0x7) && $aP - 1 == 2 * $oO)) {
            goto E3;
        }
        if ($C3[0] == 0x6) {
            goto F3;
        }
        if ($C3[0] == 0x7) {
            goto s0;
        }
        goto MG;
        F3:
        assert($C3[$aP - 1] % 2 == 0);
        goto MG;
        s0:
        assert($C3[$aP - 1] % 2 == 1);
        MG:
        return $this->point(array_slice($C3, 1, $oO), array_slice($C3, 1 + $oO, $oO));
        E3:
        if (!(($C3[0] == 0x2 || $C3[0] == 0x3) && $aP - 1 == $oO)) {
            goto LT;
        }
        return $this->pointFromX(array_slice($C3, 1, $oO), $C3[0] == 0x3);
        LT:
        throw new Exception("\125\156\153\156\x6f\x77\156\x20\160\157\x69\x6e\x74\x20\146\x6f\x72\155\141\x74");
    }
}
