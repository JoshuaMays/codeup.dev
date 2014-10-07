var now = moment();
console.log(now.calendar());

// Just return today's day
console.log(now.format('dddd'));

// Add a string inside
console.log(now.format('YYYY [escaped string] YYYY'));

// From now method
moment("20111031", "YYYYMMDD").fromNow();

// Number of hours from start of day
var startOf = now.startOf('day').fromNow();
console.log(startOf);

// Number of hours to end of day
var endOf = now.endOf('day').fromNow();
console.log(endOf);

// Start of current hour
var currentHour = moment().startOf('hour').fromNow();
console.log(currentHour);

// subtract days
var lastWeek = now.subtract(40, 'days').format('[the day was] dddd');
console.log(lastWeek);
