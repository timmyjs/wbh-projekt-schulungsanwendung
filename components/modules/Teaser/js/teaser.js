(function($) {
	'use strict';
	/**
	 * Teaser module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Teaser
	 * @extends Tc.Module
	 */
	Tc.Module.Teaser = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			// do not remove
			callback();
		},

		after: function() {
		},

	});
}(Tc.$));
