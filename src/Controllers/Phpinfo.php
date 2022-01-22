<?php namespace EvolutionCMS\Manager\Controllers;

use EvolutionCMS\Interfaces\ManagerThemeInterface;
use EvolutionCMS\Manager\Interfaces\ManagerTheme;
use Illuminate\Support\Collection;

class Phpinfo extends AbstractController implements ManagerTheme\PageControllerInterface
{
    protected $view = 'page.phpinfo';

    /**
     * {@inheritdoc}
     */
    public function checkLocked(): ?string
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function canView(): bool
    {
        return $this->managerTheme->getCore()->hasPermission('logs');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(array $params = []): array
    {
        return [];
    }
}
