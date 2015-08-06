(function($) {
	'use strict';
	/**
	 * Login module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Login
	 * @extends Tc.Module
	 */
	Tc.Module.Login = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			var mod = this,
				$ctx = mod.$ctx;
			callback();
		},

		after: function() {
			var mod = this,
				$ctx = mod.$ctx;
		}

	});
}(Tc.$));
