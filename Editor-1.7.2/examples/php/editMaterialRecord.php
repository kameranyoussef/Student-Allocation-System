<?php

/*
 * Example PHP implementation used for the index.html example
 */

// DataTables PHP library

include( "../../php/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;

// Build our Editor instance and process the data coming from _POST
Editor::inst( $db, 'cons_materials' )
    ->fields(
        Field::inst( 'material' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A Resource is required' ) 
            ) ),
        Field::inst( 'specification' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Qty is required ' )  
            ) ),

        Field::inst( 'sub_category' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Qty is required ' )  
            ) ),

        Field::inst( 'type' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Qty is required ' )  
            ) ),
    
        Field::inst( 'unit' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Qty is required ' )  
            ) ),
        
        Field::inst( 'unit_cost' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Qty is required ' )  
            ) ),
    

        Field::inst( 'category' )
      )
    ->process( $_POST )
    ->json();
	
