<?php


function auto($Class) {
    
    $cDir = array('Models','Controllers','Helpers','Conn');
    $iDir = null;
    foreach ($cDir as $dirName):
        if(!$iDir && file_exists(__DIR__."/../{$dirName}/{$Class}.php") && !is_dir(__DIR__."/../{$dirName}/{$Class}.php")){
            include_once (__DIR__."/../{$dirName}/{$Class}.php");
            $iDir = true;
        }
    endforeach;
    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.php", E_USER_ERROR);
        die;
    endif;
}

spl_autoload_register('auto');

?>
