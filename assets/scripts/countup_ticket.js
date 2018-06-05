var globalContainer;

(function($) {
    $.fn.upCount = function(options, callback) {
        var settings = $.extend({
            startTime: null,
            offset: null,
            reset: null,
            resume: null
        }, options);

        // Save container
        var container = this;
        globalContainer = container.parent().html();

        /**
         * Change client's local date to match offset timezone
         * @return {Object} Fixed Date object.
         */
        var currentDate = function() {
            // get client's current date
            var date = new Date();

            // turn date to utc
            var utc = date.getTime() + (date.getTimezoneOffset() * 60000);

            // set new Date object
            var new_date = new Date(utc + (3600000 * settings.offset))

            return new_date;
        };

        // Are we resetting our counter?
        if(settings.reset){
            reset();
        }

        // Do we need to start our counter at a certain time if we left and came back?
        // if(settings.startTime){
        //     resumeTimer(new Date(settings.startTime));
        // }

        // Define some global vars
        var original_date = new Date();

        var target_date = new Date('12/31/2020 00:00:00'); // Count up to this date

        // Reset the counter by destroying the element it was bound to
        function reset() {
            var timerContainer = $('[name=timerContainer]');
            timerContainer.empty().append(globalContainer).find('.time').empty().append('00');
        }

        // // Given a start time, lets set the timer
        // function resumeTimer(startTime){
        //     alert('Resume Timer Needs to Start From StartTime  ' +startTime);
        //     // This takes the difference between the startTime provided and the current date.
        //     // If the difference was 4 days and 25 mins, thats where the timer would start from continuing to count up
        // }

        // Start the counter
        function countUp() {

            // Set our current date
            var current_date = new Date(); 
            
            // difference of dates
            var difference = current_date - new Date(settings.startTime);

            if (current_date >= target_date) {
                // stop timer
                clearInterval(interval);
                if (callback && typeof callback === 'function') callback();
                return;
            }

            // basic math variables
            var _second = 1000,
                _minute = _second * 60,
                _hour = _minute * 60,
                _day = _hour * 24;

            // calculate dates
            var days = Math.floor(difference / _day),
                hours = Math.floor((difference % _day) / _hour),
                minutes = Math.floor((difference % _hour) / _minute),
                seconds = Math.floor((difference % _minute) / _second);

            // fix dates so that it will show two digets
            days = (String(days).length >= 2) ? days : '0' + days;
            hours = (String(hours).length >= 2) ? hours : '0' + hours;
            minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
            seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;

            // based on the date change the refrence wording
            var ref_days = (days === 1) ? 'day' : 'days',
                ref_hours = (hours === 1) ? 'hour' : 'hours',
                ref_minutes = (minutes === 1) ? 'minute' : 'minutes',
                ref_seconds = (seconds === 1) ? 'second' : 'seconds';

            // set to DOM
            container.find('.days').text(days);
            container.find('.hours').text(hours);
            container.find('.minutes').text(minutes);
            container.find('.seconds').text(seconds);

            container.find('.days_ref').text(ref_days);
            container.find('.hours_ref').text(ref_hours);
            container.find('.minutes_ref').text(ref_minutes);
            container.find('.seconds_ref').text(ref_seconds);
        };

        // start
        interval = setInterval(countUp, 1000);
    };

})(jQuery);


// Resume our timer from a specific time
var create_date = $('#created_date').val();
console.log('create_date => '+create_date);
// $('.countup').upCount({startTime: "11/13/2017 09:30:37", resume: true});
$('.countup').upCount({startTime: create_date, resume: true});