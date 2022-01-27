jQuery(
	function ($) {
		'use strict';

		$( window ).load(
			function () {
				bwmObserver.init();
			}
		);

		var bwmHandlePanelVisibility = {
			init: function (widgetsHolder) {
				var widgetsTitleHolder = $( '.wp-block-legacy-widget__edit-form-title' );

				widgetsTitleHolder.each(
					function () {
						if (backendLabels.widgetTitle === $( this ).text()) {
							var widget = $( this ).parents( '.block-editor-block-list__block' );

							widget.find( '.wp-block-legacy-widget__edit-form' ).css( {'display': 'block'} );
							widget.find( '.wp-block-legacy-widget__edit-preview' ).css( {'display': 'none'} );
						}
					}
				);
			}
		};

		var bwmObserver = {
			init: function () {
				var widgetsLoaded         = false;
				var widgetsLoadedInterval = setInterval(
					function () {
						var widgetsHolder              = $( '.block-editor-block-list__block .components-panel__body' ),
							legacyWidgetsPreviewHolder = widgetsHolder.find( '.wp-block-legacy-widget__edit-preview' );

						if (widgetsHolder.length) {
							if (legacyWidgetsPreviewHolder.length) {
								widgetsHolder.each(
									function () {
										var mutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

										// if supported by browser
										if (mutationObserver) {
											var widgetsHolderNode = $( this )[0]; // vanilla js node

											// create mutation observer instance
											mutationObserver = new MutationObserver(
												function (mutations) {
													mutations.forEach(
														function (mutation) {
															bwmHandlePanelVisibility.init();
														}
													);
												}
											);

											// mutation observer options, only class name
											var options = {
												attributes     : true,
												attributeFilter: ['class'],
												subtree        : false
											};

											// observe node with options
											mutationObserver.observe( widgetsHolderNode, options );

											widgetsLoaded = true;
										}
									}
								);
							}
						}

						if (widgetsLoaded) {
							clearInterval( widgetsLoadedInterval );
							bwmHandlePanelVisibility.init();
						}
					},
					300
				);
			},
		};
	}
);
