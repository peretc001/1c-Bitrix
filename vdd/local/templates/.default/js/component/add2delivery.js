BX.ready(function () {
    ymaps.ready(init);
    function init() {
        var myMap;
        var geolocation = ymaps.geolocation,
            suggestView = new ymaps.SuggestView('suggest'),
            myPlacemark,
            myMap = new ymaps.Map('map', {
                center: [55.022, 80.976],
                zoom: 4,
                controls: ['fullscreenControl', 'geolocationControl', 'zoomControl'],
            }),
            country, city, adress, number;


        myMap.events.add('click', function (e) {
            var coords = e.get('coords');
            setPlacemark(coords)
        });

        function setPlacemark(coords) {
            if (myPlacemark) {
                myPlacemark.geometry.setCoordinates(coords);
            }
            else {
                myPlacemark = createPlacemark(coords);
                myMap.geoObjects.add(myPlacemark);
                // Слушаем событие окончания перетаскивания на метке.
                myPlacemark.events.add('dragend', function () {
                    getAddress(myPlacemark.geometry.getCoordinates());
                });
            }
            getAddress(coords);
        }

        function createPlacemark(coords) {
            return new ymaps.Placemark(coords, {
                iconCaption: 'поиск...'
            }, {
                preset: 'islands#violetDotIconWithCaption',
                draggable: true
            });
        }

        function getAddress(coords) {
            myPlacemark.properties.set('iconCaption', 'поиск по базе ФСБ...');
            ymaps.geocode(coords).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);

                country = firstGeoObject.getCountry();
                city = firstGeoObject.getLocalities();
                adress = firstGeoObject.getThoroughfare();
                number = firstGeoObject.getPremiseNumber();

                $('.js-number').hide();
                $('.js-delivery').addClass('active');

                if(number) {
                    $('.js-adress').text(adress + ' ' + number);
                    $('.js-number').hide()
                } else {
                    $('.js-adress').text('Не определено');
                    $('.js-number').show()
                    $('#delivery-number').addClass('required');
                }
                $('.js-city').text(city + ', ' + country);

                $('[name="delivery-country"]').val(country);
                $('[name="delivery-city"]').val(city);
                $('[name="delivery-adress"]').val(adress);
                $('[name="delivery-number"]').val(number);

                myPlacemark.properties.set({
                    iconCaption: [
                        firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                        firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                    ].filter(Boolean).join(', '),
                    balloonContent: '<b>Адрес доставки:</b> ' + firstGeoObject.getAddressLine()
                });
            });
        }


        $('#suggest').bind('change', function (e) {
            geocode();
        });
        $('#suggest-clear').bind('click', function (e) {
            $('#suggest').val('')
            $('#suggest').focus()
        });
        $('#find').bind('change', function (e) {
            $('#suggest').blur()
            geocode();
        });

        suggestView.events.add('select', function (e) {
            $('#suggest').blur()
            geocode();
        });

        function geocode() {
            var request = $('#suggest').val();
            ymaps.geocode(request).then(function (res) {
                var obj = res.geoObjects.get(0);
                let coords = obj.geometry.getCoordinates();
                setPlacemark(coords)
                myMap.setCenter(coords, 17, {duration: 500});
            })
        }

        geolocation.get({
            provider: 'yandex',
        }).then(function (result) {
            myMap.setCenter(result.geoObjects.get(0).geometry.getCoordinates(), 10, {duration: 500});
            setTimeout(() => {
                result.geoObjects.options.set('preset', 'islands#geolocationIcon');
                result.geoObjects.get(0).properties.set({
                    balloonContentBody: 'Мое местоположение'
                });
                myMap.geoObjects.add(result.geoObjects);

            }, 1000);
        });

        geolocation.get({
            provider: 'browser',
        }).then(function (result) {
            setTimeout(() => {
                myMap.setCenter(result.geoObjects.get(0).geometry.getCoordinates(), 10, {duration: 500});
                result.geoObjects.options.set('preset', 'islands#geolocationIcon');
                myMap.geoObjects.add(result.geoObjects);
            }, 1000);
        });

        $('.account-delivery-addresses .btn').on('click', function (e) {
            e.preventDefault();
            $('#map').addClass('maxMap')
            myMap.container.enterFullscreen()
            myMap.container.fitToViewport();
            $('.suggest').addClass('active')
            $('#suggest').focus()
        });

        myMap.behaviors.disable('scrollZoom')

        myMap.container.events.add('fullscreenexit', function (e) {
            $('#map').removeClass('maxMap');
            $('.suggest').removeClass('active');
            $('.js-delivery').removeClass('active');
        });



        $('#delivery-flat').on('change', function() {
            $('#delivery-doorphone').val($('#delivery-flat').val())
        });
        $('#delivery-number').on('change', function() {
            $('#delivery-number').removeClass('required');
        });

        $('#delivery-house').on('change', function() {
            if( $('#delivery-house').is(':checked') ) {
                $('#delivery-flat').prop('disabled', true);
                $('#delivery-entrance').prop('disabled', true);
                $('#delivery-doorphone').prop('disabled', true);
                $('#delivery-floor').prop('disabled', true);
                $('#delivery-flat').val('');
                $('#delivery-entrance').val('');
                $('#delivery-doorphone').val('');
                $('#delivery-floor').val('');
            } else {
                $('#delivery-flat').prop('disabled', false);
                $('#delivery-entrance').prop('disabled', false);
                $('#delivery-doorphone').prop('disabled', false);
                $('#delivery-floor').prop('disabled', false);
            }
        });

        $('.js-delivery').on('submit', function(e) {
            e.preventDefault();

            if( $('#delivery-number').val() ) {
                let formData = new FormData();
                formData.append('user', $('[name="delivery-user"]').val());
                formData.append('country', country);
                formData.append('city', city);
                formData.append('adress', adress);

                formData.append('number', $('[name="delivery-number"]').val());
                formData.append('flat', $('[name="delivery-flat"]').val());
                if( $('#delivery-house').is(':checked') ) {
                    formData.append('house', 'да');
                } else {
                    formData.append('house', 'нет');
                }
                formData.append('entrance', $('[name="delivery-entrance"]').val());
                formData.append('doorphone', $('[name="delivery-doorphone"]').val());
                formData.append('floor', $('[name="delivery-floor"]').val());

                $.ajax({
                    url: "/ajax/add2delivery.php",
                    type: 'post',
                    data: formData,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (responce) {
                        let data = JSON.parse(responce);
                        if (data.status) {
                            $('.js-delivery').addClass('done')
                            setTimeout(() => {
                                myMap.container.exitFullscreen();
                                $('#map').removeClass('maxMap');
                                $('.suggest').removeClass('active')
                                $('.js-delivery').removeClass('active')
                                $('.js-delivery').removeClass('done')
                                location.reload();
                            }, 500)
                        } else {
                            console.log('error')
                        }
                    }
                })

            }
            else {
                $('.js-number').show()
                $('#delivery-number').addClass('required');
            }

        })
    }
});