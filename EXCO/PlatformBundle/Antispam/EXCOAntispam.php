<?php
/**
 * Created by PhpStorm.
 * User: Armin
 * Date: 17/04/2017
 * Time: 02:33
 */
namespace EXCO\PlatformBundle\Antispam;

class EXCOAntispam
{
private $mailer;
private $locale;
private $minLength;

    public function __construct(\Swift_Mailer $mailer, $locale, $minLength)
    {
        $this->mailer     = $mailer;
        $this->locale     = $locale;
        $this->minLength  = (int) $minLength;
    }


    public function isSpam($text)
    {
        return strlen($text) < $this->minLength;
    }
}