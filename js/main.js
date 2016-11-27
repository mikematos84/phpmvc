(function($){

    var site_url = $('base').attr('href');
    $.getJSON(site_url + '/app/data/json/config.json').done(function(data){
        console.log(data);
    });

})(jQuery);
