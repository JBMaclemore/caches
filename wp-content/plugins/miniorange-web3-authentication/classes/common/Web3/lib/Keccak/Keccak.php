<?php


namespace kornrunner;

use Exception;
use function mb_strlen;
use function mb_substr;
final class Keccak
{
    private const KECCAK_ROUNDS = 24;
    private const LFSR = 0x1;
    private const ENCODING = "\x38\142\x69\x74";
    private static $keccakf_rotc = [1, 3, 6, 10, 15, 21, 28, 36, 45, 55, 2, 14, 27, 41, 56, 8, 25, 43, 62, 18, 39, 61, 20, 44];
    private static $keccakf_piln = [10, 7, 11, 17, 18, 3, 5, 16, 8, 21, 24, 4, 15, 23, 19, 13, 12, 2, 20, 14, 22, 9, 6, 1];
    private static $x64 = PHP_INT_SIZE === 8;
    private static function keccakf64(&$RH, $H6) : void
    {
        $Qm = [[0x0, 0x1], [0x0, 0x8082], [0x80000000, 0x808a], [0x80000000, 0x80008000], [0x0, 0x808b], [0x0, 0x80000001], [0x80000000, 0x80008081], [0x80000000, 0x8009], [0x0, 0x8a], [0x0, 0x88], [0x0, 0x80008009], [0x0, 0x8000000a], [0x0, 0x8000808b], [0x80000000, 0x8b], [0x80000000, 0x8089], [0x80000000, 0x8003], [0x80000000, 0x8002], [0x80000000, 0x80], [0x0, 0x800a], [0x80000000, 0x8000000a], [0x80000000, 0x80008081], [0x80000000, 0x8080], [0x0, 0x80000001], [0x80000000, 0x80008008]];
        $Sg = [];
        $su = 0;
        fd:
        if (!($su < $H6)) {
            goto jq;
        }
        $m8 = 0;
        yv:
        if (!($m8 < 5)) {
            goto Uc;
        }
        $Sg[$m8] = [$RH[$m8][0] ^ $RH[$m8 + 5][0] ^ $RH[$m8 + 10][0] ^ $RH[$m8 + 15][0] ^ $RH[$m8 + 20][0], $RH[$m8][1] ^ $RH[$m8 + 5][1] ^ $RH[$m8 + 10][1] ^ $RH[$m8 + 15][1] ^ $RH[$m8 + 20][1]];
        ZP:
        $m8++;
        goto yv;
        Uc:
        $m8 = 0;
        kE:
        if (!($m8 < 5)) {
            goto yZ;
        }
        $mV = [$Sg[($m8 + 4) % 5][0] ^ ($Sg[($m8 + 1) % 5][0] << 1 | $Sg[($m8 + 1) % 5][1] >> 31) & 0xffffffff, $Sg[($m8 + 4) % 5][1] ^ ($Sg[($m8 + 1) % 5][1] << 1 | $Sg[($m8 + 1) % 5][0] >> 31) & 0xffffffff];
        $Dd = 0;
        Hn:
        if (!($Dd < 25)) {
            goto c8;
        }
        $RH[$Dd + $m8] = [$RH[$Dd + $m8][0] ^ $mV[0], $RH[$Dd + $m8][1] ^ $mV[1]];
        fV:
        $Dd += 5;
        goto Hn;
        c8:
        oO:
        $m8++;
        goto kE;
        yZ:
        $mV = $RH[1];
        $m8 = 0;
        Ub:
        if (!($m8 < 24)) {
            goto RQ;
        }
        $Dd = self::$keccakf_piln[$m8];
        $Sg[0] = $RH[$Dd];
        $NI = self::$keccakf_rotc[$m8];
        $wW = $mV[0];
        $G3 = $mV[1];
        if (!($NI >= 32)) {
            goto Pq;
        }
        $NI -= 32;
        $wW = $mV[1];
        $G3 = $mV[0];
        Pq:
        $RH[$Dd] = [($wW << $NI | $G3 >> 32 - $NI) & 0xffffffff, ($G3 << $NI | $wW >> 32 - $NI) & 0xffffffff];
        $mV = $Sg[0];
        Y8:
        $m8++;
        goto Ub;
        RQ:
        $Dd = 0;
        Rd:
        if (!($Dd < 25)) {
            goto Y2;
        }
        $m8 = 0;
        EY:
        if (!($m8 < 5)) {
            goto ZR;
        }
        $Sg[$m8] = $RH[$Dd + $m8];
        qH:
        $m8++;
        goto EY;
        ZR:
        $m8 = 0;
        ya:
        if (!($m8 < 5)) {
            goto IJ;
        }
        $RH[$Dd + $m8] = [$RH[$Dd + $m8][0] ^ ~$Sg[($m8 + 1) % 5][0] & $Sg[($m8 + 2) % 5][0], $RH[$Dd + $m8][1] ^ ~$Sg[($m8 + 1) % 5][1] & $Sg[($m8 + 2) % 5][1]];
        KH:
        $m8++;
        goto ya;
        IJ:
        Yq:
        $Dd += 5;
        goto Rd;
        Y2:
        $RH[0] = [$RH[0][0] ^ $Qm[$su][0], $RH[0][1] ^ $Qm[$su][1]];
        MP:
        $su++;
        goto fd;
        jq:
    }
    private static function keccak64($Yk, int $wM, int $ln, $xt, bool $Pe) : string
    {
        $wM /= 8;
        $Ch = mb_strlen($Yk, self::ENCODING);
        $Oq = 200 - 2 * $wM;
        $lX = $Oq / 8;
        $RH = [];
        $m8 = 0;
        Gz:
        if (!($m8 < 25)) {
            goto sb;
        }
        $RH[] = [0, 0];
        Jk:
        $m8++;
        goto Gz;
        sb:
        $ws = 0;
        D0:
        if (!($Ch >= $Oq)) {
            goto IL;
        }
        $m8 = 0;
        yY:
        if (!($m8 < $lX)) {
            goto LO;
        }
        $mV = unpack("\x56\52", mb_substr($Yk, $m8 * 8 + $ws, 8, self::ENCODING));
        $RH[$m8] = [$RH[$m8][0] ^ $mV[2], $RH[$m8][1] ^ $mV[1]];
        wv:
        $m8++;
        goto yY;
        LO:
        self::keccakf64($RH, self::KECCAK_ROUNDS);
        ty:
        $Ch -= $Oq;
        $ws += $Oq;
        goto D0;
        IL:
        $Dy = mb_substr($Yk, $ws, $Ch, self::ENCODING);
        $Dy = str_pad($Dy, $Oq, "\x0", STR_PAD_RIGHT);
        $Dy[$Ch] = chr($xt);
        $Dy[$Oq - 1] = chr(ord($Dy[$Oq - 1]) | 0x80);
        $m8 = 0;
        k0:
        if (!($m8 < $lX)) {
            goto eF;
        }
        $mV = unpack("\x56\52", mb_substr($Dy, $m8 * 8, 8, self::ENCODING));
        $RH[$m8] = [$RH[$m8][0] ^ $mV[2], $RH[$m8][1] ^ $mV[1]];
        r5:
        $m8++;
        goto k0;
        eF:
        self::keccakf64($RH, self::KECCAK_ROUNDS);
        $Qf = '';
        $m8 = 0;
        B3:
        if (!($m8 < 25)) {
            goto ON;
        }
        $Qf .= $mV = pack("\126\x2a", $RH[$m8][1], $RH[$m8][0]);
        gn:
        $m8++;
        goto B3;
        ON:
        $G4 = mb_substr($Qf, 0, $ln / 8, self::ENCODING);
        return $Pe ? $G4 : bin2hex($G4);
    }
    private static function keccakf32(&$RH, $H6) : void
    {
        $Qm = [[0x0, 0x0, 0x0, 0x1], [0x0, 0x0, 0x0, 0x8082], [0x8000, 0x0, 0x0, 0x808a], [0x8000, 0x0, 0x8000, 0x8000], [0x0, 0x0, 0x0, 0x808b], [0x0, 0x0, 0x8000, 0x1], [0x8000, 0x0, 0x8000, 0x8081], [0x8000, 0x0, 0x0, 0x8009], [0x0, 0x0, 0x0, 0x8a], [0x0, 0x0, 0x0, 0x88], [0x0, 0x0, 0x8000, 0x8009], [0x0, 0x0, 0x8000, 0xa], [0x0, 0x0, 0x8000, 0x808b], [0x8000, 0x0, 0x0, 0x8b], [0x8000, 0x0, 0x0, 0x8089], [0x8000, 0x0, 0x0, 0x8003], [0x8000, 0x0, 0x0, 0x8002], [0x8000, 0x0, 0x0, 0x80], [0x0, 0x0, 0x0, 0x800a], [0x8000, 0x0, 0x8000, 0xa], [0x8000, 0x0, 0x8000, 0x8081], [0x8000, 0x0, 0x0, 0x8080], [0x0, 0x0, 0x8000, 0x1], [0x8000, 0x0, 0x8000, 0x8008]];
        $Sg = [];
        $su = 0;
        NE:
        if (!($su < $H6)) {
            goto QX;
        }
        $m8 = 0;
        rz:
        if (!($m8 < 5)) {
            goto gg;
        }
        $Sg[$m8] = [$RH[$m8][0] ^ $RH[$m8 + 5][0] ^ $RH[$m8 + 10][0] ^ $RH[$m8 + 15][0] ^ $RH[$m8 + 20][0], $RH[$m8][1] ^ $RH[$m8 + 5][1] ^ $RH[$m8 + 10][1] ^ $RH[$m8 + 15][1] ^ $RH[$m8 + 20][1], $RH[$m8][2] ^ $RH[$m8 + 5][2] ^ $RH[$m8 + 10][2] ^ $RH[$m8 + 15][2] ^ $RH[$m8 + 20][2], $RH[$m8][3] ^ $RH[$m8 + 5][3] ^ $RH[$m8 + 10][3] ^ $RH[$m8 + 15][3] ^ $RH[$m8 + 20][3]];
        Xb:
        $m8++;
        goto rz;
        gg:
        $m8 = 0;
        A0:
        if (!($m8 < 5)) {
            goto So;
        }
        $mV = [$Sg[($m8 + 4) % 5][0] ^ ($Sg[($m8 + 1) % 5][0] << 1 | $Sg[($m8 + 1) % 5][1] >> 15) & 0xffff, $Sg[($m8 + 4) % 5][1] ^ ($Sg[($m8 + 1) % 5][1] << 1 | $Sg[($m8 + 1) % 5][2] >> 15) & 0xffff, $Sg[($m8 + 4) % 5][2] ^ ($Sg[($m8 + 1) % 5][2] << 1 | $Sg[($m8 + 1) % 5][3] >> 15) & 0xffff, $Sg[($m8 + 4) % 5][3] ^ ($Sg[($m8 + 1) % 5][3] << 1 | $Sg[($m8 + 1) % 5][0] >> 15) & 0xffff];
        $Dd = 0;
        gS:
        if (!($Dd < 25)) {
            goto xw;
        }
        $RH[$Dd + $m8] = [$RH[$Dd + $m8][0] ^ $mV[0], $RH[$Dd + $m8][1] ^ $mV[1], $RH[$Dd + $m8][2] ^ $mV[2], $RH[$Dd + $m8][3] ^ $mV[3]];
        pv:
        $Dd += 5;
        goto gS;
        xw:
        Va:
        $m8++;
        goto A0;
        So:
        $mV = $RH[1];
        $m8 = 0;
        q6:
        if (!($m8 < 24)) {
            goto ki;
        }
        $Dd = self::$keccakf_piln[$m8];
        $Sg[0] = $RH[$Dd];
        $NI = self::$keccakf_rotc[$m8] >> 4;
        $gw = self::$keccakf_rotc[$m8] % 16;
        $RH[$Dd] = [($mV[(0 + $NI) % 4] << $gw | $mV[(1 + $NI) % 4] >> 16 - $gw) & 0xffff, ($mV[(1 + $NI) % 4] << $gw | $mV[(2 + $NI) % 4] >> 16 - $gw) & 0xffff, ($mV[(2 + $NI) % 4] << $gw | $mV[(3 + $NI) % 4] >> 16 - $gw) & 0xffff, ($mV[(3 + $NI) % 4] << $gw | $mV[(0 + $NI) % 4] >> 16 - $gw) & 0xffff];
        $mV = $Sg[0];
        gu:
        $m8++;
        goto q6;
        ki:
        $Dd = 0;
        TD:
        if (!($Dd < 25)) {
            goto lG;
        }
        $m8 = 0;
        MC:
        if (!($m8 < 5)) {
            goto ou;
        }
        $Sg[$m8] = $RH[$Dd + $m8];
        AR:
        $m8++;
        goto MC;
        ou:
        $m8 = 0;
        kQ:
        if (!($m8 < 5)) {
            goto WH;
        }
        $RH[$Dd + $m8] = [$RH[$Dd + $m8][0] ^ ~$Sg[($m8 + 1) % 5][0] & $Sg[($m8 + 2) % 5][0], $RH[$Dd + $m8][1] ^ ~$Sg[($m8 + 1) % 5][1] & $Sg[($m8 + 2) % 5][1], $RH[$Dd + $m8][2] ^ ~$Sg[($m8 + 1) % 5][2] & $Sg[($m8 + 2) % 5][2], $RH[$Dd + $m8][3] ^ ~$Sg[($m8 + 1) % 5][3] & $Sg[($m8 + 2) % 5][3]];
        Z_:
        $m8++;
        goto kQ;
        WH:
        s3:
        $Dd += 5;
        goto TD;
        lG:
        $RH[0] = [$RH[0][0] ^ $Qm[$su][0], $RH[0][1] ^ $Qm[$su][1], $RH[0][2] ^ $Qm[$su][2], $RH[0][3] ^ $Qm[$su][3]];
        zC:
        $su++;
        goto NE;
        QX:
    }
    private static function keccak32($Yk, int $wM, int $ln, $xt, bool $Pe) : string
    {
        $wM /= 8;
        $Ch = mb_strlen($Yk, self::ENCODING);
        $Oq = 200 - 2 * $wM;
        $lX = $Oq / 8;
        $RH = [];
        $m8 = 0;
        Zd:
        if (!($m8 < 25)) {
            goto xd;
        }
        $RH[] = [0, 0, 0, 0];
        Md:
        $m8++;
        goto Zd;
        xd:
        $ws = 0;
        fY:
        if (!($Ch >= $Oq)) {
            goto DZ;
        }
        $m8 = 0;
        Df:
        if (!($m8 < $lX)) {
            goto sH;
        }
        $mV = unpack("\x76\52", mb_substr($Yk, $m8 * 8 + $ws, 8, self::ENCODING));
        $RH[$m8] = [$RH[$m8][0] ^ $mV[4], $RH[$m8][1] ^ $mV[3], $RH[$m8][2] ^ $mV[2], $RH[$m8][3] ^ $mV[1]];
        gQ:
        $m8++;
        goto Df;
        sH:
        self::keccakf32($RH, self::KECCAK_ROUNDS);
        PW:
        $Ch -= $Oq;
        $ws += $Oq;
        goto fY;
        DZ:
        $Dy = mb_substr($Yk, $ws, $Ch, self::ENCODING);
        $Dy = str_pad($Dy, $Oq, "\0", STR_PAD_RIGHT);
        $Dy[$Ch] = chr($xt);
        $Dy[$Oq - 1] = chr((int) $Dy[$Oq - 1] | 0x80);
        $m8 = 0;
        CL:
        if (!($m8 < $lX)) {
            goto j8;
        }
        $mV = unpack("\x76\52", mb_substr($Dy, $m8 * 8, 8, self::ENCODING));
        $RH[$m8] = [$RH[$m8][0] ^ $mV[4], $RH[$m8][1] ^ $mV[3], $RH[$m8][2] ^ $mV[2], $RH[$m8][3] ^ $mV[1]];
        Wa:
        $m8++;
        goto CL;
        j8:
        self::keccakf32($RH, self::KECCAK_ROUNDS);
        $Qf = '';
        $m8 = 0;
        He:
        if (!($m8 < 25)) {
            goto kN;
        }
        $Qf .= $mV = pack("\x76\52", $RH[$m8][3], $RH[$m8][2], $RH[$m8][1], $RH[$m8][0]);
        Sk:
        $m8++;
        goto He;
        kN:
        $G4 = mb_substr($Qf, 0, $ln / 8, self::ENCODING);
        return $Pe ? $G4 : bin2hex($G4);
    }
    private static function keccak($Yk, int $wM, int $ln, $xt, bool $Pe) : string
    {
        return self::$x64 ? self::keccak64($Yk, $wM, $ln, $xt, $Pe) : self::keccak32($Yk, $wM, $ln, $xt, $Pe);
    }
    public static function hash($wR, int $HV, bool $Pe = false) : string
    {
        if (in_array($HV, [224, 256, 384, 512], true)) {
            goto k7;
        }
        throw new Exception("\x55\156\163\165\160\x70\157\162\x74\x65\144\40\x4b\145\143\143\141\x6b\40\x48\x61\163\150\40\157\x75\164\x70\x75\164\40\163\151\x7a\x65\x2e");
        k7:
        return self::keccak($wR, $HV, $HV, self::LFSR, $Pe);
    }
    public static function shake($wR, int $XX, int $GT, bool $Pe = false) : string
    {
        if (in_array($XX, [128, 256], true)) {
            goto KK;
        }
        throw new Exception("\125\156\163\165\x70\160\157\162\164\x65\144\40\113\145\x63\x63\141\153\x20\x53\150\141\x6b\145\x20\163\145\x63\x75\x72\x69\164\x79\40\x6c\145\x76\x65\154\x2e");
        KK:
        return self::keccak($wR, $XX, $GT, 0x1f, $Pe);
    }
}
