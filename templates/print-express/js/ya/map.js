// Как только будет загружен API и готов DOM, выполняем инициализацию
    ymaps.ready(function () {
        var myMap = new ymaps.Map("YaMap", {
            center: [54.783074, 32.045],
            zoom: 12
        });
        myMap.behaviors.disable('scrollZoom');

        // При создании метки указываем ее свойства:  текст для отображения в иконке и содержимое балуна,
        // который откроется при нажатии на эту метку

        //Принт-Экспресс:
        PrintExpress = new ymaps.Placemark([54.76948103, 32.04727749], {
            // Свойства
            iconContent: 'Принт-Экспресс',
            balloonContentHeader: 'Типография "Принт-Экспресс"',
            balloonContentBody: '<span class="glyphicon glyphicon-map-marker"></span> проспект Гагарина, д.21, оф.33.<br/><span class="glyphicon glyphicon-earphone"></span> (4812) 32-80-70, 62-88-85, 32-71-54,<br/>68-34-70.<br><span class="glyphicon glyphicon-phone"></span> +7 (920) 665-01-84.'
        }, {
            // Опции
            preset: 'islands#darkBlueStretchyIcon' // иконка растягивается под контент
        }),

        //Призма:
        Prizma = new ymaps.Placemark([54.79487718, 32.04649242], {
            // Свойства
            iconContent: 'Призма',
            balloonContentHeader: 'Печатный салон "Призма"',
            balloonContentBody: '<span class="glyphicon glyphicon-map-marker"></span> ул.Кашена, д.1, 2 этаж, оф. 212.<br/><span class="glyphicon glyphicon-earphone"></span> (4812) 410-616.<br><span class="glyphicon glyphicon-phone"></span> +7 (920) 329-20-70.'
        }, {
            // Опции
            preset: 'islands#darkBlueStretchyIcon' // иконка растягивается под контент
        }),

        //Позитив:
        Positive = new ymaps.Placemark([54.77028373, 32.02394643], {
            // Свойства
            iconContent: 'Позитив',
            balloonContentHeader: 'Печатный салон \"Позитив\"',
            balloonContentBody: '<span class="glyphicon glyphicon-map-marker"></span> ул.Кирова, д.1.<br/><span class="glyphicon glyphicon-earphone"></span> (4812) 655-909.<br><span class="glyphicon glyphicon-phone"></span> +7 (920) 669-89-25.'
        }, {
            // Опции
            preset: 'islands#darkBlueStretchyIcon' // иконка растягивается под контент
        });

        // Добавляем метки на карту
        myMap.geoObjects
            .add(PrintExpress)
            .add(Prizma)
            .add(Positive);
    });