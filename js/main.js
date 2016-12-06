(function($){

    var site_url = $('base').attr('href');
    $.getJSON(site_url + '/app/config/app.json').done(function(data){
        console.log(data);
    });

})(jQuery);
