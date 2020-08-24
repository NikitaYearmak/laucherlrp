<?php
namespace app\forms; // НЕ ТРОГАТЬ


use bundle\windows\Registry; // НЕ ТРОГАТЬ
use bundle\windows\Windows; // НЕ ТРОГАТЬ
use std, gui, framework, app; // НЕ ТРОГАТЬ

class MainForm extends AbstractForm
{
    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null) // При открытии
    {
        $nick_name = Registry::of('HKEY_CURRENT_USER\Software\www.gtasrv.ru\CR-MP\GenerationC')->read('player_name')->value; // НЕ ТРОГАТЬ
        Element::setText($this->edit, $nick_name); // НЕ ТРОГАТЬ
        
        $game_path = Registry::of('HKEY_CURRENT_USER\Software\www.gtasrv.ru\CR-MP\GenerationC')->read('game_path')->value; // НЕ ТРОГАТЬ
        if($game_path) // НЕ ТРОГАТЬ
        return Element::setText($this->label3, 'Путь указан'); // НЕ ТРОГАТЬ
    }
    /**
     * @event buttonAlt.click-Left 
     */
    function doButtonAltClickLeft(UXMouseEvent $e = null) // Играть
    {
        $ip = '176.32.39.156'; // Ваш IP адрес
        $port = '7777'; // Порт вашего IP адреса
        
        $game_path = Registry::of('HKEY_CURRENT_USER\Software\www.gtasrv.ru\CR-MP\GenerationC')->read('game_path')->value; // НЕ ТРОГАТЬ
        $player_name = $this->edit->text; // НЕ ТРОГАТЬ
        
        Registry::of('HKEY_CURRENT_USER\Software\www.gtasrv.ru\CR-MP\GenerationC')->add('player_name', $player_name); // НЕ ТРОГАТЬ
        execute("$game_path $ip:$port", false); // НЕ ТРОГАТЬ
        app()->shutdown(); // НЕ ТРОГАТЬ
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

}
