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
			this.bindAll(
				'onSubmitLogin',
				'onSubmitSuccess',
				'onSubmitError'
			);
			this.$$('.js-login-form').on('submit', this.onSubmitLogin);
			callback();
		},

		after: function() {
		},

		onSubmitLogin: function(ev) {
			ev.preventDefault();
			var $form = $(ev.currentTarget);
			$.ajax({
				url: $form.attr('action'),
				method: $form.attr('method'),
				data: $form.serialize(),
				success: this.onSubmitSuccess,
				error: this.onSubmitError
			});
		},

		onSubmitSuccess: function(data) {
			if(data.success){
				document.location.href = '/variant';
			}
		},

		onSubmitError: function(err) {
			console.log('onSubmitError xhr:', err);
		}

	});
}(Tc.$));
