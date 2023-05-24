<?php


namespace BI;

if (defined("\123\137\115\101\124\110\137\x42\x49\107\111\116\x54\x45\107\105\x52\x5f\115\x4f\x44\x45")) {
    goto FY;
}
if (extension_loaded("\x67\x6d\x70")) {
    goto Cx;
}
if (extension_loaded("\x62\x63\155\x61\164\150")) {
    goto D4;
}
if (defined("\123\x5f\115\101\x54\110\x5f\102\x49\107\111\116\124\105\x47\x45\122\x5f\121\125\111\105\x54")) {
    goto FO;
}
throw new \Exception("\103\x61\x6e\156\x6f\x74\x20\165\163\x65\40\102\x69\147\x49\x6e\x74\145\x67\x65\162\56\40\x4e\145\151\164\x68\145\x72\40\x67\155\x70\40\x6e\157\x72\x20\x62\x63\x6d\141\x74\x68\x20\x6d\x6f\144\x75\154\x65\x20\x69\163\40\154\x6f\x61\144\x65\x64");
FO:
goto Bm;
D4:
define("\x53\x5f\115\x41\x54\x48\x5f\x42\111\x47\111\x4e\124\105\107\105\x52\x5f\115\117\x44\x45", "\142\x63\x6d\141\x74\150");
Bm:
goto XO;
Cx:
define("\x53\137\x4d\x41\124\110\137\102\111\107\x49\116\x54\x45\x47\105\x52\137\115\117\x44\105", "\147\155\160");
XO:
FY:
if (S_MATH_BIGINTEGER_MODE == "\x67\x6d\x70") {
    goto nd;
}
if (S_MATH_BIGINTEGER_MODE == "\x62\143\x6d\141\x74\150") {
    goto vF;
}
if (defined("\123\x5f\x4d\101\x54\110\137\x42\111\107\111\116\x54\105\x47\x45\122\137\121\125\111\x45\124")) {
    goto ta;
}
throw new \Exception("\125\x6e\163\165\160\160\x6f\162\164\145\144\x20\123\x5f\115\x41\x54\110\x5f\102\111\x47\111\x4e\124\x45\107\105\x52\137\115\117\104\105\x20" . S_MATH_BIGINTEGER_MODE);
ta:
goto qo;
vF:
if (extension_loaded("\142\x63\155\141\x74\150")) {
    goto rS;
}
throw new \Exception("\x45\x78\164\145\156\163\151\x6f\156\40\142\x63\x6d\141\x74\150\40\x6e\157\x74\x20\x6c\x6f\141\x64\145\144");
rS:
class BigInteger
{
    public static $chars = "\60\x31\x32\x33\64\x35\x36\67\x38\71\x41\102\103\x44\x45\x46\107\x48\x49\112\x4b\114\115\x4e\117\x50\x51\122\123\124\125\x56\x57\x58\131\x5a\x61\x62\x63\x64\x65\146\147\150\x69\x6a\153\x6c\x6d\x6e\157\x70\161\x72\x73\164\165\x76";
    public $value;
    public function __construct($K_ = 0, $RR = 10)
    {
        $this->value = $RR === true ? $K_ : BigInteger::getBC($K_, $RR);
    }
    public static function createSafe($K_ = 0, $RR = 10)
    {
        try {
            return new BigInteger($K_, $RR);
        } catch (\Exception $uP) {
            return false;
        }
    }
    public static function checkBinary($Il)
    {
        $oO = strlen($Il);
        $m8 = 0;
        Y0:
        if (!($m8 < $oO)) {
            goto EZ;
        }
        $Ux = ord($Il[$m8]);
        if (!(($m8 != 0 || $Ux != 45) && ($Ux < 48 || $Ux > 49))) {
            goto b_;
        }
        return false;
        b_:
        Vz:
        $m8++;
        goto Y0;
        EZ:
        return true;
    }
    public static function checkDecimal($Il)
    {
        $oO = strlen($Il);
        $m8 = 0;
        hH:
        if (!($m8 < $oO)) {
            goto dM;
        }
        $Ux = ord($Il[$m8]);
        if (!(($m8 != 0 || $Ux != 45) && ($Ux < 48 || $Ux > 57))) {
            goto gC;
        }
        return false;
        gC:
        GB:
        $m8++;
        goto hH;
        dM:
        return true;
    }
    public static function checkHex($Il)
    {
        $oO = strlen($Il);
        $m8 = 0;
        uh:
        if (!($m8 < $oO)) {
            goto lj;
        }
        $Ux = ord($Il[$m8]);
        if (!(($m8 != 0 || $Ux != 45) && ($Ux < 48 || $Ux > 57) && ($Ux < 65 || $Ux > 70) && ($Ux < 97 || $Ux > 102))) {
            goto Uv;
        }
        return false;
        Uv:
        dD:
        $m8++;
        goto uh;
        lj:
        return true;
    }
    public static function getBC($K_ = 0, $RR = 10)
    {
        if (!$K_ instanceof BigInteger) {
            goto rN;
        }
        return $K_->value;
        rN:
        $bs = gettype($K_);
        if (!($bs == "\151\x6e\x74\x65\147\145\162")) {
            goto Jg;
        }
        return strval($K_);
        Jg:
        if (!($bs == "\163\164\162\x69\x6e\147")) {
            goto Rb;
        }
        if (!($RR == 2)) {
            goto b2;
        }
        $K_ = str_replace("\x20", '', $K_);
        if (BigInteger::checkBinary($K_)) {
            goto yj;
        }
        throw new \Exception("\111\156\x76\141\x6c\x69\144\x20\x63\150\141\162\141\143\164\x65\162\x73");
        yj:
        $Fz = $K_[0] == "\55";
        if (!$Fz) {
            goto w4;
        }
        $K_ = substr($K_, 1);
        w4:
        $oO = strlen($K_);
        $gw = 1;
        $cT = "\60";
        $m8 = $oO - 1;
        Xr:
        if (!($m8 >= 0)) {
            goto sY;
        }
        $R6 = $m8 - 7 < 0 ? substr($K_, 0, $m8 + 1) : substr($K_, $m8 - 7, 8);
        $cT = bcadd($cT, bcmul(bindec($R6), $gw, 0), 0);
        $gw = bcmul($gw, "\62\65\x36", 0);
        zm:
        $m8 -= 8;
        goto Xr;
        sY:
        return ($Fz ? "\x2d" : '') . $cT;
        b2:
        if (!($RR == 10)) {
            goto f8;
        }
        $K_ = str_replace("\40", '', $K_);
        if (BigInteger::checkDecimal($K_)) {
            goto po;
        }
        throw new \Exception("\111\x6e\x76\141\x6c\151\144\x20\x63\150\141\x72\141\143\164\145\162\x73");
        po:
        return $K_;
        f8:
        if (!($RR == 16)) {
            goto C0;
        }
        $K_ = str_replace("\x20", '', $K_);
        if (BigInteger::checkHex($K_)) {
            goto pF;
        }
        throw new \Exception("\111\156\166\x61\x6c\151\x64\x20\x63\150\x61\x72\141\143\164\145\x72\x73");
        pF:
        $Fz = $K_[0] == "\x2d";
        if (!$Fz) {
            goto xl;
        }
        $K_ = substr($K_, 1);
        xl:
        $oO = strlen($K_);
        $gw = 1;
        $cT = "\x30";
        $m8 = $oO - 1;
        hQ:
        if (!($m8 >= 0)) {
            goto x1;
        }
        $R6 = $m8 == 0 ? "\x30" . substr($K_, 0, 1) : substr($K_, $m8 - 1, 2);
        $cT = bcadd($cT, bcmul(hexdec($R6), $gw, 0), 0);
        $gw = bcmul($gw, "\62\x35\x36", 0);
        PR:
        $m8 -= 2;
        goto hQ;
        x1:
        return ($Fz ? "\x2d" : '') . $cT;
        C0:
        if (!($RR == 256)) {
            goto FH;
        }
        $oO = strlen($K_);
        $gw = 1;
        $cT = "\60";
        $m8 = $oO - 1;
        ns:
        if (!($m8 >= 0)) {
            goto h_;
        }
        $R6 = $m8 - 5 < 0 ? substr($K_, 0, $m8 + 1) : substr($K_, $m8 - 5, 6);
        $cT = bcadd($cT, bcmul(base_convert(bin2hex($R6), 16, 10), $gw, 0), 0);
        $gw = bcmul($gw, "\62\x38\61\x34\x37\x34\x39\x37\66\67\61\60\66\65\66", 0);
        Us:
        $m8 -= 6;
        goto ns;
        h_:
        return $cT;
        FH:
        throw new \Exception("\125\x6e\163\x75\x70\160\157\x72\164\145\x64\x20\102\151\147\111\156\164\x65\x67\145\x72\40\x62\141\163\145");
        Rb:
        throw new \Exception("\x55\156\163\165\160\160\157\x72\x74\145\144\x20\x76\141\x6c\x75\145\x2c\x20\157\x6e\x6c\x79\40\163\x74\x72\151\x6e\147\40\x61\x6e\x64\x20\151\156\164\145\x67\x65\162\40\141\162\x65\x20\x61\x6c\x6c\157\167\x65\144\x2c\x20\x72\145\143\x65\x69\x76\x65\x20" . $bs . ($bs == "\157\x62\152\x65\143\164" ? "\54\x20\143\x6c\x61\x73\163\x3a\x20" . get_class($K_) : ''));
    }
    public function toDec()
    {
        return $this->value;
    }
    public function toHex()
    {
        return bin2hex($this->toBytes());
    }
    public function toBytes()
    {
        $K_ = '';
        $cI = $this->value;
        if (!($cI[0] == "\x2d")) {
            goto rK;
        }
        $cI = substr($cI, 1);
        rK:
        nL:
        if (!(bccomp($cI, "\60", 0) > 0)) {
            goto xp;
        }
        $Dy = bcmod($cI, "\x32\70\x31\x34\67\x34\x39\x37\x36\67\61\x30\66\65\66");
        $K_ = hex2bin(str_pad(base_convert($Dy, 10, 16), 12, "\60", STR_PAD_LEFT)) . $K_;
        $cI = bcdiv($cI, "\x32\x38\61\x34\67\64\71\67\66\x37\61\x30\66\65\66", 0);
        goto nL;
        xp:
        return ltrim($K_, chr(0));
    }
    public function toBase($RR)
    {
        if (!($RR < 2 || $RR > 62)) {
            goto sr;
        }
        throw new \Exception("\x49\x6e\x76\x61\x6c\151\144\40\142\x61\x73\145");
        sr:
        $K_ = '';
        $cI = $this->value;
        $RR = BigInteger::getBC($RR);
        if (!($cI[0] == "\x2d")) {
            goto Rm;
        }
        $cI = substr($cI, 1);
        Rm:
        xX:
        if (!(bccomp($cI, "\60", 0) > 0)) {
            goto E6;
        }
        $qK = bcmod($cI, $RR);
        $K_ = BigInteger::$chars[$qK] . $K_;
        $cI = bcdiv($cI, $RR, 0);
        goto xX;
        E6:
        return $K_;
    }
    public function toBits()
    {
        $C3 = $this->toBytes();
        $cT = '';
        $oO = strlen($C3);
        $m8 = 0;
        kJ:
        if (!($m8 < $oO)) {
            goto lT;
        }
        $nC = decbin(ord($C3[$m8]));
        $cT .= strlen($nC) != 8 ? str_pad($nC, 8, "\60", STR_PAD_LEFT) : $nC;
        zD:
        $m8++;
        goto kJ;
        lT:
        $cT = ltrim($cT, "\x30");
        return strlen($cT) == 0 ? "\x30" : $cT;
    }
    public function toString($RR = 10)
    {
        if (!($RR == 2)) {
            goto Ur;
        }
        return $this->toBits();
        Ur:
        if (!($RR == 10)) {
            goto DX;
        }
        return $this->toDec();
        DX:
        if (!($RR == 16)) {
            goto r3;
        }
        return $this->toHex();
        r3:
        if (!($RR == 256)) {
            goto l7;
        }
        return $this->toBytes();
        l7:
        return $this->toBase($RR);
    }
    public function __toString()
    {
        return $this->toString();
    }
    public function toNumber()
    {
        return intval($this->value);
    }
    public function add($f5)
    {
        return new BigInteger(bcadd($this->value, BigInteger::getBC($f5), 0), true);
    }
    public function sub($f5)
    {
        return new BigInteger(bcsub($this->value, BigInteger::getBC($f5), 0), true);
    }
    public function mul($f5)
    {
        return new BigInteger(bcmul($this->value, BigInteger::getBC($f5), 0), true);
    }
    public function div($f5)
    {
        return new BigInteger(bcdiv($this->value, BigInteger::getBC($f5), 0), true);
    }
    public function divR($f5)
    {
        return new BigInteger(bcmod($this->value, BigInteger::getBC($f5)), true);
    }
    public function divQR($f5)
    {
        return array($this->div($f5), $this->divR($f5));
    }
    public function mod($f5)
    {
        $wU = BigInteger::getBC($f5);
        $VJ = bcmod($this->value, $wU);
        if (!($VJ[0] == "\55")) {
            goto X9;
        }
        $VJ = bcadd($VJ, $wU[0] == "\55" ? substr($wU, 1) : $wU, 0);
        X9:
        return new BigInteger($VJ, true);
    }
    public function extendedGcd($NI)
    {
        $Jc = $this->value;
        $qK = (new BigInteger($NI))->abs()->value;
        $TA = "\61";
        $nC = "\x30";
        $Ux = "\60";
        $py = "\61";
        oo:
        if (!(bccomp($qK, "\x30", 0) != 0)) {
            goto iS;
        }
        $Ps = bcdiv($Jc, $qK, 0);
        $Dy = $Jc;
        $Jc = $qK;
        $qK = bcsub($Dy, bcmul($qK, $Ps, 0), 0);
        $Dy = $TA;
        $TA = $Ux;
        $Ux = bcsub($Dy, bcmul($TA, $Ps, 0), 0);
        $Dy = $nC;
        $nC = $py;
        $py = bcsub($Dy, bcmul($nC, $Ps, 0), 0);
        goto oo;
        iS:
        $this->gcd = new BigInteger($Jc, true);
        $this->x = new BigInteger($TA, true);
        $this->y = new BigInteger($nC, true);
    }
    public function gcd($f5)
    {
        $this->extendedGcd($f5);
        return $this->gcd;
    }
    public function modInverse($NI)
    {
        $NI = (new BigInteger($NI))->abs();
        if (!($this->sign() < 0)) {
            goto t1;
        }
        $Dy = $this->abs();
        $Dy = $Dy->modInverse($NI);
        return $NI->sub($Dy);
        t1:
        $this->extendedGcd($NI);
        if ($this->gcd->equals(1)) {
            goto Ju;
        }
        return false;
        Ju:
        $f5 = $this->x->sign() < 0 ? $this->x->add($NI) : $this->x;
        return $this->sign() < 0 ? $NI->sub($f5) : $f5;
    }
    public function pow($f5)
    {
        return new BigInteger(bcpow($this->value, BigInteger::getBC($f5), 0), true);
    }
    public function powMod($f5, $NI)
    {
        return new BigInteger(bcpowmod($this->value, BigInteger::getBC($f5), BigInteger::getBC($NI), 0), true);
    }
    public function abs()
    {
        return new BigInteger($this->value[0] == "\55" ? substr($this->value, 1) : $this->value, true);
    }
    public function neg()
    {
        return new BigInteger($this->value[0] == "\x2d" ? substr($this->value, 1) : "\55" . $this->value, true);
    }
    public function binaryAnd($f5)
    {
        $w8 = $this->toBytes();
        $bw = (new BigInteger($f5))->toBytes();
        $fX = max(strlen($w8), strlen($bw));
        $w8 = str_pad($w8, $fX, chr(0), STR_PAD_LEFT);
        $bw = str_pad($bw, $fX, chr(0), STR_PAD_LEFT);
        return new BigInteger($w8 & $bw, 256);
    }
    public function binaryOr($f5)
    {
        $w8 = $this->toBytes();
        $bw = (new BigInteger($f5))->toBytes();
        $fX = max(strlen($w8), strlen($bw));
        $w8 = str_pad($w8, $fX, chr(0), STR_PAD_LEFT);
        $bw = str_pad($bw, $fX, chr(0), STR_PAD_LEFT);
        return new BigInteger($w8 | $bw, 256);
    }
    public function binaryXor($f5)
    {
        $w8 = $this->toBytes();
        $bw = (new BigInteger($f5))->toBytes();
        $fX = max(strlen($w8), strlen($bw));
        $w8 = str_pad($w8, $fX, chr(0), STR_PAD_LEFT);
        $bw = str_pad($bw, $fX, chr(0), STR_PAD_LEFT);
        return new BigInteger($w8 ^ $bw, 256);
    }
    public function setbit($ra, $bH = true)
    {
        $ED = $this->toBits();
        $ED[strlen($ED) - $ra - 1] = $bH ? "\x31" : "\60";
        return new BigInteger($ED, 2);
    }
    public function testbit($ra)
    {
        $C3 = $this->toBytes();
        $GE = intval($ra / 8);
        $oO = strlen($C3);
        $nC = $GE >= $oO ? 0 : ord($C3[$oO - $GE - 1]);
        $qK = 1 << $ra % 8;
        return ($nC & $qK) === $qK;
    }
    public function scan0($uN)
    {
        $ED = $this->toBits();
        $oO = strlen($ED);
        if (!($uN < 0 || $uN >= $oO)) {
            goto rl;
        }
        return -1;
        rl:
        $ev = strrpos($ED, "\x30", -1 - $uN);
        return $ev === false ? -1 : $oO - $ev - 1;
    }
    public function scan1($uN)
    {
        $ED = $this->toBits();
        $oO = strlen($ED);
        if (!($uN < 0 || $uN >= $oO)) {
            goto pA;
        }
        return -1;
        pA:
        $ev = strrpos($ED, "\x31", -1 - $uN);
        return $ev === false ? -1 : $oO - $ev - 1;
    }
    public function cmp($f5)
    {
        return bccomp($this->value, BigInteger::getBC($f5));
    }
    public function equals($f5)
    {
        return $this->value === BigInteger::getBC($f5);
    }
    public function sign()
    {
        return $this->value[0] === "\55" ? -1 : ($this->value === "\60" ? 0 : 1);
    }
}
qo:
goto T7;
nd:
if (extension_loaded("\x67\155\x70")) {
    goto UG;
}
throw new \Exception("\105\x78\x74\145\156\x73\151\157\x6e\40\x67\155\x70\x20\156\x6f\164\40\x6c\157\141\x64\x65\144");
UG:
if (class_exists("\102\111\134\102\151\x67\x49\156\164\x65\147\x65\x72")) {
    goto Iw;
}
class BigInteger
{
    public $value;
    public $gcd, $x, $y;
    public function __construct($K_ = 0, $RR = 10)
    {
        $this->value = $RR === true ? $K_ : BigInteger::getGmp($K_, $RR);
    }
    public static function createSafe($K_ = 0, $RR = 10)
    {
        try {
            return new BigInteger($K_, $RR);
        } catch (\Exception $uP) {
            return false;
        }
    }
    public static function isGmp($xn)
    {
        if (!is_resource($xn)) {
            goto Ri;
        }
        return get_resource_type($xn) == "\x47\x4d\x50\x20\151\156\164\x65\x67\x65\x72";
        Ri:
        if (!(class_exists("\x47\x4d\120") && $xn instanceof \GMP)) {
            goto qK;
        }
        return true;
        qK:
        return false;
    }
    public static function getGmp($K_ = 0, $RR = 10)
    {
        if (!$K_ instanceof BigInteger) {
            goto VG;
        }
        return $K_->value;
        VG:
        if (!BigInteger::isGmp($K_)) {
            goto t4;
        }
        return $K_;
        t4:
        $bs = gettype($K_);
        if (!($bs == "\x69\x6e\x74\145\147\145\x72")) {
            goto Gr;
        }
        $eS = gmp_init($K_);
        if (!($eS === false)) {
            goto xs;
        }
        throw new \Exception("\103\x61\x6e\156\x6f\x74\x20\151\x6e\x69\x74\151\x61\x6c\151\x7a\145");
        xs:
        return $eS;
        Gr:
        if (!($bs == "\163\164\x72\151\x6e\x67")) {
            goto qv;
        }
        if (!($RR != 2 && $RR != 10 && $RR != 16 && $RR != 256)) {
            goto Pu;
        }
        throw new \Exception("\125\156\163\x75\160\x70\x6f\x72\164\145\x64\x20\102\x69\x67\111\156\x74\145\147\x65\x72\40\142\x61\163\145");
        Pu:
        if (!($RR == 256)) {
            goto NA;
        }
        $K_ = bin2hex($K_);
        $RR = 16;
        NA:
        $U3 = error_reporting();
        error_reporting(0);
        $eS = gmp_init($K_, $RR);
        error_reporting($U3);
        if (!($eS === false)) {
            goto EG;
        }
        throw new \Exception("\103\x61\x6e\156\x6f\x74\x20\151\156\x69\164\151\141\x6c\151\x7a\x65");
        EG:
        return $eS;
        qv:
        throw new \Exception("\x55\156\163\x75\160\x70\157\162\x74\x65\144\40\166\141\x6c\165\x65\54\x20\157\156\x6c\171\40\163\164\162\x69\x6e\147\40\141\156\144\x20\151\x6e\x74\x65\x67\x65\162\x20\x61\162\145\x20\141\154\154\x6f\x77\145\x64\x2c\x20\162\145\143\145\151\x76\x65\x20" . $bs . ($bs == "\x6f\x62\152\145\143\x74" ? "\54\x20\143\x6c\141\163\x73\x3a\x20" . get_class($K_) : ''));
    }
    public function toDec()
    {
        return gmp_strval($this->value, 10);
    }
    public function toHex()
    {
        $YI = gmp_strval($this->value, 16);
        return strlen($YI) % 2 == 1 ? "\60" . $YI : $YI;
    }
    public function toBytes()
    {
        return hex2bin($this->toHex());
    }
    public function toBase($RR)
    {
        if (!($RR < 2 || $RR > 62)) {
            goto re;
        }
        throw new \Exception("\x49\x6e\x76\x61\x6c\x69\144\40\x62\141\163\x65");
        re:
        return gmp_strval($this->value, $RR);
    }
    public function toBits()
    {
        return gmp_strval($this->value, 2);
    }
    public function toString($RR = 10)
    {
        if (!($RR == 2)) {
            goto gE;
        }
        return $this->toBits();
        gE:
        if (!($RR == 10)) {
            goto aQ;
        }
        return $this->toDec();
        aQ:
        if (!($RR == 16)) {
            goto eo;
        }
        return $this->toHex();
        eo:
        if (!($RR == 256)) {
            goto e5;
        }
        return $this->toBytes();
        e5:
        return $this->toBase($RR);
    }
    public function __toString()
    {
        return $this->toString();
    }
    public function toNumber()
    {
        return gmp_intval($this->value);
    }
    public function add($f5)
    {
        return new BigInteger(gmp_add($this->value, BigInteger::getGmp($f5)), true);
    }
    public function sub($f5)
    {
        return new BigInteger(gmp_sub($this->value, BigInteger::getGmp($f5)), true);
    }
    public function mul($f5)
    {
        return new BigInteger(gmp_mul($this->value, BigInteger::getGmp($f5)), true);
    }
    public function div($f5)
    {
        return new BigInteger(gmp_div_q($this->value, BigInteger::getGmp($f5)), true);
    }
    public function divR($f5)
    {
        return new BigInteger(gmp_div_r($this->value, BigInteger::getGmp($f5)), true);
    }
    public function divQR($f5)
    {
        $cT = gmp_div_qr($this->value, BigInteger::getGmp($f5));
        return array(new BigInteger($cT[0], true), new BigInteger($cT[1], true));
    }
    public function mod($f5)
    {
        return new BigInteger(gmp_mod($this->value, BigInteger::getGmp($f5)), true);
    }
    public function gcd($f5)
    {
        return new BigInteger(gmp_gcd($this->value, BigInteger::getGmp($f5)), true);
    }
    public function modInverse($f5)
    {
        $cT = gmp_invert($this->value, BigInteger::getGmp($f5));
        return $cT === false ? false : new BigInteger($cT, true);
    }
    public function pow($f5)
    {
        return new BigInteger(gmp_pow($this->value, (new BigInteger($f5))->toNumber()), true);
    }
    public function powMod($f5, $NI)
    {
        return new BigInteger(gmp_powm($this->value, BigInteger::getGmp($f5), BigInteger::getGmp($NI)), true);
    }
    public function abs()
    {
        return new BigInteger(gmp_abs($this->value), true);
    }
    public function neg()
    {
        return new BigInteger(gmp_neg($this->value), true);
    }
    public function binaryAnd($f5)
    {
        return new BigInteger(gmp_and($this->value, BigInteger::getGmp($f5)), true);
    }
    public function binaryOr($f5)
    {
        return new BigInteger(gmp_or($this->value, BigInteger::getGmp($f5)), true);
    }
    public function binaryXor($f5)
    {
        return new BigInteger(gmp_xor($this->value, BigInteger::getGmp($f5)), true);
    }
    public function setbit($ra, $bH = true)
    {
        $BX = gmp_init(gmp_strval($this->value, 16), 16);
        gmp_setbit($BX, $ra, $bH);
        return new BigInteger($BX, true);
    }
    public function testbit($ra)
    {
        return gmp_testbit($this->value, $ra);
    }
    public function scan0($uN)
    {
        return gmp_scan0($this->value, $uN);
    }
    public function scan1($uN)
    {
        return gmp_scan1($this->value, $uN);
    }
    public function cmp($f5)
    {
        return gmp_cmp($this->value, BigInteger::getGmp($f5));
    }
    public function equals($f5)
    {
        return $this->cmp($f5) === 0;
    }
    public function sign()
    {
        return gmp_sign($this->value);
    }
}
Iw:
T7:
