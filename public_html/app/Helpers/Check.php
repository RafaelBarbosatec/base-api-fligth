<?php

/**
 * Check.class [ HELPER ]
 * Classe responável por manipular e validade dados do sistema!
 * 
 * @copyright (c) 2014, Robson V. Leite UPINSIDE TECNOLOGIA
 */
class Check {

    private static $Data;
    private static $Format;

    /**
     * <b>Verifica E-mail:</b> Executa validação de formato de e-mail. Se for um email válido retorna true, ou retorna false.
     * @param STRING $Email = Uma conta de e-mail
     * @return BOOL = True para um email válido, ou false
     */

    public static function Email($Email){
        self::$Data   = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if(preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * <b>Tranforma URL:</b> Tranforma uma string no formato de URL amigável e retorna o a string convertida!
     * @param STRING $Name = Uma string qualquer
     * @return STRING = $Data = Uma URL amigável válida
     */
    

    public static function Name ($Name){
        self::$Format = Array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';

        self::$Data = strtr(utf8_decode($Name), utf8_decode(self::$Format['a']), self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ','-', self::$Data);
        self::$Data = str_replace(array('-----','----','---','--'),'-', self::$Data);

        return strtolower(utf8_encode(self::$Data));
    }


    /**
     * <b>Tranforma Data:</b> Transforma uma data no formato DD/MM/YY em uma data no formato TIMESTAMP!
     * @param STRING $Name = Data em (d/m/Y) ou (d/m/Y H:i:s)
     * @return STRING = $Data = Data no formato timestamp!
     */

    public static function Data($Data){
        self::$Data   = explode('/',$Data);
        
        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0];

        return self::$Data;
    }

    //O data 2 considera qaue existe h:i:s
    public static function Data2($Data){
        self::$Format = explode(' ',$Data);
        self::$Data   = explode('/',self::$Format[0]);

        if(empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2] . '-' . self::$Data[1] . '-' . self::$Data[0] . ' ' .self::$Format[1];

        return self::$Data;
    }

    //O data 3 ajusta a data do banco para exibição
    public static function Data3($param){

        self::$Data   = explode('-',$param);

        self::$Data = self::$Data[2] . '/' . self::$Data[1] . '/' . self::$Data[0];

        return self::$Data;
    }


   
    /**
     * <b>Limita os Palavras:</b> Limita a quantidade de palavras a serem exibidas em uma string!
     * @param STRING $String = Uma string qualquer
     * @return INT = $Limite = String limitada pelo $Limite
     */
    
    public static function Words($String, $Limite, $Pointer = null){
        self::$Data = strip_tags(trim($String));
        self::$Format = (int)$Limite;

        $ArrWords = explode(' ',self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ',array_slice($ArrWords, 0 , self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' '.$Pointer);
        $Result  = (self::$Format < $NumWords ? $NewWords . $Pointer: self::$Data);

        return $Result;

    }


    /**
     * <b>Obter categoria:</b> Informe o name (url) de uma categoria para obter o ID da mesma.
     * @param STRING $category_name = URL da categoria
     * @return INT $category_id = id da categoria informada
     */
    
    public static function CatByName($CategoryName){
        $read = new Read();
        $read->ExeRead('categories',"WHERE category_name = :name", "name={$CategoryName}");

        if($read->getRowCount()):
            $res = array();
            $res = array_shift($read->getResult());
            return $res['category_id'];
        else:
            echo "A categoria {$CategoryName} não foi encontrada";
            die;
        endif;
    }



    /**
     * <b>Usuários Online:</b> Ao executar este HELPER, ele automaticamente deleta os usuários expirados. Logo depois
     * executa um READ para obter quantos usuários estão realmente online no momento!
     * @return INT = Qtd de usuários online
     */

    //ws_siteviews_online
    public static function UserOnline(){
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete();
        $deleteUserOnline->ExeDelete('siteviews_online', "WHERE online_endview < :now", "now={$now}");

        $readUserOnline = new Read;
        $readUserOnline->ExeRead('siteviews_online');
        return $readUserOnline->getRowCount();
    }
            
    /**
     * <b>Imagem Upload:</b> Ao executar este HELPER, ele automaticamente verifica a existencia da imagem na pasta
     * uploads. Se existir retorna a imagem redimensionada!
     * @return HTML = imagem redimencionada!
     */
            public static function Image($ImageUrl, $ImageW = null, $ImageH = null){

                self::$Data = 'uploads/'.$ImageUrl;

                if(file_exists(self::$Data) && !is_dir(self::$Data)):
                    $patch  = 'http://'.$_SERVER["SERVER_NAME"];
        
                    $imagem = self::$Data;
                                       
                    return "{$patch}/tim.php?src={$imagem}&w={$ImageW}&h={$ImageH}";

                else:
                    return false;
                endif;
            }

    /**
     * <b>Imagem Upload:</b> Ao executar este HELPER, ele automaticamente verifica a existencia da imagem na pasta, se a imagem nao existir ele deixar o input pra upload, se nao, exibe a imagem com o button de 'excluir imagem'
     * 
     * uploads. Se existir retorna a imagem redimensionada!
     * @return HTML = imagem redimencionada!
     */
            public static function LoadImageUpdate($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null){

                self::$Data = $ImageUrl;

                if(file_exists(self::$Data) && !is_dir(self::$Data)):
                    $patch  = HOME;         

                    if($_SERVER['HTTP_HOST'] == 'appsuporte.local' || true){
                        $imagem = str_replace('../','', self::$Data);
                    }else{
                        $imagem = self::$Data;
                    }                    
                    /*return "<div class='boxImg'> <img src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}time=0\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"> <br> <button class=\"btn btn-danger pull-right delImgUpdate \" data-path=\"{$imagem}\" style=\"margin-right: 0;\">Excluir Imagem</button> </div>";*/
                    //return "<div class='boxImg'> <img src={$patch}/{$imagem} alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\" width=\"{$ImageW}\" > <br> <button type=\"button\" class=\"btn btn-danger pull-right delImgUpdate \" data-path=\"{$imagem}\" style=\"margin-right: 0; \">Excluir Imagem</button> </div>";
                   /* return "<div class='boxImg'> <img src={$patch}/{$imagem} alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\" width=\"{$ImageW}\" > <br> <button type=\"button\" data-toggle=\"modal\" data-target=\"#modalDeleteImagem\" data-whatever=\"{$imagem}\" class=\"btn btn-danger pull-right \" data-path=\"{$imagem}\" style=\"margin-right: 0; \">Excluir Imagem</button> </div>";*/

                    return "<div class='boxImg'> <img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageW}&h={$ImageH}time=0\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\"> <br> <button type=\"button\" data-toggle=\"modal\" data-target=\"#modalDeleteImagem\" data-whatever=\"{$imagem}\" class=\"btn btn-danger pull-right \" data-path=\"{$imagem}\" style=\"margin-right: 0; \">Excluir Imagem</button> </div>";
                    
                else:
                    return false;
                endif;
            }

}
