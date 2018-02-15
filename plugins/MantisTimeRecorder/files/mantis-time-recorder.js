var clock, saveBtn, runBtn, saveDialog;
$(document).ready(function() {

    window.onbeforeunload = function(e) {
        var s = clock.time.getSeconds() - 1;
        if((clock.running || s > 0) && !saveDialog){
            //advise the user will lose tracking
           return "If you leave the page you will lose your time tracking. Are you sure?";
        }
        return null;
    };


    clock = $('.clock').FlipClock({
        clockFace: 'HourlyCounter',
        autoStart: false,
        callbacks: {
            create: function(){
                $('.btn-run, .btn-save').show();
            }
            //stop: function() {}
        }        
    });

    runBtn = $('.btn-run').click(function(){
        clock.running ? clock.stop() : clock.start();
        $(this).toggleClass('btn-success').toggleClass('btn-danger');
        $(this).find('span').eq(0).toggleClass('glyphicon-play').toggleClass('glyphicon-stop');
        $(this).find('span').eq(1).toggleClass('start-text').toggleClass('stop-text');
    });

    //$.post( "plugin.php?page=MantisTimeRecorder/start_record.php", { bug_id: "4508", text: "testamelo" } );
    function getModalForm(bid, h, m){
        var form = $('<form id="time-recorder-form" method="post" action="plugin.php?page=MantisTimeRecorder/bug_time_update.php">');
        var bugid = $('<input type="number" id="bug_id" name="bug_id" hidden>').val(bid);      
        var row = $('<div class="row">');
        var hours = $('<div class="form-group col-md-6">')
            .append($('<label for="time_hours">Hours:</label>'))
            .append($('<input id="time_hours" name="time_hours" min="0" type="number" class="form-control">').val(h).on('blur', valueCheck));
        var minutes = $('<div class="form-group col-md-6">')
            .append($('<label for="time_minutes">Minutes:</label>'))
            .append($('<input id="time_minutes" name="time_minutes" min="0" max="59" type="number" class="form-control">').val(m).on('blur', valueCheck));
        var comment = $('<div class="form-group">')
            .append($('<label for="time_comment">Comment:</label>'))
            .append($('<textarea id="time_comment" name="time_comment" rows="4" type="text" class="form-control">'));
        return form
            .append(bugid)
            .append(row
                .append(hours)
                .append(minutes))
            .append(comment);
        }
    
    saveBtn = $('.btn-save').click(function(){
        //1. stop the clock
        clock.stop();

        //2. get the clock values
        var bid=$(this).data('bugid');
        var totMins = clock.time.getMinutes();
        var h = Math.floor(totMins / 60);
        var m = (totMins == 0) ? 1 : totMins % 60; 
        
        //3. open the bootbox
        saveDialog = bootbox.dialog({
            title: 'Save Time',
            message: getModalForm(bid, h, m),
            buttons: {
                cancel: {
                    label: "Close",
                    className: 'btn-danger',
                    callback: function(){
                        saveDialog = null;
                    }
                },
                ok: {
                    label: "Save",
                    className: 'btn-success',
                    callback: function(){
                        clock.reset();
                        $(this).find('#time-recorder-form').submit();
                    }
                }
            }
            });
        
        //clock.reset(); // most probably not needed
    });
});

function valueCheck(input){
    var val = parseInt($(this).val()),
        min = parseInt($(this).attr('min')),
        max = parseInt($(this).attr('max'));
    if (min != NaN && val < min) $(this).val(min);
    if (max != NaN && val > max) $(this).val(max);
}