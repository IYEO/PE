ymaps.ready(function () {
    if (!ymaps.panorama.isSupported()) {
        var msg = {
            danger: ['<h4>Ой! Что-то не так...</h4>Не удалось отобразить некоторые элементы веб-страницы. Попробуйте её обновить (<kbd>F5</kbd>).']
        };
        return Joomla.renderMessages(msg);
    } else {
        // Ищем панораму "Принт-Экспресс" в переданной точке.
        ymaps.panorama.locate([54.769377569908684, 32.04606849999998]).done(
            function (PlayerPE) {
                // Убеждаемся, что найдена хотя бы одна панорама.
                if (PlayerPE.length > 0) {
                    // Создаем плеер с одной из полученных панорам.
                    var pePlayer = new ymaps.panorama.Player(
                        'pePan',
                        // Панорамы в ответе отсортированы по расстоянию
                        // от переданной в panorama.locate точки. Выбираем первую,
                        // она будет ближайшей.
                        PlayerPE[0],
                        {
                            scrollZoomBehavior: false,  //отключаем масштабирование колесом мыши
                            controls: ['fullscreenControl', 'zoomControl'],     //доступные контролы (кнопки)
                            direction: [75, 19]     // направление взгляда
                        }
                    );
                }
            },
            function (error) {
                // Если что-то пошло не так, сообщим об этом пользователю.
                var msgPE = {
                    danger: ['Не удалось отобразить местонахождение центрального офиса типографии "Принт-Экспресс".']
                };
                Joomla.renderMessages(msgPE);
            }
        );

        // Ищем панораму "Позитива" в переданной точке.
        ymaps.panorama.locate([54.77011102016731,32.02362981903684]).done(
            function (PlayerPositive) {
                // Убеждаемся, что найдена хотя бы одна панорама.
                if (PlayerPositive.length > 0) {
                    // Создаем плеер с одной из полученных панорам.
                    var positivePlayer = new ymaps.panorama.Player(
                        'positivePan',
                        // Панорамы в ответе отсортированы по расстоянию
                        // от переданной в panorama.locate точки. Выбираем первую,
                        // она будет ближайшей.
                        PlayerPositive[0],
                        {
                            scrollZoomBehavior: false,  //отключаем масштабирование колесом мыши
                            controls: ['fullscreenControl', 'zoomControl'],     //доступные контролы (кнопки)
                            direction: [40, 0] // направление взгляда
                        }
                    );
                }
            },
            function (error) {
                // Если что-то пошло не так, сообщим об этом пользователю.
                var msgPositive = {
                    danger: ['Не удалось отобразить местонахождение печатного салона "Позитив".']
                };
                Joomla.renderMessages(msgPositive);
            }
        );

        // Ищем панораму "Призмы" в переданной точке.
        ymaps.panorama.locate([54.79505324574292,32.04711068783565]).done(
            function (PlayerPrizma) {
                // Убеждаемся, что найдена хотя бы одна панорама.
                if (PlayerPrizma.length > 0) {
                    // Создаем плеер с одной из полученных панорам.
                    var prizmaPlayer = new ymaps.panorama.Player(
                        'prizmaPan',
                        // Панорамы в ответе отсортированы по расстоянию
                        // от переданной в panorama.locate точки. Выбираем первую,
                        // она будет ближайшей.
                        PlayerPrizma[0],
                        {
                            scrollZoomBehavior: false,  //отключаем масштабирование колесом мыши
                            controls: ['fullscreenControl', 'zoomControl'],     //доступные контролы (кнопки)
                            direction: [270, 0]     // направление взгляда
                        }
                    );
                }
            },
            function (error) {
                // Если что-то пошло не так, сообщим об этом пользователю.
                var msgPrizma = {
                    danger: ['Не удалось отобразить местонахождение печатного салона "Призма".']
                };
                Joomla.renderMessages(msgPrizma);
            }
        );
    }
});