(function($) {
	'use strict';
	/**
	 * Stats module implementation
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module
	 * @class Stats
	 * @extends Tc.Module
	 */
	Tc.Module.Stats = Tc.Module.extend({

		init: function($ctx, sandbox, modId) {
			this._super($ctx, sandbox, modId);
		},

		on: function(callback) {
			this.bindAll(
				'getStats',
				'onGetStatsSuccess',
				'onGetStatsError'
			);
			this.$('.js-form').on('submit', this.getStats);
			// do not remove
			callback();
		},

		after: function() {
		},

		getStats: function(ev) {
			ev.preventDefault();
			var $form = $(ev.currentTarget);
			$.ajax({
				url: $form.attr('action'),
				type: $form.attr('method'),
				success: this.onGetStatsSuccess,
				error: this.onGetStatsError
			});
		},

		onGetStatsSuccess: function(data) {
			var options = {
			 	labelInterpolationFnc: function(value) {
					return value[0]
				}
			};

			var responsiveOptions = [
				['screen and (min-width: 640px)', {
					chartPadding: 30,
					labelOffset: 100,
					labelDirection: 'explode',
					labelInterpolationFnc: function(value) {
						return value;
					}
				}],
				['screen and (min-width: 1024px)', {
					labelOffset: 80,
					chartPadding: 20
				}]
			];
			new Chartist.Pie('.js-pie-chart', data, options, responsiveOptions);
			// this.$('.js-chart-container').html(this.template(this.$('#chart-template').html(), data));
		},

		onGetStatsError: function(err) {
			console.log('err', err);
		}

	});
}(Tc.$));
