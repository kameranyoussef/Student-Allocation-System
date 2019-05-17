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
Editor::inst( $db, 'cons_work_items_expenses_transactional' )
    ->fields(
        Field::inst( 'description' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A Resource is required' ) 
            ) ),
        Field::inst( 'type' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'Qty is required ' )  
            ) ),
        Field::inst( 'amount' )
      )
    ->process( $_POST )
    ->json();
	
