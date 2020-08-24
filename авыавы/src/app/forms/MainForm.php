<?php
namespace app\forms; // НЕ ТРОГАТЬ


use bundle\windows\Registry;
use bundle\windows\Windows;
use std, gui, framework, app; // НЕ ТРОГАТЬ
use php\gui\event\UXEvent; 


class MainForm extends AbstractForm
{
    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null) // При открытии
    {
       $nickname = $this->ini->get('nickname', 'settings'); // НЕ ТРОГАТЬ
        $this->edit->text = $nickname; // НЕ ТРОГАТЬ
        
        $game_path = $this->ini->get('game_path', 'settings'); // НЕ ТРОГАТЬ
        if(empty($game_path)){
          UXDialog::show('Путь не указан!'); // НЕ ТРОГАТЬ  
        } 
    }

    /**
     * @event label7.click-Left 
     */
    function doLabel7ClickLeft(UXMouseEvent $e = null)
    {   
    /* 
        $this->label7->visible = false;
        $this->label7->enabled = false;
        $this->progressDownload->visible = true;
        $this->label8->visible = true;
        $this->label9->visible = true;
        $this->label10->visible = true;
        $this->timer->start();*/
        if($this->dirChooser->execute())
        {
            $this->label7->visible = false;
            $this->label7->enabled = false;
            $this->progressDownload->visible = true;
            $this->label8->visible = true;
            $this->label9->visible = true;
            $this->label10->visible = true;
            $this->downloader->destDirectory = $this->dirChooser->file;  
            $this->downloader->urls = "https://files.sa-mp.com/sa-mp-0.3.7-R4-install.exe";
            $this->downloader->start();
        }
    }

    /**
     * @event imageAlt.click-Left 
     */
    function doImageAltClickLeft(UXMouseEvent $e = null)
    {    
        app()->shutdown(); // НЕ ТРОГАТЬ        
    }

    /**
     * @event image.click-Left 
     */
    function doImageClickLeft(UXMouseEvent $e = null)
    {    
        app()->minimizeForm('MainForm'); // НЕ ТРОГАТЬ
    }


    /**
     * @event button.click-Left 
     */
    function doButtonClickLeft(UXMouseEvent $e = null)
    {    
         browse('http://forum.lcrmp.ru'); // укажите ссылку на ваш форум
    }

    /**
     * @event button3.click-Left 
     */
    function doButton3ClickLeft(UXMouseEvent $e = null)
    {
        browse('www.lcrmp.ru'); // укажите ссылку на ваш форум
    }

    /**
     * @event button4.click-Left 
     */
    function doButton4ClickLeft(UXMouseEvent $e = null)
    {
        browse('https://vk.com/lamborghini_rp'); // укажите ссылку на ваш форум
    }

    /**
     * @event image3.click-Left 
     */
    function doImage3ClickLeft(UXMouseEvent $e = null)
    {    
        
    }

    /**
     * @event button5.action 
     */
    function doButton5Action(UXEvent $e = null)
    {    
        $nickname = $this->edit->text;
        $this->ini->set('nickname', $nickname, 'settings');
    }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null)
    {    
             $ip = '176.32.39.156'; // Ваш IP адрес
      $port = '7777'; // Порт вашего IP адреса
        
         $game_path = $this->ini->get('game_path', 'settings');
         $nickname = $this->ini->get('nickname', 'settings');
        
        Registry::of('HKEY_CURRENT_USER\Software\www.gtasrv.ru\CR-MP\GenerationC')->add('player_name', $nickname); // НЕ ТРОГАТЬ
       execute("$game_path $ip:$port", false); // НЕ ТРОГАТЬ
    app()->shutdown(); // НЕ ТРОГАТЬ
    }

}
