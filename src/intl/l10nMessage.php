<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of l10nMessage
 *
 * @author olamedia
 */
class l10nMessage{
    protected $_msg = '';
    protected $_lmsg = null;
    protected $_args = array();
    protected $_locale = 'ru';
    protected $_realLocale = 'ru';
    protected $_file = null;
    protected $_line = null;
    public function __construct($msg){
        $this->_msg = $msg;
        $bt = debug_backtrace();
        $t = $bt[1];
        $this->_file = $t['file'];
        $this->_line = $t['line'];
        //echo $this->_file;
        //var_dump($bt);
    }
    public function setLocale($locale = 'ru'){
        $this->_locale = $locale;
    }
    public function setArguments($args){
        $this->_args = $args;
    }
    protected function _getTemplate(){
        $d = dirname($this->_file);
        $f = basename($this->_file);
        $lcPath = $d.'/locale/'.$this->_locale.'/'.$f;
        l10n::loadFile($this->_locale, $lcPath);
        $this->_lmsg = l10n::getTemplate($this->_locale, $this->_msg);
        echo $lcPath.' ';
    }
    protected function _applyForms(){
        $changed = false;
        if (preg_match_all("#\{(GENDER|PLURAL):([^\|{]+)((\|([^|{]+))+)\}#ims", $this->_lmsg, $subs)){
            var_dump($subs);
        }
        if ($changed) $this->_applyForms();
    }
    public function getLocalizedMessage(){
        $this->_getTemplate();
        $this->_applyForms();
        return $this->_lmsg;
    }
    public function __toString(){
        return (string) $this->getLocalizedMessage();
    }
}

