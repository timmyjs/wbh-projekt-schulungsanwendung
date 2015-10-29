(function($) {
	'use strict';
	/**
	 * Practice skin implementation for the Stats module.
	 *
	 * @author Thomas May <thomas.may@namics.com>
	 * @namespace Tc.Module.Stats
	 * @class Practice
	 * @extends Tc.Module
	 * @constructor
	 */
	Tc.Module.Stats.Practice = function(parent) {
		/**
		 * override the appropriate methods from the decorated module (ie. this.get = function()).
		 * the former/original method may be called via parent.<method>()
		 */
		this.on = function(callback) {
			//calling parent method
			parent.on(callback);
		};

		this.after = function() {
			// calling parent method
			parent.after();
		};

		this.onShowStats = function(data) {
			if(data.right === 0 && data.wrong === 0){
				this.$('.js-no-results').removeClass('hidden');
			}else{
				this.renderChart(data);
				this.$('.js-pie-chart').removeClass('hidden');
			}
		};

		this.renderChart = function(data) {
			data = {
				labels: ['RICHTIG', 'FALSCH'],
				series: [data.right, data.wrong]
			};
			parent.createChart(data);
		};
	};
}(Tc.$));
