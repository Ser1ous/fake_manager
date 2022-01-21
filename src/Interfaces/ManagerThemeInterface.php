<?php namespace EvolutionCMS\Manager\Interfaces;

interface ManagerThemeInterface
{
    public function getCore() : EvolutionCMS\CoreInterface;

    public function getLang() : string;

    public function getStyle($key = null);

    /**
     * @param string $message
     * @param bool $lexicon
     */
    public function alertAndQuit(string $message, $lexicon = true) : void;
}
