$( function() {
	$('.open-city-list').on('click', function() {
		$(".city-list input[name='city']").autocomplete({
			source: function (request, response) {
				$.ajax({
					url: "/ajax/city.php",
					type: 'post',
					dataType: "json",
					data: {
						term: request.term
					},
					success: function (data) {
						response(data)
					}
				});
			},
			minLength: 2,
			select: function (event, ui) {
				document.querySelector('.modal-body.city .modal-body__city').textContent = ui.item.label;
				// document.cookie = "city=" + ui.item.label + '; path=/';
				$.ajax({
					url: "/ajax/setCity.php",
					type: 'post',
					dataType: "json",
					data: {
						city: ui.item.label
					},
					success: function (data) {
						location.reload()
					}
				});

			}
		});
	})
});
