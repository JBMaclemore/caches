<?php


namespace Elliptic\EC;

require_once "\102\116\56\x70\150\x70";
use BN\BN;
class KeyPair
{
    public $ec;
    public $pub;
    public $priv;
    function __construct($BI, $Iq)
    {
        $this->ec = $BI;
        $this->priv = null;
        $this->pub = null;
        if (!isset($Iq["\160\x72\151\x76"])) {
            goto vA;
        }
        $this->_importPrivate($Iq["\160\162\x69\166"], $Iq["\x70\x72\151\x76\x45\x6e\x63"]);
        vA:
        if (!isset($Iq["\160\165\x62"])) {
            goto iX;
        }
        $this->_importPublic($Iq["\160\165\x62"], $Iq["\160\165\x62\x45\x6e\143"]);
        iX:
    }
    public static function fromPublic($BI, $OW, $B1)
    {
        if (!$OW instanceof KeyPair) {
            goto zN;
        }
        return $OW;
        zN:
        return new KeyPair($BI, array("\x70\x75\142" => $OW, "\160\165\142\x45\x6e\x63" => $B1));
    }
    public static function fromPrivate($BI, $cs, $B1)
    {
        if (!$cs instanceof KeyPair) {
            goto ce;
        }
        return $cs;
        ce:
        return new KeyPair($BI, array("\x70\162\x69\x76" => $cs, "\160\162\x69\166\x45\x6e\x63" => $B1));
    }
    public function validate()
    {
        $OW = $this->getPublic();
        if (!$OW->isInfinity()) {
            goto UT;
        }
        return array("\162\x65\163\x75\x6c\x74" => false, "\x72\145\x61\x73\157\x6e" => "\111\x6e\166\141\x6c\151\144\x20\160\x75\142\x6c\151\143\x20\x6b\x65\171");
        UT:
        if ($OW->validate()) {
            goto Td;
        }
        return array("\162\145\163\165\154\x74" => false, "\x72\145\141\163\157\156" => "\120\x75\142\154\151\x63\40\x6b\x65\171\40\151\x73\x20\x6e\x6f\164\40\x61\40\160\157\151\x6e\x74");
        Td:
        if ($OW->mul($this->ec->curve->n)->isInfinity()) {
            goto RD;
        }
        return array("\x72\145\x73\165\154\x74" => false, "\162\145\x61\163\157\x6e" => "\120\165\x62\154\x69\x63\x20\x6b\x65\x79\40\52\x20\116\x20\x21\x3d\x20\x4f");
        RD:
        return array("\x72\145\163\165\x6c\164" => true, "\162\x65\x61\x73\x6f\156" => null);
    }
    public function getPublic($ZX = false, $B1 = '')
    {
        if (!is_string($ZX)) {
            goto TC;
        }
        $B1 = $ZX;
        $ZX = false;
        TC:
        if (!($this->pub === null)) {
            goto c0;
        }
        $this->pub = $this->ec->g->mul($this->priv);
        c0:
        if ($B1) {
            goto nZ;
        }
        return $this->pub;
        nZ:
        return $this->pub->encode($B1, $ZX);
    }
    public function getPrivate($B1 = false)
    {
        if (!($B1 === "\150\145\170")) {
            goto Da;
        }
        return $this->priv->toString(16, 2);
        Da:
        return $this->priv;
    }
    private function _importPrivate($ai, $B1)
    {
        $this->priv = new BN($ai, isset($B1) && $B1 ? $B1 : 16);
        $this->priv = $this->priv->umod($this->ec->curve->n);
    }
    private function _importPublic($ai, $B1)
    {
        $f5 = $o_ = null;
        if (is_object($ai)) {
            goto Rv;
        }
        if (is_array($ai)) {
            goto qD;
        }
        goto qn;
        Rv:
        $f5 = $ai->x;
        $o_ = $ai->y;
        goto qn;
        qD:
        $f5 = isset($ai["\x78"]) ? $ai["\170"] : null;
        $o_ = isset($ai["\x79"]) ? $ai["\x79"] : null;
        qn:
        if ($f5 != null || $o_ != null) {
            goto u3;
        }
        $this->pub = $this->ec->curve->decodePoint($ai, $B1);
        goto tp;
        u3:
        $this->pub = $this->ec->curve->point($f5, $o_);
        tp:
    }
    public function derive($OW)
    {
        return $OW->mul($this->priv)->getX();
    }
    public function sign($U2, $B1 = false, $Iq = false)
    {
        return $this->ec->sign($U2, $this, $B1, $Iq);
    }
    public function verify($U2, $t0)
    {
        return $this->ec->verify($U2, $t0, $this);
    }
    public function inspect()
    {
        return "\x3c\113\x65\x79\40\x70\x72\x69\166\x3a\40" . (isset($this->priv) ? $this->priv->toString(16, 2) : '') . "\40\x70\x75\142\72\x20" . (isset($this->pub) ? $this->pub->inspect() : '') . "\x3e";
    }
    public function __debugInfo()
    {
        return ["\160\x72\151\166" => $this->priv, "\x70\x75\142" => $this->pub];
    }
}
