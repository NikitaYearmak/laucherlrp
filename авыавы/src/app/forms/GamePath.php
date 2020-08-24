<?php
namespace app\forms;

use bundle\windows\Registry;
use bundle\windows\Windows;
use php\lib\fs;
use std, gui, framework, app;
use php\gui\event\UXEvent; 


class GamePath extends AbstractForm
{

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {    
        $game_path = $this->fileChooser->execute();
         $this->edit->text = $game_path;
         if(fs::isFile($game_path)) // НЕ ТРОГАТЬ
        {
         $this->ini->set('game_path', $game_path, 'settings');
         app()->hideForm('GamePath');
        app()->showForm('MainForm'); 
        }
        else UXDialog::show('Выберите путь к игре!'); // НЕ ТРОГАТЬ
    }


    

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $game_path = $this->ini->get('game_path','settings'); // НЕ ТРОГАТЬ
    }

    /**
     * @event image.click-Left 
     */
    function doImageClickLeft(UXMouseEvent $e = null)
    {    
        app()->hideForm($this->getContextFormName());
    }

    /**
     * @event imageAlt.click-Left 
     */
    function doImageAltClickLeft(UXMouseEvent $e = null)
    {    
      app()->hideForm($this->getContextFormName());
    }



}
