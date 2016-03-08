define(['jquery', 'lodash'], function($, _) {
    var targetYear = "",
        targetMonth = "",
        objPathData = JSON.parse($('#data').html()),
        aryVocable = [];

    $('.target_year').click(function(e) {
        var domMonth = $('#month'),
            targetYear = $(e.currentTarget).html();

        $('#year').attr('value', targetYear);
        domMonth.empty();

        $('#btn_random_all').css('display', 'none');
        $('#btn_random_100').css('display', 'none');

        _.map(objPathData[targetYear], function(value, index) {
            domMonth
            .append('<li><h3 class="target_month">' + value + '</h3></li>')
            .append('<div class="clear_both"></div>');
        });

        domMonth.on('click', 'li > .target_month', function(e) {
            var targeYear = $('#year').attr('value');
                targetMonth = $(e.currentTarget).html();

            $.ajax({
                url: 'vocable.php?action=load&year=' + targetYear + '&month=' + targetMonth,
                type: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    aryVocable.length = 0;

                    _.map(data, function(value, index) {
                        aryVocable.push(value);
                    });

                    $('#btn_random_all').css('display', 'block');
                    $('#btn_random_100').css('display', 'block');
                    $('#total').html(aryVocable.length);
                }
            });
        });
    });

    $('#btn_random_all').click(function(e) {
        var domVocable = $('#vocable');

        domVocable.empty();
        aryVocable.sort(function(){ return 0.5 - Math.random(); });

        _.map(aryVocable, function(value, index) {
            var number = index + 1,
                strNumber = "";

            if (number < 10) {
                strNumber = "00" + number.toString();
            } else if (number < 100) {
                strNumber = "0" + number.toString();
            } else {
                strNumber = number;
            }

            domVocable
            .append('<li style="width: 50px;"><h2>' + strNumber + '.</h2></li>')
            .append('<li style="width: 300px;"><h2>' + value + '</h2></li>')
            .append('<li><input type="checkbox" class="w20 h20" id="number' + number + '"/></li>')
            .append('<li style="width: 10px;"></li>')
            .append('<li><input type="text" class="inp"></li>')
            .append('<div class="clear_both h10"></div>');
        });
    });

    $('#btn_random_100').click(function(e) {
        var domVocable = $('#vocable');

        domVocable.empty();
        aryVocable.sort(function(){ return 0.5 - Math.random(); });

        _.map(aryVocable, function(value, index) {
            var number = index + 1,
                strNumber = "";

            if (number > 100) {
                return false;
            }

            if (number < 10) {
                strNumber = "00" + number.toString();
            } else if (number < 100) {
                strNumber = "0" + number.toString();
            } else {
                strNumber = number;
            }

            domVocable
            .append('<li style="width: 50px;"><h2>' + strNumber + '.</h2></li>')
            .append('<li style="width: 300px;"><h2>' + value + '</h2></li>')
            .append('<li><input type="checkbox" class="w20 h20" id="number' + number + '"/></li>')
            .append('<li style="width: 10px;"></li>')
            .append('<li><input type="text" class="inp"></li>')
            .append('<div class="clear_both h10"></div>');
        });
    });
});
