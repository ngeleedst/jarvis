$(function() {
    function loadTemperatures(){

        var jqxhr = $.get( "http://localhost/home-automation/web/api",  function(data) {
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
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });
    }
});
