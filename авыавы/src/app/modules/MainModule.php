<?php
namespace app\modules;

use std, gui, framework, app;


class MainModule extends AbstractModule
{

    /**
     * @event downloader.progress 
     */
    function doDownloaderProgress(ScriptEvent $e = null)
    {    
        $percent = round($e->progress * 100 / $e->max, 2);
        $this->progressDownload->progressK = $e->progress / $e->max;
        $this->label9->text = round($this->downloader->speed / 1024) . " Kb/s";
        $this->label9->show();
        
        $this->label8->text = round($e->max / 1024 / 1024, 2) . " Mb";
        $this->label8->show();
    }

    /**
     * @event downloader.successAll 
     */
    function doDownloaderSuccessAll(ScriptEvent $e = null)
    {    
        $this->label7->visible = true;
        $this->label7->text = "УСТАНОВЛЕНО";
        $this->label7->show();
        $this->progressDownload->visible = false;
        $this->label8->visible = false;
        $this->label9->visible = false;
        $this->label10->visible = false;
    }

    /**
     * @event downloader.errorOne 
     */
    function doDownloaderErrorOne(ScriptEvent $e = null)
    {    
        $message = $e->error ?: 'Неизвестная ошибка';
        $response = $e->response;
        
        if ($response->isNotFound()) {
            $message = 'Файл не найден';
        } else if ($response->isAccessDenied()) {
            $message = 'Доступ запрещен';
        } else if ($response->isServerError()) {
            $message = 'Сервер недоступен';
        }
        UXDialog::showAndWait('Ошибка загрузки файла: ' . $message, 'ERROR'); 
    }

}
