<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Filterable inside custom select - jQuery Mobile Demos</title>
	<link rel="stylesheet"  href="../../../css/themes/default/jquery.mobile.css">
	<link rel="stylesheet" href="../../_assets/css/jqm-demos.css">
	<link rel="shortcut icon" href="../../favicon.ico">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<script src="../../../js/jquery.js"></script>
	<script src="../../_assets/js/"></script>
	<script src="../../../js/"></script>
	<script>
	$.mobile.document

		// "filter-menu-menu" is the ID generated for the listview when it is created
		// by the custom selectmenu plugin. Upon creation of the listview widget we
		// want to prepend an input field to the list to be used for a filter.
		.on( "listviewcreate", "#filter-menu-menu", function( e ) {
			var input,
				listbox = $( "#filter-menu-listbox" ),
				form = listbox.jqmData( "filter-form" ),
				listview = $( e.target );

			// We store the generated form in a variable attached to the popup so we
			// avoid creating a second form/input field when the listview is
			// destroyed/rebuilt during a refresh.
			if ( !form ) {
				input = $( "<input data-type='search'></input>" );
				form = $( "<form></form>" ).append( input );

				input.textinput();

				$( "#filter-menu-listbox" )
					.prepend( form )
					.jqmData( "filter-form", form );
			}

			// Instantiate a filterable widget on the newly created listview and
			// indicate that the generated input is to be used for the filtering.
			listview.filterable({ input: input });
		})

		// The custom select list may show up as either a popup or a dialog,
		// depending how much vertical room there is on the screen. If it shows up
		// as a dialog, then the form containing the filter input field must be
		// transferred to the dialog so that the user can continue to use it for
		// filtering list items.
		//
		// After the dialog is closed, the form containing the filter input is
		// transferred back into the popup.
		.on( "pagebeforeshow pagehide", "#filter-menu-dialog", function( e ) {
			var form = $( "#filter-menu-listbox" ).jqmData( "filter-form" ),
				placeInDialog = ( e.type === "pagebeforeshow" ),
				destination = placeInDialog ? $( e.target ).find( ".ui-content" ) : $( "#filter-menu-listbox" );

			form
				.find( "input" )

				// Turn off the "inset" option when the filter input is inside a dialog
				// and turn it back on when it is placed back inside the popup, because
				// it looks better that way.
				.textinput( "option", "inset", !placeInDialog )
				.end()
				.prependTo( destination );
		});
	</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" class="jqm-header">
		<h1 class="jqm-logo"><a href="../../"><img src="../../_assets/img/jquery-logo.png" alt="jQuery Mobile Framework"></a></h1>
		<a href="#" class="jqm-navmenu-link" data-icon="bars" data-iconpos="notext">Navigation</a>
		<a href="#" class="jqm-search-link" data-icon="search" data-iconpos="notext">Search</a>
        <?php include( '../../search.php' ); ?>
	</div><!-- /header -->

	<div data-role="content" class="jqm-content">

    <h1>Filterable inside custom select</h1>

		<p class="jqm-intro">
		This examples shows how you can filter the list inside a custom select menu.
		</p>

		<p>You can create an input field and prepend it to the popup and/or the dialog used by the custom select menu list and you can use it to filter items inside the list by instantiating a filterable widget on the list.</p>

		<div data-demo-html="true" data-demo-js="true">
			<form>
				<select id="filter-menu" data-native-menu="false">
					<option value="SFO">San Francisco</option>
					<option value="LAX">Los Angeles</option>
					<option value="YVR">Vancouver</option>
					<option value="YYZ">Toronto</option>
				</select>
			</form>
		</div>

	</div><!-- /content -->

	<div data-role="footer" class="jqm-footer">
		<p class="jqm-version"></p>
		<p>Copyright 2013 The jQuery Foundation</p>
	</div><!-- /footer -->

<?php include( '../../global-nav.php' ); ?>

</div><!-- /page -->
</body>
</html>
