<?php namespace EvolutionCMS\Manager\Controllers\Users;

use EvolutionCMS\Manager\Controllers\AbstractController;
use EvolutionCMS\Exceptions\ServiceActionException;
use EvolutionCMS\Exceptions\ServiceValidationException;
use EvolutionCMS\Models;
use EvolutionCMS\Manager\Interfaces\ManagerTheme;
use Illuminate\Support\Facades\Lang;

class DeleteUser extends AbstractController implements ManagerTheme\PageControllerInterface
{
    protected $view = '';

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
        return $this->managerTheme->getCore()->hasPermission('delete_user');
    }

    public function process() : bool
    {
        if($_GET['id'] == evo()->getLoginUserID()){
            EvolutionCMS()->webAlertAndQuit(Lang::get('global.delete_yourself'));
        }
        $user = Models\UserAttribute::query()->where('internalKey', $_GET['id'])->first();
        if($user->role == 1){
            $otherAdmin = Models\UserAttribute::query()->where('role', 1)->where('internalKey', '!=', $_GET['id'])->count();
            if($otherAdmin == 0){
                EvolutionCMS()->webAlertAndQuit(Lang::get('global.delete_last_admin'));
            }
        }
        try {
            \UserManager::delete($_GET);
        }catch (ServiceValidationException $exception){
            foreach ($exception->getValidationErrors() as $errors){
                if(is_array($errors)){
                    foreach ($errors as $error){
                        EvolutionCMS()->webAlertAndQuit($error);
                    }
                }
            }
        }
        header("Location: ?a=99");
        exit();
    }




}
