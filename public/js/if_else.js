// var test = false;

// if(test) {
//     console.log('yay we got true!');
// } else {
//     console.log('ugh, it\'s false');
// }

// ignore these lines for now
// just know that the variable 'color' will end up with a random value from the colors array
var colors = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'];
var color = colors[Math.floor(Math.random()*colors.length)];

var favorite = 'violet'; // todo, change this to your favorite color from the list

// todo: Create a block of if/else statements to check for every color except indigo and violet.
// todo: When a color is encountered log a message that tells the color, and an object of that color.
//       Example: Blue is the color of the sky.
if (color == 'red') {
    console.log(color.toUpperCase() + ' is the color of a bloody lip.');
} else if (color == 'orange') {
    console.log(color.toUpperCase() + ' is the color of a well-groomed Orangutan.');
} else if (color == 'yellow') {
    console.log(color.toUpperCase() + ' is the color of that really creepy guy from Sin City.');
} else if (color == 'green') {
    console.log(color.toUpperCase() + ' is the color of a fruit that vitamin-c deficient sailors should really try to eat more often.');
} else if (color == 'blue') {
    console.log(color.toUpperCase() + ' is the color of the face of the man who didn\'t chew his food before swallowing.');
} else {
    console.log(color.toUpperCase() + ': I do not know anything by that color.');
}

// todo: Have a final else that will catch indigo and violet.
// todo: In the else, log: I do not know anything by that color.

// todo: Using the ternary operator, conditionally log a statement that
//       says whether the random color matches your favorite color.

var match = (color == favorite) ? console.log('YEAH, WE GOT A MATCH!') : console.log('No match. Like a better color.');
