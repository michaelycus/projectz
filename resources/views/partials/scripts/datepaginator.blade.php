<script>
    init.push(function () {
        var options = {
            selectedDateFormat: 'YYYY-MM-DD', // default
            onSelectedDateChanged: function(event, date) {
                $( "#published_at" ).val( date.format('YYYY-MM-DD') );
              }
          }

        if (! $('html').hasClass('ie8')) {
            $('#bs-datepaginator').datepaginator(options);
        } else {
            $('.ie8-note').attr('style', '');
        }
    });
</script>