<?php namespace EvolutionCMS\Manager\Interfaces;

use EvolutionCMS\Interfaces\CoreInterface;

interface ManagerThemeInterface
{
    public function getCore() : CoreInterface;

    public function getLang() : string;

    public function getStyle($key = null);

    /**
     * @param string $message
     * @param bool $lexicon
     */
    public function alertAndQuit(string $message, $lexicon = true) : void;
}
