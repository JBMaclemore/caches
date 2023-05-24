<?php


namespace Elliptic\Curve;

require_once "\x53\x68\x6f\162\x74\x43\x75\162\166\145\56\160\x68\x70";
require_once "\x4d\157\156\164\103\165\x72\x76\x65\x2e\160\x68\160";
require_once "\105\x64\x77\141\162\144\163\x43\x75\x72\166\x65\56\x70\x68\x70";
class PresetCurve
{
    public $curve;
    public $g;
    public $n;
    public $hash;
    function __construct($Iq)
    {
        if ($Iq["\x74\x79\x70\x65"] === "\x73\150\x6f\162\x74") {
            goto gM;
        }
        if ($Iq["\164\171\x70\145"] === "\145\144\167\141\x72\x64\x73") {
            goto qf;
        }
        $this->curve = new MontCurve($Iq);
        goto hN;
        gM:
        $this->curve = new ShortCurve($Iq);
        goto hN;
        qf:
        $this->curve = new EdwardsCurve($Iq);
        hN:
        $this->g = $this->curve->g;
        $this->n = $this->curve->n;
        $this->hash = isset($Iq["\x68\141\x73\x68"]) ? $Iq["\150\x61\163\x68"] : null;
    }
}
