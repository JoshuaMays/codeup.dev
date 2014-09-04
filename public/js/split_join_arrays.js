// Create an array of the planets of the solar system.
var planets = ['Mercury', 'Venus', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'Uranus', 'Neptune'];

// Convert array of planets into string.
var planetsAsString = planets.join(' | ');
console.log(planetsAsString);

// Convert string of planets back into an array.
var planetsAsArray = planetsAsString.split(' | ');
console.log(planetsAsArray);
