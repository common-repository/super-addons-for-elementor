;(function($) {
    'use strict';
    $(window).on( 'elementor/frontend/init', function() {

        // Owl Slider
        elementorFrontend.hooks.addAction('frontend/element_ready/safeowlcarousel.default',function($scope) {
            let $owlcarousel = $scope.find('.owl-carousel');
            if( $owlcarousel.length ) {
                $owlcarousel.owlCarousel({
                    items: $owlcarousel.data('owl-items'),
                    margin: $owlcarousel.data('owl-margin'),
                    loop: $owlcarousel.data('owl-loop'),
                    smartSpeed: 450,
                    autoplay: $owlcarousel.data('owl-autoplay'),
                    autoplayTimeout: 8000,
                    nav: $owlcarousel.data('owl-nav'),
                    dots: $owlcarousel.data('owl-dots'),
                    lazyLoad: true,
                    responsive: {"0":{"items":1,stagePadding: 60},"575":{"items":1,stagePadding: 100},"992":{"items":1,stagePadding: 200},"1199": {"items":1,stagePadding: 250},"1400": {"items": 1,stagePadding: 300}}
                });
            }
        });

        // blog post
        elementorFrontend.hooks.addAction('frontend/element_ready/safeblogpost.default',function($scope) {
            let $bgImg = $scope.find('[data-bg-img]');
            $bgImg.css('background-image', function () {
                return 'url("' + $(this).data('bg-img') + '")';
            }).removeAttr('data-bg-img').addClass('bg-img');
        });
        // // Countdown
        // elementorFrontend.hooks.addAction('frontend/element_ready/safecountdown.default',function($scope) {
        //     $('.countdown').final_countdown({
        //        'start': 15,
        //        'end': 30,
        //        'now': 10        
        //    });
        // });

        // client logo slider
        elementorFrontend.hooks.addAction('frontend/element_ready/safelogocarousel.default',function($scope) {
            let $owlcarousel = $scope.find('.owl-carousel');
            if( $owlcarousel.length ) {
                $owlcarousel.owlCarousel({
                    items: $owlcarousel.data('owl-items'),
                    margin: $owlcarousel.data('owl-margin'),
                    loop: $owlcarousel.data('owl-loop'),
                    smartSpeed: 450,
                    mouseDrag:$owlcarousel.data('owl-mousedrag'),
                    autoplayHoverPause:$owlcarousel.data('owl-autoplay-hoverpause'),
                    autoplay: $owlcarousel.data('owl-autoplay'),
                    autoplayTimeout: $owlcarousel.data('owl-autoplay-timeout'),
                    nav: false,
                    dots: false,
                    responsive: {"0":{"items": $owlcarousel.data('mi')},"768": {"items": $owlcarousel.data('ti')},"992":{"items": $owlcarousel.data('di')}}
                });
            }
        });

        // instafeed slider
        elementorFrontend.hooks.addAction('frontend/element_ready/safeinstafeed.default',function($scope) {
            let $owlcarousel = $scope.find('.owl-carousel');
            if( $owlcarousel.length ) {
                $owlcarousel.owlCarousel({
                    items: $owlcarousel.data('owl-items'),
                    loop: $owlcarousel.data('owl-loop'),
                    smartSpeed: 450,
                    margin: $owlcarousel.data('owl-margin'),
                    autoplay: $owlcarousel.data('owl-autoplay'),
                    autoplayTimeout: 8000,
                    nav: false,
                    dots: false,
                    responsive: {"0":{"items": "1"},"379":{"items": $owlcarousel.data('mi')},"479":{"items": $owlcarousel.data('ti')},"1199": {"items": $owlcarousel.data('di')}}
                });
            }
        });

        // google map
        elementorFrontend.hooks.addAction('frontend/element_ready/safegooglemap.default',function($scope) {
            var $map = $scope.find('[data-trigger="map"]');

            if ($map.length) {


                // Map Initialization
                window.initMap = function () {
                    $map.css('min-height', '530px');

                    var map, lat, lng, zoom;
                    lat = parseFloat($map.data('latitude'), 10);
                    lng = parseFloat($map.data('longitude'), 10);
                    zoom = parseFloat($map.data('zoom'), 10);

                    map = new google.maps.Map($map[0], {
                        center: { lat: lat, lng: lng },
                        zoom: zoom,
                        scrollwheel: false,
                        disableDefaultUI: true,
                        zoomControl: true,
                        styles: [
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#e9e9e9"
                                    },
                                    {
                                        "lightness": 17
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    },
                                    {
                                        "lightness": 20
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 17
                                    }
                                ]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 29
                                    },
                                    {
                                        "weight": 0.2
                                    }
                                ]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 18
                                    }
                                ]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 16
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f5f5f5"
                                    },
                                    {
                                        "lightness": 21
                                    }
                                ]
                            },
                            {
                                "featureType": "poi.park",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#dedede"
                                    },
                                    {
                                        "lightness": 21
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.stroke",
                                "stylers": [
                                    {
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "lightness": 16
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.text.fill",
                                "stylers": [
                                    {
                                        "saturation": 36
                                    },
                                    {
                                        "color": "#333333"
                                    },
                                    {
                                        "lightness": 40
                                    }
                                ]
                            },
                            {
                                "elementType": "labels.icon",
                                "stylers": [
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "geometry",
                                "stylers": [
                                    {
                                        "color": "#f2f2f2"
                                    },
                                    {
                                        "lightness": 19
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative",
                                "elementType": "geometry.fill",
                                "stylers": [
                                    {
                                        "color": "#fefefe"
                                    },
                                    {
                                        "lightness": 20
                                    }
                                ]
                            },
                            {
                                "featureType": "administrative",
                                "elementType": "geometry.stroke",
                                "stylers": [
                                    {
                                        "color": "#fefefe"
                                    },
                                    {
                                        "lightness": 17
                                    },
                                    {
                                        "weight": 1.2
                                    }
                                ]
                            }
                        ]
                    });

                    map = new google.maps.Marker({
                        position: { lat: lat, lng: lng },
                        map: map,
                        animation: google.maps.Animation.DROP,
                        draggable: false,
                        icon: $map.data('marker')
                    });

                };
                initMap();
            };
        });

        // testimonial slider
        elementorFrontend.hooks.addAction('frontend/element_ready/safetestimonialslider.default',function($scope) {
            let $owlcarousel = $scope.find('.owl-carousel');
            if( $owlcarousel.length ) {
                $owlcarousel.owlCarousel({
                    items: $owlcarousel.data('owl-items'),
                    loop: $owlcarousel.data('owl-loop'),
                    smartSpeed: 450,
                    autoplay: $owlcarousel.data('owl-autoplay'),
                    autoplayTimeout: 8000,
                    nav: $owlcarousel.data('owl-nav'),
                    navText: ['<span><i class="fa fa-angle-left"></i></span>Prev', 'Next<span><i class="fa fa-angle-right"></i></span>'],
                    dots: false,
                    responsive: {"0":{"items": $owlcarousel.data('mi')},"992": {"items": $owlcarousel.data('di')}}
                });
            }
        });

    });
}(jQuery));
