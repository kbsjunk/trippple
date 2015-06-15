(function($) {

	$('[data-selectize="place"]').selectize({
		valueField: 'id',
		searchField: ['name', 'country_name'],
		// optgroupField: 'country',
		// optgroupValueField: 'country',
		// optgroupLabelField: 'country',
		create: false,
		maxItems: 1,
		render: {
			option: function(item, escape) {
				return '<div class="option">' +
				escape(item.name) + ', ' +
				'<span class="text-muted">' + escape(item.country.name) + '</span>' +
				'</div>';
			},
			item: function(item, escape) {
				return '<div class="item">' +
				escape(item.name) + ', ' +
				'<span class="text-muted">' + escape(item.country.name) + '</span>' +
				'</div>';
			}
		},
		load: function(query, callback) {
			if (!query.length) return callback();
			$.ajax({
				url: '/places/search/' + encodeURIComponent(query),
				type: 'GET',
				error: function() {
					callback();
				},
				success: function(res) {
					callback(res);
				}
			});
		}
	});

	$('[data-selectize="timezone"]').selectize();


})(jQuery);