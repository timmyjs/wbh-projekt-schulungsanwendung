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
				'onSubmitLoginSuccess',
				'onSubmitLoginError'
			);
			this.$('.js-login-form').on('submit', this.onSubmitLogin);
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
				success: this.onSubmitLoginSuccess,
				error: this.onSubmitLoginError
			});
		},

		onSubmitLoginSuccess: function(data) {
			console.log('success', data);
		},

		onSubmitLoginError: function(err) {
			console.log('error', err);
		}

	});
}(Tc.$));
