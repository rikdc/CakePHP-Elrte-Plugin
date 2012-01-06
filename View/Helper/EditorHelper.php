<?php
/*
* Eltre Helper for CakePHP 2.0
*
* Copyright (c) 2011 - 2012 Richard Claydon
*
* Distributed under the terms of the MIT License.
* Redistributions of files must retain the above copyright notice.
*
* PHP version 5
*
* @package    eltre
* @copyright  2012 Richard Claydon <richard@icdw.co.uk>
* @license    http://www.opensource.org/licenses/mit-license.php The MIT License
* @link       http://github.com/rikdc/CakePHP-Elrte-Plugin
*
*
* @todo Improve JavaScript and Form dependency.
*
* Inspired by http://bakery.cakephp.org/articles/eliasfa/2011/11/11/elrte_and_elfinder_component_helper
 */
class EditorHelper extends Helper
{
    public $helpers = Array('Html', 'Form');

    public function beforeRender() {
        $this->Html->css("/Elrte/css/elrte.min.css", null, array('inline' => false));
        $this->Html->script('jquery-1.6.2.min', null, array('inline' => false, 'once' => 'true'));
        $this->Html->script("/Elrte/js/elrte.min.js", null, array("inline"=>false));
    } 
     
    public function load($id){
        $did = '';  
        foreach (explode('.', $id) as $v) { 
            $did .= ucfirst($v);  
        }

        $code = "$(document).ready(function(){   
                    var opts = { 
                        cssClass : 'el-rte',
                        lang     : 'pt_BR',
                        height   : 280,
                        toolbar  : 'complete',
                        fmOpen : function(callback) {
                        $('<div id=\"myelfinder\" />').elfinder({
                           url : '".$this->Html->url(array("controller"=>"editor","action"=>"load_editor"))."',
                           lang : 'pt_BR',
                           dialog : { width : 800, modal : true, title : 'Gerenciador de arquivos' }, // open in dialog window
                           closeOnEditorCallback : true, // close after file select
                           editorCallback : callback     // pass callback to file manager
                           });
                     }
                        //cssfiles : ['css/elrte-inner.css']
                                } 
                    $('#".$did."').elrte(opts);             
                }); ";  
        return $this->Html->scriptBlock($code, array("inline"=> true));
    }  
}