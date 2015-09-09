/**
 * Created by Dmitriy Kholoshevskiy on 03.08.2015.
 */
$ ( document ).ready(function(){
    $ ( '.datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
        //minDate:  new Date(1920, 1 - 1, 1),
        //maxDate:  new Date(2015, 1 - 1, 1),

    });
});