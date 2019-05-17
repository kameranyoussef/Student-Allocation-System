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
Editor::inst( $db, 'cons_work_item_materials_transactional' )
    ->fields(
        Field::inst( 'material' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A first name is required' ) 
            ) ),
        Field::inst( 'unit' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A last name is required' )  
            ) ),
        Field::inst( 'qty' )
      )
    ->process( $_POST )
    ->json();
	
