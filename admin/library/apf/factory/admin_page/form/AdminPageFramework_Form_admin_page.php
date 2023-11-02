<?php
/*
 * Admin Page Framework v3.9.1 by Michael Uno
 * Compiled with Admin Page Framework Compiler <https://github.com/michaeluno/admin-page-framework-compiler>
 * <https://en.michaeluno.jp/admin-page-framework>
 * Copyright (c) 2013-2022, Michael Uno; Licensed under MIT <https://opensource.org/licenses/MIT>
 */

class AdminPageFramework_Form_admin_page extends AdminPageFramework_Form {
    public function getPageOptions($aOptions, $sPageSlug)
    {
        $_aOtherPageOptions = $this->getOtherPageOptions($aOptions, $sPageSlug);
        return $this->invertCastArrayContents($aOptions, $_aOtherPageOptions);
    }
    public function getPageOnlyOptions($aOptions, $sPageSlug)
    {
        $_aStoredOptionsOfThePage = array();
        foreach ($this->aFieldsets as $_sSectionID => $_aSubSectionsOrFields) {
            if (! $this->_isThisSectionSetToThisPage($_sSectionID, $sPageSlug)) {
                continue;
            }
            $this->_setPageOnlyOptions($_aStoredOptionsOfThePage, $aOptions, $_aSubSectionsOrFields, $sPageSlug, $_sSectionID);
        }
        return $_aStoredOptionsOfThePage;
    }
    private function _setPageOnlyOptions(array &$_aStoredOptionsOfThePage, array $aOptions, array $_aSubSectionsOrFields, $sPageSlug, $_sSectionID)
    {
        foreach ($_aSubSectionsOrFields as $_sFieldID => $_aFieldset) {
            if ($this->isNumericInteger($_sFieldID)) {
                $this->_setOptionValue($_aStoredOptionsOfThePage, $_sSectionID, $aOptions);
                continue;
            }
            $_aFieldset = $_aFieldset + array( 'section_id' => null, 'field_id' => null, 'page_slug' => null, );
            if ($sPageSlug !== $_aFieldset[ 'page_slug' ]) {
                continue;
            }
            if ('_default' !== $_aFieldset[ 'section_id' ]) {
                $this->_setOptionValue($_aStoredOptionsOfThePage, $_aFieldset[ 'section_id' ], $aOptions);
                continue;
            }
            $this->_setOptionValue($_aStoredOptionsOfThePage, $_aFieldset[ 'field_id' ], $aOptions);
        }
    }
    public function getOtherPageOptions($aOptions, $sPageSlug)
    {
        $_aStoredOptionsNotOfThePage = array();
        foreach ($this->aFieldsets as $_sSectionID => $_aSubSectionsOrFields) {
            if ($this->_isThisSectionSetToThisPage($_sSectionID, $sPageSlug)) {
                continue;
            }
            $this->_setOtherPageOptions($_aStoredOptionsNotOfThePage, $aOptions, $_aSubSectionsOrFields, $sPageSlug);
        }
        return $_aStoredOptionsNotOfThePage;
    }
    private function _setOtherPageOptions(array &$_aStoredOptionsNotOfThePage, array $aOptions, array $_aSubSectionsOrFields, $sPageSlug)
    {
        foreach ($_aSubSectionsOrFields as $_sFieldID => $_aFieldset) {
            if ($this->isNumericInteger($_sFieldID)) {
                continue;
            }
            if ('_default' !== $_aFieldset[ 'section_id' ]) {
                $this->_setOptionValue($_aStoredOptionsNotOfThePage, $_aFieldset[ 'section_id' ], $aOptions);
                continue;
            }
            $this->_setOptionValue($_aStoredOptionsNotOfThePage, $_aFieldset[ 'field_id' ], $aOptions);
        }
    }
    public function getOtherTabOptions($aOptions, $sPageSlug, $sTabSlug)
    {
        $_aStoredOptionsNotOfTheTab = array();
        foreach ($this->aFieldsets as $_sSectionPath => $_aSubSectionsOrFields) {
            if ($this->_isThisSectionSetToThisTab($_sSectionPath, $sPageSlug, $sTabSlug)) {
                continue;
            }
            $this->_setOtherTabOptions($_aStoredOptionsNotOfTheTab, $aOptions, $_aSubSectionsOrFields, $_sSectionPath);
        }
        return $_aStoredOptionsNotOfTheTab;
    }
    private function _setOtherTabOptions(array &$_aStoredOptionsNotOfTheTab, array $aOptions, array $_aSubSectionsOrFields, $sSectionPath)
    {
        foreach ($_aSubSectionsOrFields as $_isSubSectionIndexOrFieldID => $_aSubSectionOrField) {
            if ($this->isNumericInteger($_isSubSectionIndexOrFieldID)) {
                $this->_setOptionValue($_aStoredOptionsNotOfTheTab, $sSectionPath, $aOptions);
                continue;
            }
            $_aFieldset = $_aSubSectionOrField;
            if ($_aFieldset[ 'section_id' ] !== '_default') {
                $this->_setOptionValue($_aStoredOptionsNotOfTheTab, $_aFieldset[ 'section_id' ], $aOptions);
                continue;
            }
            $this->_setOptionValue($_aStoredOptionsNotOfTheTab, $_aFieldset[ 'field_id' ], $aOptions);
        }
    }
    public function getTabOptions($aOptions, $sPageSlug, $sTabSlug='')
    {
        $_aOtherTabOptions = $this->getOtherTabOptions($aOptions, $sPageSlug, $sTabSlug);
        $_aTabOptions = $this->invertCastArrayContents($aOptions, $_aOtherTabOptions);
        return $_aTabOptions;
    }
    public function getTabOnlyOptions(array $aOptions, $sPageSlug, $sTabSlug='')
    {
        $_aStoredOptionsOfTheTab = array();
        if (! $sTabSlug) {
            return $_aStoredOptionsOfTheTab;
        }
        foreach ($this->aFieldsets as $_sSectionID => $_aSubSectionsOrFields) {
            if (! $this->_isThisSectionSetToThisTab($_sSectionID, $sPageSlug, $sTabSlug)) {
                continue;
            }
            $this->_setTabOnlyOptions($_aStoredOptionsOfTheTab, $aOptions, $_aSubSectionsOrFields, $_sSectionID);
        }
        return $_aStoredOptionsOfTheTab;
    }
    private function _setTabOnlyOptions(array &$_aStoredOptionsOfTheTab, array $aOptions, array $_aSubSectionsOrFields, $_sSectionID)
    {
        foreach ($_aSubSectionsOrFields as $_sFieldID => $_aFieldset) {
            if ($this->isNumericInteger($_sFieldID)) {
                $this->_setOptionValue($_aStoredOptionsOfTheTab, $_sSectionID, $aOptions);
                continue;
            }
            if ('_default' !== $_aFieldset[ 'section_id' ]) {
                $this->_setOptionValue($_aStoredOptionsOfTheTab, $_aFieldset[ 'section_id' ], $aOptions);
                continue;
            }
            $this->_setOptionValue($_aStoredOptionsOfTheTab, $_aFieldset[ 'field_id' ], $aOptions);
        }
    }
    private function _isThisSectionSetToThisPage($sSectionPath, $sPageSlug)
    {
        if (! isset($this->aSectionsets[ $sSectionPath ][ 'page_slug' ])) {
            return false;
        }
        return ($sPageSlug === $this->aSectionsets[ $sSectionPath ][ 'page_slug' ]);
    }
    private function _isThisSectionSetToThisTab($sSectionPath, $sPageSlug, $sTabSlug)
    {
        if (! $this->_isThisSectionSetToThisPage($sSectionPath, $sPageSlug)) {
            return false;
        }
        if (! isset($this->aSectionsets[ $sSectionPath ][ 'tab_slug' ])) {
            return false;
        }
        return ($sTabSlug === $this->aSectionsets[ $sSectionPath ][ 'tab_slug' ]);
    }
    private function _setOptionValue(&$aSubject, $asDimensionalPath, $aOptions)
    {
        $_aDimensionalPath = $this->getAsArray($asDimensionalPath);
        $_mValue = $this->getElement($aOptions, $_aDimensionalPath, null);
        if (isset($_mValue)) {
            $this->setMultiDimensionalArray($aSubject, $_aDimensionalPath, $_mValue);
        }
    }
}
