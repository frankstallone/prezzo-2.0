<?php 
/**
	Admin Page Framework v3.8.19 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/amazon-auto-links>
	Copyright (c) 2013-2019, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
abstract class AmazonAutoLinks_AdminPageFramework_Form_Model___Modifier_Base extends AmazonAutoLinks_AdminPageFramework_FrameworkUtility {
    }
    class AmazonAutoLinks_AdminPageFramework_Form_Model___Modifier_FilterRepeatableElements extends AmazonAutoLinks_AdminPageFramework_Form_Model___Modifier_Base {
        public $aSubject = array();
        public $aDimensionalKeys = array();
        public function __construct() {
            $_aParameters = func_get_args() + array($this->aSubject, $this->aDimensionalKeys,);
            $this->aSubject = $_aParameters[0];
            $this->aDimensionalKeys = array_unique($_aParameters[1]);
        }
        public function get() {
            foreach ($this->aDimensionalKeys as $_sFlatFieldAddress) {
                $this->unsetDimensionalArrayElement($this->aSubject, explode('|', $_sFlatFieldAddress));
            }
            return $this->aSubject;
        }
    }
    