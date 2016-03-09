$(function() {

    var apiEndpoint = $('base').attr('href') + 'api';

    function loadTemperatures(){

        var jqxhr = $.get( apiEndpoint,  function(data) {
        })
            .done(function(data) {
                loadMorris(data)
            });

    }

    loadTemperatures();

    function loadMorris(response) {

        Morris.Area({
            element: 'morris-area-chart',
            data: response ,
            xkey: 'date',
            ykeys: ['degree'],
            labels: ['Temp'],
            pointSize: 1,
            hideHover: 'auto',
            resize: true
        });
    }
});
