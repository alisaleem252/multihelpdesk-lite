<?php
/**
 Admin Page Framework v3.5.12 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class mhelpdeskAdminPageFramework_Script_OptionStorage extends mhelpdeskAdminPageFramework_Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function ( $ ) {
            
    $.fn.aAPFInputOptions = {}; 
                            
    $.fn.storeAPFInputOptions = function( sID, vOptions ) {
        var sID = sID.replace( /__\d+_/, '___' );	// remove the section index. The g modifier is not used so it will replace only the first occurrence.
        $.fn.aAPFInputOptions[ sID ] = vOptions;
    };	
    $.fn.getAPFInputOptions = function( sID ) {
        var sID = sID.replace( /__\d+_/, '___' ); // remove the section index
        return ( 'undefined' === typeof $.fn.aAPFInputOptions[ sID ] )
            ? null
            : $.fn.aAPFInputOptions[ sID ];
    }

}( jQuery ));
JAVASCRIPTS;
        
    }
}