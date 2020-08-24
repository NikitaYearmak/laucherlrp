<?php
namespace app\forms;

use bundle\windows\Registry;
use bundle\windows\Windows;
use php\lib\fs;
use std, gui, framework, app;


class GamePath extends AbstractForm
{

    /**
     * @event button.click-Left 
     */
    function doButtonClickLeft(UXMouseEvent $e = null)
    {
        $game_path = $this->edit->text; // НЕ ТРОГАТЬ
        if(fs::isFile("$game_path")) // НЕ ТРОГАТЬ
        {
            if(fs::exists("$game_path")) // НЕ ТРОГАТЬ
            {
                Registry::of('HKEY_CURRENT_USER\Software\www.gtasrv.ru\CR-MP\GenerationC')->add('game_path', $game_path); // НЕ ТРОГАТЬ
                app()->hideForm('GamePath'); // НЕ ТРОГАТЬ
                app()->showForm('MainForm'); // НЕ ТРОГАТЬ
            }
            else UXDialog::show('Выберите путь к игре!'); // НЕ ТРОГАТЬ      
        }
        else UXDialog::show('Выберите путь к игре!'); // НЕ ТРОГАТЬ
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $game_path = Registry::of('HKEY_CURRENT_USER\Software\www.gtasrv.ru\CR-MP\GenerationC')->read('game_path'); // НЕ ТРОГАТЬ
        if($game_path) app()->hideForm('GamePath'); app()->showForm('MainForm'); // НЕ ТРОГАТЬ
    }

    /**
     * @event image.click-Left 
     */
    function doImageClickLeft(UXMouseEvent $e = null)
    {    
        app()->shutdown(); // НЕ ТРОГАТЬ  
    }

    /**
     * @event imageAlt.click-Left 
     */
    function doImageAltClickLeft(UXMouseEvent $e = null)
    {    
        app()->hideForm('GamePath'); // НЕ ТРОГАТЬ
        app()->showForm('MainForm'); // НЕ ТРОГАТЬ
    }


}
