(function($) {

	$('[data-selectize="place"]').selectize({
		valueField: 'id',
		searchField: ['name'],
		// optgroupField: 'country.name',
		// optgroupValueField: 'country.name',
		// optgroupLabelField: 'country.name',
		create: false,
		maxItems: 1,
		render: {
			option: function(item, escape) {
				var option = '<div class="option">' + escape(item.name);
				if (item.region) {
					option = option + ', <span class="text-muted">' + escape(item.region.name) + '</span>';
				}
				if (item.country) {
					option = option + ', <span class="text-muted">' + escape(item.country.name) + '</span>';
				}
				return option+'</div>';
			},
			item: function(item, escape) {
				var option = '<div class="option">' + escape(item.name);
				if (item.region) {
					option = option + ', <span class="text-muted">' + escape(item.region.name) + '</span>';
				}
				if (item.country) {
					option = option + ', <span class="text-muted">' + escape(item.country.name) + '</span>';
				}
				return option+'</div>';
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