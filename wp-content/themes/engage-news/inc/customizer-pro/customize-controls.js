( function( api ) {

	// Extends our custom "engage-news" section.
	api.sectionConstructor['engage-news'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
